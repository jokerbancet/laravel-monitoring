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
                                    <button class="btn btn-success" id="import-modal">Import</button>
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

<!-- Modal Form Import Excel -->
<div class="modal fade" id="importExcel" role="dialog" aria-labelledby="importExcelLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/inputlaporan/excel" id="formExcel" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importExcelLabel">Import Data Laporan</h5>
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
                            <thead>
                                <tr>
                                    <th>ID Data Bimbingan</th>
                                    <th>Capaian ID</th>
                                    <th>Tgl Laporan</th>
                                    <th>Kegiatab</th>
                                    <th>Deskripsi</th>
                                    <th>Durasi</th>
                                    <th>Output</th>
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

        $('#import-modal').on('click', function(){
            $('#importExcel').modal('show')
        })

        $('#excel').change(function(){
            let fd = new FormData();
            let files = $(this)[0].files;

            // Check file selected or not
            if(files.length > 0 ){
                fd.append('excel',files[0]);
                fd.append('_token',$('input[name=_token]').val());
                $.ajax({
                    method: 'post',
                    url: '/inputlaporan/excel',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        console.log(result);
                        $('.table-excel tbody').empty();
                        $('.table-excel').show().DataTable({
                            data: result,
                            destroy:true
                        });
                    }
                })
            }
        })
    </script>
@endpush
