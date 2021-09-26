@extends('layouts.layout_master')

@section('main_content2')
@livewire('persetujuan-modal')
@endsection
{{-- @push('js')
    <script>
        $('#persetujuan').addClass('active');
        function detail(laporan_id){
            $.ajax({
                url: `{{url('/persetujuan/${laporan_id}')}}`,
                success: function(result){
                    $.ajax({
                        url: `{{url('capaian/${result.mahasiswa.id}')}}`,
                        async: false,
                        success: function(capaian){
                            $('#capaian_id').empty().append('<option></option>');
                            capaian.forEach(v=>{
                                $('#capaian_id').append(`<option value="${v.id}">${v.deskripsi_capaian}</option>`)
                            })
                        }
                    })

                    $('#formAction').attr('action',`/persetujuan/${laporan_id}/approve`);

                    $('#avatar').attr('src','images/'+result.mahasiswa.avatar);
                    for(i in result.mahasiswa){
                        $('.'+i).text(result.mahasiswa[i]);
                    }
                    for(i in result){
                        let is_approve = i=='approve_dosen'||i=='approve_industri';
                        $('#'+i).val(result[i]);
                        if(!is_approve)
                        $('#'+i).attr('disabled',!is_approve);
                    }
                    let is_dosen="{{is_null(auth()->user()->pembimbingIndustri)}}";
                    $('#approve_dosen').attr('disabled',result.approve_industri=='pending'||!is_dosen);
                    $('#approve_dosen2').attr('disabled',result.approve_industri=='pending'||!is_dosen);
                    if(is_dosen!=""){
                        let myIdDosen = "{{auth()->user()->dosenPembimbing->id??''}}"
                        if(result.mahasiswa.pemagangan.dosenpembimbing_id==myIdDosen){
                            $('#approve_dosen2').attr('disabled',true)
                        }else if(result.mahasiswa.pemagangan.dosenpembimbing2_id==myIdDosen){
                            $('#approve_dosen').attr('disabled',true)
                        }
                    }
                }
            })
        }
    </script>
@endpush --}}
