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
                                <button type="button" class="btn" data-toggle="modal" data-target="#importExcel">Import Excel</button>
                                <button type="button" class="btn" data-toggle="modal"
                                    data-target="#tambahdatamahasiswa">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 20px">
                                <div style="display: flex">
                                    <a href="/mahasiswa/trash" class="btn btn-sm btn-info">
                                        Sampah <span class="bg-primary" style="margin-left: 5px; border-radius: 50%; padding: 2px 5px">{{ $trash }}</span></a>
                                    <select name="filter" id="filter" class="form-control" style="margin-left: 10px">
                                        <option>Semua</option>
                                        @foreach ($data_mahasiswa->groupBy('tahun_angkatan') as $thn => $item)
                                            <option>{{ $thn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-danger" style="margin-right: 10px" id="soft-delete-all">Delete All</button>
                                    <button class="btn btn-sm btn-warning" id="soft-delete">Delete Selected</button>
                                </div>
                            </div>
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th style="width: 20px">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="checkAll">
                                            </div>
                                        </th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>NIM</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Angkatan</th>
                                        <th>Created at</th>
                                        <th style="width: 150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_mahasiswa as $mhs)
                                        <tr>
                                            <td style="width: 20px">
                                                <div class="form-check">
                                                    <input class="form-check-input selectbox" type="checkbox" value="{{ $mhs->id }}" id="check{{ $loop->iteration }}">
                                                </div>
                                            </td>
                                            <td>{{ $mhs->nama }}</td>
                                            <td>{{ $mhs->email }}</td>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->jurusan }}</td>
                                            <td>{{ $mhs->tahun_angkatan }}</td>
                                            <td>{{ $mhs->created_at }}</td>
                                            <td><a href="/mahasiswa/{{ $mhs->id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                <a href="/mahasiswa/{{ $mhs->id }}/edit"
                                                    class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                <a href="/mahasiswa/{{ $mhs->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $mhs->nama }} akan dihapus?')"><i
                                                        class="lnr lnr-trash"></i></a>
                                                <a href="#" class="btn btn-success btn-xs" 
                                                    onclick="changePasswordModal({{ $mhs->user }})"><i class="lnr lnr-lock"></i></a>
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

@include('user.reset-password')
<!-- Modal Form Import Excel -->
<div class="modal fade" id="importExcel" role="dialog" aria-labelledby="importExcelLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/mahasiswa/excel" id="formExcel" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importExcelLabel">Import Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group margin-bottom-10">
                        <label for="excel">Pilih Excel</label>
                        <input type="file" name="excel" id="excel" class="form-control">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-excel table-striped">
                            <th>NIM</th>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>EMAIL</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Alamat</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Angkatan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahdatamahasiswa" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <div class="row g-1">
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

<form action="/mahasiswa/delete-selected" method="post" id="form-delete-selected">
    @csrf
    @method('delete')
    <input type="hidden" name="delete_all" value="false">
    <input type="hidden" name="id" value="" id="id-mhs">
</form>
@endsection

@push('js')
    <script>
        function setChecked(){
            let is_checked = $('#checkAll').prop('checked');
            $('.selectbox').prop('checked', is_checked)
        }
        setChecked();
        $('#checkAll').on('change', setChecked)
        $('#soft-delete').on('click', function(){
            let selected = []
            $('.selectbox:checked').each((k, node) => {
                selected.push(node.value)
            })
            
            if(selected.length<1){
                Swal.fire({
                    icon: 'error',
                    title: 'Pilih data terlebih dahulu',
                    toast: true,
                    position: 'top-end',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                })
                return 0;
            }
            Swal.fire({
                title: 'Apakah yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
            }).then(result => {
                if(result.isConfirmed){
                    $('#id-mhs').val(selected)
                    $('input[name=delete_all]').val(false)
                    $('#form-delete-selected').submit()
                }
            })
        })
        $('#soft-delete-all').on('click', function(){
            Swal.fire({
                title: 'Apakah yakin ingin menghapus semua data?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
            }).then(result => {
                if(result.isConfirmed){
                    $('input[name=delete_all]').val(true)
                    $('#form-delete-selected').submit()
                }
            })
        })
        $('#subPages').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#mahasiswa').addClass('active')
        $('.table-excel').hide();
        $('#excel').change(function(){
            let fd = new FormData();
            let files = $(this)[0].files;

            // Check file selected or not
            if(files.length > 0 ){
                fd.append('excel',files[0]);
                fd.append('_token',$('input[name=_token]').val());
                $.ajax({
                    method: 'post',
                    url: '/mahasiswa/excel',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        $('.table-excel tbody').empty();
                        $('.table-excel').show().DataTable({
                            data: result,
                            destroy:true
                        });
                    }
                })
            }
        })
        $('#filter').on('change', function(){
            table
                .column( 5 )
                .search($(this).val()=='Semua'?'':this.value).draw()
        })
    </script>
@endpush
