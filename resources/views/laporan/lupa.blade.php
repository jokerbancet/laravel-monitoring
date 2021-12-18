@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <span class="h3">Halo, {{auth()->user()->name}}.</span>
                        </div>
                    </div>
                </div>
                {{-- Cek apakah si mahasiswa terdaftar sebagai pemagang atau tidak --}}
                @if (!is_null(auth()->user()->mahasiswa->pemagangan))
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-body">
                                <span class="h4">
                                    {{(auth()->user()->mahasiswa->dosenpembimbing->isNotEmpty()?'Dosen Pembimbing 1 : '.auth()->user()->mahasiswa->dosenpembimbing[0]->nama:'')}}
                                    <br>
                                    {{('Dosen Pembimbing 2 : '.auth()->user()->mahasiswa->pemagangan->dosenPembimbing2->nama)}}
                                </span><br>
                                <span class="h4">Pembimbing Industri: {{auth()->user()->mahasiswa->pembimbingindustri->isNotEmpty()?auth()->user()->mahasiswa->pembimbingindustri[0]->nama:''}}.</span><br>
                                <span class="h4">Nama Industri: {{auth()->user()->mahasiswa->pembimbingindustri->isNotEmpty()?auth()->user()->mahasiswa->pembimbingindustri[0]->industri->nama_industri:''}}.</span>
                            </div>
                        </div>
                    </div>

                    @if(session('sukses'))
                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {{ session('sukses') }}
                        </div>
                    </div>
                    @endif

                    {{-- Cek apakah masa menjadi pemagang masih berlaku atau tidak --}}
                    @if (!is_null($masa_magang))
                        <div class="col-md-12">
                            <!-- TABLE HOVER -->
                            <div class="panel">
                                <div class="panel-body">
                                    <form action="/laporan/lupa" method="post">
                                        @include('laporan._form', ['lupa'=>true,'min'=>$masa_magang->mulai_magang,'max'=>$masa_magang->selesai_magang])
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- END TABLE HOVER -->
                        </div>
                    @else
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="alert alert-warning">Maaf, masa menjadi pemagang anda sudah habis.</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="alert alert-warning">Maaf anda belum menjadi peserta magang.</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'classic'
            })
        });

        function showMore(id){
            document.getElementById(id+'Overflow').className='';
            document.getElementById(id+'MoreLink').className='hidden';
            document.getElementById(id+'LessLink').className='';
        }

        function showLess(id){
            document.getElementById(id+'Overflow').className='hidden';
            document.getElementById(id+'MoreLink').className='';
            document.getElementById(id+'LessLink').className='hidden';
        }

        var len = 300;
        var shrinkables = document.getElementsByClassName('shrinkable');
        if (shrinkables.length > 0) {
            for (var i = 0; i < shrinkables.length; i++){
                var fullText = shrinkables[i].innerHTML;
                if(fullText.length > len){
                    var trunc = fullText.substring(0, len).replace(/\w+$/, '');
                    var remainder = "";
                    var id = shrinkables[i].id;
                    remainder = fullText.substring(len, fullText.length);
                    shrinkables[i].innerHTML = '<span>' + trunc + '<span class="hidden" id="' + id + 'Overflow">'+ remainder +'</span></span>&nbsp;<a id="' + id + 'MoreLink" href="#!" onclick="showMore(\''+ id + '\');">...Lihat Selengkapnya</a><a class="hidden" href="#!" id="' + id + 'LessLink" onclick="showLess(\''+ id + '\');">Tampilkan Sedikit</a>';
                }
            }
        }

        let laporan = $('.history-laporan li');
        let batas = 4;
        if(laporan.length>=batas){
            laporan.each((v,k)=>{
                if(v>batas-1){
                    k.classList.add('hide');
                }
            })
        }else{
            $('#see-all').hide();
        }
        $('#see-all').click(function(){
            laporan.each((v,k)=>{
                k.classList.remove('hide');
            })
        })
    </script>
@endpush
