@csrf
<div class="form-group">
    <label for="kegiatan_pekerjaan">Kegiatan Pekerjaan</label>
    <input type="text" id="kegiatan_pekerjaan" name="kegiatan_pekerjaan" class="form-control" placeholder="Masukan nama kegiatan...">
    @error('kegiatan_pekerjaan')
        <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<div class="form-group">
    <label for="deskripsi_pekerjaan">Deskripsi Pekerjaan</label>
    <textarea name="deskripsi_pekerjaan" id="deskripsi_pekerjaan" cols="30" rows="10" class="form-control"></textarea>
    @if ($errors->has('deskripsi_pekerjaan'))
        <p class="text-danger">{{$errors->first('deskripsi_pekerjaan')}}</p>
    @endif
</div>
<div class="form-group">
    <label for="durasi">Durasi Pekerjaan</label>
    <input type="number" id="durasi" name="durasi" class="form-control" placeholder="Masukan Durasi">
    @if ($errors->has('durasi'))
        <p class="text-danger">{{$errors->first('durasi')}}</p>
    @endif
</div>
<div class="form-group">
    <label for="output">Output Pekerjaan</label>
    <input type="text" id="output" name="output" class="form-control" placeholder="Masukan output kegiatan...">
    @if ($errors->has('output'))
        <p class="text-danger">{{$errors->first('output')}}</p>
    @endif
</div>
<div class="form-group">
    <label for="capaian_id">Kompetensi Khusus yang tercapai</label>
    <select name="capaian_id" id="capaian_id" class="form-control">
        <option value=""></option>
        @foreach ($data as $data)
            <option value="{{$data->id}}">{{$data->jurusan.' - '.$data->deskripsi_capaian}}</option>
        @endforeach
    </select>
</div>
