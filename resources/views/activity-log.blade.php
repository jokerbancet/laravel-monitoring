@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Log Aktifitas Mahasiswa</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>{{ $log->user->name }}</td>
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