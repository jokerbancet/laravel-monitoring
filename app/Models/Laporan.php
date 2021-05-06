<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'data_laporan';
    protected $fillable = [
        'id_data_kompetensi',
        'tanggal_laporan',
        'kegiatan_pekerjaan',
        'deskripsi_pekerjaan',
        'durasi',
        'output',
        'laporan',
        'approve_dosen',
        'approve_industri',
        'status_laporan'
    ];
}
