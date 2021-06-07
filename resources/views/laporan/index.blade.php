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
                        </div>
                    </div>
                </div>
                {{-- Cek apakah si mahasiswa terdaftar sebagai pemagang atau tidak --}}
                @if (!is_null(auth()->user()->mahasiswa->pemagangan))
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <span class="h4">
                                    {{(auth()->user()->mahasiswa->dosenpembimbing->isNotEmpty()?'Dosen Pembimbing: '.auth()->user()->mahasiswa->dosenpembimbing[0]->nama:'')}}
                                </span><br>
                                <span class="h4">Pembimbing Industri: {{auth()->user()->mahasiswa->pembimbingindustri[0]->nama}}.</span><br>
                                <span class="h4">Nama Industri: {{auth()->user()->mahasiswa->pembimbingindustri[0]->industri->nama_industri}}.</span>
                            </div>
                        </div>
                    </div>

                    @if(session('sukses'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                        </div>
                    </div>
                    @endif

                    {{-- Cek apakah masa menjadi pemagang masih berlaku atau tidak --}}
                    @if (!is_null($masa_magang))
                        {{-- Cek apakah hari ini hari libur atau bukan ['Minggu', 'Sabtu'] -> cek di LaporanController method index variable $excepted_days --}}
                        @if (!$hari_libur)
                            {{-- Cek apakah si pemagang sudah melakukan laporan hari ini atau belum --}}
                            @if ($hasLaporanToday->count()<2)
                                <div class="col-md-12">
                                    <!-- TABLE HOVER -->
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h2 class="panel-title">Pelaporan Magang Hari ini. Tanggal :@php
                                                date_default_timezone_set('asia/jakarta');
                                                echo date('D, d-m-Y H:i');
                                            @endphp</h2>
                                        </div>
                                        <div class="panel-body">
                                            <form action="/laporan/create" method="post" enctype="multipart/form-data">
                                                {{-- {{ csrf_field() }} simple pake ini --}}
                                                @csrf
                                                <div class="form-group">
                                                    <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
                                                    <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan...">
                                                    {{-- @if ($errors->has('kegiatan_pekerjaan'))
                                                        <p class="text-danger">{{$errors->first('kegiatan_pekerjaan')}}</p>
                                                    @endif simple ngangge iyeu kang --}}
                                                    @error('kegiatan_pekerjaan')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                                                    <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" cols="30" rows="10" class="form-control"></textarea>
                                                    @if ($errors->has('deskripsi_pekerjaan'))
                                                        <p class="text-danger">{{$errors->first('deskripsi_pekerjaan')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="durasi">Durasi Pekerjaan</label>
                                                    <input type="number" id="durasi" name="durasi" class="form-control" placeholder="Masukan Durasi">
                                                    @if ($errors->has('durasi'))
                                                        <p class="text-danger">{{$errors->first('durasi')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="output">Output Pekerjaan</label>
                                                    <input type="text" id="output" name="output" class="form-control" placeholder="Masukan output kegiatan...">
                                                    @if ($errors->has('output'))
                                                        <p class="text-danger">{{$errors->first('output')}}</p>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
                                                    <select name="capaian_id" id="capaian_id" class="form-control">
                                                        <option value=""></option>
                                                        @foreach ($data as $data)
                                                            <option value="{{$data->id}}">{{$data->jurusan.' - '.$data->deskripsi_capaian}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END TABLE HOVER -->
                                </div>
                            @endif
                            @if ($hasLaporanToday->count()>0)
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Laporan Harian</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-hover mydatatable" id="mydatatable">
                                            <thead>
                                                <tr>
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
                                                @foreach ($hasLaporanToday as $laporan)
                                                    <tr>
                                                        <td>{{ $laporan->kegiatan_pekerjaan }}</td>
                                                        <td>{{ $laporan->deskripsi_pekerjaan }}</td>
                                                        <td>{{ $laporan->durasi }}</td>
                                                        <td>{{ $laporan->output }}</td>
                                                        <td><span class="label {{cek_status($laporan->approve_dosen,1)}}">{{ $laporan->approve_dosen }}</span></td>
                                                        <td><span class="label {{cek_status($laporan->approve_industri,1)}}">{{ $laporan->approve_industri }}</span></td>
                                                        <td><span class="label {{cek_status($laporan->status_laporan,2)}}">{{ $laporan->status_laporan }}</span></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="alert alert-warning">Maaf, hari ini bukan hari kerja.</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="alert alert-warning">Maaf, masa menjadi pemagang anda sudah habis.</div>
                                </div>
                            </div>
                        </div>
                    @endif
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
        $('#laporan').addClass('active');
    </script>
@endpush
