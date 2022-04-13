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
                            <h3 class="panel-title">Data Trash Mahasiswa</h3>
                        </div>
                        <div class="panel-body">
                            <div style="display: flex; justify-content: end; margin-bottom: 20px">
                                <button class="btn btn-sm btn-success" style="margin-right: 10px" id="restore-all">Restore All</button>
                                <button class="btn btn-sm btn-primary" id="restore">Restore Selected</button>
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
                                        <th>NIM</th>
                                        <th>Jurusan</th>
                                        <th>Tahun Angkatan</th>
                                        <th>Deleted at</th>
                                        <th style="width: 150px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswa as $mhs)
                                        <tr>
                                            <td style="width: 20px">
                                                <div class="form-check">
                                                    <input class="form-check-input selectbox" type="checkbox" value="{{ $mhs->id }}" id="check{{ $loop->iteration }}">
                                                </div>
                                            </td>
                                            <td>{{ $mhs->nama }}</td>
                                            <td>{{ $mhs->nim }}</td>
                                            <td>{{ $mhs->jurusan }}</td>
                                            <td>{{ $mhs->tahun_angkatan }}</td>
                                            <td>{{ $mhs->deleted_at }}</td>
                                            <td>
                                                <a href="/mahasiswa/{{ $mhs->id }}/restore" class="btn btn-success btn-xs">Restore</a>
                                                <a href="/mahasiswa/{{ $mhs->id }}/delete"
                                                    class="btn btn-danger btn-xs"
                                                    onclick="return confirm('Yakin data dengan nama {{ $mhs->nama }} akan dihapus?')">Hapus Permanent</a>
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

<form action="/mahasiswa/restore-selected" method="post" id="form-restore-selected">
    @csrf
    @method('patch')
    <input type="hidden" name="restore_all" value="false">
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
        $('#restore').on('click', function(){
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
                title: 'Apakah yakin ingin mengembalikan?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
            }).then(result => {
                if(result.isConfirmed){
                    $('#id-mhs').val(selected)
                    $('input[name=restore_all]').val(false)
                    $('#form-restore-selected').submit()
                }
            })
        })
        $('#restore-all').on('click', function(){
            Swal.fire({
                title: 'Apakah yakin ingin mengembalikan semua data?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
            }).then(result => {
                if(result.isConfirmed){
                    $('input[name=restore_all]').val(true)
                    $('#form-restore-selected').submit()
                }
            })
        })
        $('#subPages').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#mahasiswa').addClass('active')
    </script>
@endpush
