<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDosenPembimbingRequest;
use App\Http\Requests\EditDosenPembimbingRequest;
use Illuminate\Support\Str;

class DosenPembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_dosen = DosenPembimbing::all();
        return view('dosenpembimbing.index', ['data_dosen' => $data_dosen]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateDosenPembimbingRequest $request)
    {
        $user = new \App\Models\User;
        $user->role = 'dosenpembimbing';
        $user->name = $request->nama_depan . ' ' . $request->nama_belakang;
        $user->email = $request->email;
        $user->password = bcrypt('passworddosen');
        $user->remember_token = Str::random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id]);
        $mahasiswa = DosenPembimbing::create($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $mahasiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $mahasiswa->save();
        }
        return redirect('/dosenpembimbing')->with('sukses','Data Berhasil di input');
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
        $data_dosen = DosenPembimbing::find($id);
        return view('dosenpembimbing.detail', ['dosen' => $data_dosen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_dosen = DosenPembimbing::find($id);
        return view('dosenpembimbing.edit', ['dosen' => $data_dosen]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDosenPembimbingRequest $request, $id)
    {
        $data_dosen = DosenPembimbing::find($id);
        $data_dosen->update($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $data_dosen->avatar = $request->file('avatar')->getClientOriginalName();
            $data_dosen->save();
        }
        return redirect('/dosenpembimbing')->with('sukses','Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data_dosen = DosenPembimbing::find($id);
        $email = $data_dosen->email;
        User::where('email', $email)->delete();
        $data_dosen->delete($id);
        return redirect('/dosenpembimbing')->with('sukses','Data Berhasil di hapus');
    }
}
