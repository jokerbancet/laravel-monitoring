<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    use HasFactory;
    protected $table = 'industri';
    protected $fillable = [
        'nama_industri',
        'kategori_industri',
        'email',
        'alamat',
    ];

    public function pembimbingindustri()
    {
        return $this->hasOne(PembimbingIndustri::class);
    }
}
