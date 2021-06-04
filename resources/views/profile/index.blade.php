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
                <div class="panel-heading">Ganti Password</div>
                <div class="panel-body">
                    <form action="" method="post">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Password Lama</label>
                            <input type="password" class="form-control" name="old_password" id="old_password">
                            @error('old_password')
                                <i class="text-sm text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" class="form-control" name="password" id="password">
                            @error('password')
                                <i class="text-sm text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password_confirmation Baru</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                                <i class="text-sm text-danger">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-netral">Ganti</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
