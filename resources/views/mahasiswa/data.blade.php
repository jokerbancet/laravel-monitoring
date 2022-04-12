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
                    <h3 class="panel-title">Data Mahasiswa Bimbingan, {{auth()->user()->dosenPembimbing->nama??auth()->user()->pembimbingIndustri->nama}}</h3>
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
                                    <th>Prakerin ke</th>
                                    @if (auth()->user()->pembimbingIndustri)
                                        <th>Dosen Pembimbing</th>
                                        <th>Dosen Pembimbing 2</th>
                                    @else
                                        <th>Pembimbing Industri</th>
                                    @endif
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
                                        <td>{{ $data->pembimbingIndustri->industri->nama_industri ?? '' }}</td>
                                        <td align="center">{{ $data->prakerin_ke }}</td>
                                        @if (auth()->user()->pembimbingIndustri)
                                            <td>{{ $data->dosenPembimbing->nama??'' }}</td>
                                            <td>{{ $data->dosenPembimbing2->nama??'' }}</td>
                                        @else
                                            <td>{{ $data->pembimbingIndustri->nama??'' }}</td>
                                        @endif
                                        <td>{!! $data->is_active !!}</td>
                                        <td>
                                            <a href="{{url('/data-bimbingan/'.$data->mahasiswa->id.'/detail')}}" class="btn btn-info btn-xs">
                                                Detail
                                            </a>
                                            @if ($data->selesai_magang<=date('Y-m-d'))
                                                <a href="/data-bimbingan/{{ $data->id }}/print" target="_blank" class="btn btn-success btn-xs">Print</a>
                                            @endif
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
