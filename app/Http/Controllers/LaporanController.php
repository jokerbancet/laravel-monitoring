<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use App\Http\Requests\LaporanRequest;

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
        $pemagang = auth()->user()->pemagang;

        //ambil data master_capaian
        $data = DB::table('master_capaian')->where('jurusan',$mahasiswa->jurusan)->get();

        // Hari yang dikecualikan untuk laporan ['sabtu','minggu'];
        $is_enabled = $pemagang->laporan_weekend??0;
        $excepted_days = [];
        if(!$is_enabled){
            $excepted_days=['Sat','Sun'];
        }
        $this_day=date('D');
        $hari_libur=in_array($this_day,$excepted_days);
        // Cek apakah hari ini sudah melakukan 2x laporan apa belum
        $hasLaporanToday=!is_null($pemagang)?
                    Laporan::where('id_data_bimbingan',$pemagang->id)
                            ->whereDate('tanggal_laporan', '=', date('Y-m-d'))->get()
                    :collect([]);

        // Cek apakah si user nya sudah melewati masa akhir magang
        $masa_magang=Pemagangan::where('mahasiswa_id',$mahasiswa->id)
                                ->whereDate('mulai_magang','<=',date('Y-m-d'))
                                ->whereDate('selesai_magang','>=',date('Y-m-d'))->first();

        $view = request()->is('lupa-laporan')?'laporan.lupa':'laporan.index';
        return view($view, compact('data','hari_libur','hasLaporanToday','masa_magang','pemagang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(LaporanRequest $request)
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
    public function lupa(LaporanRequest $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;
        $id_bimbingan = $mahasiswa->pemagangan->id;
        $tanggal = date('Y-m-d',strtotime($request->tanggal_laporan));
        $has_laporan_that_day = Laporan::where('id_data_bimbingan', $id_bimbingan)->whereDate('tanggal_laporan',$tanggal)->get();

        if($has_laporan_that_day->count()<2){
            // Cek apakah si user nya sudah melewati masa akhir magang
            $masa_magang=Pemagangan::where('mahasiswa_id',$mahasiswa->id)
                ->whereDate('mulai_magang','<=', $tanggal)
                ->whereDate('selesai_magang','>=', $tanggal)->first();
            if(!is_null($masa_magang)){
                if(date('Y-m-d') > $tanggal){
                    Laporan::create($request->merge(['id_data_bimbingan'=>$id_bimbingan])->toArray()); //Cuma sebaris kang
                }else{
                    return redirect('/laporan')->with('failed', "Belum waktunya untuk melakukan laporan tanggal $tanggal");
                }
            }else{
                return redirect('/laporan')->with('failed','Pada tanggal '.$tanggal.' anda belum menjadi peserta magang');
            }
            return redirect('/histori-laporan')->with('sukses','Data Berhasil di input');
        }else{
            return redirect('/laporan')->with('failed','Anda sudah laporan 2x tanggal '.$tanggal);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $laporan = auth()->user()->pemagang?Laporan::whereIn('id_data_bimbingan',auth()->user()->mahasiswa->pemagangans()->pluck('id'))->get():null;
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
    public function update(LaporanRequest $request, Laporan $laporan)
    {
        $laporan->update($request->all());
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
