<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id','id');
    }

    public function pemagang()
    {
        $date = date('Y-m-d');
        return $this->hasOneThrough(Pemagangan::class, Mahasiswa::class)
            ->whereDate('mulai_magang', '<=', $date)
            ->whereDate('selesai_magang', '>=', $date);
    }

    public function dosenPembimbing()
    {
        return $this->hasOne(DosenPembimbing::class, 'user_id','id');
    }

    public function pembimbingIndustri()
    {
        return $this->hasOne(PembimbingIndustri::class, 'user_id', 'id');
    }

    public function logs()
    {
        return $this->hasMany(ActivityLog::class, 'causer_id');
    }
}
