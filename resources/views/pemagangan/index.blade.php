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
                                        <th>Jenis Pekerjaan</th>
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
                                            <td>{{ $p->jenis_pekerjaan }}</td>
                                            <td>@php
                                                if($p->status_magang == 1){
                                                    echo '<span class="label label-primary">Mulai Magang</span>';
                                                }elseif($p->status_magang == 2){
                                                    echo '<span class="label label-success">Selesai Magang</span>';
                                                }else{
                                                }
                                                @endphp
                                            </td>
                                            <td><a href="/mahasiswa/{{ $p->id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                <a href="/mahasiswa/{{ $p->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/mahasiswa/{{ $p->id }}/delete"
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
                <form action="/magang/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="mahasiswa_id" placeholder="Masukan Nama Mahasiswa" value="{{old('nama_depan')}}">
                            @if ($errors->has('nama_depan'))
                                <p class="text-danger">{{$errors->first('nama_depan')}}</p>
                            @endif
                        </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dosen Pembimbing</label>
                        <input type="text" class="form-control" name="dosenpembimbing_id" placeholder="Masukan Nama Dosen Pembimbing" value="{{old('email')}}">
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pembimbing Industri</label>
                        <input type="text" class="form-control" name="pembimbingindustri_id" placeholder="Masukan Nama Pembimbing Industri" value="{{old('email')}}">
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mulai Magang</label>
                        <input type="date" class="form-control" name="pembimbingindustri_id" placeholder="Masukan Email" value="{{old('email')}}">
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Selesai Magang</label>
                        <input type="date" class="form-control" name="pembimbingindustri_id" placeholder="Masukan Email" value="{{old('email')}}">
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Pekerjaan</label>
                        <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Masukan Jenis Pekerjaan" value="{{old('email')}}">
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="status_magang">Status Magang</label>
                            <select name="jk" id="jk" class="form-control">
                                <option value="1">Mulai Magang</option>
                                <option value="2">Selesai Magang</option>
                            </select>
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
