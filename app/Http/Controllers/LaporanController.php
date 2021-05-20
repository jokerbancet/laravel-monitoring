<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
use Carbon\Carbon;
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
        // $id_user = auth()->user()->id;

        //ambil id data mahasiswa sedang login
        // $id_data_mahasiswa = DB::table('mahasiswa')
        // ->select('*')
        // ->where('mahasiswa.user_id', '=', $id_user)
        // ->value('id'); gini aja cukup kang
        $mahasiswa = auth()->user()->mahasiswa;

        //ambil data master_capaian
        $data = DB::table('master_capaian')->where('jurusan',$mahasiswa->jurusan)->get();

        // Hari yang dikecualikan untuk laporan ['sabtu','minggu'];
        $excepted_days=['Sat','Sun'];
        $this_day=date('D');
        $hari_libur=in_array($this_day,$excepted_days);

        // Cek apakah hari ini sudah melakukan laporan apa belum
        $hasLaporanToday=!is_null(auth()->user()->mahasiswa->pemagangan)?
                    Laporan::where('id_data_bimbingan',auth()->user()->mahasiswa->pemagangan->id)
                            ->whereDate('tanggal_laporan', '=', date('Y-m-d'))->first()
                    :null;

        // Cek apakah si user nya sudah melewati masa akhir magang
        $masa_magang=!is_null($hasLaporanToday)?Pemagangan::where('mahasiswa_id',auth()->user()->mahasiswa->id)
                                ->whereDate('mulai_magang','<=',date('Y-m-d'))
                                ->whereDate('selesai_magang','>=',date('Y-m-d'))->first():null;

        // dd($data_bimbingan2); lebih indah pake compact
        // return view('laporan.index', ['data' => $data]);
        return view('laporan.index', compact('data','hari_libur','hasLaporanToday','masa_magang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $id_user = auth()->user()->id;

        // $laporan = new \App\Models\laporan;
        // $laporan->id_data_kompetensi = $id_user; //kok id user? bukanya id yang di data kompetensi?
        // $laporan->kegiatan_pekerjaan = $request->kegiatan_pekerjaan;
        // $laporan->deskripsi_pekerjaan = $request->deskripsi_pekerjaan;
        // $laporan->durasi = $request->durasi;
        // $laporan->output = $request->output;
        // $laporan->approve_dosen = 'pending';
        // $laporan->approve_industri = 'pending';
        // $laporan->status_laporan = 'pending';
        // $laporan->save();
        Laporan::create(collect($request)->put('id_data_bimbingan',auth()->user()->mahasiswa->pemagangan->id)->toArray()); //Cuma sebaris kang

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
