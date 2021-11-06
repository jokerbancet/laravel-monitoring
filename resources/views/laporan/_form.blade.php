@csrf
@if (isset($lupa)&&$lupa)
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="tanggal_laporan">Tanggal Laporan</label>
                <input type="datetime-local" id="tanggal_laporan" name="tanggal_laporan" class="form-control" placeholder="Masukan nama kegiatan...">
                @error('tanggal_laporan')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
                <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan...">
                @error('kegiatan_pekerjaan')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div>
@else
    <div class="form-group">
        <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
        <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan...">
        @error('kegiatan_pekerjaan')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
@endif
<div class="form-group">
    <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
    <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" cols="30" rows="20" class="form-control" maxlength="1500" placeholder="Masukan Deskripsi Pekerjaan maksimal 750 karakter...."></textarea>
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
<div class="form-group">
    <label for="durasi">Durasi Pekerjaan (Dalam satuan Jam)</label>
    <input type="time" id="durasi" name="durasi" class="form-control" placeholder="jam" required>
    @if ($errors->has('durasi'))
        <p class="text-danger">{{$errors->first('durasi')}}</p>
    @endif
</div>
<div class="form-group">
    <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
    <select name="capaian_id" id="capaian_id" class="form-control select2">
        <option value=""></option>
        @foreach ($data as $data)
            <option value="{{$data->id}}">{{$data->jurusan.' - '.$data->deskripsi_capaian}}</option>
        @endforeach
    </select>
    @if ($errors->has('capaian_id'))
        <p class="text-danger">{{$errors->first('capaian_id')}}</p>
    @endif
</div>
