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
            <h3 class="mb-3">{{ $title??'' }}</h3>
            <div class="row">
                @foreach ($mahasiswa as $mhs)
                    <div class="col-sm-12 col-md-6">
                        <div class="panel">
                            <div class="panel-body">
                                <h4 style="display: flex; justify-content: space-between">
                                    <span>Nama    : {{ $mhs->mahasiswa->nama }}</span><b>Prakerin Ke-{{ $mhs->prakerin_ke }}</b>
                                </h4>
                                <h4>NIM     : {{ $mhs->mahasiswa->nim }}</h4>
                                <h4>Jurusan : {{ $mhs->mahasiswa->jurusan }}</h4>
                                <a href="{{$action.$mhs->id}}" class="ml-3 pl-3 btn btn-sm btn-success">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
