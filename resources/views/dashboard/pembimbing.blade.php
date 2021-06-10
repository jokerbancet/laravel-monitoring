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
