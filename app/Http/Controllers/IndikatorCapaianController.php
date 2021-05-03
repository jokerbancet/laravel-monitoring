<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIndikatorCapaianRequest;
use App\Http\Requests\EditIndikatorCapaianRequest;
use App\Models\IndikatorCapaian;
use Illuminate\Http\Request;

class IndikatorCapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = IndikatorCapaian::all();
        return view('capaian.index', ['capaian' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateIndikatorCapaianRequest $request)
    {
        IndikatorCapaian::create($request->all());
        return redirect('/capaian')->with('sukses','Data Berhasil di input');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = IndikatorCapaian::find($id);
        return view('capaian.edit', ['capaian' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditIndikatorCapaianRequest $request, $id)
    {
        $data = IndikatorCapaian::find($id);
        $data->update($request->all());
        // dd($data);
        return redirect('/capaian')->with('sukses','Data Berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = IndikatorCapaian::find($id);
        $data->delete($id);
        return redirect('/capaian')->with('sukses','Data Berhasil di hapus');
    }
}
