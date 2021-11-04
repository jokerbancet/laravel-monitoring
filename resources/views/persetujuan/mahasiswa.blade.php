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
                            <img src="{{ $mahasiswa->mahasiswa->getAvatar() }}" width="35%" class="img-circle" alt="Avatar">
                            <h3 class="name">{{ $mahasiswa->mahasiswa->nama }}
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
                    </div>   
                </div>
            </div>
            <div class="panel">
                <div class="panel-body">
                    <ul class="list-unstyled activity-timeline history-laporan">
                        @foreach ($mahasiswa->laporan->sortBy('created_at') as $laporan)
                            <li>
                                @can('status-laporan', $laporan)
                                    <i class="fa fa-check activity-icon" style="background-color:  #3287B2;"></i>
                                @else
                                    <i class="fa fa-times activity-icon" style="background-color:  #f0ad4e;"></i>   
                                @endcan
                                   <p><b style="margin-right: 7px">{{$laporan->kegiatan_pekerjaan}}</b>
    
                                    <br>
                                    <span class="text-sm text-muted shrinkable" id="{{$loop->iteration}}">
                                        {{$laporan->deskripsi_pekerjaan}}
                                    </span><br>
                                    <span class="text-success">
                                        Output Pekerjaan : {{$laporan->output}}
                                    </span>
                                    <span class="timestamp">{{date('d-m-Y',strtotime($laporan->tanggal_laporan))}}</span>
                                   
                                    <button class="btn btn-sm btn-info detailBtn" data-id="{{ $laporan->id }}">Detail</button>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        <button id="see-all" class="btn btn-default">
                        Lihat Semua Histori
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLaporan" tabindex="-1" role="dialog" aria-labelledby="modalLaporanLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <form action="/persetujuan/laporan_id/approve" id="form-modal" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <span class="modal-title" id="modalLaporanLabel">Laporan Harian {{ $mahasiswa->nama??'' }}</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
                        <input type="text" id="kegiatan_pekerjaan" disabled class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                        <textarea id="deskripsi_pekerjaan" disabled cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="output">Output Pekerjaan</label>
                        <textarea id="output" disabled name="output" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi Pekerjaan</label>
                        <input type="number" id="durasi" disabled class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
                        <select disabled id="capaian_id" class="form-control">
                            @foreach ($mahasiswa->mahasiswa->capaian??[] as $capaian)
                                <option value="{{ $capaian->id }}">{{ $capaian->deskripsi_capaian }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="approve_industri" class="text-success">Penilaian Katergori Industri</label>
                            <select name="approve_industri" id="approve_industri" class="form-control" @cannot('pembimbingindustri') disabled @endcan>
                                <option value="pending">Pending</option>
                                <option value="mengamati">Mengamati</option>
                                <option value="mengikuti">Mengikuti</option>
                                <option value="terampil">Terampil</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="approve_industri_nilai" class="text-success">Penilaian Angka Industri</label>
                            <input type="number" class="form-control" max="100" min="0" name="approve_industri_nilai" id="approve_industri_nilai" @cannot('pembimbingindustri') disabled @endcannot>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label for="approve_dosen" class="text-success">Penilaian Dospem 1</label>
                            <input type="number" class="form-control" max="100" min="0" name="approve_dosen" id="approve_dosen" {{$is_dosen1?'':'disabled'}}>
                        </div>
                        <div class="col-sm-6">
                            <label for="approve_dosen2" class="text-success">Penilaian Dospem 2</label>
                            <input type="number" class="form-control" max="100" min="0" name="approve_dosen2" id="approve_dosen2" {{$is_dosen2?'':'disabled'}}>
                        </div>
                    </div>
                    <i class="text-muted text-sm">Jika Pembimbing Industri dan Kedua Dosen Pembimbing sudah memberikan penilaian maka status laporan menjadi Disetujui.</i>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Submit</button>
                </div>
            </form>
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

    let laporan = $('.history-laporan li');
    let batas = 4;
    if(laporan.length>batas){
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
        $(this).hide()
    })
</script>
@endpush