<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereNotIn('role', ['admin','pembimbingindustri','dosenpembimbing','mahasiswa'])->get();
        return view('user.index',compact('users'));
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
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:6'
        ]);
        $validate['password'] = bcrypt($validate['password']);
        User::create($validate);
        return redirect('user')->with('sukses', 'Data User berhasil ditambahkan');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'role' => 'required',
            'password' => 'nullable|min:6'
        ]);
        if(!is_null($validate['password'])){
            // unset($validate['password']);
            $validate['password'] = bcrypt($validate['password']);
        }
        $user->update($validate);
        return redirect('user')->with('sukses', 'Data User berhasil diedit');
    }

    public function reset_password(Request $request, User $user)
    {
        switch($user->role){
            case 'mahasiswa': 
                $password = 'passwordmahasiswa';
                $url = 'mahasiswa';
                break;
            case 'dosenpembimbing':
                $password = 'passworddosen';
                $url = 'dosenpembimbing';
                break;
            case 'pembimbingindustri':
                if($user->pembimbingIndustri->is_hrd){
                    $password = 'passworddpi';
                    $url = 'pembimbingindustri';
                }else{
                    $password = 'passwordhrd';
                    $url = 'hrd';
                }
                break;
            default:
                $password = '123456';
                break;
        }
        $user->update([
            'password' => bcrypt($password)
        ]);
        return $request->ajax()?response()->json('Password '.$user->name.' berhasil direset')
            :back()->with('sukses','Password '.$user->name.' berhasil direset');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('sukses', 'Data User berhasil dihapus');
    }
}
