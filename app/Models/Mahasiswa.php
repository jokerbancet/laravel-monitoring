<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'Mahasiswa';
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'nim',
        'jk',
        'agama',
        'alamat',
        'jurusan',
        'tahun_angkatan',
        'avatar'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }
        return asset('images/'.$this->avatar);
    }

    public function dosenpembimbing()
    {
        return $this->belongsToMany(dosenpembimbing::class, 'data_bimbingan', 'mahasiswa_id', 'dosenpembimbing_id')->withPivot(['mulai_magang', 'selesai_magang','status_magang']);
    }

    public function pembimbingindustri()
    {
        return $this->belongsToMany(pembimbingindustri::class, 'data_bimbingan', 'mahasiswa_id', 'pembimbingindustri_id')->withPivot(['mulai_magang','selesai_magang','status_magang']);
    }
}
