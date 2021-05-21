<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
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

    public function user()
    {
        return $this->hasOne(User::class, 'user_id','id');
    }

    public function pemagangan()
    {
        return $this->hasOne(Pemagangan::class, 'mahasiswa_id','id');
    }

    public function laporan()
    {
        return $this->hasOneThrough(Laporan::class, Pemagangan::class,'mahasiswa_id','id_data_bimbingan', 'id','id');
    }

    public function laporans()
    {
        return $this->hasManyThrough(Laporan::class, Pemagangan::class,'mahasiswa_id','id_data_bimbingan', 'id','id');
    }

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }
        return asset('images/'.$this->avatar);
    }

    public function dosenpembimbing()
    {
        return $this->belongsToMany(dosenpembimbing::class, 'data_bimbingan', 'mahasiswa_id', 'dosenpembimbing_id')->withPivot(['mulai_magang', 'selesai_magang']);
    }

    public function pembimbingindustri()
    {
        return $this->belongsToMany(pembimbingindustri::class, 'data_bimbingan', 'mahasiswa_id', 'pembimbingindustri_id')->withPivot(['mulai_magang','selesai_magang']);
    }
}
