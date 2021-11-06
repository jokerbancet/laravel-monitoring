<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePembimbingIndustriRequest;
use App\Http\Requests\EditPembimbingIndustriRequest;
use App\Models\PembimbingIndustri;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class HrdController extends Controller
{
    public function index()
    {

        //ambil data nama pembimbing industri
        $industries = DB::table('industri')
        ->select('id', 'nama_industri')
        ->get();

        $hrds = PembimbingIndustri::where('is_hrd', 1)->get();

        return view('hrd.index', compact('hrds', 'industries'));
    }
    public function detail($id)
    {
        $dpi = PembimbingIndustri::find($id);
        return view('hrd.detail', ['dpi' => $dpi]);
    }

    public function store(CreatePembimbingIndustriRequest  $request)
    {
        $user = new \App\Models\User;
        $user->role = 'pembimbingindustri';
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = bcrypt('passwordhrd');
        $user->remember_token = Str::random(60);
        $user->save();

        $request->request->add(['user_id' => $user->id, 'is_hrd'=>1]);
        $mahasiswa = PembimbingIndustri::create($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $mahasiswa->avatar = $request->file('avatar')->getClientOriginalName();
            $mahasiswa->save();
        }
        return redirect('/hrd')->with('sukses','Data Berhasil di input');
    }
    public function edit($id)
    {
        $dpi = PembimbingIndustri::find($id);
        return view('hrd.edit', ['dpi' => $dpi]);
    }

    public function update(EditPembimbingIndustriRequest $request, $id)
    {
        $dpi = PembimbingIndustri::find($id);
        $dpi->update($request->all());
        if($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $dpi->avatar = $request->file('avatar')->getClientOriginalName();
            $dpi->save();
        }
        return redirect('/hrd')->with('sukses','Data Berhasil di update');
    }

    public function delete($id)
    {
        $dpi = PembimbingIndustri::find($id);
        $email = $dpi->email;
        User::where('email', $email)->delete();
        $dpi->delete($id);
        return redirect('/hrd')->with('sukses','Data Berhasil di hapus');
    }
}
