@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <span class="h3">Halo, {{auth()->user()->name}}.</span>
                            <span class="h3" style="float: right; margin-top: 1px">
                                {{(auth()->user()->mahasiswa->dosenpembimbing->isNotEmpty()?'Dosen Pembimbing: '.auth()->user()->mahasiswa->dosenpembimbing[0]->nama:'')}}
                            </span>
                        </div>
                    </div>
                </div>
                {{-- Cek apakah si mahasiswa terdaftar sebagai pemagang atau tidak --}}
                @if (!is_null(auth()->user()->mahasiswa->pemagangan))
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <span class="h3">Pembimbing Industri: {{auth()->user()->mahasiswa->pembimbingindustri[0]->nama}}.</span>
                                <span class="h3" style="float: right; margin-top: 1px">Nama Industri: {{auth()->user()->mahasiswa->pembimbingindustri[0]->industri->nama_industri}}.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Histori Laporan</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-hover mydatatable" id="mydatatable">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Kegiatan</th>
                                            <th>Deskripsi Pekerjaan</th>
                                            <th>Durasi</th>
                                            <th>Output</th>
                                            <th>Persetujuan Dosen</th>
                                            <th>Persetujuan Pembimbing Industri</th>
                                            <th>Status Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporan as $lprn)
                                            <tr>
                                                <td>{{ $lprn->waktu }}</td>
                                                <td>{{ $lprn->kegiatan_pekerjaan }}</td>
                                                <td>{{ $lprn->deskripsi_pekerjaan }}</td>
                                                <td class="text-center">{{ $lprn->durasi }}</td>
                                                <td>{{ $lprn->output }}</td>
                                                <td><span class="label {{cek_status($lprn->approve_dosen,1)}}">{{ $lprn->approve_dosen }}</span></td>
                                                <td><span class="label {{cek_status($lprn->approve_industri,1)}}">{{ $lprn->approve_industri }}</span></td>
                                                <td><span class="label {{cek_status($lprn->status_laporan,2)}}">{{ $lprn->status_laporan }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="alert alert-warning">Maaf anda belum menjadi peserta magang.</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#histori-laporan').addClass('active');
    </script>
@endpush
