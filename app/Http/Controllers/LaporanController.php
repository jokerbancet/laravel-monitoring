<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil id user sedang login
        $id_user = auth()->user()->id;

        //ambil id data mahasiswa sedang login
        $id_data_mahasiswa = DB::table('mahasiswa')
        ->select('*')
        ->where('mahasiswa.user_id', '=', $id_user)
        ->value('id');

        //ambil data master_capaian
        $data = DB::table('master_capaian')
        ->select('*')
        ->get();

        // dd($data_bimbingan2);
        return view('laporan.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_user = auth()->user()->id;

        $laporan = new \App\Models\laporan;
        $laporan->id_data_kompetensi = $id_user;
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
