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
                            <h3 class="panel-title">Data Pemagangan</h3>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="#tambahdatamagang">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Mulai Magang</th>
                                        <th>Selesai Magang</th>
                                        {{-- <th>Jenis Pekerjaan</th> --}}
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemagangan as $p)
                                        <tr>
                                            <td>{{ $p->nama}}</td>
                                            <td>{{ $p->jurusan }}</td>
                                            <td>{{ $p->mulai_magang }}</td>
                                            <td>{{ $p->selesai_magang }}</td>
                                            {{-- <td>{{ $p->jenis_pekerjaan }}</td> --}}
                                                @php
                                                    $tgl_sekarang = strtotime(date("d-m-Y"));
                                                    $tgl_selesai = strtotime($p->selesai_magang);
                                                @endphp
                                            <td>@php
                                                if($tgl_sekarang < $tgl_selesai){
                                                    echo '<span class="label label-primary">Sedang Magang</span>';
                                                }else{
                                                    echo '<span class="label label-success">Selesai Magang</span>';
                                                }
                                                @endphp
                                            </td>
                                            <td><a href="/mahasiswa/{{ $p->mahasiswa_id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                <a href="/pemagangan/{{ $p->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/pemagangan/{{ $p->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $p->nama }} akan dihapus?')"><i
                                                        class="lnr lnr-trash"></i></a>
                                            </td>
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


<!-- Modal -->
<div class="modal fade" id="tambahdatamagang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pemagangan/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mahasiswa</label>
                            <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                                <option value=""></option>
                                @foreach ($data1 as $data)
                                    <option value="{{$data->id}}">{{$data->nama.' - '.$data->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dosen Pembimbing</label>
                        <select name="dosenpembimbing_id" id="dosenpembimbing_id" class="form-control">
                            <option value=""></option>
                            @foreach ($data2 as $data)
                                <option value="{{$data->id}}">{{$data->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pembimbing Industri</label>
                        <select name="pembimbingindustri_id" id="pembimbingindustri_id" class="form-control">
                            <option value=""></option>
                            @foreach ($data3 as $data)
                                <option value="{{$data->id}}">{{$data->nama.' - '.$data->nama_industri}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mulai Magang</label>
                        <input type="date" class="form-control" name="mulai_magang" value="{{old('mulai_magang')}}">
                        @if ($errors->has('mulai_magang'))
                                <p class="text-danger">{{$errors->first('mulai_magang')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Selesai Magang</label>
                        <input type="date" class="form-control" name="selesai_magang" value="{{old('selesai_magang')}}">
                        @if ($errors->has('selesai_magang'))
                                <p class="text-danger">{{$errors->first('selesai_magang')}}</p>
                            @endif
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Pekerjaan</label>
                        <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Masukan Jenis Pekerjaan" value="{{old('jenis_pekerjaan')}}">
                        @if ($errors->has('jenis_pekerjaan'))
                                <p class="text-danger">{{$errors->first('jenis_pekerjaan')}}</p>
                            @endif
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#subPages2').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#data-pemagang').addClass('active')
    </script>
@endpush
