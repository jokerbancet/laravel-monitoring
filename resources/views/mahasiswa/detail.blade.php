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
                        <div class="tab-content">
                            {{-- aktifitas --}}
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
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <th></th>
                                            <th>Prakerin Ke</th>
                                            <th>Status Prakerin</th>
                                            <th>Progres Prakerin Prakerin</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($mahasiswa->pemagangans as $pemagangan)
                                                <tr>
                                                    <td>
                                                        <button class="btn btn-sm btn-info btn-show-tr" style="border-radius: 50%; padding-left: 10px; padding-right: 10px"><i class="fa fa-plus"></i></button>
                                                    </td>
                                                    <td>{{ $pemagangan->prakerin_ke }}</td>
                                                    <td>{!! $pemagangan->is_active !!}</td>
                                                    <td>{{ $pemagangan->progress }}</td>
                                                </tr>
                                                <tr class="detail-tr">
                                                    <td colspan="4">
                                                        <ul>
                                                            <li>Dospem 1 : {{ $pemagangan->dosenPembimbing->nama }}</li>
                                                            <li>Dospem 2 : {{ $pemagangan->dosenPembimbing2->nama }}</li>
                                                            <li>Pembimbing Industri : {{ $pemagangan->pembimbingIndustri->nama }}</li>
                                                            <li>Mulai Magang : {{ $pemagangan->mulai_magang }}</li>
                                                            <li>Selesai Magang : {{ $pemagangan->selesai_magang }}</li>
                                                            <li>Jenis Pekerjaan : {{ $pemagangan->jenis_pekerjaan }}</li>
                                                        </ul>
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $('#subPages').addClass('in').prev().addClass('active').removeClass('collapsed');
    $('#mahasiswa').addClass('active')

    $('.detail-tr').hide()
    $('.btn-show-tr').on('click', function(){
        $(this).children().toggleClass('fa-plus').toggleClass('fa-minus')
        $(this).parent().parent().next().toggle()
    })
</script>
@endpush
