<div>
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
                                <div class="table-responsive" wire:ignore>
                                    <table class="table table-hover mydatatable" id="mydatatable">
                                        <thead>
                                            <tr>
                                                <th>Tanggal Laporan</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Jurusan</th>
                                                <th>Kegiatan</th>
                                                @if (auth()->user()->role=='dosenpembimbing')
                                                    <th>Persetujuan Dosen Pembimbing 1&2</th>
                                                @else
                                                    <th>Persetujuan Pembimbing Industri</th>
                                                @endif
                                                <th>Status Laporan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mahasiswa as $laporan)
                                                @foreach ($laporan->laporan??[] as $lprn)
                                                    <tr>
                                                        <td>{{ $lprn->tanggal_laporan }}</td>
                                                        <td>{{ $lprn->mahasiswa->nama }}</td>
                                                        <td>{{ $lprn->mahasiswa->jurusan }}</td>
                                                        <td>{{ $lprn->kegiatan_pekerjaan }}</td>
                                                        @if (auth()->user()->role=='dosenpembimbing')
                                                            <td class="text-center">
                                                                <span class="label {{cek_status($lprn->approve_dosen,1)}}">{{ $lprn->approve_dosen }}</span> &
                                                                <span class="label {{cek_status($lprn->approve_dosen2,1)}}">{{ $lprn->approve_dosen2 }}</span>
                                                            </td>
                                                        @else
                                                            <td class="text-center"><span class="label {{cek_status($lprn->approve_industri,1)}}">{{ $lprn->approve_industri }}</span></td>
                                                        @endif
                                                        <td class="text-center"><span class="label {{cek_status($lprn->status_laporan,2)}}">{{ $lprn->status_laporan }}</span></td>
                                                        <td>
                                                            <button class="btn btn-info" wire:click="detail({{$lprn}})">
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
    <div class="modal fade" id="modalLaporan" tabindex="-1" role="dialog" aria-labelledby="modalLaporanLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <form action="/persetujuan/{{ $laporan_id }}/approve" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <span class="modal-title" id="modalLaporanLabel">Laporan Harian {{ $laporan->mahasiswa->nama??'' }}</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <h3>Laporan Id {{ $laporan_id??'' }}</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel">
                                    <div class="profile-header">
                                        <div class="overlay"></div>
                                        <div class="profile-main">
                                            <img id="avatar" src="{{ $laporan->mahasiswa?$laporan->mahasiswa->getAvatar():'' }}" width="35%" class="img-circle" alt="Avatar">
                                            <h3 class="nama">{{ $laporan->mahasiswa->nama??'' }}</h3>
                                            <h5>Mahasiswa Magang</h5>
                                        </div>
                                    </div>
                                    <!-- END PROFILE HEADER -->
                                    <!-- PROFILE DETAIL -->
                                    <div class="profile-detail">
                                        <div class="profile-info">
                                            <h4 class="heading">Informasi Dasar</h4>
                                            <ul class="list-unstyled list-justify">
                                                <li>Nomor Induk Mahasiswa <span>{{ $laporan->mahasiswa->nim??'' }}</span></li>
                                                <li>Email <span>{{ $laporan->mahasiswa->email??'' }}</span></li>
                                                <li>Jenis Kelamin <span>{{ $laporan->mahasiswa->jk??'' }}</span></li>
                                                <li>Agama <span>{{ $laporan->mahasiswa->agama??'' }}</span>
                                                <li>Alamat <span>{{ $laporan->mahasiswa->alamat??'' }}</span>
                                                <li>Prodi <span>{{ $laporan->mahasiswa->jurusan??'' }}</span>
                                                <li>Tahun Angkatan <span>{{ $laporan->mahasiswa->tahun_angkatan??'' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
                                    <input type="text" id="kegiatan_pekerjaan" disabled name="kegiatan_pekerjaan" wire:model.defer='kegiatan_pekerjaan' class="form-control" placeholder="Masukan nama kegiatan...">
                                    @error('kegiatan_pekerjaan')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
                                    <textarea disabled name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" cols="30" rows="5" class="form-control" wire:model.defer='deskripsi_pekerjaan'></textarea>
                                    @error('deskripsi_pekerjaan')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="durasi">Durasi Pekerjaan</label>
                                    <input type="number" id="durasi" disabled name="durasi" class="form-control" wire:model.defer='durasi' placeholder="Masukan Durasi">
                                    @error('durasi')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="output">Output Pekerjaan</label>
                                    <input type="text" id="output" disabled name="output" class="form-control" wire:model.defer='output' placeholder="Masukan output kegiatan...">
                                    @error('output')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
                                    <select disabled name="capaian_id" id="capaian_id" class="form-control" wire:model.defer='capaian_id'>
                                        @foreach ($laporan->mahasiswa->capaian??[] as $capaian)
                                            <option value="{{ $capaian->id }}">{{ $capaian->deskripsi_capaian }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="approve_industri" class="text-success">Approval Industri</label>
                                        <select name="approve_industri" id="approve_industri" wire:model.defer='approve_industri' class="form-control" {{auth()->user()->pembimbingIndustri?'':'disabled'}}>
                                            <option value="pending">Pending</option>
                                            <option value="mengamati">Mengamati</option>
                                            <option value="mengikuti">Mengikuti</option>
                                            <option value="terampil">Terampil</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="approve_industri_nilai">Approve Indurstri Nilai</label>
                                        <input type="number" class="form-control @error('approve_industri_nilai') is-invalid @enderror" max="100" min="0" name="approve_industri_nilai" wire:model.defer='approve_industri_nilai' {{auth()->user()->pembimbingIndustri?'':'disabled'}}>
                                        @error('approve_industri_nilai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="approve_dosen">Approve Dosen</label>
                                        <input type="number" class="form-control @error('approve_dosen') is-invalid @enderror" max="100" min="0" name="approve_dosen" wire:model.defer='approve_dosen' {{$is_dosen1?'':'disabled'}}>
                                        @error('approve_dosen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="approve_dosen2">Approve Dosen</label>
                                        <input type="number" class="form-control @error('approve_dosen2') is-invalid @enderror" max="100" min="0" name="approve_dosen2" wire:model.defer='approve_dosen2' {{$is_dosen2?'':'disabled'}}>
                                        @error('approve_dosen2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <i class="text-muted text-sm">Jika approval dosen dan industri bukan pending, maka status laporan akan berubah.</i>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('showModal', function(){
            $('#modalLaporan').modal('show')
        })
    </script>
</div>
