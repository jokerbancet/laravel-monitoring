@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Data Mahasiswa</h3>
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
                        <form action="/capaian/{{ $capaian->id }}/update" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option value=""></option>
                                    <option value="Teknologi Geologi"
                                        @if ($capaian->jurusan == 'Teknologi Geologi') selected @endif>
                                        Teknologi Geologi</option>
                                    <option value="Teknologi Pertambangan"
                                        @if ($capaian->jurusan == 'Teknologi Pertambangan') selected @endif>
                                        Teknologi Pertambangan</option>
                                    <option value="Teknologi Metalurgi"
                                        @if ($capaian->jurusan == 'Teknologi Metalurgi') selected @endif>
                                        Teknologi Metalurgi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_capaian">Deskripsi Capaian</label>
                                <textarea name="deskripsi_capaian" id="deskripsi_capaian" class="form-control" cols="20"
                                    rows="10">{{ $capaian->deskripsi_capaian }}</textarea>
                                @if($errors->has('deskripsi_capaian'))
                                    <p class="text-danger">
                                        {{ $errors->first('deskripsi_capaian') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="kategori_capaian">Kategori Capaian</label>
                                <select name="kategori_capaian" id="kategori_capaian" class="form-control">
                                    <option value="sikap"
                                        @if ($capaian->kategori_capaian == 'sikap') selected @endif>
                                        Sikap</option>
                                    <option value="pengetahuan"
                                        @if ($capaian->kategori_capaian == 'pengetahuan') selected @endif>
                                        Pengetahuan</option>
                                    <option value="keterampilan umum"
                                        @if ($capaian->kategori_capaian == 'keterampilan umum') selected @endif>
                                        Keterampilan Umum</option>
                                    <option value="keterampilan khusus"
                                    @if ($capaian->kategori_capaian == 'keterampilan khusus') selected @endif>
                                        Keterampilan Khusus</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bobot_capaian">Bobot Nilai</label>
                                <input type="number" class="form-control" name="bobot_capaian" value="{{ $capaian->bobot_capaian}}">
                                @if($errors->has('bobot_capaian'))
                                    <p class="text-danger">{{ $errors->first('bobot_capaian') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                <a href="/capaian" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
