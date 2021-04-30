<?php

namespace App\Http\Controllers;

use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemaganganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil data_bimbingan untuk tabel
        $data_pemagangan = DB::table('data_bimbingan')
        ->join('mahasiswa', 'data_bimbingan.mahasiswa_id', '=', 'mahasiswa.id')
        ->select('data_bimbingan.*', 'mahasiswa.*')
        ->get();

        //ambil data nama mahasiswa
        $data1 = DB::table('mahasiswa')
        ->select('id', 'nama')
        ->get();

        //ambil data nama dosen pembimbing
        $data2 = DB::table('dosenpembimbing')
        ->select('id', 'nama')
        ->get();

        //ambil data nama pembimbing industri
        $data3 = DB::table('pembimbingindustri')
        ->select('id', 'nama_depan')
        ->get();

        return view('pemagangan.index', [
            'pemagangan' => $data_pemagangan,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        //masukan data ke dalam database
        Pemagangan::create($request->all());
        return redirect('/pemagangan')->with('sukses','Data Berhasil di input');
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
