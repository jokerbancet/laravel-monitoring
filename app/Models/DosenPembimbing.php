<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPembimbing extends Model
{
    use HasFactory;
    protected $table = 'dosenpembimbing';
    protected $fillable = [
        'user_id',
        'nama',
        'gelar_depan',
        'gelar_belakang',
        'jk',
        'nidn',
        'email',
        'avatar'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }
        return asset('images/'.$this->avatar);
    }

    //relasi ke tabel mahasiswa dengan many to many
    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'data_bimbingan', 'dosenpembimbing_id', 'mahasiswa_id')->withPivot(['mulai_magang', 'selesai_magang']);
    }

    public function pembimbingindustri()
    {
        return $this->belongsToMany(pembimbingindustri::class,'data_bimbingan', 'dosenpembimbing_id', 'pembimbingindustri_id')->withPivot(['mulai_magang', 'selesai_magang']);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id','id');
    }

}
