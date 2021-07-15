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
                        <form action="/pemagangan/{{ $pemagang->id }}/update" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="mahasiswa_id">Nama Mahasiswa</label>
                                        <select name="mahasiswa_id" id="mahasiswa_id" class="form-control">
                                            @foreach($mahasiswa as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row no-gutters gt-1">
                                        <div class="col-sm-6">
                                            <label for="dosenpembimbing_id">Dosen Pembimbing 1</label>
                                            <select name="dosenpembimbing_id" id="dosenpembimbing_id" class="form-control">
                                                <option value=""></option>
                                                @foreach($dosenPembimbing as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="dosenpembimbing_id">Dosen Pembimbing 2</label>
                                            <select name="dosenpembimbing2_id" id="dosenpembimbing2_id" class="form-control">
                                                <option value=""></option>
                                                @foreach($dosenPembimbing as $data)
                                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pembimbingindustri_id">Pembimbing Industri</label>
                                        <select name="pembimbingindustri_id" id="pembimbingindustri_id" class="form-control">
                                            <option value=""></option>
                                            @foreach($pembimbingIndustri as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="mulai">Mulai Magang</label>
                                        <input type="date" class="form-control" id="mulai_magang" name="mulai_magang">
                                        @error('mulai_magang')
                                            <i class="text-sm text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="selesai_magang">Selesai Magang</label>
                                        <input type="date" class="form-control" id="selesai_magang" name="selesai_magang">
                                        @error('selesai_magang')
                                            <i class="text-sm text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                                        <input type="text" class="form-control" id="jenis_pekerjaan" name="jenis_pekerjaan">
                                        @error('jenis_pekerjaan')
                                            <i class="text-sm text-danger">{{$message}}</i>
                                        @enderror
                                    </div>
                                </div>
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
        $.ajax({
            url: '',
            success: function(pemagang){
                for(let index in pemagang){
                    $('#'+index).val(pemagang[index]);
                }
            }
        })
    </script>
@endpush

