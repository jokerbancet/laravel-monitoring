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
                            <h3 class="panel-title d-flex justify-content-between">
                                <span>
                                    Data Laporan Mahasiswa
                                </span>
                                {{-- <span>
                                    <label for="is_enabled">Enabled Laporan Weekend</label>
                                    <input type="checkbox" name="is_enabled" {{ $is_enabled=='true'?'checked':'' }} id="is_enabled">
                                </span> --}}
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="datalaporan_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Dosen Pembimbing</th>
                                            <th>Dosen Pembimbing 2</th>
                                            <th>Pembimbing Industri</th>
                                            <th>Industri</th>
                                            <th>Tanggal Laporan</th>
                                            <th>Persetujuan Pembimbing Industri</th>
                                            <th>Persetujuan Dosen Pembimbing 1</th>
                                            <th>Persetujuan Dosen Pembimbing 2</th>
                                            <th>Status Laporan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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
        $('#subPages3').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#data-laporan').addClass('active')
        $('#is_enabled').on('change', function(){
            $.ajax({
                url:'/api/set-enable-laporan',
                method: 'post',
                data: {is_enabled:$(this).prop('checked')}
            })
        })
        $("#datalaporan_table").DataTable({
            "processing": true,
            "serverSide": true,
            "bSort" : true,
            "ajax": {
                url: "/datalaporan-ajax"
            },
            // orderCellsTop: true,
            fixedHeader: true,
            "columns": [
                {data:"id"},
                {data:"mahasiswa.nama"},
                {data:"dosen_pembimbing.nama"},
                {data:"dosen_pembimbing2.nama"},
                {data:"pembimbing_industri.nama"},
                {data:"pembimbing_industri.industri.nama_industri"},
                {data:"tanggal_laporan"},
                {data:"approve_industri"},
                {data:"approve_dospem1"},
                {data:"approve_dospem2"},
                {data:"status_laporan"},
            ],
        })
    </script>
@endpush
