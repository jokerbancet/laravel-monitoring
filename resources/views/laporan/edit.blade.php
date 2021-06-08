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
                                <form action="" method="post">
                                    @method('put')
                                    @include('laporan._form')
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Edit</button>
                                    </div>
                                </form>
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
        $('#laporan').addClass('active');

        $.ajax({
            url: '',
            success: function(laporan){
                for(let index in laporan){
                    $('#'+index).val(laporan[index]);
                }
            }
        })
    </script>
@endpush
