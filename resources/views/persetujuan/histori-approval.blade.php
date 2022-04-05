@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="{{ asset('images/default.png') }}" width="35%" class="img-circle" alt="Avatar">
                            <h3 class="name">{{ $mahasiswa->mahasiswa->nama }}
                            </h3>
                            <h5>Mahasiswa Magang</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-detail">
                        <div class="profile-info">
                            <h4 class="heading">Informasi Dasar</h4>
                            <ul class="list-unstyled list-justify">
                                <li>Nomor Induk Mahasiswa<span>{{ $mahasiswa->mahasiswa->nim }}</span></li>
                                <li>Email <span>{{ $mahasiswa->mahasiswa->email }}</span></li>
                                <li>Prodi <span>{{ $mahasiswa->mahasiswa->jurusan }}</span>
                                <li>Tahun Angkatan <span>{{ $mahasiswa->mahasiswa->tahun_angkatan }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    @if(session('sukses'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                        </div>
                    @endif
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Histori Laporan Mahasiswa</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover mydatatable" id="mydatatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Laporan</th>
                                            <th>Kegiatan</th>
                                            <th>Persetujuan Pembimbing Industri</th>
                                            <th>Persetujuan Dosen Pembimbing 1</th>
                                            <th>Persetujuan Dosen Pembimbing 2</th>
                                            <th>Status Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($mahasiswa->laporan()->where('status_laporan', 'approve')->get() as $lprn) --}}
                                        @foreach ($mahasiswa->laporan as $lprn)
                                            <tr>
                                                <td>{{ $lprn->tanggal_laporan }}</td>
                                                <td>{{ $lprn->kegiatan_pekerjaan }}</td>
                                                <td class="text-center"><span class="label {{cek_status($lprn->approve_industri,1)}}">{{ $lprn->approve_industri }}{{ ' | '.$lprn->approve_industri_nilai}}</span></td>
                                                <td class="text-center"><span class="label {{cek_status($lprn->approve_dosen,1)}}">{{ $lprn->approve_dosen }}</span></td>
                                                <td class="text-center"><span class="label {{cek_status($lprn->approve_dosen2,1)}}">{{ $lprn->approve_dosen2 }}</span></td>
                                                <td class="text-center"><span class="label {{cek_status($lprn->status_laporan,2)}}">{{ $lprn->status_laporan }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
