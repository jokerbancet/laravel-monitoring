@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
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
                            <h3 class="panel-title">Data Laporan Mahasiswa</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Dosen Pembimbing 2</th>
                                        <th>Pembimbing Industri</th>
                                        <th>Industri</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Persetujuan Dosen</th>
                                        <th>Persetujuan Pembimbing Industri</th>
                                        <th>Status Laporan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $d)
                                        <tr>
                                            <td>{{ $d->mahasiswa->nama??'' }}</td>
                                            <td>{{ $d->dosenPembimbing->nama??'' }}</td>
                                            <td>{{ $d->dosenPembimbing2->nama??'' }}</td>
                                            <td>{{ $d->pembimbingIndustri->nama??'' }}</td>
                                            <td>{{ $d->pembimbingIndustri->industri->nama_industri??'' }}</td>
                                            <td>{{ $d->updated_at??'' }}</td>
                                            <td><span class="label {{cek_status($d->approve_dosen,1)}}">{{ $d->approve_dosen??'' }}</span></td>
                                            <td><span class="label {{cek_status($d->approve_industri,1)}}">{{ $d->approve_industri??'' }}</span></td>
                                            <td><span class="label {{cek_status($d->status_laporan,2)}}">{{ $d->status_laporan??'' }}</span></td>
                                            {{-- <td><a href="/mahasiswa/{{ $d->id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                <a href="/mahasiswa/{{ $d->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/mahasiswa/{{ $d->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $d->nama_depan }} akan dihapus?')"><i
                                                        class="lnr lnr-trash"></i></a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#subPages3').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#data-laporan').addClass('active')
    </script>
@endpush
