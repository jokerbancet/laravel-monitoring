<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard" id="dashboard" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                @if (auth()->user()->role == 'admin')
                <li>
                    <a href="#subPages" data-toggle="collapse" class="{{ request()->is('user*')?'active':'collapsed' }}"><i class="lnr lnr-file-empty"></i> <span>Data Master</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="subPages" class="collapse {{ request()->is('user*')?'in':'' }}">
                        <ul class="nav active">
                            <li><a href="/mahasiswa" id="mahasiswa">Data Mahasiswa</a></li>
                            <li><a href="/dosenpembimbing" id="dosenpembimbing">Data Dosen Pembimbing</a></li>
                            <li><a href="/pembimbingindustri" id="pembimbingindustri">Data Pembimbing Industri</a></li>
                            <li><a href="/hrd" id="hrd" class="{{ request()->is('hrd')?'active':'' }}">Data HRD</a></li>
                            <li><a href="/industri" id="industri">Data Tempat Industri</a></li>
                            <li><a href="/capaian" id="capaian">Data Indikator Capaian</a></li>
                            <li><a href="/user" class="{{ request()->is('user*')?'active':'' }}">Data User</a></li>
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
                            <li><a href="/inputlaporan" class="{{ request()->is('inputlaporan')?'active':'' }}">Input Laporan</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="/data-statistik" class="{{ request()->is('data-statistik')?'active':'' }}"><i class="lnr lnr-home"></i> <span>Data Statistik</span></a></li>
                <li><a href="/activity-log" class="{{ request()->is('activity-log')?'active':'' }}"><i class="lnr lnr-history"></i> <span>Aktifitas Log</span></a></li>
                @endif
                @can('mahasiswa')
                    <li><a href="/laporan" id="laporan"><i class="lnr lnr-pencil"></i> <span>Laporan</span></a></li>
                    <li><a href="/histori-laporan" id="histori-laporan"><i class="lnr lnr-history"></i> <span>Histori Laporan</span></a></li>
                    <li><a href="/absen-ku" id="absen-ku" class="{{ request()->is('absen-ku')?'active':'' }}"><i class="lnr lnr-calendar-full"></i> <span>Absen Ku</span></a></li>
                    <li><a href="/lupa-laporan" class="{{ request()->is('lupa-laporan')?'active':'' }}"><i class="lnr lnr-highlight"></i> <span>Pengajuan Lupa Laporan</span></a></li>
                @endcan
                @canany (['pembimbingindustri','dosenpembimbing'])
                    <li><a href="/data-bimbingan" id="data-bimbingan"><i class="lnr lnr-database"></i> <span>Mahasiswa Bimbingan</span></a></li>
                    @can('hrd')
                    <li><a href="/rekap-laporan" id="persetujuan" class="{{ request()->is('rekap-laporan')?'active':'' }}"><i class="lnr lnr-chart-bars"></i> <span>Rekap Laporan</span></a></li>
                    @else
                    <li><a href="/persetujuan" id="persetujuan" class="{{ request()->is('persetujuan')?'active':'' }}"><i class="lnr lnr-chart-bars"></i> <span>Persetujuan</span></a></li>
                    @endcan
                    <li><a href="/histori-approval" id="persetujuan" class="{{ request()->is('histori-approval*')?'active':'' }}"><i class="lnr lnr-history"></i> <span>Histori Persetujuan</span></a></li>
                @endcanany
            </ul>
        </nav>
    </div>
</div>
