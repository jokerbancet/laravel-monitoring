@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <h3>Halo, {{auth()->user()->name}}.</h3>
                            <p>Industri : </p>
                            <p>Dosen Pembimbing : </p>
                            <p>Pembimbing Industri : </p>
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
                            <h2 class="panel-title">Pelaporan Magang Hari ini.</h2>
                        </div>
                        <div class="panel-body">
                            <form action="/laporan/create" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <label for="">Tanggal</label>
                                    <h5>@php
                                        date_default_timezone_set('asia/jakarta');
                                        echo date('D, d-m-Y H:i');
                                    @endphp</h5>
                                </div>
                                <div class="form-group">
                                    <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
                                    <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan...">
                                    @if ($errors->has('kegiatan_pekerjaan'))
                                        <p class="text-danger">{{$errors->first('kegiatan_pekerjaan')}}</p>
                                    @endif
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
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
