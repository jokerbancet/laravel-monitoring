<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

class PersetujuanController extends Controller
{
    public function index()
    {
        $clause = auth()->user()->role == 'dosenpembimbing' ?
            ['dosenpembimbing_id' => auth()->user()->dosenPembimbing->id] :
            ['pembimbingindustri_id' => auth()->user()->pembimbingIndustri->id];
        $mahasiswa = Pemagangan::where($clause);
        if (Gate::allows('dosenpembimbing')) {
            $mahasiswa->orWhere(['dosenpembimbing2_id' => auth()->user()->dosenPembimbing->id]);
        }
        $mahasiswa->with(['laporan' => function ($laporan) {
            $laporan->where('status_laporan', 'pending');
        }])->withCount(['laporan as laporan_count' => function ($laporan) {
            $laporan->where('status_laporan', 'pending');
        }]);

        if (request()->is('persetujuan')) {
            $title = 'Data Laporan Mahasiswa';
            $action = '/persetujuan/mhs/';
            $mahasiswa = $mahasiswa->having('laporan_count', '>', 0)->get();
        } else {
            $title = 'Data Histori Laporan Mahasiswa';
            $action = '/histori-approval/';
            $mahasiswa = $mahasiswa->get();
        }
        return view('persetujuan.index', compact('mahasiswa', 'title', 'action'));
    }

    public function mahasiswa(Pemagangan $mahasiswa)
    {
        $is_dosen1 = $mahasiswa->dosenPembimbing2 != auth()->user()->dosenPembimbing && auth()->user()->dosenPembimbing;
        $is_dosen2 = $mahasiswa->dosenPembimbing2 == auth()->user()->dosenPembimbing;
        $laporan_dinilai = $mahasiswa->laporan->filter(function ($laporan) {
            return Gate::allows('status-laporan', $laporan);
        })->count();
        $laporan_belum_dinilai = $mahasiswa->laporan->filter(function ($laporan) {
            return !Gate::allows('status-laporan', $laporan);
        })->count();
        return view('persetujuan.mahasiswa', compact('mahasiswa', 'is_dosen1', 'is_dosen2', 'laporan_dinilai', 'laporan_belum_dinilai'));
    }

    public function show(Request $request, Laporan $laporan)
    {
        $laporan->mahasiswa->pemagangan;
        return $request->ajax() ? response()->json($laporan) : abort(403, 'Permintaan harus ajax');
    }

    public function approve(Request $request, Laporan $laporan)
    {
        $validation = [];
        $pemagangan = $laporan->pemagangan;
        if (auth()->user()->pembimbingIndustri) {
            $validation['approve_industri_nilai'] = 'required|numeric|min:0|max:100';
        } else {
            if ($pemagangan->dosenPembimbing2 == auth()->user()->dosenPembimbing) {
                $validation['approve_dosen2'] = 'required|numeric|min:0|max:100';
            } else {
                $validation['approve_dosen'] = 'required|numeric|min:0|max:100';
            }
        }
        $request->validate($validation);
        $laporan->update($request->toArray());
        if ($laporan->approve_dosen !== 'pending' && $laporan->approve_dosen2 !== 'pending' && $laporan->approve_industri !== 'pending') {
            $laporan->update(['status_laporan' => 'approve']);
        }

        $redirect = back();
        return $redirect->with('sukses', 'Laporan telah diapprove');
    }

    public function histori_approval(Pemagangan $mahasiswa)
    {
        return view('persetujuan.histori-approval', compact('mahasiswa'));
    }

    public function rekap()
    {
        $mahasiswa = Mahasiswa::with('pemagangans','pemagangans.pembimbingIndustri.industri')->whereHas('pemagangans.pembimbingIndustri.industri', function($q){
            $q->where('id', auth()->user()->pembimbingIndustri->industri->id);
        })->withCount(['laporans as laporan_count'=>function($laporan){
            return $laporan->where('status_laporan','pending');
        }])->having('laporan_count','>',0)->get();
        return view('laporan.rekap', compact('mahasiswa'));
    }

    public function rekap_show(Mahasiswa $mahasiswa)
    {
        $prakerin1 = $mahasiswa->pemagangans->where('prakerin_ke', 1)->first()->laporan??[];
        $prakerin2 = $mahasiswa->pemagangans->where('prakerin_ke', 2)->first()->laporan??[];
        // dd($prakerin1,$prakerin2);
        return view('laporan.rekap-show', compact('mahasiswa','prakerin1','prakerin2'));
    }
}
