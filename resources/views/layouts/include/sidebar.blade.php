<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                @if (auth()->user()->role == 'admin')
                <li>
                    <a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse ">
                        <ul class="nav active">
                            <li><a href="/mahasiswa" class="">Data Mahasiswa</a></li>
                            <li><a href="/dosenpembimbing" class="">Data Dosen Pembimbing</a></li>
                            <li><a href="/pembimbingindustri" class="">Data Pembimbing Industri</a></li>
                            <li><a href="/industri" class="">Data Tempat Industri</a></li>
                            <li><a href="/capaian" class="">Data Indikator Capaian</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages2" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Pemagangan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages2" class="collapse ">
                        <ul class="nav active">
                            <li><a href="/pemagangan" class="">Data Pemagangan</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#subPages3" data-toggle="collapse" class="collapsed"><i class="lnr lnr-file-empty"></i> <span>Data Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages3" class="collapse ">
                        <ul class="nav active">
                            <li><a href="#" class="">Data Laporan</a></li>
                        </ul>
                    </div>
                </li>
                @endif
                @if (auth()->user()->role == 'mahasiswa')
                    <li><a href="/laporan" class=""><i class="lnr lnr-home"></i> <span>Laporan</span></a></li>
                    <li><a href="/laporan" class=""><i class="lnr lnr-home"></i> <span>Histori Laporan</span></a></li>
                    <li><a href="/laporan" class=""><i class="lnr lnr-home"></i> <span>Grafik Kinerja</span></a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
