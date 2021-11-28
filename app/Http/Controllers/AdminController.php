<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Mahasiswa;
use App\Models\Pemagangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

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

    public function data_statistik()
    {
        $pemagangan = Pemagangan::all();
        $response = [
            ['y'=>0,'name'=>'0 - 100','exploded'=>true],
            ['y'=>0,'name'=>'101 - 200'],
            ['y'=>0,'name'=>'201 - 300'],
            ['y'=>0,'name'=>'301 - 435'],
        ];
        foreach($pemagangan as $pem){
            $progress = $pem->laporan->sum('durasi');
            if($progress >= 0 && $progress <= 100){
                $response[0]['y'] += 1;
            }else if($progress >= 101 && $progress <= 200){
                $response[1]['y'] += 1;
            }else if($progress >= 201 && $progress <= 300){
                $response[2]['y'] += 1;
            }else{
                $response[3]['y'] += 1;
            }
        }
        return request()->ajax()? response()->json($response):view('data_statistik', compact('pemagangan'));
    }
}
