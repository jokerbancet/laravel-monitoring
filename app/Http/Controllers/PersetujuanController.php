<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Gate;

class PersetujuanController extends Controller
{
    public function index()
    {
        if(Gate::allows('hrd')){
            $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
                return $laporan->where('status_laporan','pending')->get();
            }])->whereHas('pembimbingIndustri', function($q){
                return $q->where('industri_id', auth()->user()->pembimbingIndustri->industri_id);
            });
        }else{
            $clause=auth()->user()->role=='dosenpembimbing'?
                    ['dosenpembimbing_id'=>auth()->user()->dosenPembimbing->id]:
                    ['pembimbingindustri_id'=>auth()->user()->pembimbingIndustri->id];
            $mahasiswa = Pemagangan::where($clause);
            if(Gate::allows('dosenpembimbing')){
                $mahasiswa->orWhere(['dosenpembimbing2_id'=>auth()->user()->dosenPembimbing->id]);
            }
            $mahasiswa->with(['laporan'=>function($q){
                if(Gate::allows('dosenpembimbing')){
                    $q->where('approve_dosen', 'pending');
                }else{
                    $q->where('approve_industri','pending');
                }
            }])->withCount(['laporan as laporan_count'=> function($laporan){
                if(Gate::allows('dosenpembimbing')){
                    // $pemagangan = Pemagangan::whereHas('laporan',function($q)use($laporan){
                    //     $q->where('id', $laporan->id);
                    // })->first();
                    // $dospem_id = auth()->user()->dosenPembimbing->id;
                    // if($pemagangan->dosenpembimbing_id==$dospem_id){
                    //     $laporan->where('approve_dosen','pending');
                    // }else{
                    //     $laporan->where('approve_dosen2', 'pending');
                    // }
                    $laporan->where('approve_dosen', 'pending');
                }else{
                    $laporan->where('approve_industri','pending');
                }
            }]);
        }

        if(request()->is('persetujuan')){
            $title = 'Data Laporan Mahasiswa';
            $action = '/persetujuan/mhs/';
            $mahasiswa=$mahasiswa->having('laporan_count', '>', 0)->get()->filter(function($p){
                if(Gate::allows('dosenpembimbing')){
                    if($p->dosenpembimbing_id==auth()->user()->dosenPembimbing->id){
                        return $p->laporan->where('approve_dosen', 'pending')->count()>0;
                    }else{
                        return $p->laporan->where('approve_dosen2', 'pending')->count()>0;
                    }
                }
                return true;
            });
        }else{
            $title = 'Data Histori Laporan Mahasiswa';
            $action = '/histori-approval/';
            $mahasiswa=$mahasiswa->get();
        }
        return view('persetujuan.index', compact('mahasiswa', 'title', 'action'));
    }

    public function mahasiswa(Pemagangan $mahasiswa)
    {
        $is_dosen1 = $mahasiswa->dosenPembimbing2!=auth()->user()->dosenPembimbing&&auth()->user()->dosenPembimbing;
        $is_dosen2 = $mahasiswa->dosenPembimbing2==auth()->user()->dosenPembimbing;
        $laporan_dinilai = $mahasiswa->laporan->filter(function($laporan){
            return Gate::allows('status-laporan', $laporan);
        })->count();
        $laporan_belum_dinilai = $mahasiswa->laporan->filter(function($laporan){
            return !Gate::allows('status-laporan', $laporan);
        })->count();
        return view('persetujuan.mahasiswa', compact('mahasiswa', 'is_dosen1', 'is_dosen2', 'laporan_dinilai', 'laporan_belum_dinilai'));
    }

    public function show(Request $request,Laporan $laporan)
    {
        $laporan->mahasiswa->pemagangan;
        return $request->ajax()?response()->json($laporan):abort(403,'Permintaan harus ajax');
    }

    public function approve(Request $request, Laporan $laporan)
    {
        $validation = [];
        $pemagangan = $laporan->pemagangan;
        if(auth()->user()->pembimbingIndustri){
            $validation['approve_industri_nilai'] = 'required|numeric|min:0|max:100';
        }else{
            if($pemagangan->dosenPembimbing2==auth()->user()->dosenPembimbing){
                $validation['approve_dosen2'] = 'required|numeric|min:0|max:100';
            }else{
                $validation['approve_dosen'] = 'required|numeric|min:0|max:100';
            }
        }
        $request->validate($validation);
        $laporan->update($request->toArray());
        if($laporan->approve_dosen!=='pending'&&$laporan->approve_dosen2!=='pending'&&$laporan->approve_industri!=='pending'){
            $laporan->update(['status_laporan'=>'approve']);
            DB::table('data_kompetensi')->insert([
                'mahasiswa_id'=>$laporan->mahasiswa->id,
                'jurusan'=>$laporan->mahasiswa->jurusan,
                'capaian_id'=>$laporan->capaian_id,
                'created_at'=>now()
            ]);
        }

        $redirect = back();
        if($pemagangan->dosenPembimbing==auth()->user()->pembimbingIndustri){
            if($pemagangan->laporan->where('approve_industri', 'pending')->count()<1) $redirect = redirect('persetujuan');
        }elseif($pemagangan->dosenPembimbing==auth()->user()->dosenPembimbing){
            if($pemagangan->laporan->where('approve_dosen', 'pending')->count()<1) $redirect = redirect('persetujuan');
        }elseif($pemagangan->dosenPembimbing2==auth()->user()->dosenPembimbing2){
            if($pemagangan->laporan->where('approve_dosen2', 'pending')->count()<1) $redirect = redirect('persetujuan');
        }
        return $redirect->with('sukses', 'Laporan telah diapprove');
    }

    public function histori_approval(Pemagangan $mahasiswa){
        return view('persetujuan.histori-approval', compact('mahasiswa'));
    }
}
