<?php

namespace App\Http\Controllers;

use App\Models\Pemagangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RelasiCapaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array(auth()->user()->role, ['admin','Direktur'])){
            $pemagang=Pemagangan::whereHas('mahasiswa')->get();
        }else{
            $jurusan = jurusan();
            $pemagang=Pemagangan::whereHas('mahasiswa', function($q)use($jurusan){
                $q->where('jurusan',$jurusan);
            })->get();
        }
        return view('relasi.index', compact('pemagang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pemagangan $pemagang)
    {
        $kategori = request('kategori');
        $kompetensi = $pemagang->laporan()->select('capaian_id',DB::raw('count(*) as total'))->where('status_laporan', 'approve')->with('capaian');
        if($kategori!=''){
            $kompetensi->where('approve_industri', $kategori);
        }
        $pemagang->kompetensi = $kompetensi->groupBy('capaian_id')->get();
        $pemagang->mahasiswa;
        return request()->ajax()?response()->json($pemagang):abort(403, 'permintaan harus ajax');
    }

    public function print(Pemagangan $pemagang)
    {
        if($pemagang->selesai_magang>=date('Y-m-d')){
            abort(403, 'Maaf mahasiswa ini belum selesai magang');
        }
        $jhm = Carbon::createFromFormat('Y-m-d',$pemagang->selesai_magang)->diffInDays(Carbon::createFromFormat('Y-m-d', $pemagang->mulai_magang));
        $jlhd = round($jhm/7)*5;
        $nks = $pemagang->laporan->count()/$jlhd;
        // $nka = $pemagang->laporan->where('status_laporan', 'approve')->count()/$jlhd;
        $nilai = $pemagang->laporan()->where('status_laporan', 'approve')->selectRaw('avg(approve_dosen) as dospem1, avg(approve_dosen2) as dospem2, avg(approve_industri_nilai) as pembid')->first();
        $nilai_akhir = ($nilai->dospem1*30/100)+($nilai->dospem2*30/100)+($nilai->pembid*40/100)*$nks;
        
        $capaian = $pemagang->laporan()->select('id','id_data_bimbingan','created_at', 'capaian_id', 'approve_industri')->where('status_laporan', 'approve')->with('capaian')->get()->groupBy('capaian_id');

        $pdf = \PDF::loadView('pdf.index',compact('pemagang', 'capaian', 'nilai_akhir', 'jhm','jlhd', 'nks'))->setPaper('a4','landscape');
        return $pdf->stream("Hasil Laporan ".$pemagang->mahasiswa->nama." ".$pemagang->mahasiswa->jurusan." ".$pemagang->pembimbingIndustri->industri->nama_industri.".pdf");
    }

    public function batch_export(Request $request)
    {
        $pemagangs = Pemagangan::whereIn('id', explode(',', $request->id))->get();

        $files = [];
        foreach($pemagangs as $pemagang){
            $jhm = Carbon::createFromFormat('Y-m-d',$pemagang->selesai_magang)->diffInDays(Carbon::createFromFormat('Y-m-d', $pemagang->mulai_magang));
            $jlhd = round($jhm/7)*5;
            $nks = $pemagang->laporan->count()/$jlhd;
            // $nka = $pemagang->laporan->where('status_laporan', 'approve')->count()/$jlhd;
            $nilai = $pemagang->laporan()->where('status_laporan', 'approve')->selectRaw('avg(approve_dosen) as dospem1, avg(approve_dosen2) as dospem2, avg(approve_industri_nilai) as pembid')->first();
            $nilai_akhir = ($nilai->dospem1*30/100)+($nilai->dospem2*30/100)+($nilai->pembid*40/100)*$nks;
            
            $capaian = $pemagang->laporan()->select('id','id_data_bimbingan','created_at', 'capaian_id', 'approve_industri')->where('status_laporan', 'approve')->with('capaian')->get()->groupBy('capaian_id');

            $file_name = "Hasil Laporan ".$pemagang->mahasiswa->nama." ".$pemagang->mahasiswa->jurusan." ".$pemagang->pembimbingIndustri->industri->nama_industri.".pdf";
            $pdf = \PDF::loadView('pdf.index',compact('pemagang', 'capaian', 'nilai_akhir', 'jhm','jlhd', 'nks'))->setPaper('a4','landscape');
            // $pdf->save(public_path('batch-pdf')."\\".$file_name);
            Storage::put('public/batch-pdf/'.$file_name, $pdf->output());
            $files[] = $file_name;
        }
        $zip = \Zip::create('batch_pdf.zip');
        foreach($files as $file){
            $zip->add(storage_path("app\public\batch-pdf\\".$file));
        }
        $zip->close();
        Storage::deleteDirectory('public/batch-pdf');
        return response()->download(public_path('batch_pdf.zip'))->deleteFileAfterSend(true);
    }

}
