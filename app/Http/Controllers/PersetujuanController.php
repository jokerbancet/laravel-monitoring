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
            $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
                return $laporan->where('status_laporan','pending')->get();
            }])->where($clause);
        }
        if(auth()->user()->role=='dosenpembimbing'){
            $mahasiswa->orWhere(['dosenpembimbing2_id'=>auth()->user()->dosenPembimbing->id]);
        }
        $mahasiswa=$mahasiswa->get();
        return view('persetujuan.index', compact('mahasiswa'));
    }

    public function mahasiswa(Pemagangan $mahasiswa)
    {
        $is_dosen1 = $mahasiswa->dosenPembimbing2!=auth()->user()->dosenPembimbing&&auth()->user()->dosenPembimbing;
        $is_dosen2 = $mahasiswa->dosenPembimbing2==auth()->user()->dosenPembimbing;
        return view('persetujuan.mahasiswa', compact('mahasiswa', 'is_dosen1', 'is_dosen2'));
    }

    public function show(Request $request,Laporan $laporan)
    {
        $laporan->mahasiswa->pemagangan;
        return $request->ajax()?response()->json($laporan):abort(403,'Permintaan harus ajax');
    }

    public function approve(Request $request, Laporan $laporan)
    {
        $validation = [];
        if(auth()->user()->pembimbingIndustri){
            $validation['approve_industri_nilai'] = 'required|numeric|min:0|max:100';
        }else{
            if($laporan->pemagangan->dosenPembimbing2==auth()->user()->dosenPembimbing){
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
        return back()->with('sukses', 'Laporan telah diapprove');
    }

    public function historiApproval(){
        $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
            return $laporan->where('status_laporan','approve')->get();
        }]);
        if(auth()->user()->role=='dosenpembimbing'){
            $dosen_id = auth()->user()->dosenPembimbing->id;
            $mahasiswa = $mahasiswa->where('dosenpembimbing_id', $dosen_id)->orWhere('dosenpembimbing2_id', $dosen_id);
        }else{
            $mahasiswa = $mahasiswa->where('pembimbingindustri_id', auth()->user()->pembimbingIndustri->id);
        }
        $mahasiswa = $mahasiswa->get();
        return view('persetujuan.histori-approval', compact('mahasiswa'));
    }
}
