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
                            <h2 class="panel-title">Relasi Capaian dengan mahasiswa.</h2>
                        </div>
                        <div class="panel-body">
                            <table class="table mydatatable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">NO</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prakerin Ke</th>
                                        <th>Jurusan</th>
                                        <th style="width: 10px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pemagang as $data)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$data->mahasiswa->nama}}</td>
                                            <td>{{ $data->prakerin_ke }}</td>
                                            <td>{{$data->mahasiswa->jurusan}}</td>
                                            <td>
                                                <button class="btn btn-info" onclick="detail({{$data->id}})" data-toggle="modal" data-target="#modalDetail">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <form id="formAction" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <span class="modal-title" id="modalDetailLabel">Detail Capaian Mahasiswa <span class="nama"></span></span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="profile-header">
                                    <div class="overlay"></div>
                                    <div class="profile-main">
                                        <img id="avatar" src="/images/default.png" width="35%" class="img-circle" alt="Avatar">
                                        <h3 class="nama"></h3>
                                        <h5>Mahasiswa Magang</h5>
                                    </div>
                                </div>
                                <!-- END PROFILE HEADER -->
                                <!-- PROFILE DETAIL -->
                                <div class="profile-detail">
                                    <div class="profile-info">
                                        <h4 class="heading">Informasi Dasar</h4>
                                        <ul class="list-unstyled list-justify">
                                            <li>Nomor Induk Mahasiswa<span class="nim"></span></li>
                                            <li>Email <span class="email"></span></li>
                                            <li>Jenis Kelamin <span class="jk"></span></li>
                                            <li>Agama <span class="agama"></span>
                                            <li>Alamat <span class="alamat"></span>
                                            <li>Prodi <span class="jurusan"></span>
                                            <li>Tahun Angkatan <span class="tahun_angkatan"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-center">Capaian Mahasiswa</h3>
                            <table class="table table-bordered">
                                <tbody id="capaian-mahasiswa">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="link-print" href="#" class="btn btn-success" target="_blank">Print</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#subPages2').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#data-relasi-capaian').addClass('active')

        function detail(mahasiswa_id){
            $.ajax({
                url: `{{url('/rel_capaian/${mahasiswa_id}')}}`,
                success: function(pemagang){
                    $('#avatar').attr('src','/images/'+pemagang.mahasiswa.avatar);
                    for(i in pemagang.mahasiswa){
                        $('.'+i).text(pemagang.mahasiswa[i]);
                    }
                    $('#capaian-mahasiswa').empty();
                    if(pemagang.kompetensi.length<=0){
                        $('#capaian-mahasiswa').append(`
                            <tr>
                                <td class="text-center text-warning">Mahasiswa ini belum mempunyai pencapaian</td>
                            </tr>
                        `)
                    }
                    let today = new Date;
                    let tanggal = today.toISOString().split('T')[0];
                    console.log(tanggal, pemagang.selesai_magang);
                    if(tanggal>=pemagang.selesai_magang){
                        $('#link-print').show();
                        $('#link-print').attr('href',`{{url('/rel_capaian/${pemagang.id}/print')}}`)
                    }else{
                        $('#link-print').hide();
                    }
                    pemagang.kompetensi.forEach((v,k)=>{
                        $('#capaian-mahasiswa').append(`
                            <tr>
                                <td style="width: 10px;vertical-align: top">${k+1}</td>
                                <td>${v.capaian.deskripsi_capaian}</td>
                            </tr>
                        `)
                    })
                }
            })
        }
    </script>
@endpush
