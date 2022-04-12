@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            @if(session('sukses'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                </div>
            @endif
            <div class="panel">
                <div class="panel-heading">
                    <h2 class="panel-title">Data User</h2>
                    <div class="right">
                        <button type="button" class="btn" onclick="create()">
                            <i class="lnr lnr-plus-circle"></i>
                        </button>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table mydatatable">
                        <thead>
                            <tr>
                                <th style="width: 10px">NO</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 10px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <button class="btn btn-warning" onclick="detail({{json_encode($user->only('id','name','email','role'))}})">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <form action="{{ route('user.destroy', $user) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger" onclick="return confirm('Apakah Yakin?')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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

@include('user.modal')
@endsection

@push('js')
    <script>
        function create(){
            $('#formAction').attr('action', '/user')
            $('#form-method').val('post')
            $('#form-modal-title').html('Tambah Data User');
            $('#form-modal').modal('show');
            ['name','email','password','role'].forEach((v)=>{
                $('#'+v).val('')
            })
        }
        
        function detail(user){
            for(let i in user){
                $('#'+i).val(user[i])
            }
            $('#form-method').val('put')
            $('#formAction').attr('action', '/user/'+user.id)
            $('#form-modal-title').html('Edit Data User '+user.name);
            $('#form-modal').modal('show');
        }

        if(`{{ $errors->any() }}`){
            $('#form-modal').modal('show')
            $('#role').val('{{ old("role") }}')
        }
    </script>
@endpush