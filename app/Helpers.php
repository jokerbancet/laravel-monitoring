<?php

if(!function_exists('cek_status')){
    function cek_status($data,$type)
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
        if(is_numeric($data)){
            return 'label-info';
        }
        switch($type){
            case 1:
                return 'label-'.$type1[$data];
            case 2:
                return 'label-'.$type2[$data];
        }
    }
}

if(!function_exists('jurusan')){
    function jurusan()
    {
        $trim = '';
        if(str_contains(auth()->user()->role,'Kaprodi ')){
            $trim = substr(auth()->user()->role, 0, 8); 
        }else if(str_contains(auth()->user()->role,'Admin Teknologi')){
            $trim = substr(auth()->user()->role, 0, 6);
        }
        return ltrim(auth()->user()->role, $trim);
    }
}