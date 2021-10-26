@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel">
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{ $mahasiswa->mahasiswa->getAvatar() }}" width="35%" class="img-circle" alt="Avatar">
                                <h3 class="name">{{ $mahasiswa->mahasiswa->nama }}
                                </h3>
                                <h5>Mahasiswa Magang</h5>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Informasi Dasar</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Nomor Induk Mahasiswa<span>{{ $mahasiswa->mahasiswa->nim }}</span></li>
                                    <li>Email <span>{{ $mahasiswa->mahasiswa->email }}</span></li>
                                    <li>Jenis Kelamin <span>{{ $mahasiswa->mahasiswa->jk }}</span></li>
                                    <li>Agama <span>{{ $mahasiswa->mahasiswa->agama }}</span>
                                    <li>Alamat <span>{{ $mahasiswa->mahasiswa->alamat }}</span>
                                    <li>Prodi <span>{{ $mahasiswa->mahasiswa->jurusan }}</span>
                                    <li>Tahun Angkatan <span>{{ $mahasiswa->mahasiswa->tahun_angkatan }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="margin-top-30 text-center">
                                {{-- <a href="/mahasiswa/{{ $mahasiswa->mahasiswa->id }}/edit" class="btn btn-warning">Edit Data</a> --}}
                                <button href="" class="btn btn-primary" onclick="goBack()">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="custom-tabs-line tabs-line-bottom left-aligned">
                            <ul class="nav" role="tablist">
                                <li class="active">
                                    <a href="#tab-bottom-left1" role="tab" data-toggle="tab">History Laporan</a>
                                </li>
                                <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Dosen Pembimbing</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            {{-- Histori Laporan --}}
                            <div class="tab-pane fade in active" id="tab-bottom-left1">
                                <ul class="list-unstyled activity-timeline history-laporan">
                                    @foreach ($mahasiswa->laporan->sortBy('id') as $laporan)
                                        <li>
                                            <i class="fa fa-check activity-icon"></i>
                                            <p><b style="margin-right: 7px">{{$laporan->kegiatan_pekerjaan}}</b>

                                                <br>
                                                <span class="text-sm text-muted shrinkable" id="{{$loop->iteration}}">
                                                    {{$laporan->deskripsi_pekerjaan}}
                                                </span><br>
                                                <span class="text-success">
                                                    Output Pekerjaan : {{$laporan->output}}
                                                </span>
                                                <span class="timestamp">{{date('d-m-Y',strtotime($laporan->tanggal_laporan))}}</span>
                                                @if ($laporan->status_laporan=='approve')
                                                    <span class="label label-success">Approved</span>
                                                @else
                                                    <span class="label label-warning">Pending</span>
                                                @endif
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-center">
                                    <button id="see-all" class="btn btn-default">
                                    Lihat Semua Histori
                                    </button>
                                </div>
                                {{-- <table class="table mydatatable">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Kegiatan Pekerjaan</th>
                                            <th>Deskripsi Pekerjaan</th>
                                            <th>Durasi</th>
                                            <th>Output</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswa->laporan as $laporan)
                                            <tr>
                                                <td>{{date('d-m-Y',strtotime($laporan->tanggal_laporan))}}</td>
                                                <td>{{$laporan->kegiatan_pekerjaan}}</td>
                                                <td>{{$laporan->deskripsi_pekerjaan}}</td>
                                                <td>{{$laporan->durasi}}</td>
                                                <td>{{$laporan->output}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> --}}
                            </div>
                            {{-- pembimbing --}}
                            <div class="tab-panel fade" id="tab-bottom-left2">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dosen Pembimbing 1</th>
                                            <th>Dosen Pembimbing 2</th>
                                            <th>Pembimbing Industri</th>
                                            <th>Industri</th>
                                            <th>Mulai Magang</th>
                                            <th>Selesai Magang</th>
                                            <th>Status Magang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($mahasiswa->mahasiswa->dosenpembimbing as $dosen)
                                                <td>{{ $dosen->gelar_depan.' '.$dosen->nama.' '.$dosen->gelar_belakang }}</td>
                                            @endforeach
                                                <td>{{ $mahasiswa->dosenPembimbing2->gelar_depan.' '.$mahasiswa->dosenPembimbing2->nama.' '.$mahasiswa->dosenPembimbing2->gelar_belakang }}</td>
                                            @foreach($mahasiswa->mahasiswa->pembimbingindustri as $pembimbing)
                                                <td>{{ $pembimbing->nama }}</td>
                                                <td>{{ $pembimbing->industri->nama_industri }}</td>
                                                <td>{{ $pembimbing->pivot->mulai_magang }}</td>
                                                <td>{{ $pembimbing->pivot->selesai_magang }}</td>
                                                <td>
                                                    @if(strtotime(date("d-m-Y")) < strtotime($pembimbing->pivot->selesai_magang))
                                                        <span class="label label-primary">Mulai Magang</span>
                                                    @else
                                                        <span class="label label-success">Selesai Magang</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#data-bimbingan').addClass('active')

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

    var len = 150;
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
