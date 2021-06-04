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
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Mahasiswa Bimbingan, {{auth()->user()->dosenPembimbing->nama}}</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover mydatatable" id="mydatatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>NIM</th>
                                    <th>Jurusan</th>
                                    <th>Industri</th>
                                    <th>Pembimbing Industri</th>
                                    <th>Status Magang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mahasiswa as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->mahasiswa->nama }}</td>
                                        <td>{{ $data->mahasiswa->nim }}</td>
                                        <td>{{ $data->mahasiswa->jurusan }}</td>
                                        <td>{{ $data->pembimbingIndustri->industri->nama_industri }}</td>
                                        <td>{{ $data->pembimbingIndustri->nama }}</td>
                                        <td>
                                            @if(date('Y-m-d') < $data->selesai_magang){
                                                <span class="label label-primary">Mulai Magang</span>
                                            @else
                                                <span class="label label-success">Selesai Magang</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/data-bimbingan/'.$data->id.'/detail')}}" class="btn btn-info">
                                                Detail
                                            </a>
                                        </td>
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
@endsection
@push('js')
    <script>
        $('#data-bimbingan').addClass('active');
    </script>
@endpush
