<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard" id="dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                @if (auth()->user()->role == 'admin')
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav active">
                            <li><a href="/mahasiswa" id="mahasiswa">Data Mahasiswa</a></li>
                            <li><a href="/dosenpembimbing" id="dosenpembimbing">Data Dosen Pembimbing</a></li>
                            <li><a href="/pembimbingindustri" id="pembimbingindustri">Data Pembimbing Industri</a></li>
                            <li><a href="/industri" id="industri">Data Tempat Industri</a></li>
                            <li><a href="/capaian" id="capaian">Data Indikator Capaian</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Pemagangan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages2" class="collapse ">
                        <ul class="nav active">
                            <li><a href="/rel_capaian" id="data-relasi-capaian">Data Relasi Capaian</a></li>
                            <li><a href="/pemagangan" id="data-pemagang">Data Pemagangan</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages3" class="collapse ">
                        <ul class="nav active">
                            <li><a href="/datalaporan" id="data-laporan">Data Laporan</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (auth()->user()->role == 'mahasiswa')
                    {{-- <li><a href="/profile" class=""><i class="lnr lnr-pencil"></i> <span>Profile</span></a></li> --}}
                    <li><a href="/laporan" id="laporan"><i class="lnr lnr-pencil"></i> <span>Laporan</span></a></li>
                    <li><a href="/histori-laporan" id="histori-laporan"><i class="lnr lnr-history"></i> <span>Histori Laporan</span></a></li>
                    <li><a href="#"><i class="lnr lnr-chart-bars"></i> <span>Grafik Kinerja</span></a></li>
                @endif
                @if (auth()->user()->role == 'dosenpembimbing'||auth()->user()->role == 'pembimbingindustri')
                    <li><a href="/data-bimbingan" id="data-bimbingan"><i class="lnr lnr-chart-bars"></i> <span>Mahasiswa Bimbingan</span></a></li>
                    <li><a href="/persetujuan" id="persetujuan"><i class="lnr lnr-chart-bars"></i> <span>Persetujuan</span></a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
