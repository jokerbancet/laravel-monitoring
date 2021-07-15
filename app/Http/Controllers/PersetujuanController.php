<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersetujuanController extends Controller
{
    public function index()
    {
        $clause=auth()->user()->role=='dosenpembimbing'?
                ['dosenpembimbing_id'=>auth()->user()->dosenPembimbing->id]:
                ['pembimbingindustri_id'=>auth()->user()->pembimbingIndustri->id];
        $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
            return $laporan->where('status_laporan','pending')->get();
        }])->where($clause);
        if(auth()->user()->role=='dosenpembimbing'){
            $mahasiswa->orWhere(['dosenpembimbing2_id'=>auth()->user()->dosenPembimbing->id]);
        }
        $mahasiswa=$mahasiswa->get();

        return view('persetujuan.index', compact('mahasiswa'));
    }

    public function show(Request $request,Laporan $laporan)
    {
        $laporan->mahasiswa->pemagangan;
        return $request->ajax()?response()->json($laporan):abort(403,'Permintaan harus ajax');
    }

    public function approve(Request $request, Laporan $laporan)
    {
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
        $clause=auth()->user()->role=='dosenpembimbing'?
                ['dosenpembimbing_id'=>auth()->user()->dosenPembimbing->id]:
                ['pembimbingindustri_id'=>auth()->user()->pembimbingIndustri->id];
        $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
            return $laporan->where('status_laporan','approve')->get();
        }])->where($clause)->get();

        // dd($mahasiswa);
        return view('persetujuan.histori-approval', compact('mahasiswa'));
    }
}
