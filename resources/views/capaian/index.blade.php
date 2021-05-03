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
                            <h3 class="panel-title">Data Master Indikator Capaian</h3>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal" data-target="#tambahdataindikatorcapaian">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Prodi/Jurusan</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori</th>
                                        <th>Bobot Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($capaian as $c)
                                        <tr>
                                            <td>{{ $c->jurusan }}</td>
                                            <td>{{ $c->deskripsi_capaian }}</td>
                                            <td>{{ $c->kategori_capaian }}</td>
                                            <td>{{ $c->bobot_capaian }}</td>
                                            <td><a href="/capaian/{{ $c->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/capaian/{{ $c->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $c->nama_depan }} akan dihapus?')"><i
                                                        class="lnr lnr-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahdataindikatorcapaian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Indikator Capaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/capaian/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-control">
                                <option value=""></option>
                                <option value="Teknologi Geologi"{{old('jurusan') == 'Teknologi Geologi' ? ' selected' : ''}}>Teknologi Geologi</option>
                                <option value="Teknologi Pertambangan"{{old('jurusan') == 'Teknologi Pertambangan' ? ' selected' : ''}}>Teknologi Pertambangan</option>
                                <option value="Teknologi Metalurgi"{{old('jurusan') == 'Teknologi Metalurgi' ? ' selected' : ''}}>Teknologi Metalurgi</option>
                        </select>
                        </div>
                    <div class="form-group">
                        <label for="deskripsi_capaian">Deskripsi Capaian</label>
                        <textarea name="deskripsi_capaian" id="deskripsi_capaian" class="form-control" cols="20" rows="10">{{old('deskripsi_capaian')}}</textarea>
                        @if($errors->has('deskripsi_capaian'))
                            <p class="text-danger">{{ $errors->first('deskripsi_capaian') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="kategori_capaian">Kategori Capaian</label>
                        <select name="kategori_capaian" id="kategori_capaian" class="form-control">
                            <option value="sikap"
                                {{ old('kategori_capaian') == 'sikap' ? ' selected' : '' }}>
                                Sikap</option>
                            <option value="pengetahuan"
                                {{ old('kategori_capaian') == 'pengetahuan' ? ' selected' : '' }}>
                                Pengetahuan</option>
                            <option value="keterampilan umum"
                                {{ old('kategori_capaian') == 'keterampilan umum' ? ' selected' : '' }}>
                                Keterampilan Umum</option>
                            <option value="keterampilan khusus"
                                {{ old('kategori_capaian') == 'keterampilan khusus' ? ' selected' : '' }}>
                                Keterampilan Khusus</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bobot_capaian">Bobot Nilai</label>
                        <input type="number" class="form-control" name="bobot_capaian">
                        @if($errors->has('bobot_capaian'))
                            <p class="text-danger">{{ $errors->first('bobot_capaian') }}</p>
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
