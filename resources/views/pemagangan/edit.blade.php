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
                        <form action="/pemagangan/{{ $data->id }}/update" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Mahasiswa</label>
                                <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                                    @foreach($data1 as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dosen Pembimbing</label>
                                <select name="dosenpembimbing_id" id="dosenpembimbing_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($data2 as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pembimbing Industri</label>
                                <select name="pembimbingindustri_id" id="pembimbingindustri_id" class="form-control">
                                    <option value=""></option>
                                    @foreach($data3 as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mulai Magang</label>
                                @foreach ($data1 as $data)
                                    <input type="date" class="form-control" name="mulai_magang" value="{{ $data->mulai_magang }}">
                                @endforeach
                                @if($errors->has('mulai_magang'))
                                    <p class="text-danger">{{ $errors->first('mulai_magang') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Selesai Magang</label>
                                @foreach ($data1 as $data)
                                    <input type="date" class="form-control" name="mulai_magang" value="{{ $data->selesai_magang }}">
                                @endforeach
                                @if($errors->has('selesai_magang'))
                                    <p class="text-danger">{{ $errors->first('selesai_magang') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Pekerjaan</label>
                                @foreach ($data1 as $data)
                                    <input type="text" class="form-control" name="jenis_pekerjaan" value="{{ $data->jenis_pekerjaan }}">
                                @endforeach
                                @if($errors->has('jenis_pekerjaan'))
                                    <p class="text-danger">{{ $errors->first('jenis_pekerjaan') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                <a href="/pemagangan" class="btn btn-warning">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
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

