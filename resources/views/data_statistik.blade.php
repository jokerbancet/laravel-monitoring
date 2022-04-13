@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Statistik Mahasiswa</h3>
                </div>
                <div class="panel-body">
                    <div style="display: flex">
                        <div class="form-group" style="width: 150px; margin-right: 10px">
                            <label for="tahun">Tahun</label>
                            <select name="" id="tahun" class="form-control">
                                @foreach ($tahun as $thn => $v)
                                    <option>{{ $thn }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" style="width: 150px">
                            <label for="prakerin-ke">Prakerin Ke</label>
                            <select name="" id="prakerin-ke" class="form-control">
                                <option value="1">Ke Satu</option>
                                <option value="2">Ke Dua</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-hover" id="akumulasi-table">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Akumulasi Jam</th>
                            <th>Jumlah Laporan</th>
                            <th>Jumlah Laporan Approve</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group" style="width: 150px">
                        <label for="pie-prakerin-ke">Prakerin Ke</label>
                        <select name="" id="pie-prakerin-ke" class="form-control" onchange="setPie()">
                            <option value="1">Ke Satu</option>
                            <option value="2">Ke Dua</option>
                        </select>
                    </div>
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-bordered" id="data-dosen">
                        <thead>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Jml Laporan Belum Approve</th>
                            <th>Jml Laporan Approve</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-bordered" id="data-pembimbing">
                        <thead>
                            <th>No</th>
                            <th>Nama Pembimbing Industri</th>
                            <th>Nama Industri</th>
                            <th>Jml Laporan Belum Approve</th>
                            <th>Jml Laporan Approve</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/scripts/jquery.canvasjs.min.js') }}"></script>
    <script>
        var table = $('#akumulasi-table').DataTable({
            "processing": true,
            "serverSide": true,
            "bSort" : true,
            "ajax": {
                url: "",
                data: function(data){
                    data.filter_prakerin = $('#prakerin-ke').val();
                    data.filter_tahun = $('#tahun').val();
                }
            },
            // orderCellsTop: true,
            fixedHeader: false,
            "columns": [
                {data:"DT_RowIndex"},
                {data:"mahasiswa.nama"},
                {data:"progress"},
                {data:"count_laporan"},
                {data:"count_laporan_approve"},
            ],
        });

        var table_dosen = $('#data-dosen').DataTable({
            "processing": true,
            "serverSide": true,
            "bSort" : true,
            "ajax": {
                url: "/api/data-dosen",
            },
            fixedHeader: false,
            "columns": [
                {data:"DT_RowIndex"},
                {data:"nama_dosen"},
                {data:"not_approved"},
                {data:"approved"},
            ],
        });

        var table_pembimbing = $('#data-pembimbing').DataTable({
            "processing": true,
            "serverSide": true,
            "bSort" : true,
            "ajax": {
                url: "/api/data-pembimbing",
            },
            fixedHeader: false,
            "columns": [
                {data:"DT_RowIndex"},
                {data:"nama_pembimbing"},
                {data:"nama_industri"},
                {data:"not_approved"},
                {data:"approved"},
            ],
        });

        $('#prakerin-ke,#tahun').on('change', function(){
            table.draw();
        })

        var chart = new CanvasJS.Chart("chartContainer", {
            exportEnabled: true,
            animationEnabled: true,
            title:{text: "Data Akumulasi Laporan Pemagangan"},
            legend:{
                cursor: "pointer",
                itemclick: explodePie
            },
            data: [{
                type: "pie",
                showInLegend: true,
                toolTipContent: "{name}: <strong>{y}%</strong>",
                indexLabel: "{name} = {jml} Orang",
            }]
        });

        function setPie(){
            $.ajax({
                url: '/api/data-statistik',
                data: {prakerin_ke:$('#pie-prakerin-ke').val()},
                success: function(dataPoints){
                    chart.options.data[0].dataPoints = dataPoints;
                    chart.render();
                }
            })
        }
        setPie();
        function explodePie (e) {
            if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();
        }
    </script>
@endpush
