@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Log Aktifitas Mahasiswa</h3>
                    <div class="right">
                        <input type="text" id="range" data-toggle="daterangepicker">
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped mydatatable">
                        <thead>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->user->name }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($log->user->role) }}</span></td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        {{ $log->created_at }}
                                        ({{ $log->created_at->diffForHumans() }})
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
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/daterangepicker/daterangepicker.css') }}">
@endpush
@push('js')
    <script src="{{ asset('admin/assets/vendor/daterangepicker/daterangepicker.min.js') }}"></script>
    <script>
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var range = $('[data-toggle="daterangepicker"]').val().split(' / ')
                var min = range[0];
                var max = range[1];
                var date = data[3].split(' ')[0]; // use data for the date column
        
                return min <= date && date <= max;
            }
        );
        // Date Range Picker
        var currentYear = moment().year(); // This Year
        var currentYearStart = moment({
            years: currentYear,
            months: '0',
            date: '1'
        }); // 1st Jan this year
        var currentYearEnd = moment({
            years: currentYear,
            months: '11',
            date: '31'
        }); // 31st Dec this year
        var start = moment().subtract(29, 'days'); // Subtract 29 days from today
        var end = moment(); // Today
        $('[data-toggle="daterangepicker"]').daterangepicker({
            // startDate: start, // after open picker you'll see this dates as picked
            // endDate: end,
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' / '
            },
            ranges: {
                'Hari Ini': [moment(), moment()],
                '1 Minggu Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Tahun Ini': [moment(currentYearStart), moment(currentYearEnd)],
                'Tahun Lalu': [moment(currentYearStart.subtract(1, 'year')), moment(currentYearEnd.subtract(1,
                    'year'))],
            }
        });
        $('[data-toggle="daterangepicker"]').on('change', function(){
            table.draw()
        })
    </script>
@endpush
