<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pemagangan = DB::table('data_bimbingan')
        ->join('mahasiswa', 'data_bimbingan.mahasiswa_id', '=', 'mahasiswa.id')
        ->select('data_bimbingan.id', 'data_bimbingan.mahasiswa_id','data_bimbingan.mulai_magang', 'data_bimbingan.selesai_magang','data_bimbingan.jenis_pekerjaan', 'mahasiswa.nama','mahasiswa.jurusan')
        ->get();

        return view('laporan.index', [
            'data' => $data_pemagangan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $laporan = new \App\Models\laporan;
        $laporan->kegiatan_pekerjaan = $request->kegiatan_pekerjaan;
        $laporan->deskripsi_pekerjaan = $request->deskripsi_pekerjaan;
        $laporan->durasi = $request->durasi;
        $laporan->output = $request->output;
        $laporan->approve_dosen = 'pending';
        $laporan->approve_industri = 'pending';
        $laporan->status_laporan = 'pending';
        $laporan->save();

        return redirect('/laporan')->with('sukses','Data Berhasil di input');
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
    public function show($id)
    {
        //
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
