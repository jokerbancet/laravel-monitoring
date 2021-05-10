<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMahasiswaRequest;
use App\Http\Requests\EditMahasiswaRequest;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Str;
use Validator;
use DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('cari')){
        //     $data_mahasiswa = Mahasiswa::where('nama_depan', 'LIKE','%'.$request->cari.'%')->get();
        // }else{
        // }
        $data_mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', ['data_mahasiswa' => $data_mahasiswa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateMahasiswaRequest $request)
    {
        //inisialisasi store data user
        $user = new \App\Models\User;
        $user->role = 'mahasiswa';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('passwordmahasiswa');
        $user->remember_token = Str::random(60);
        $user->save();

        //add user_id
        $request->request->add(['user_id' => $user->id]);
        //store data ke tabel mahasiswa
        $mahasiswa = Mahasiswa::create($request->all());
        //pengecekan gambar dan mengalihkan gambar ke folder images
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $mahasiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $mahasiswa->save();
        }
        return redirect('/mahasiswa')->with('sukses','Data Berhasil di input');
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
    public function detail($id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.detail', ['mahasiswa' => $data_mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.edit', ['mahasiswa' => $data_mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditMahasiswaRequest $request, $id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        $data_mahasiswa->update($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $data_mahasiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $data_mahasiswa->save();
        }
        return redirect('/mahasiswa')->with('sukses','Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data_mahasiswa = Mahasiswa::find($id);
        $email = $data_mahasiswa->email;
        User::where('email', $email)->delete();
        $data_mahasiswa->delete($id);
        return redirect('/mahasiswa')->with('sukses','Data Berhasil di hapus');
    }
}
