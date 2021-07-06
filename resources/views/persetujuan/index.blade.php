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
                            <h3 class="panel-title">Data Laporan Mahasiswa</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover mydatatable" id="mydatatable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Laporan</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Kegiatan</th>
                                            <th>Persetujuan Dosen</th>
                                            <th>Status Laporan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mahasiswa as $laporan)
                                            {{-- @dump($laporan->mahasiswa) --}}
                                            @foreach ($laporan->laporan as $lprn)
                                                <tr>
                                                    <td>{{ $lprn->tanggal_laporan }}</td>
                                                    <td>{{ $lprn->mahasiswa->nama }}</td>
                                                    <td>{{ $lprn->mahasiswa->jurusan }}</td>
                                                    <td>{{ $lprn->kegiatan_pekerjaan }}</td>
                                                    @if (auth()->user()->role=='dosenpembimbing')
                                                        <td class="text-center"><span class="label {{cek_status($lprn->approve_dosen,1)}}">{{ $lprn->approve_dosen }}</span></td>
                                                    @else
                                                        <td class="text-center"><span class="label {{cek_status($lprn->approve_industri,1)}}">{{ $lprn->approve_industri }}</span></td>
                                                    @endif
                                                    <td class="text-center"><span class="label {{cek_status($lprn->status_laporan,2)}}">{{ $lprn->status_laporan }}</span></td>
                                                    <td>
                                                        <button class="btn btn-info" onclick="detail({{$lprn->id}})" data-toggle="modal" data-target="#modalLaporan">
                                                            Detail
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END TABLE HOVER -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLaporan" tabindex="-1" role="dialog" aria-labelledby="modalLaporanLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <form id="formAction" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <span class="modal-title" id="modalLaporanLabel">Laporan Harian <span class="nama"></span></span>
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
                                        <img id="avatar" src="images/default.png" width="35%" class="img-circle" alt="Avatar">
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
                            <div class="form-group">
                                <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
                                <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan...">
                                @error('kegiatan_pekerjaan')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                                <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" cols="30" rows="5" class="form-control"></textarea>
                                @error('deskripsi_pekerjaan')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="durasi">Durasi Pekerjaan</label>
                                <input type="number" id="durasi" name="durasi" class="form-control" placeholder="Masukan Durasi">
                                @error('durasi')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="output">Output Pekerjaan</label>
                                <input type="text" id="output" name="output" class="form-control" placeholder="Masukan output kegiatan...">
                                @error('output')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
                                <select name="capaian_id" id="capaian_id" class="form-control">

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status_laporan">Status Laporan</label>
                                <select name="status_laporan" id="status_laporan" class="form-control">
                                    <option value="pending">Pending</option>
                                    <option value="rejected">Rejected</option>
                                    <option value="approve">Approve</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="approve_industri">Approval Industri</label>
                                    <select name="approve_industri" id="approve_industri" class="form-control" {{auth()->user()->pembimbingIndustri?'':'disabled'}}>
                                        <option value="pending">Pending</option>
                                        <option value="mengamati">Mengamati</option>
                                        <option value="mengikuti">Mengikuti</option>
                                        <option value="terampil">Terampil</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="approve_dosen">Approval Dosen</label>
                                    <select name="approve_dosen" id="approve_dosen" class="form-control"{{auth()->user()->dosenPembimbing?'':'disabled="true"'}}>
                                        <option value="pending">Pending</option>
                                        <option value="mengamati">Mengamati</option>
                                        <option value="mengikuti">Mengikuti</option>
                                        <option value="terampil">Terampil</option>
                                    </select>
                                </div>
                            </div>
                            <i class="text-muted text-sm">Jika approval dosen dan industri bukan pending, maka status laporan akan berubah.</i>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $('#persetujuan').addClass('active');
        function detail(laporan_id){
            $.ajax({
                url: `{{url('/persetujuan/${laporan_id}')}}`,
                success: function(result){
                    $.ajax({
                        url: `{{url('capaian/${result.mahasiswa.id}')}}`,
                        async: false,
                        success: function(capaian){
                            $('#capaian_id').empty().append('<option></option>');
                            capaian.forEach(v=>{
                                $('#capaian_id').append(`<option value="${v.id}">${v.deskripsi_capaian}</option>`)
                            })
                        }
                    })

                    $('#formAction').attr('action',`/persetujuan/${laporan_id}/approve`);

                    $('#avatar').attr('src','images/'+result.mahasiswa.avatar);
                    for(i in result.mahasiswa){
                        $('.'+i).text(result.mahasiswa[i]);
                    }
                    for(i in result){
                        let is_approve = i=='approve_dosen'||i=='approve_industri';
                        $('#'+i).val(result[i]);
                        if(!is_approve)
                        $('#'+i).attr('disabled',!is_approve);
                    }
                    let is_dosen="{{is_null(auth()->user()->pembimbingIndustri)}}";
                    $('#approve_dosen').attr('disabled',result.approve_industri=='pending'||!is_dosen);
                }
            })
        }
    </script>
@endpush
