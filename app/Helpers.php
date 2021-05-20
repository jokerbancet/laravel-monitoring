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
        switch($type){
            case 1:
                return 'label-'.$type1[$data];
            default:
                return 'label-'.$type2[$data];
        }
    }
}
