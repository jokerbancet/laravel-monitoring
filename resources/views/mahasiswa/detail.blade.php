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
                                <img src="{{ $mahasiswa->getAvatar() }}" width="35%" class="img-circle" alt="Avatar">
                                <h3 class="name">{{ $mahasiswa->nama }}
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
                            <div class="margin-top-30 text-center">
                                <a href="/mahasiswa/{{ $mahasiswa->id }}/edit" class="btn btn-warning">Edit Data</a>
                                <button href="" class="btn btn-primary" onclick="goBack()">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel">
                        <div class="custom-tabs-line tabs-line-bottom left-aligned">
                            <ul class="nav" role="tablist">
                                <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Aktifitas
                                        Terkini</a></li>
                                <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Dosen Pembimbing</a></li>
                            </ul>
                        </div>
                        {{-- aktifitas --}}
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="tab-bottom-left1">
                                <ul class="list-unstyled activity-timeline">
                                    <li>
                                        <i class="fa fa-comment activity-icon"></i>
                                        <p>Commented on post <a href="#">Prototyping</a> <span class="timestamp">2
                                                minutes ago</span></p>
                                    </li>
                                    <li>
                                        <i class="fa fa-cloud-upload activity-icon"></i>
                                        <p>Uploaded new file <a href="#">Proposal.docx</a> to project <a href="#">New
                                                Year Campaign</a> <span class="timestamp">7 hours ago</span></p>
                                    </li>
                                    <li>
                                        <i class="fa fa-plus activity-icon"></i>
                                        <p>Added <a href="#">Martin</a> and <a href="#">3 others colleagues</a> to
                                            project repository <span class="timestamp">Yesterday</span></p>
                                    </li>
                                    <li>
                                        <i class="fa fa-check activity-icon"></i>
                                        <p>Finished 80% of all <a href="#">assigned tasks</a> <span class="timestamp">1
                                                day ago</span></p>
                                    </li>
                                </ul>
                                <div class="margin-top-30 text-center"><a href="#" class="btn btn-default">See all
                                        activity</a></div>
                            </div>
                            {{-- pembimbing --}}
                            <div class="tab-panel fade" id="tab-bottom-left2">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Dosen Pembimbing</th>
                                            <th>Pembimbing Industri</th>
                                            <th>Industri</th>
                                            <th>Mulai Magang</th>
                                            <th>Selesai Magang</th>
                                            <th>Status Magang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($mahasiswa->dosenpembimbing as $dosen)
                                                <td><a
                                                        href="/dosenpembimbing/{{ $dosen->id }}/detail">{{ $dosen->gelar_depan.' '.$dosen->nama.' '.$dosen->gelar_belakang }}</a>
                                                </td>
                                            @endforeach
                                            @foreach($mahasiswa->pembimbingindustri as $pembimbing)
                                                <td><a
                                                        href="/pembimbingindustri/{{ $pembimbing->id }}/detail">{{ $pembimbing->nama_depan.' '.$pembimbing->nama_belakang }}</a>
                                                </td>
                                                <td>{{ $pembimbing->industri->nama_industri }}</td>
                                                <td>{{ $pembimbing->pivot->mulai_magang }}</td>
                                                <td>{{ $pembimbing->pivot->selesai_magang }}</td>
                                                <td>@php
                                                    if($pembimbing->pivot->status_magang == 1){
                                                        echo '<span class="label label-primary">Mulai Magang</span>';
                                                    }elseif($pembimbing->pivot->status_magang == 2){
                                                        echo '<span class="label label-success">Selesai Magang</span>';
                                                    }else{
                                                    }
                                                    @endphp</td>
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
@stop
