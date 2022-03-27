@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="profile-header">
                        <div class="overlay"></div>
                        <div class="profile-main">
                            <img src="{{ asset('images/default.png') }}" width="35%" class="img-circle" alt="Avatar">
                            <h3 class="name">{{ $mahasiswa->nama }}
                            </h3>
                            <h5>Mahasiswa Magang</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="profile-detail">
                        <div class="profile-info">
                            <h4 class="heading">Informasi Dasar</h4>
                            <ul class="list-unstyled list-justify">
                                <li>Nomor Induk Mahasiswa<span>{{ $mahasiswa->nim }}</span></li>
                                <li>Email <span>{{ $mahasiswa->email }}</span></li>
                                <li>Jenis Kelamin <span>{{ $mahasiswa->jk }}</span></li>
                                <li>Agama <span>{{ $mahasiswa->agama }}</span>
                                <li>Alamat <span>{{ $mahasiswa->alamat }}</span>
                                <li>Prodi <span>{{ $mahasiswa->jurusan }}</span>
                                <li>Tahun Angkatan <span>{{ $mahasiswa->tahun_angkatan }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Jumlah Laporan</th>
                                <th class="text-center">Laporan dinilai</th>
                                <th class="text-center">Laporan belum dinilai</th>
                                <th class="text-center">Laporan disetujui</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $mahasiswa->laporans()->count() }}</td>
                                <td>{{ $mahasiswa->laporans->filter(function ($laporan) {
                                    return Gate::allows('status-laporan', $laporan);
                                })->count() }}</td>
                                <td>{{ $mahasiswa->laporans->filter(function ($laporan) {
                                    return !Gate::allows('status-laporan', $laporan);
                                })->count() }}</td>
                                <td>{{ $mahasiswa->laporans()->where('status_laporan', 'approve')->count() }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="tabbable-panel">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                    Prakerin Ke 1 </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                    Prakerin Ke 2 </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <ul class="list-unstyled activity-timeline history-laporan">
                                        @foreach ($prakerin1->sortByDesc('created_at') as $laporan)
                                            <li>
                                                <i class="fa fa-times activity-icon" style="background-color:  #f0ad4e;"></i>
                                                   <p><b style="margin-right: 7px">{{$laporan->kegiatan_pekerjaan}}</b>
                                                    <br>
                                                    <span class="text-sm text-muted shrinkable" id="{{$loop->iteration}}">
                                                        {{$laporan->deskripsi_pekerjaan}}
                                                    </span><br>
                                                    <span class="text-success">
                                                        Output Pekerjaan : {{$laporan->output}}
                                                    </span>
                                                    <span class="timestamp">{{date('d-m-Y',strtotime($laporan->tanggal_laporan))}}</span>
                                                    <table class="table table-bordered" style="margin-left: 36px; width: 95%; margin-top: 10px">
                                                        <tr>
                                                            <th class="text-center">Durasi Pekerjaan</th>
                                                            <th class="text-center">Persetujuan Pembimbing Industri</th>
                                                            <th class="text-center">Persetujuan Dosen Pembimbing 1</th>
                                                            <th class="text-center">Persetujuan Dosen Pembimbing 2</th>
                                                            <th class="text-center">Status Laporan</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">{{$laporan->durasi}} Jam</td>
                                                            <td class="text-center"><span class="label {{cek_status($laporan->approve_industri,1)}}">{{ $laporan->approve_industri??''}}{{ ' | '.$laporan->approve_industri_nilai??'' }}</span></td>
                                                            <td class="text-center">{!! $laporan->cek_status('approve_dosen',1) !!}</td>
                                                            <td class="text-center">{!! $laporan->cek_status('approve_dosen2',1) !!}</td>
                                                            <td class="text-center">{!! $laporan->cek_status('status_laporan',2) !!}</td>
                                                        </tr>
                                                    </table>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="text-center">
                                        <button class="btn btn-default see-all">
                                        Lihat Semua Laporan
                                        </button>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <ul class="list-unstyled activity-timeline history-laporan">
                                        @foreach ($prakerin2->sortByDesc('created_at') as $laporan)
                                            <li>
                                                <i class="fa fa-times activity-icon" style="background-color:  #f0ad4e;"></i>
                                                   <p><b style="margin-right: 7px">{{$laporan->kegiatan_pekerjaan}}</b>
                                                    <br>
                                                    <span class="text-sm text-muted shrinkable" id="{{$loop->iteration}}">
                                                        {{$laporan->deskripsi_pekerjaan}}
                                                    </span><br>
                                                    <span class="text-success">
                                                        Output Pekerjaan : {{$laporan->output}}
                                                    </span>
                                                    <span class="timestamp">{{date('d-m-Y',strtotime($laporan->tanggal_laporan))}}</span>
                                                    <table class="table table-bordered" style="margin-left: 36px; width: 95%; margin-top: 10px">
                                                        <tr>
                                                            <th class="text-center">Durasi Pekerjaan</th>
                                                            <th class="text-center">Persetujuan Pembimbing Industri</th>
                                                            <th class="text-center">Persetujuan Dosen Pembimbing 1</th>
                                                            <th class="text-center">Persetujuan Dosen Pembimbing 2</th>
                                                            <th class="text-center">Status Laporan</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-center">{{$laporan->durasi}} Jam</td>
                                                            <td class="text-center"><span class="label {{cek_status($laporan->approve_industri,1)}}">{{ $laporan->approve_industri??''}}{{ ' | '.$laporan->approve_industri_nilai??'' }}</span></td>
                                                            <td class="text-center">{!! $laporan->cek_status('approve_dosen',1) !!}</td>
                                                            <td class="text-center">{!! $laporan->cek_status('approve_dosen2',1) !!}</td>
                                                            <td class="text-center">{!! $laporan->cek_status('status_laporan',2) !!}</td>
                                                        </tr>
                                                    </table>
                                                </p>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="text-center">
                                        <button class="btn btn-default see-all">
                                        Lihat Semua Laporan
                                        </button>
                                    </div>
                                </div>
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
    $('#persetujuan').addClass('active')

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

    $('.detailBtn').click(function(){
        let id = $(this).data('id');
        $('#form-modal').attr('action', '/persetujuan/'+id+'/approve');
        $.ajax({
            url: '/persetujuan/'+id,
            success: function(result){
                for(let i in result){
                    $('#'+i).val(result[i])
                }
                $('#modalLaporan').modal('show')
            }
        })
    })

    let history = $('.history-laporan');
    history.each((k,node) => {
        let laporan = $(node).find('li');
        let batas = 4;
        if(laporan.length>batas){
            laporan.each((v,k)=>{
                if(v>batas-1){
                    k.classList.add('hide');
                }
            })
        }else{
            $('.see-all').hide();
        }
    })
    $('.see-all').click(function(){
        let laporan = $(this).parent().prev().find('li')
        laporan.each((v,k)=>{
            k.classList.remove('hide');
        })
        $(this).hide()
    })
</script>
@endpush
