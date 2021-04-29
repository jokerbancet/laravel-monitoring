<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use Illuminate\Http\Request;
use App\Http\Requests\CreateIndustriRequest;
use App\Http\Requests\EditIndustriRequest;


class IndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_industri = Industri::all();
        return view('industri.index', ['industri' => $data_industri]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateIndustriRequest $request)
    {
        Industri::create($request->all());
        return redirect('/industri')->with('sukses','Data Berhasil di input');
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
        $data_industri = Industri::find($id);
        return view('industri.edit', ['industri' => $data_industri]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditIndustriRequest $request, $id)
    {
        $data_industri = Industri::find($id);
        $data_industri->update($request->all());
        return redirect('/industri')->with('sukses','Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data_industri = Industri::find($id);
        $data_industri->delete($id);
        return redirect('/industri')->with('sukses','Data Berhasil di hapus');
    }
}
