<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
}
