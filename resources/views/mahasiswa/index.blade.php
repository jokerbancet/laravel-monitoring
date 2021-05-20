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
                            <h3 class="panel-title">Data Mahasiswa</h3>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="#tambahdatamahasiswa">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>NIM</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Angkatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_mahasiswa as $mhs)
                                        <tr>
                                            <td>{{ $mhs->nama }}</td>
                                            <td>{{ $mhs->email }}</td>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->jurusan }}</td>
                                            <td>{{ $mhs->tahun_angkatan }}</td>
                                            <td><a href="/mahasiswa/{{ $mhs->id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                <a href="/mahasiswa/{{ $mhs->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/mahasiswa/{{ $mhs->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $mhs->nama_depan }} akan dihapus?')"><i
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
<div class="modal fade" id="tambahdatamahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/mahasiswa/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Depan" value="{{old('nama')}}">
                            @if ($errors->has('nama'))
                                <p class="text-danger">{{$errors->first('nama')}}</p>
                            @endif
                        </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" value="{{old('email')}}">
                        @if ($errors->has('email'))
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIM</label>
                        <input type="number" class="form-control" name="nim" placeholder="Masukan NIM" value="{{old('nim')}}">
                        @if ($errors->has('nim'))
                                <p class="text-danger">{{$errors->first('nim')}}</p>
                            @endif
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="jk">Jenis Kelamin</label>
                            <select name="jk" id="jk" class="form-control">
                                <option value="Laki-Laki"{{old('jk') == 'Laki-Laki' ? ' selected' : ''}}>Laki - Laki</option>
                                <option value="Perempuan"{{old('jk') == 'Perempuan' ? ' selected' : ''}}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="agama">Agama</label>
                            <select name="agama" id="agama" class="form-control">
                                <option value="Islam"{{old('agama') == 'Islam' ? ' selected' : ''}}>Islam</option>
                                <option value="Kristen"{{old('agama') == 'Kristen' ? ' selected' : ''}}>Kristen</option>
                                <option value="Katholik"{{old('agama') == 'Katholik' ? ' selected' : ''}}>Katholik</option>
                                <option value="Hindu"{{old('agama') == 'Hindu' ? ' selected' : ''}}>Hindu</option>
                                <option value="Budha"{{old('agama') == 'Budha' ? ' selected' : ''}}>Budha</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Masukan Alamat" value="{{old('alamat')}}">
                        @if ($errors->has('alamat'))
                                <p class="text-danger">{{$errors->first('alamat')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="jurusan">jurusan</label>
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option value="Teknologi Geologi"{{old('jurusan') == 'Teknologi Geologi' ? ' selected' : ''}}>Teknologi Geologi</option>
                            <option value="Teknologi Pertambangan"{{old('jurusan') == 'Teknologi Pertambangan' ? ' selected' : ''}}>Teknologi Pertambangan</option>
                            <option value="Teknologi Metalurgi"{{old('jurusan') == 'Teknologi Metalurgi' ? ' selected' : ''}}>Teknologi Metalurgi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tahun Angkatan</label>
                        <input type="text" class="form-control" name="tahun_angkatan"
                            placeholder="Masukan Tahun Angkatan" value="{{old('tahun_angkatan')}}">
                            @if ($errors->has('tahun_angkatan'))
                                <p class="text-danger">{{$errors->first('tahun_angkatan')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Foto</label>
                        <input type="file" class="form-control" name="avatar">
                        @if ($errors->has('avatar'))
                                <p class="text-danger">{{$errors->first('avatar')}}</p>
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
        $('#mahasiswa').addClass('active')
    </script>
@endpush
