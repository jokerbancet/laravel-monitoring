<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
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
        $pemagangan = Pemagangan::with('mahasiswa')->get();
        $dt = new DataTables;
        return request()->ajax()? $dt->collection($pemagangan->where('prakerin_ke', $request->filter_prakerin))
            ->addColumn('progress', function($pemagangan){
                return $pemagangan->laporan->where('status_laporan', 'approve')->sum('durasi').' jam';
            })
            ->toJson():view('data_statistik', compact('pemagangan'));
    }

    public function api_data_statistik(Request $request)
    {
        $pemagangan = Pemagangan::where('prakerin_ke', $request->prakerin_ke)->get();
        $response = [
            ['y'=>0,'jml'=>0,'name'=>'0 - 100','exploded'=>true],
            ['y'=>0,'jml'=>0,'name'=>'101 - 200'],
            ['y'=>0,'jml'=>0,'name'=>'201 - 300'],
            ['y'=>0,'jml'=>0,'name'=>'301 - 435'],
        ];
        foreach($pemagangan as $pem){
            $progress = $pem->laporan->where('status_laporan', 'approve')->sum('durasi');
            if($progress >= 0 && $progress <= 100){
                $response[0]['jml'] += 1;
            }else if($progress >= 101 && $progress <= 200){
                $response[1]['jml'] += 1;
            }else if($progress >= 201 && $progress <= 300){
                $response[2]['jml'] += 1;
            }else{
                $response[3]['jml'] += 1;
            }
        }
        $total = $pemagangan->count();

        foreach($response as $i => $v){
            $response[$i]['y'] = $v['jml']/$total*100;
        }

        return response()->json($response);
    }
}
