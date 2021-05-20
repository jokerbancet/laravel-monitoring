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
                    {{-- Cek apakah masa menjadi pemagang masih berlaku atau tidak --}}
                    @if (!is_null($masa_magang))
                        {{-- Cek apakah hari ini hari libur atau bukan ['Minggu', 'Sabtu'] -> cek di LaporanController method index variable $excepted_days --}}
                        @if (!$hari_libur)
                            {{-- Cek apakah si pemagang sudah melakukan laporan hari ini atau belum --}}
                            @if (is_null($hasLaporanToday))
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
                            @else
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Data Laporan Mahasiswa</h3>
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
                                                <tr>
                                                    <td>{{ $hasLaporanToday->kegiatan_pekerjaan }}</td>
                                                    <td>{{ $hasLaporanToday->deskripsi_pekerjaan }}</td>
                                                    <td>{{ $hasLaporanToday->durasi }}</td>
                                                    <td>{{ $hasLaporanToday->output }}</td>
                                                    <td><span class="label {{cek_status($hasLaporanToday->approve_dosen,1)}}">{{ $hasLaporanToday->approve_dosen }}</span></td>
                                                    <td><span class="label {{cek_status($hasLaporanToday->approve_industri,1)}}">{{ $hasLaporanToday->approve_industri }}</span></td>
                                                    <td><span class="label {{cek_status($hasLaporanToday->status_laporan,2)}}">{{ $hasLaporanToday->status_laporan }}</span></td>
                                                    {{-- <td><a href="/mahasiswa/{{ $hasLaporanToday->id }}/detail"
                                                            class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                        <a href="/mahasiswa/{{ $hasLaporanToday->id }}/edit"
                                                            class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                        <a href="/mahasiswa/{{ $hasLaporanToday->id }}/delete"
                                                            class="btn btn-danger btn-xs"
                                                            onclick="return confirm('Yakin data dengan nama {{ $hasLaporanToday->nama_depan }} akan dihapus?')"><i
                                                                class="lnr lnr-trash"></i></a>
                                                    </td> --}}
                                                </tr>
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
