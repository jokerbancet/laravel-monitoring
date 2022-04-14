<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\DosenPembimbing;
use App\Models\Laporan;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
use App\Models\PembimbingIndustri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function excel_mahasiswa(Request $request)
    {
        // return $request->file('excel');
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        // lokasi file excel
        $spreadsheet = $reader->load($request->file('excel'));

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $result = [];
        foreach($rows as $row){
            if(is_int($row[0])){
                if(count($row)<9){
                    for($i=count($row);$i<9;$i++){
                        $row[]='';
                    }
                }else if(count($row)>9){
                    for($i=count($row);$i>9;$i--){
                        unset($row[$i-1]);
                    }
                }
                $result[]=$row;
            }
        }
        if($request->ajax()){
            return response()->json($result);
        }
        foreach($result as $rst){
            $id = User::create([
                'name'=>$rst[1],
                'email'=>$rst[3],
                'password'=>Hash::make('passwordmahasiswa'),
                'role'=>'mahasiswa'
            ])->id;
            Mahasiswa::create([
                'user_id'=>$id,
                'nama'=>$rst[1],
                'email'=>$rst[3],
                'nim'=>$rst[2],
                'jk'=>$rst[4],
                'agama'=>$rst[5],
                'alamat'=>$rst[6],
                'jurusan'=>$rst[7],
                'tahun_angkatan'=>$rst[8]
            ]);
        }
        return back()->with('sukses','Excel berhasil diimport.');
    }

    public function excel_laporan(Request $request)
    {
        // return $request->file('excel');
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        // lokasi file excel
        $spreadsheet = $reader->load($request->file('excel'));

        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();
        $result = [];
        foreach($rows as $row){
            if(is_int($row[0])){
                if(count($row)<9){
                    for($i=count($row);$i<9;$i++){
                        $row[]='';
                    }
                }else if(count($row)>9){
                    for($i=count($row);$i>9;$i--){
                        unset($row[$i-1]);
                    }
                }
                $row[2] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2])->format('Y-m-d H:i:s');
                $result[]=$row;
            }
        }
        if($request->ajax()){
            return response()->json($result);
        }
        foreach($result as $rst){
            Laporan::create([
                'id_data_bimbingan' => $rst[0],
                'capaian_id' => $rst[1],
                'tanggal_laporan' => $rst[2],
                'kegiatan_pekerjaan' => $rst[3],
                'deskripsi_pekerjaan' => $rst[4],
                'durasi' => $rst[5],
                'output' => $rst[6],
            ]);
        }
        return back()->with('sukses','Excel berhasil diimport.');
    }

    public function data_statistik(Request $request)
    {
        $pemagangan = Pemagangan::whereHas('mahasiswa', function($q)use($request){
            if(!in_array(auth()->user()->role, ['admin','Direktur'])){
                $q->where('jurusan', jurusan());
            }else{
                if($request->filter_jurusan!=''){
                    $q->where('jurusan', $request->filter_jurusan);
                }
            }
        })->where('prakerin_ke', $request->filter_prakerin)->whereYear('mulai_magang',$request->filter_tahun)->with('mahasiswa')->get();
        $tahun = Pemagangan::pluck('mulai_magang')->groupBy(function($item,$key){
            return date('Y', strtotime($item));
        });
        $dt = new DataTables;
        return request()->ajax()? $dt->collection($pemagangan)
            ->addIndexColumn()
            ->addColumn('progress', function($pemagangan){
                return $pemagangan->laporan->where('status_laporan', 'approve')->sum('durasi').' jam';
            })
            ->addColumn('count_laporan', function($pemagangan){
                return $pemagangan->laporan->count();
            })
            ->addColumn('count_laporan_approve', function($pemagangan){
                return $pemagangan->laporan->where('status_laporan', 'approve')->count();
            })
            ->toJson():view('data_statistik', compact('pemagangan', 'tahun'));
    }

    public function api_data_statistik(Request $request)
    {
        $pemagangan = Pemagangan::whereHas('mahasiswa', function($q){
            if(!in_array(auth()->user()->role, ['admin','Direktur'])){
                $q->where('jurusan', jurusan());
            }
        })->where('prakerin_ke', ($request->prakerin_ke??1))->whereYear('mulai_magang', $request->tahun??date('Y'))->get();
        $response = [
            ['y'=>0,'jml'=>0,'name'=>'0 - 100','exploded'=>true],
            ['y'=>0,'jml'=>0,'name'=>'101 - 200'],
            ['y'=>0,'jml'=>0,'name'=>'201 - 300'],
            ['y'=>0,'jml'=>0,'name'=>'301 - 435'],
        ];
        if(($request->prakerin_ke??1)==2){
            $response[0]['name'] = '0 - 200';
            $response[1]['name'] = '201 - 400';
            $response[2]['name'] = '401 - 600';
            $response[3]['name'] = '601 - 725';
        }
        foreach($pemagangan as $pem){
            $progress = $pem->laporan->where('status_laporan', 'approve')->sum('durasi');
            if(($request->prakerin_ke??1)==1){
                if($progress >= 0 && $progress <= 100){
                    $response[0]['jml'] += 1;
                }else if($progress >= 101 && $progress <= 200){
                    $response[1]['jml'] += 1;
                }else if($progress >= 201 && $progress <= 300){
                    $response[2]['jml'] += 1;
                }else{
                    $response[3]['jml'] += 1;
                }
            }elseif(($request->prakerin_ke??1)==2){
                if($progress >= 0 && $progress <= 200){
                    $response[0]['jml'] += 1;
                }elseif($progress >= 201 && $progress <= 400){
                    $response[1]['jml'] += 1;
                }elseif($progress >= 401 && $progress <= 600){
                    $response[2]['jml'] += 1;
                }else{ // >725
                    $response[3]['jml'] += 1;
                }
            }
        }
        $total = $pemagangan->count()==0?1:$pemagangan->count();

        foreach($response as $i => $v){
            $response[$i]['y'] = $v['jml']/$total*100;
        }

        return response()->json($response);
    }

    public function data_dosen()
    {
        $model = DosenPembimbing::whereHas('mahasiswa')->orWhereHas('mahasiswa2')->with('mahasiswa','mahasiswa2')->get();
        $collection = [];
        foreach($model as $i => $m){
            $collection[$i]['nama_dosen'] = $m->nama;
            $collection[$i]['approved'] = 0;
            $collection[$i]['not_approved'] = 0;
            foreach($m->mahasiswa as $m1){
                foreach($m1->pemagangans as $p){
                    $collection[$i]['approved'] += $p->laporan->where('approve_dosen', '!=', 'pending')->count();
                    $collection[$i]['not_approved'] += $p->laporan->where('approve_dosen', 'pending')->count();
                }
            }
            foreach($m->mahasiswa2 as $m2){
                foreach($m2->pemagangans as $p){
                    $collection[$i]['approved'] += $p->laporan->where('approve_dosen2', '!=', 'pending')->count();
                    $collection[$i]['not_approved'] += $p->laporan->where('approve_dosen2', 'pending')->count();
                }
            }
        }
        $dt = new DataTables;
        return $dt->collection(collect($collection))
                ->addIndexColumn()
                ->toJson();
    }

    public function data_pembimbing()
    {
        $model = PembimbingIndustri::whereHas('mahasiswa')->with('mahasiswa')->get();
        $collection = [];
        foreach($model as $i => $m){
            $collection[$i]['nama_pembimbing'] = $m->nama;
            $collection[$i]['nama_industri'] = $m->industri->nama_industri;
            $collection[$i]['approved'] = 0;
            $collection[$i]['not_approved'] = 0;
            foreach($m->mahasiswa as $mhs){
                foreach($mhs->pemagangans as $p){
                    $collection[$i]['approved'] = $p->laporan->where('approve_industri', '!=' ,'pending')->count();
                    $collection[$i]['not_approved'] = $p->laporan->where('approve_industri', 'pending')->count();
                }
            }
        }
        $dt = new DataTables;
        return $dt->collection(collect($collection))
                ->addIndexColumn()
                ->toJson();
    }

    public function activity_log()
    {
        $logs = ActivityLog::latest()->limit(10)->get();
        return view('activity-log', compact('logs'));
    }
}
