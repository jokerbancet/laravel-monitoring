<?php

namespace App\Http\Livewire;

use App\Models\Laporan;
use App\Models\Pemagangan;
use Livewire\Component;

class PersetujuanModal extends Component
{
    public $mahasiswa;
    public $laporan_id;
    public $laporan_mahasiswa;
    public $kegiatan_pekerjaan = '';
    public $deskripsi_pekerjaan = '';
    public $durasi = 0;
    public $output = '';
    public $capaian_id = 0;
    public $status_laporan = 'pending';
    public $approve_industri = 'pending';
    public $approve_industri_nilai = 0;
    public $approve_dosen = 0;
    public $approve_dosen2 = 0;
    public $is_dosen1 = false, $is_dosen2 = false;

    public function mount()
    {
        $clause=auth()->user()->role=='dosenpembimbing'?
                ['dosenpembimbing_id'=>auth()->user()->dosenPembimbing->id]:
                ['pembimbingindustri_id'=>auth()->user()->pembimbingIndustri->id];
        $mahasiswa = Pemagangan::with(['laporan'=>function($laporan){
            return $laporan->where('status_laporan','pending')->get();
        }])->where($clause);
        if(auth()->user()->role=='dosenpembimbing'){
            $mahasiswa->orWhere(['dosenpembimbing2_id'=>auth()->user()->dosenPembimbing->id]);
        }
        $this->mahasiswa=$mahasiswa->get();
    }

    public function detail(Laporan $laporan)
    {
        $this->is_dosen1 = $laporan->pemagangan->dosenPembimbing2!=auth()->user()->dosenPembimbing&&auth()->user()->dosenPembimbing;
        $this->is_dosen2 = $laporan->pemagangan->dosenPembimbing2==auth()->user()->dosenPembimbing;
        $this->laporan_mahasiswa = $laporan->mahasiswa;
        $this->laporan_id = $laporan->id;
        // dd($this->laporan_mahasiswa);
        foreach($laporan->toArray() as $key => $value){
            $this->$key=$value;
        }
        $this->dispatchBrowserEvent('showModal');
    }

    public function render()
    {
        return view('livewire.persetujuan-modal');
    }
}
