@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="h3">Halo, {{auth()->user()->name}}.</span>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button class="btn btn-success">Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <ul class="col-md-12">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @endif

                @if(session('sukses'))
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                        <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                    </div>
                </div>
                @endif

                <div class="col-md-12">
                    <!-- TABLE HOVER -->
                    <div class="panel">
                        <div class="panel-body">
                            <form action="" method="post">
                                @include('datalaporan._form')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#laporan').addClass('active');
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic'
            })
        });

        $('#id_data_bimbingan').on('change', function(){
            let id = $(this).val()
            $.ajax({
                url: '/pemagangan/'+id,
                success: function(mhs){
                    $('#capaian_id').empty().append('<option></option>');
                    mhs.forEach(element => {
                        $('#capaian_id').append(`<option value="${element.id}">${element.deskripsi_capaian}</option>`)
                    });
                }
            })
        })
    </script>
@endpush
