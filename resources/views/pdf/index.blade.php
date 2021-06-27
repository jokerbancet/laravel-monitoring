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
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('pdf/header.png'))) }}" alt="" width="300" height="50" style="margin-left: 30px">
        <h4>DAFTAR CAPAIAN MAHASISWA DAN REKAP LAPORAN MAHASISWA MAGANG INDUSTRI POLITEKNIK ENERGI DAN<br> PERTAMBANGAN BANDUNG</h4>
    </center>
    <p style="font-size: 18px; margin-top: 30px;margin-bottom: 50px">Berikut data detail mahasiswa yang melakukan magang.</p>
    <div class="row no-gutters" style="margin-top: 30px;">
        <div class="col-5">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/'.$pemagang->mahasiswa->getAvatar(false))))}}" style="width: 270px; height: 300px;margin-top: 30px;margin-left: 20px" alt="Avatar">
        </div>
        <div class="col-5">
            <table style="width: 100%; line-height: 25px;margin-left: 310px">
                <tbody>
                    <tr>
                        <td style="width: 160px">Nama</td>
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
                        <td>Mulai Magang</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->mulai_magang}}</td>
                    </tr>
                    <tr>
                        <td>Selesai Magang</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->selesai_magang}}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing</td>
                        <td class="text-center">:</td>
                        <td>{{$pemagang->dosenPembimbing->nama}}</td>
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
                </tbody>
            </table>
        </div>
    </div><br><br>
    <table class="table-bordered" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 10px">NO</th>
                <th>Keterampilan Khusus yang Tercapai</th>
                <th style="width: 150px">Tanggal Ketercapai</th>
            </tr>
        </thead>
        <tbody class="top">
            @foreach ($pemagang->kompetensi as $kompetensi)
                <tr>
                    <td style="padding-left: 0" class="text-center">{{$loop->iteration}}</td>
                    <td>{{$kompetensi->capaian->deskripsi_capaian}}</td>
                    <td>{{$kompetensi->created_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="font-size: 18px; margin-top: 20px">Berikut rekap laporan mahasiswa magang industry.</p>
    <table class="table-bordered">
        <thead class="text-xs-center">
            <tr>
                <th style="width: 10px">No</th>
                <th>Tanggal Laporan</th>
                <th>Capaian Kompetensi Khusus</th>
                <th>Kegiatan Pekerjaan</th>
                <th>Deskripsi Pekerjaan</th>
                <th>Durasi</th>
                <th>Output</th>
                <th>Persetujuan Dosen</th>
                <th>Persetujuan Pembimbing Industri</th>
                <th>Status Laporan</th>
            </tr>
        </thead>
        <tbody class="top">
            @foreach ($pemagang->laporan as $laporan)
                <tr>
                    <td style="padding-left: 0" class="text-center">{{$loop->iteration}}</td>
                    <td>{{$laporan->tanggal_laporan}}</td>
                    <td>{{$laporan->capaian->deskripsi_capaian}}</td>
                    <td>{{$laporan->kegiatan_pekerjaan}}</td>
                    <td>{{$laporan->deskripsi_pekerjaan}}</td>
                    <td>{{$laporan->durasi}}</td>
                    <td>{{$laporan->output}}</td>
                    <td>{{$laporan->approve_dosen}}</td>
                    <td>{{$laporan->approve_industri}}</td>
                    <td>{{$laporan->status_laporan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
