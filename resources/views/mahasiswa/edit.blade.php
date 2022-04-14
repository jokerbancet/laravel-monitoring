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
                        <form action="/mahasiswa/{{ $mahasiswa->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        placeholder="Masukan Nama Depan" value="{{ $mahasiswa->nama }}">
                                        @if($errors->has('nama'))
                                        <p class="text-danger">{{ $errors->first('nama') }}
                                        </p>
                                    @endif
                                </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukan Email"
                                    value="{{ $mahasiswa->email }}" disabled>
                                    @if($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}
                                        </p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">NIM</label>
                                <input type="number" class="form-control" name="nim" placeholder="Masukan NIM"
                                    value="{{ $mahasiswa->nim }}">
                                    @if($errors->has('nim'))
                                        <p class="text-danger">{{ $errors->first('nim') }}
                                        </p>
                                    @endif
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="jk">Jenis Kelamin</label>
                                    <select name="jk" id="jk" class="form-control">
                                        <option value="Laki-Laki" @if ($mahasiswa->jk == 'Laki-Laki') selected
                                            @endif>Laki - Laki</option>
                                        <option value="Perempuan" @if ($mahasiswa->jk == 'Perempuan') selected
                                            @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="agama">Agama</label>
                                    <select name="agama" id="agama" class="form-control">
                                        <option value="Islam" @if ($mahasiswa->agama == 'Islam') selected @endif>Islam
                                        </option>
                                        <option value="Kristen" @if ($mahasiswa->agama == 'Kristen') selected
                                            @endif>Kristen</option>
                                        <option value="Katholik" @if ($mahasiswa->agama == 'Katholik') selected
                                            @endif>Katholik</option>
                                        <option value="Hindu" @if ($mahasiswa->agama == 'Hindu') selected @endif>Hindu
                                        </option>
                                        <option value="Budha" @if ($mahasiswa->agama == 'Budha') selected @endif>Budha
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat"
                                    value="{{ $mahasiswa->alamat }}">
                                    @if($errors->has('alamat'))
                                        <p class="text-danger">{{ $errors->first('alamat') }}
                                        </p>
                                    @endif
                            </div>
                            <div class="form-group">
                                <label for="jurusan">Prodi</label>
                                @if (auth()->user()->role=='admin')
                                    <select name="jurusan" id="jurusan" class="form-control">
                                        <option value="Teknologi Geologi" @if ($mahasiswa->jurusan == 'Teknologi Geologi') selected @endif>Teknologi Geologi</option>
                                        <option value="Teknologi Pertambangan" @if ($mahasiswa->jurusan == 'Teknologi Pertambangan') selected @endif>Teknologi Pertambangan</option>
                                        <option value="Teknologi Metalurgi" @if ($mahasiswa->jurusan == 'Teknologi Metalurgi') selected @endif>Teknologi Metalurgi</option>
                                    </select>
                                @else
                                    <input type="text" name="jurusan" id="jurusan" value="{{ $mahasiswa->jurusan }}" readonly class="form-control">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Angkatan</label>
                                <input type="text" class="form-control" name="tahun_angkatan"
                                    placeholder="Masukan Tahun Angkatan" value="{{ $mahasiswa->tahun_angkatan }}">
                                @if($errors->has('tahun angkatan'))
                                    <p class="text-danger">{{ $errors->first('tahun angkatan') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Foto</label>
                                <input type="file" class="form-control" name="avatar">
                                @if($errors->has('avatar'))
                                    <p class="text-danger">{{ $errors->first('avatar') }} </p>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit Data</button>
                                <a href="/mahasiswa" class="btn btn-warning">Kembali</a>
                                <a href="#" class="btn btn-success" onclick="changePasswordModal({{ $mahasiswa->user }})">Reset Kata Sandi</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('user.reset-password')
@endsection

@push('js')
<script>
    $('#subPages').addClass('in').prev().addClass('active').removeClass('collapsed');
    $('#mahasiswa').addClass('active')
</script>
@endpush
