@csrf
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="id_data_bimbingan">Pemagang</label>
            <select name="id_data_bimbingan" id="id_data_bimbingan" class="form-control select2">
                <option value=""></option>
                @foreach ($pemagangs as $pemagang)
                    <option value="{{ $pemagang->id }}">{{ $pemagang->mahasiswa->nama }} (Prakerin Ke-{{ $pemagang->prakerin_ke }})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="tanggal_laporan">Tanggal Laporan</label>
            <input type="datetime-local" class="form-control" name="tanggal_laporan" id="tanggal_laporan">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
    <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan pekerjaan anda...">
    @error('kegiatan_pekerjaan')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
    <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" cols="30" rows="20" class="form-control"></textarea>
    @if ($errors->has('deskripsi_pekerjaan'))
        <p class="text-danger">{{$errors->first('deskripsi_pekerjaan')}}</p>
    @endif
</div>
<div class="form-group">
    <label for="deskripsi_pekerjaan">Output Pekerjaan</label>
    <textarea name="output" id="output" cols="30" rows="10" class="form-control" maxlength="1500" placeholder="Masukan Output Pekerjaan yang dihasilkan..."></textarea>
    @if ($errors->has('output'))
        <p class="text-danger">{{$errors->first('output')}}</p>
    @endif
</div>
<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="durasi">Durasi Pekerjaan (Jam)</label>
            <input type="number" min="0" id="durasi" name="durasi" class="form-control" placeholder="jam" required>
            @if ($errors->has('durasi'))
                <p class="text-danger">{{$errors->first('durasi')}}</p>
            @endif
        </div>
    </div>
    <div class="col-sm-9">
        <div class="form-group">
            <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
            <select name="capaian_id" id="capaian_id" class="form-control select2">

            </select>
            @if ($errors->has('capaian_id'))
                <p class="text-danger">{{$errors->first('capaian_id')}}</p>
            @endif
        </div>
    </div>
</div>
