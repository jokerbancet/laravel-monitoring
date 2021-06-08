@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <span class="h3">Halo, {{auth()->user()->name}}.</span>
                        </div>
                    </div>
                </div>
                {{-- Cek apakah si mahasiswa terdaftar sebagai pemagang atau tidak --}}
                @if (!is_null(auth()->user()->mahasiswa->pemagangan))
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <span class="h4">
                                    {{(auth()->user()->mahasiswa->dosenpembimbing->isNotEmpty()?'Dosen Pembimbing: '.auth()->user()->mahasiswa->dosenpembimbing[0]->nama:'')}}
                                </span><br>
                                <span class="h4">Pembimbing Industri: {{auth()->user()->mahasiswa->pembimbingindustri[0]->nama}}.</span><br>
                                <span class="h4">Nama Industri: {{auth()->user()->mahasiswa->pembimbingindustri[0]->industri->nama_industri}}.</span>
                            </div>
                        </div>
                    </div>

                    @if(session('sukses'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                        </div>
                    </div>
                    @endif

                    {{-- Cek apakah masa menjadi pemagang masih berlaku atau tidak --}}
                    @if (!is_null($masa_magang))
                        {{-- Cek apakah hari ini hari libur atau bukan ['Minggu', 'Sabtu'] -> cek di LaporanController method index variable $excepted_days --}}
                        @if (!$hari_libur)
                            {{-- Cek apakah si pemagang sudah melakukan laporan hari ini atau belum --}}
                            @if ($hasLaporanToday->count()<2)
                                <div class="col-md-12">
                                    <!-- TABLE HOVER -->
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h2 class="panel-title">Pelaporan Magang Hari ini. Tanggal :@php
                                                date_default_timezone_set('asia/jakarta');
                                                echo date('D, d-m-Y H:i');
                                            @endphp</h2>
                                        </div>
                                        <div class="panel-body">
                                            <form action="/laporan/create" method="post">
                                                @include('laporan._form')
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END TABLE HOVER -->
                                </div>
                            @endif
                            @if ($hasLaporanToday->count()>0)
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Laporan Harian</h3>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-unstyled activity-timeline history-laporan">
                                            @foreach ($hasLaporanToday->sortBy('id') as $laporan)
                                                <li>
                                                    <i class="fa fa-check activity-icon"></i>
                                                    <p><b style="margin-right: 7px">{{$laporan->kegiatan_pekerjaan}}</b>
                                                        @if ($laporan->status_laporan=='pending')
                                                        <a href="/laporan/{{$laporan->id}}/edit" class="label label-success">
                                                            <i class="lnr lnr-pencil"></i>
                                                            Edit
                                                        </a>
                                                        @endif
                                                        <br>
                                                        <span class="text-sm text-muted shrinkable" id="{{$loop->iteration}}">
                                                            {{$laporan->deskripsi_pekerjaan}}
                                                        </span><br>
                                                        <span class="timestamp">{{date('d-m-Y',strtotime($laporan->tanggal_laporan))}}</span>
                                                        <table class="table table-bordered" style="margin-left: 36px; width: 95%; margin-top: 10px">
                                                            <tr>
                                                                <th>Durasi</th>
                                                                <th>Output</th>
                                                                <th>Persetujuan Dosen</th>
                                                                <th>Persetujuan Pembimbing Industri</th>
                                                                <th>Status Laporan</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{$laporan->durasi}}</td>
                                                                <td>{{$laporan->output}}</td>
                                                                <td>{!! $laporan->cek_status('approve_dosen',1) !!}</td>
                                                                <td>{!! $laporan->cek_status('approve_industri',1)!!}</td>
                                                                <td>{!! $laporan->cek_status('status_laporan',2) !!}</td>
                                                            </tr>
                                                        </table>

                                                    </p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="alert alert-warning">Maaf, hari ini bukan hari kerja.</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="alert alert-warning">Maaf, masa menjadi pemagang anda sudah habis.</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="alert alert-warning">Maaf anda belum menjadi peserta magang.</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#laporan').addClass('active');

        function showMore(id){
            document.getElementById(id+'Overflow').className='';
            document.getElementById(id+'MoreLink').className='hidden';
            document.getElementById(id+'LessLink').className='';
        }

        function showLess(id){
            document.getElementById(id+'Overflow').className='hidden';
            document.getElementById(id+'MoreLink').className='';
            document.getElementById(id+'LessLink').className='hidden';
        }

        var len = 300;
        var shrinkables = document.getElementsByClassName('shrinkable');
        if (shrinkables.length > 0) {
            for (var i = 0; i < shrinkables.length; i++){
                var fullText = shrinkables[i].innerHTML;
                if(fullText.length > len){
                    var trunc = fullText.substring(0, len).replace(/\w+$/, '');
                    var remainder = "";
                    var id = shrinkables[i].id;
                    remainder = fullText.substring(len, fullText.length);
                    shrinkables[i].innerHTML = '<span>' + trunc + '<span class="hidden" id="' + id + 'Overflow">'+ remainder +'</span></span>&nbsp;<a id="' + id + 'MoreLink" href="#!" onclick="showMore(\''+ id + '\');">...Lihat Selengkapnya</a><a class="hidden" href="#!" id="' + id + 'LessLink" onclick="showLess(\''+ id + '\');">Tampilkan Sedikit</a>';
                }
            }
        }

        let laporan = $('.history-laporan li');
        let batas = 4;
        if(laporan.length>=batas){
            laporan.each((v,k)=>{
                if(v>batas-1){
                    k.classList.add('hide');
                }
            })
        }else{
            $('#see-all').hide();
        }
        $('#see-all').click(function(){
            laporan.each((v,k)=>{
                k.classList.remove('hide');
            })
        })
    </script>
@endpush
