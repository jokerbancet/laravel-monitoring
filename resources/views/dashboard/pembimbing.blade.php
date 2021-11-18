@foreach($mahasiswa as $jurusan)
<div class="col-md-4">
    <div class="metric">
        <span class="icon"><i class="fa fa-industry"></i></span>
        <p>
            <span class="number">{{$jurusan->jumlah}}</span>
            <span class="title">Total Jurusan {{$jurusan->jurusan}}</span>
        </p>
    </div>
</div>
@endforeach
<div class="col-md-6">
    <div class="panel">
		<div class="panel-heading">
			<h3 class="panel-title">Kriteria Penilaian Laporan</h3>
		</div>
		<div class="panel-body">
			<img src="{{ asset('admin/assets/img/kriteria_penilaian.png') }}">
		</div>
	</div>
</div>
