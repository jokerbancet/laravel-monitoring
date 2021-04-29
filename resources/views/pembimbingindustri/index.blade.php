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
                            <h3 class="panel-title">Data Pembimbing Industri</h3>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal" data-target="#tambahdatapi">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dpi as $pi)
                                        <tr>
                                            <td>{{ $pi->nama_depan.' '.$pi->nama_belakang }}</td>
                                            <td>{{ $pi->email }}</td>
                                            <td><a href="/pembimbingindustri/{{ $pi->id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                <a href="/pembimbingindustri/{{ $pi->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/pembimbingindustri/{{ $pi->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $pi->nama_depan }} akan dihapus?')"><i
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
<div class="modal fade" id="tambahdatapi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembimbing Industri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pembimbingindustri/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_depan">Nama Depan</label>
                            <input type="text" class="form-control" name="nama_depan" placeholder="Masukan Nama Depan"
                                value="{{ old('nama_depan') }}">
                            @if($errors->has('nama_depan'))
                                <p class="text-danger">{{ $errors->first('nama_depan') }}</p>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input type="text" class="form-control" name="nama_belakang"
                                placeholder="Masukan Nama Belakang"
                                value="{{ old('nama_belakang') }}">
                            @if($errors->has('nama_belakang'))
                                <p class="text-danger">{{ $errors->first('nama_belakang') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email"
                            value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control">
                            <option value="Laki-Laki"
                                {{ old('jk') == 'Laki-Laki' ? ' selected' : '' }}>
                                Laki - Laki</option>
                            <option value="Perempuan"
                                {{ old('jk') == 'Perempuan' ? ' selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Foto</label>
                        <input type="file" class="form-control" name="avatar">
                        @if($errors->has('avatar'))
                            <p class="text-danger">{{ $errors->first('avatar') }}</p>
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
