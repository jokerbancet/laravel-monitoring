<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersetujuanController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user()->dosenPembimbing->mahasiswa??auth()->user()->pembimbingIndustri->mahasiswa;
        // dd($mahasiswa[0]->laporan);

        return view('persetujuan.index', compact('mahasiswa'));
    }

    public function show(Request $request,Laporan $laporan)
    {
        $laporan->mahasiswa;
        return $request->ajax()?response()->json($laporan):abort(403,'Permintaan harus ajax');
    }

    public function approve(Request $request, Laporan $laporan)
    {
        $laporan->update($request->toArray());
        if($laporan->approve_dosen!=='pending'&&$laporan->approve_industri!=='pending'){
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
}
