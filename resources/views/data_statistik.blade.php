@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Data Statistik</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered mydatatable">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Akumulasi Jam</th>
                        </thead>
                        <tbody>
                            @foreach ($pemagangan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->mahasiswa->nama }}</td>
                                    <td>{{ $item->laporan->where('status_laporan', 'approve')->sum('durasi') }} jam</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('admin/assets/scripts/jquery.canvasjs.min.js') }}"></script>
    <script>
        $.ajax({
            url: '',
            success: function(dataPoints){
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
                        toolTipContent: "{name}: <strong>{y} Orang</strong>",
                        indexLabel: "{name} = {y} Orang",
                        dataPoints
                        // dataPoints: [
                        //     { y: 26, name: "0 - 100", exploded: true },
                        //     { y: 20, name: "101 - 200" },
                        //     { y: 5, name: "201 - 300" },
                        //     { y: 20, name: "301 - 435" },
                        // ]
                    }]
                });
                chart.render();
            }
        })

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
