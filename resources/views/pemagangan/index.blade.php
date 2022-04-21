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
                            <h3 class="panel-title">Data Pemagangan</h3>
                            <div class="right">
                                @canany(['admin','admin-prodi'])
                                    <button type="button" class="btn" data-toggle="modal"
                                    data-target="#tambahdatamagang">
                                    <i class="lnr lnr-plus-circle"></i>
                                </button>
                                @endcanany
                            </div>
                        </div>
                        <div class="panel-body">
                            @canany(['admin','direktur'])
                                <div style="display: flex;">
                                    <div class="form-group">
                                        <label for="filter-tahun">Tahun</label>
                                        <select name="filter-tahun" id="filter-tahun" class="form-control" style="width: 100px">
                                            <option>Semua</option>
                                            @foreach ($pemagangan->groupBy(fn($item) => date('Y', strtotime($item->mulai_magang)) )->sortKeys() as $thn => $item)
                                            <option>{{ $thn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-left: 10px">
                                        <label for="filter-prakern">Semester</label>
                                        <select name="filter-prakerin" id="filter-prakerin" class="form-control" style="width: 120px">
                                            <option>Semua</option>
                                            <option value="1">Ganjil</option>
                                            <option value="2">Genap</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-left: 10px">
                                        <label for="filter-jurusan">Jurusan</label>
                                        <select name="filter-jurusan" id="filter-jurusan" class="form-control" style="width: 200px">
                                            <option>Semua</option>
                                            <option>Teknologi Geologi</option>
                                            <option>Teknologi Pertambangan</option>
                                            <option>Teknologi Metalurgi</option>
                                        </select>
                                    </div>
                                </div>
                            @endcanany
                            <table class="table table-hover mydatatable" id="mydatatable">
                                <thead>
                                    <tr>
                                        <th>Nama Mahasiswa</th>
                                        <th>Prodi</th>
                                        <th>Prakerin ke</th>
                                        <th>Mulai Magang</th>
                                        <th>Selesai Magang</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemagangan as $p)
                                        <tr>
                                            <td>{{ $p->mahasiswa->nama}}</td>
                                            <td>{{ $p->mahasiswa->jurusan }}</td>
                                            <td class="text-center">{{ $p->prakerin_ke }}</td>
                                            <td>{{ $p->mulai_magang }}</td>
                                            <td>{{ $p->selesai_magang }}</td>
                                            <td>{!! $p->is_active !!}</td>
                                            <td>
                                                <a href="/mahasiswa/{{ $p->mahasiswa_id }}/detail"
                                                    class="btn btn-info btn-xs"><i class="lnr lnr-magnifier"></i></a>
                                                @canany(['admin','admin-prodi'])
                                                    <a href="/pemagangan/{{ $p->id }}/edit"
                                                        class="btn btn-warning btn-xs"><i class="lnr lnr-pencil"></i></a>
                                                    <a href="/pemagangan/{{ $p->id }}/delete"
                                                        class="btn btn-danger btn-xs"
                                                        onclick="return confirm('Yakin data dengan nama {{ $p->nama }} akan dihapus?')"><i
                                                            class="lnr lnr-trash"></i></a>
                                                @endcanany
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
<div class="modal fade" id="tambahdatamagang" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/pemagangan/create" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label for="mahasiswa_id">Nama Mahasiswa</label>
                            <select name="mahasiswa_id" data-width="100%" id="mahasiswa_id" class="form-control select2">
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($data1 as $data)
                                    <option value="{{$data->id}}">{{$data->nama.' - '.$data->jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="prakerin_ke">Prakerin Ke</label>
                            <select name="prakerin_ke" data-width="100%" id="prakerin_ke" class="form-control select2">
                                <option value="">Pilih Prakerin</option>
                                <option value="1">Ke-1</option>
                                <option value="2">Ke-2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row no-gutters gt-3">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Dosen Pembimbing 1</label>
                            <select name="dosenpembimbing_id" data-width="100%" id="dosenpembimbing_id" class="form-control select2">
                                <option value="">Pilih Dosen Pembimbing</option>
                                @foreach ($data2 as $data)
                                    <option value="{{$data->id}}">{{$data->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Dosen Pembimbing 2</label>
                            <select name="dosenpembimbing2_id" data-width="100%" id="dosenpembimbing2_id" class="form-control select2">
                                <option value="">Pilih Dosen Pembimbing</option>
                                @foreach ($data2 as $data)
                                    <option value="{{$data->id}}">{{$data->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Pembimbing Industri</label>
                        <select name="pembimbingindustri_id" data-width="100%" id="pembimbingindustri_id" class="form-control select2">
                            <option value="">Pilih Pembimbing Industri</option>
                            @foreach ($data3 as $data)
                                <option value="{{$data->id}}">{{$data->nama.' - '.$data->nama_industri}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mulai Magang</label>
                        <input type="date" class="form-control" name="mulai_magang" value="{{old('mulai_magang')}}">
                        @if ($errors->has('mulai_magang'))
                                <p class="text-danger">{{$errors->first('mulai_magang')}}</p>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Selesai Magang</label>
                        <input type="date" class="form-control" name="selesai_magang" value="{{old('selesai_magang')}}">
                        @if ($errors->has('selesai_magang'))
                                <p class="text-danger">{{$errors->first('selesai_magang')}}</p>
                            @endif
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Pekerjaan</label>
                        <input type="text" class="form-control" name="jenis_pekerjaan" placeholder="Masukan Jenis Pekerjaan" value="{{old('jenis_pekerjaan')}}">
                        @if ($errors->has('jenis_pekerjaan'))
                                <p class="text-danger">{{$errors->first('jenis_pekerjaan')}}</p>
                            @endif
                    </div> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $('#subPages2').addClass('in').prev().addClass('active').removeClass('collapsed');
        $('#data-pemagang').addClass('active')
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic'
            })
        });
        $('#filter-tahun').on('change', function(){
            table
                .column( 3   )
                .search($(this).val()=='Semua'?'':this.value).draw()
        })
        $('#filter-prakerin').on('change', function(){
            table
                .column( 2 )
                .search($(this).val()=='Semua'?'':this.value).draw()
        })
        $('#filter-jurusan').on('change', function(){
            table
                .column( 1 )
                .search($(this).val()=='Semua'?'':this.value).draw()
        })
    </script>
@endpush
