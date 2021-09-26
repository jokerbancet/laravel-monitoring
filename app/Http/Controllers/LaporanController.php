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
        $mahasiswa = auth()->user()->mahasiswa;

        //ambil data master_capaian
        $data = DB::table('master_capaian')->where('jurusan',$mahasiswa->jurusan)->get();

        // Hari yang dikecualikan untuk laporan ['sabtu','minggu'];
        $is_enabled = json_decode(DB::table('settings')->where('key', 'laporan_weekend')->first()->value)->is_enabled;
        $excepted_days = [];
        if($is_enabled!='true'){
            $excepted_days=['Sat','Sun'];
        }
        $this_day=date('D');
        $hari_libur=in_array($this_day,$excepted_days);
        // Cek apakah hari ini sudah melakukan 2x laporan apa belum
        $hasLaporanToday=!is_null(auth()->user()->mahasiswa->pemagangan)?
                    Laporan::where('id_data_bimbingan',auth()->user()->mahasiswa->pemagangan->id)
                            ->whereDate('created_at', '=', date('Y-m-d'))->get()
                    :collect([]);
        // $hasLaporanToday=!is_null(auth()->user()->mahasiswa->pemagangan)?
        //             Laporan::where('id_data_bimbingan',auth()->user()->mahasiswa->pemagangan->id)
        //                     ->whereDate('tanggal_laporan', '=', date('Y-m-d'))->first()
        //             :null;

        // Cek apakah si user nya sudah melewati masa akhir magang
        $masa_magang=Pemagangan::where('mahasiswa_id',auth()->user()->mahasiswa->id)
                                ->whereDate('mulai_magang','<=',date('Y-m-d'))
                                ->whereDate('selesai_magang','>=',date('Y-m-d'))->first();

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
    public function history()
    {
        $laporan = auth()->user()->pemagang?Laporan::where('id_data_bimbingan',auth()->user()->pemagang->id)->get():null;
        return view('laporan.histori',compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        //ambil data master_capaian
        $data = DB::table('master_capaian')->where('jurusan',$mahasiswa->jurusan)->get();

        $id_data_mahasiswa = auth()->user()->pemagang?auth()->user()->pemagang->id:0;
        $laporan = Laporan::where('id_data_bimbingan', $id_data_mahasiswa)
                   ->where('id',$id)->firstOrFail();
        return $request->ajax()?response()->json($laporan):view('laporan.edit',compact('laporan','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $id)
    {
        $id->update($request->all());
        return redirect('/laporan')->with('sukses', 'Laporan berhasi diperbarui.');
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
