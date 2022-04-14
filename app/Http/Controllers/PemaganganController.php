<?php

namespace App\Http\Controllers;

use App\Models\DosenPembimbing;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
use App\Models\PembimbingIndustri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemaganganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil data_bimbingan untuk tabel
        if(in_array(auth()->user()->role, ['admin','Direktur'])){
            $data_pemagangan = Pemagangan::whereHas('mahasiswa')->get();
            
            //ambil data nama mahasiswa
            $data1 = Mahasiswa::withCount('pemagangan')->having('pemagangan_count', "<", 2)->get();
        }else{
            $jurusan = jurusan();
            $data_pemagangan = Pemagangan::whereHas('mahasiswa', function($q)use($jurusan){
                $q->where('jurusan',$jurusan);
            })->get();
            
            //ambil data nama mahasiswa
            $data1 = Mahasiswa::withCount('pemagangan')->where('jurusan',$jurusan)->having('pemagangan_count', "<", 2)->get();
        }


        //ambil data nama dosen pembimbing
        $data2 = DB::table('dosenpembimbing')
        ->select('dosenpembimbing.id', 'dosenpembimbing.nama', DB::raw('COUNT(data_bimbingan.mahasiswa_id) AS jumlah_anak'))
        ->leftJoin('data_bimbingan', 'dosenpembimbing.id', '=', 'data_bimbingan.dosenpembimbing_id')
        ->groupBy('dosenpembimbing.id')
        ->having('jumlah_anak', '<', 100)
        ->get();

        //ambil data nama pembimbing industri
        $data3 = DB::table('pembimbingindustri')->where('is_hrd', 0)
        ->join('industri', 'pembimbingindustri.industri_id', '=', 'industri.id')
        ->select('pembimbingindustri.id', 'pembimbingindustri.nama', 'industri.nama_industri')
        ->get();

        // dd($data_pemagangan);
        return view('pemagangan.index', [
            'pemagangan' => $data_pemagangan,
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //masukan data ke dalam database
        Pemagangan::create($request->all());
        return redirect('/pemagangan')->with('sukses','Data Berhasil di input');
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
    public function show(Pemagangan $pemagang)
    {
        $data = DB::table('master_capaian')->where('jurusan',$pemagang->mahasiswa->jurusan)->get();
        return response()->json($data->toArray());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemagangan $pemagang)
    {
        if(in_array(auth()->user()->role, ['admin','Direktur'])){
            $mahasiswa          = Mahasiswa::all();
        }else{
            $jurusan = jurusan();
            $mahasiswa          = Mahasiswa::where('jurusan',$jurusan)->get();
        }
        $dosenPembimbing    = DosenPembimbing::all();
        $pembimbingIndustri = PembimbingIndustri::all();
        return request()->ajax()?response()->json($pemagang):view('pemagangan.edit',compact('pemagang','mahasiswa','dosenPembimbing','pembimbingIndustri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemagangan $pemagang)
    {
        $validate = $request->validate([
            'mahasiswa_id' => 'required',
            'dosenpembimbing_id' => 'required',
            'dosenpembimbing2_id' => 'required',
            'pembimbingindustri_id' => 'required',
            'mulai_magang' => 'required|date',
            'selesai_magang' => 'required|date',
            'laporan_weekend' => 'required|numeric'
        ]);
        $nama = $pemagang->mahasiswa->nama;
        // dd($validate);
        $pemagang->update($validate);
        return redirect('/pemagangan')->with('sukses',"Pemagangan $nama berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data_magang = Pemagangan::find($id);
        $data_magang->delete($id);
        return redirect('/pemagangan')->with('sukses','Data Berhasil di hapus');
    }
}
