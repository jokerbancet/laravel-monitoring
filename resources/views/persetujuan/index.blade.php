@extends('layouts.layout_master')

@section('main_content2')
{{-- <livewire:persetujuan-modal/> --}}
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
                            <div class="panel-heading">
                                <img src="{{ $mhs->mahasiswa->getAvatar() }}" alt="" class="image-thumbnails" style="max-height: 100px">
                                <h4 class="panel-title">{{ $mhs->mahasiswa->nama }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
