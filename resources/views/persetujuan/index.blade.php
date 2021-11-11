@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <!-- TABLE HOVER -->
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                </div>
            @endif
            <h3 class="mb-3">Data Laporan Mahasiswa</h3>
            <div class="row">
                @foreach ($mahasiswa as $mhs)
                    <div class="col-sm-12 col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4>Nama    : {{ $mhs->mahasiswa->nama }}</h4>
                                <h4>NIM     : {{ $mhs->mahasiswa->nim }}</h4>
                                <h4>Jurusan : {{ $mhs->mahasiswa->jurusan }}</h4>
                                <a href="/persetujuan/mhs/{{$mhs->id}}" class="ml-3 pl-3 btn btn-sm btn-success">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
