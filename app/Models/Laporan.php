<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'data_laporan';
    protected $guarded = ['id','created_at','updated_at'];
    protected $dates = ['tanggal_laporan'];
    protected $casts = ['tanggal_laporan'=>'date'];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id','id_data_bimbingan');
    }
}
