<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            padding: 0;
            margin: 0;
        }
        *,
        *::before,
        *::after {
        box-sizing: border-box;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .no-gutters {
            margin-right: 0;
            margin-left: 0;
        }
        .col-5 {
            flex: 0 0 41.6666666667%;
            max-width: 41.6666666667%;
        }
        body{
            margin-left: 100px;
            margin-right: 100px;

            font-family: 'Times New Roman',Verdana, Geneva, Tahoma, sans-serif;
        }
        .top tr td{
            vertical-align: top;
            padding-left: 5px;
        }
        .table-bordered{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table-bordered tr td,.table-bordered tr th{
            border: 1px solid black;
            border-collapse: collapse;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <center style="margin-top: 40px">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('pdf/logo.png'))) }}" alt="" width="50" height="50">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('pdf/header.png'))) }}" alt="" width="300" height="50" style="margin-left: 30px; margin-bottom: 15px">
        <br>
        <h3>DAFTAR CAPAIAN MAHASISWA DAN REKAP LAPORAN MAHASISWA MAGANG INDUSTRI POLITEKNIK ENERGI DAN PERTAMBANGAN BANDUNG</h3>
    </center>
    <div class="row no-gutters" style="margin-top: 30px;">
        <div class="col-5">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/'.$pemagang->mahasiswa->getAvatar(false))))}}" style="width: 65%; margin-top: 30px;margin-left: 20px" alt="Avatar">
        </div>
        <div class="col-5">
            <table style="width: 100%; line-height: 25px;margin-left: 310px">
                <tbody>
                    <tr>
                        <td style="width: 190px">Nama</td>
                        <td style="width: 15px"> :</td>
                        <td style="width: 300">{{$pemagang->mahasiswa->nama}}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->mahasiswa->nim}}</td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->mahasiswa->jurusan}}</td>
                    </tr>
                    <tr>
                        <td>Tahun Angkatan</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->mahasiswa->tahun_angkatan}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->mahasiswa->email}}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 1</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->dosenPembimbing->nama}}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 2</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->dosenPembimbing2->nama}}</td>
                    </tr>
                    <tr>
                        <td>Pembimbing Industri</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->pembimbingIndustri->nama}}</td>
                    </tr>
                    <tr>
                        <td>Industri</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->pembimbingIndustri->industri->nama_industri}}</td>
                    </tr>
                    <tr>
                        <td>Praktik Kerja Industri</td>
                        <td class="text-center">:</td>
                        <td class="font-weight-bold">Ke - {{$pemagang->prakerin_ke}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
    <table class="table-bordered" style="text-align: center; width: 100%; margin-bottom: 20px">
        <thead>
            <tr>
                <th>Mulai Magang</th>
                <th>Selesai Magang</th>
                {{-- <th>Jumlah hari magang</th> --}}
                <th>Akumulasi Jam Magang</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pemagang->mulai_magang }}</td>
                <td>{{ $pemagang->selesai_magang }}</td>
                {{-- <td>{{ $jhm }}  hari</td> --}}
                <td>{{ $pemagang->progress }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-bordered" style="text-align: center; width: 100%; margin-bottom: 20px">
        <thead>
            <tr>
                <th>Jumlah laporan yang harus dikumpulkan</th>
                <th>Jumlah laporan</th>
                <th>Jumlah laporan disetujui</th>
                <th>Nilai konstanta</th>
                <th>Nilai Rata - rata Pembimbing Industri</th>
                <th>Nilai Rata - rata Dosbing 1</th>
                <th>Nilai Rata - rata Dosbing 2</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $jlhd }}</td>
                <td>{{ $pemagang->laporan->count() }}</td>
                <td>{{ $pemagang->laporan->where('status_laporan', 'approve')->count() }}</td>
                <td>{{ number_format($nks, 3) }}</td>
                <td>{{ number_format($pemagang->laporan()->avg('approve_industri_nilai'), 1) }}</td>
                <td>{{ number_format($pemagang->laporan()->avg('approve_dosen'), 1) }}</td>
                <td>{{ number_format($pemagang->laporan()->avg('approve_dosen2'), 1) }}</td>
                <td>{{ $nilai_akhir }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 25px">No.</th>
                <th>Keterampilan Khusus yang Tercapai</th>
                <th style="width: 100px">Qty</th>
                <th style="width: 150px; text-align: center">Tanggal Ketercapaian</th>
            </tr>
        </thead>
        <tbody class="top">
            @foreach ($capaian as $kompetensi)
                <tr>
                    <td style="padding-left: 0; text-align: center">{{$loop->iteration}}</td>
                    <td>{{$kompetensi->capaian->deskripsi_capaian}}</td>
                    <td style="text-align: center">{{$kompetensi->total }} kali</td>
                    <td>{{$kompetensi->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
    {{-- <p style="font-size: 18px; margin-top: 20px margin-bottom: 10px">Berikut rekap laporan mahasiswa.</p> --}}
    <table class="table-bordered">
        <thead class="text-xs-center">
            <tr>
                <th style="font-size: 12px; width: 25px">No.</th>
                <th style="font-size: 12px; width: 70px">Tanggal Laporan</th>
                {{-- <th>Tanggal Laporan Dibuat</th> --}}
                {{-- <th>Kegiatan Pekerjaan</th> --}}
                <th style="font-size: 12px;">Deskripsi Pekerjaan</th>
                <th style="font-size: 12px; width: 50px">Durasi</th>
                {{-- <th>Output</th> --}}
                <th style="font-size: 12px; width: 95px">Nilai Pem.Industri</th>
                <th style="font-size: 12px; width: 40px">Nilai Dosbing 1</th>
                <th style="font-size: 12px; width: 40px">Nilai Dosbing 2</th>
                {{-- <th style="width: 15px">Status Laporan</th> --}}
            </tr>
        </thead>
        <tbody class="top">
            @foreach ($pemagang->laporan as $laporan)
                <tr>
                    <td style="font-size: 12px; padding-left: 0; text-align: center">{{$loop->iteration}}</td>
                    <td style="font-size: 12px;">{{$laporan->tanggal_laporan}}</td>
                    {{-- <td>{{$laporan->kegiatan_pekerjaan}}</td> --}}
                    <td style="font-size: 10px;">{{$laporan->deskripsi_pekerjaan}}</td>
                    {{-- <td>{{$laporan->output}}</td> --}}
                    <td style="font-size: 12px; text-align: center;">{{$laporan->durasi}} Jam</td>
                    <td style="font-size: 12px; text-align: center;">{{$laporan->approve_industri.' | '.$laporan->approve_industri_nilai}}</td>
                    <td style="font-size: 12px; text-align: center;">{{$laporan->approve_dosen}}</td>
                    <td style="font-size: 12px; text-align: center;">{{$laporan->approve_dosen2}}</td>
                    {{-- <td>{{$laporan->status_laporan}}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
