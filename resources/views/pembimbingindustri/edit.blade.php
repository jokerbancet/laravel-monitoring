@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Pembimbing Industri</h3>
                        @if(session('sukses'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('sukses') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="panel-body">
                        <form action="/pembimbingindustri/{{ $dpi->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama_depan">Nama Depan</label>
                                    <input type="text" class="form-control" name="nama_depan"
                                        placeholder="Masukan Nama Depan"
                                        value="{{ $dpi->nama_depan }}">
                                    @if($errors->has('nama_depan'))
                                        <p class="text-danger">{{ $errors->first('nama_depan') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_belakang">Nama Belakang</label>
                                    <input type="text" class="form-control" name="nama_belakang"
                                        placeholder="Masukan Nama Belakang"
                                        value="{{ $dpi->nama_belakang }}">
                                    @if($errors->has('nama_belakang'))
                                        <p class="text-danger">
                                            {{ $errors->first('nama_belakang') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" id="disabledTextInput" class="form-control" name="email" placeholder="Masukan Email"
                                    value="{{ $dpi->email }}" disabled>
                                @if($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="Laki-Laki"
                                    @if ($dpi->jk == 'Laki-Laki') selected
                                    @endif>
                                        Laki - Laki</option>
                                    <option value="Perempuan"
                                    @if ($dpi->jk == 'Perempuan') selected
                                    @endif>
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                <button href="/pembimbingindustri" class="btn btn-warning" >Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
