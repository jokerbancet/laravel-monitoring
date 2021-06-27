<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $table = 'data_laporan';
    protected $guarded = ['id','created_at','updated_at'];

    public function mahasiswa()
    {
        return $this->hasOneThrough(Mahasiswa::class, Pemagangan::class, 'id', 'id','id_data_bimbingan','mahasiswa_id');
    }

    public function dosenPembimbing()
    {
        return $this->hasOneThrough(DosenPembimbing::class, Pemagangan::class, 'id', 'id','id_data_bimbingan','dosenpembimbing_id');
    }

    public function pembimbingIndustri()
    {
        return $this->hasOneThrough(PembimbingIndustri::class, Pemagangan::class, 'id', 'id','id_data_bimbingan','pembimbingindustri_id');
    }

    public function pemagangan()
    {
        return $this->belongsTo(Pemagangan::class, 'id_data_bimbingan','id');
    }

    public function capaian()
    {
        return $this->belongsTo(IndikatorCapaian::class, 'capaian_id', 'id');
    }

    public function cek_status($column, $type)
    {
        $type1=[
            'mengamati'=>'info',
            'mengikuti'=>'primary',
            'terampil'=>'success',
            'pending'=>'warning',
        ];
        $type2=[
            'approve'=>'success',
            'rejected'=>'danger',
            'pending'=>'warning',
        ];
        switch($type){
            case 1:
                return '<span class="label label-'.$type1[$this->$column].'">'.$this->$column.'</span>';
            default:
                return '<span class="label label-'.$type2[$this->$column].'">'.$this->$column.'</span>';
        }
    }
}
