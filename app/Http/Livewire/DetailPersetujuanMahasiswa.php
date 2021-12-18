<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailPersetujuanMahasiswa extends Component
{
    public $mahasiswa;
    public $sort = 'desc';

    public function render()
    {
        return view('livewire.detail-persetujuan-mahasiswa');
    }
}
