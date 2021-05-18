@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Dosen Pembimbing</h3>
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
                        <form action="/dosenpembimbing/{{ $dosen->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukan Nama Depan"
                                        value="{{ $dosen->nama }}">
                                    @if($errors->has('nama'))
                                        <p class="text-danger">{{ $errors->first('nama') }}
                                        </p>
                                    @endif
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="gelar_depan">Gelar Depan</label>
                                    <input type="text" class="form-control" name="gelar_depan"
                                        placeholder="Masukan Gelar Depan"
                                        value="{{ $dosen->gelar_depan }}">
                                    @if($errors->has('gelar_depan'))
                                        <p class="text-danger">{{ $errors->first('gelar_depan') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="gelar_belakang">Gelar Belakang</label>
                                    <input type="text" class="form-control" name="gelar_belakang"
                                        placeholder="Masukan Nama Belakang"
                                        value="{{ $dosen->gelar_belakang }}">
                                    @if($errors->has('gelar_belakang'))
                                        <p class="text-danger">
                                            {{ $errors->first('gelar_belakang') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIDN</label>
                                <input type="number" class="form-control" name="nidn" placeholder="Masukan NIDN"
                                    value="{{ $dosen->nidn }}">
                                @if($errors->has('nidn'))
                                    <p class="text-danger">{{ $errors->first('nidn') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" id="disabledTextInput" class="form-control" name="email" placeholder="Masukan Email"
                                    value="{{ $dosen->email }}" disabled>
                                @if($errors->has('email'))
                                    <p class="text-danger">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select name="jk" id="jk" class="form-control">
                                    <option value="Laki-Laki"
                                    @if ($dosen->jk == 'Laki-Laki') selected
                                    @endif>
                                        Laki - Laki</option>
                                    <option value="Perempuan"
                                    @if ($dosen->jk == 'Perempuan') selected
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
                                <a href="/dosenpembimbing" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
