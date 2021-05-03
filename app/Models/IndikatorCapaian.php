<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorCapaian extends Model
{
    use HasFactory;
    protected $table = 'master_capaian';
    protected $fillable = [
        'jurusan',
        'deskripsi_capaian',
        'kategori_capaian',
        'bobot_capaian',
    ];
}
