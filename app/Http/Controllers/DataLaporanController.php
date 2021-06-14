<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datalaporan = DB::table('data_laporan')
        // ->join('mahasiswa', 'data_laporan.id_data_kompetensi' , '=', 'mahasiswa.user_id')
        // ->select('mahasiswa.nama','mahasiswa.jurusan', 'data_laporan.tanggal_laporan', 'data_laporan.kegiatan_pekerjaan', 'data_laporan.deskripsi_pekerjaan', 'data_laporan.durasi', 'data_laporan.output', 'data_laporan.approve_dosen', 'data_laporan.approve_industri', 'data_laporan.status_laporan')
        // ->get();
        $data=Laporan::all();
        // dd($data);
        return view('datalaporan.index', compact('data'));
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
