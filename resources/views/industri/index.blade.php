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
                            <h3 class="panel-title">Data Industri</h3>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal" data-target="#tambahdataindustri">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Nama Industri</th>
                                        <th>Kategori Industri</th>
                                        <th>Created at</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($industri as $ind)
                                        <tr>
                                            <td>{{ $ind->nama_industri }}</td>
                                            <td>{{ $ind->kategori_industri }}</td>
                                            <td>{{ $ind->created_at }}</td>
                                            <td><a href="/industri/{{ $ind->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/industri/{{ $ind->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $ind->nama_industri }} akan dihapus?')"><i
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
<div class="modal fade" id="tambahdataindustri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="/industri/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nama_industri">Nama Industri</label>
                            <input type="text" class="form-control" name="nama_industri"
                                placeholder="Masukan Nama Industri"
                                value="{{ old('nama_industri') }}">
                            @if($errors->has('nama_industri'))
                                <p class="text-danger">{{ $errors->first('nama_industri') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="kategori_industri">Kategori Industri</label>
                            <input type="text" class="form-control" name="kategori_industri"
                                placeholder="Masukan Kategori Industri"
                                value="{{ old('kategori_industri') }}">
                            @if($errors->has('kategori_industri'))
                                <p class="text-danger">{{ $errors->first('kategori_industri') }}</p>
                            @endif
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
                        <label for="alamat">Alamat Industri</label>
                        <input type="text" class="form-control" name="alamat"
                            placeholder="Masukan Alamat Industri"
                            value="{{ old('alamat') }}">
                        @if($errors->has('alamat'))
                            <p class="text-danger">{{ $errors->first('alamat') }}</p>
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

@push('js')
    <script>
        $('#subPages').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#industri').addClass('active')
    </script>
@endpush

