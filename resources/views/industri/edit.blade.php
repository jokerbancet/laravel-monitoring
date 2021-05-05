@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Industri</h3>
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
                        <form action="/industri/{{ $industri->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="nama_industri">Nama Industri</label>
                                    <input type="text" class="form-control" name="nama_industri"
                                        placeholder="Masukan Nama Industri"
                                        value="{{ $industri->nama_industri }}">
                                    @if($errors->has('nama_industri'))
                                        <p class="text-danger">{{ $errors->first('nama_industri') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="kategori_industri">Kategori Industri</label>
                                    <input type="text" class="form-control" name="kategori_industri"
                                        placeholder="Masukan Nama Industri"
                                        value="{{ $industri->kategori_industri }}">
                                    @if($errors->has('kategori_industri'))
                                        <p class="text-danger">{{ $errors->first('kategori_industri') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="email" id="disabledTextInput" class="form-control" name="email" placeholder="Masukan Email"
                                        value="{{ $industri->email }}">
                                    @if($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="disabledTextInput" class="form-control" name="alamat" placeholder="Masukan alamat"
                                        value="{{ $industri->alamat }}">
                                    @if($errors->has('alamat'))
                                        <p class="text-danger">{{ $errors->first('alamat') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                <button href="/industri" class="btn btn-primary">Kembali</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
