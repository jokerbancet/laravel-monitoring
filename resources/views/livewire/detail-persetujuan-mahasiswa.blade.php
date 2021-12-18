<div>
    <div style="display: flex; justify-content: end">
        <div class="form-group form-row" style="width: 300px">
            <div class="col-sm-6 col-md-6 text-right"><label style="margin-top: 5px">Urutkan Tanggal</label></div>
            <div class="col-sm-6 col-md-6">
                <select class="form-control" wire:model='sort'>
                    <option value="desc">Menurun</option>
                    <option value="asc">Menaik</option>
                </select>
            </div>
        </div>
    </div>
    <ul class="list-unstyled activity-timeline history-laporan">
        @foreach ($mahasiswa->laporan()->orderBy('created_at', $sort)->get() as $laporan)
            @cannot('status-laporan', $laporan)
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
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr>
                            <td class="text-center">{{$laporan->durasi}} Jam</td>
                            <td class="text-center"><span class="label {{cek_status($laporan->approve_industri,1)}}">{{ $laporan->approve_industri??''}}{{ ' | '.$laporan->approve_industri_nilai??'' }}</span></td>
                            <td class="text-center">{!! $laporan->cek_status('approve_dosen',1) !!}</td>
                            <td class="text-center">{!! $laporan->cek_status('approve_dosen2',1) !!}</td>
                            <td class="text-center">{!! $laporan->cek_status('status_laporan',2) !!}</td>
                            <td>
                                <button class="btn btn-sm btn-info detailBtn" @can('hrd') disabled @endcan data-id="{{ $laporan->id }}">Beri Nilai</button>
                            </td>
                        </tr>
                    </table>
                </p>
            </li>
            @endcannot
        @endforeach
    </ul>
    <div class="text-center">
        <button id="see-all" class="btn btn-default">
        Lihat Semua Laporan
        </button>
    </div>
</div>
