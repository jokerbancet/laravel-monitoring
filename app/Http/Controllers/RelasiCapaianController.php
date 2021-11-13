<?php

namespace App\Http\Controllers;

use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelasiCapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemagang=Pemagangan::all();;
        return view('relasi.index', compact('pemagang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pemagangan $pemagang)
    {
        $pemagang->kompetensi->map(function($data){
            return $data->capaian;
        });
        $pemagang->mahasiswa;
        return request()->ajax()?response()->json($pemagang):abort(403, 'permintaan harus ajax');
    }

    public function print(Pemagangan $pemagang)
    {
        if($pemagang->selesai_magang>=date('Y-m-d')){
            abort(403, 'Maaf mahasiswa ini belum selesai magang');
        }
        $nilai = $pemagang->laporan()->where('status_laporan', 'approve')->selectRaw('sum(approve_dosen) as dospem1, sum(approve_dosen2) as dospem2, sum(approve_industri_nilai) as pembid')->first();
        $nilai_akhir = ($nilai->dospem1*30/100)+($nilai->dospem2*30/100)+($nilai->pembid*40/100);
        $capaian = $pemagang->kompetensi()->select('created_at', 'capaian_id', DB::raw('count(*) as total'))->groupBy('capaian_id')->get();
        // dd($capaian);
        $pdf = \PDF::loadView('pdf.index',compact('pemagang', 'capaian', 'nilai_akhir'))->setPaper('a4','landscape');
        return $pdf->stream("Hasil Laporan ".$pemagang->mahasiswa->nama.".pdf");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
