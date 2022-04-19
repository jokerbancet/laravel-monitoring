@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            {{-- <div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<i style="color: white; font-size: 20px" class="fa fa-warning"></i>  Fitur Absen-ku pada Menu Mahasiswa sedang dalam proses perbaikan. Mohon maaf atas ketidaknyamanannya.
			</div> --}}
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Dashboard Aplikasi MERDEKA (Media Rekam Data Elektronik Praktik Kerja)</h3>
                    <p class="panel-subtitle">Pertanggal: @php
                        echo date("d-m-Y");
                    @endphp</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i style="color: white; font-size: 20px" class="fa fa-user"></i></span>
                                <p>
                                    <span class="number">{{ $data->count()}}</span>
                                    <span class="title">Total Mahasiswa</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i style="color: white; font-size: 20px" class="fa fa-user"></i></span>
                                <p>
                                    <span class="number">{{$data2->count()}}</span>
                                    <span class="title">Total Dosen Pembimbing</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i style="color: white; font-size: 20px" class="fa fa-user"></i></span>
                                <p>
                                    <span class="number">{{$data3->count()}}</span>
                                    <span class="title">Total Pembimbing Industri</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i style="color: white; font-size: 20px" class="fa fa-industry"></i></span>
                                <p>
                                    <span class="number">{{$data4->count()}}</span>
                                    <span class="title">Total Industri</span>
                                </p>
                            </div>
                        </div>
                        @can('mahasiswa')
                        @foreach (auth()->user()->mahasiswa->pemagangans??[] as $pemagangan)
                            <div class="col-md-6">
                                <div class="metric">
                                    @php
                                        $progress = explode(' / ', rtrim($pemagangan->progress, ' jam'));
                                    @endphp
                                    <progress value="{{ $progress[0] }}" max="{{ $progress[1] }}" style="width: 100%; height: 50px"></progress>
                                    <p>
                                        <span class="number">{{$pemagangan->progress}}</span>
                                        <span class="title">Progres Prakerin ke-{{ $pemagangan->prakerin_ke }}</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        @endcan
                        @if (auth()->user()->dosenPembimbing || auth()->user()->pembimbingIndustri)
                            @include('dashboard.pembimbing')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>$('#dashboard').addClass('active')</script>
    <script>
        $.ajax({
            url: '/check-password',
            success: (result) => {
                if(result){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Password anda masih default!',
                        text: 'Silahkan klik "Ganti" untuk mengganti password.',
                        showCancelButton: true,
                        confirmButtonText: 'Ganti',
                        cancelButtonText: 'Batal'
                    }).then(result => {
                        if(result.isConfirmed){
                            window.location.href = '/ganti-password'
                        }
                    })
                }
            }
        })
    </script>
@endpush
