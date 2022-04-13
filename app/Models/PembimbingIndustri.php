<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingIndustri extends Model
{
    use HasFactory;
    protected $table = 'pembimbingindustri';
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'jk',
        'industri_id',
        'is_hrd',
        'avatar'
    ];

    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.png');
        }
        return asset('images/'.$this->avatar);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'data_bimbingan', 'pembimbingindustri_id', 'mahasiswa_id')->withPivot(['mulai_magang','selesai_magang']);
    }

    public function dosenpembimbing()
    {
        return $this->belongsToMany(DosenPembimbing::class, 'data_bimbingan', 'pembimbingindustri_id', 'dosenpembimbing_id')->withPivot(['mulai_magang']);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
