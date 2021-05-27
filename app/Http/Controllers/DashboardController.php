<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //mengambil data dari setiap tabel
        $data = DB::table('mahasiswa')->get();
        $data2 = DB::table('dosenpembimbing')->get();
        $data3 = DB::table('pembimbingindustri')->get();
        $data4 = DB::table('industri')->get();
        // dd($data);
        return view('dashboard.index', [
            'data' => $data,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4
            ]);
    }
}
