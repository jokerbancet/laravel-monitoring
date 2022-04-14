<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pemagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DataLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datalaporan.index');
    }

    public function ajax()
    {
        $query = Laporan::select('id', 'id_data_bimbingan','tanggal_laporan','approve_industri','approve_industri_nilai','approve_dosen','approve_dosen2','status_laporan')->whereHas('mahasiswa', function($q){
            if(auth()->user()->role!='admin'){
                $jurusan = substr(auth()->user()->role, 0, 6);
                $jurusan = ltrim(auth()->user()->role, $jurusan);
                $q->where('jurusan', $jurusan);
            }
        })->whereHas('dosenPembimbing')->whereHas('dosenPembimbing2')->whereHas('pembimbingIndustri')->with([
            'mahasiswa'=>function($q){ $q->select('nama'); },
            'dosenPembimbing'=>function($q){ $q->select('nama'); },
            'dosenPembimbing2'=>function($q){ $q->select('nama'); },
            'pembimbingIndustri'=>function($q){ $q->select('industri_id','nama'); },
            'pembimbingIndustri.industri'=>function($q){ $q->select('industri.id','nama_industri'); },
        ])->orderBy('created_at', 'desc')->get();
        
        $dt = new DataTables();
        return $dt->collection($query)
            ->addColumn('approve_industri', function($d){
                return "<span class='label ".cek_status($d->approve_industri,1.)."'>$d->approve_industri | $d->approve_industri_nilai</span>";
            })
            ->addColumn('approve_dospem1', function($d){
                return  '<span class="label '.cek_status($d->approve_dosen,1).'">'.$d->approve_dosen.'</span>';
            })
            ->addColumn('approve_dospem2', function($d){
                return '<span class="label '.cek_status($d->approve_dosen2,1).'">'.$d->approve_dosen2.'</span>';
            })
            ->addColumn('status_laporan', function($d){
                return '<span class="label '.cek_status($d->status_laporan,2).'">'.$d->status_laporan.'</span>';
            })
            ->escapeColumns([])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pemagangs = Pemagangan::whereHas('mahasiswa', function($q){
            if(auth()->user()->role!='admin'){
                $jurusan = substr(auth()->user()->role, 0, 6);
                $jurusan = ltrim(auth()->user()->role, $jurusan);
                $q->where('jurusan', $jurusan);
            }
        })->get();
        return view('datalaporan.create', compact('pemagangs'));
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
            'id_data_bimbingan' => 'required',
            'tanggal_laporan' => 'required|date',
            'kegiatan_pekerjaan' => 'required',
            'deskripsi_pekerjaan' => 'required',
            'output' => 'required',
            'durasi' => 'required',
            'capaian_id' => 'required'
        ]);

        Laporan::create($validate);

        return back()->with('sukses', 'Laporan berhasil diinput.');
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
