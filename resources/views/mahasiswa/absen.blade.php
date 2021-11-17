@extends('layouts.layout_master')

@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            {{-- Cek apakah si mahasiswa terdaftar sebagai pemagang atau tidak --}}
            @if (!is_null(auth()->user()->mahasiswa->pemagangan))
            <div class="panel">
                <div class="panel-body">
                    <h2 class="text-center">Absen Ku</h2>
                    <div id="calendar"></div>
                </div>
            </div>
            @else
            <div class="panel">
                <div class="panel-heading">
                    <div class="alert alert-warning">Maaf anda belum menjadi peserta magang.</div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@if (!is_null(auth()->user()->mahasiswa->pemagangan))
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.css">
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"></script>
        <script>
            $('#absen-ku').addClass('active');
            $.ajax({
                url: '',
                success: function(events){
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'id',
                        footerToolbar: false,
                        events
                    });
                    calendar.render();
                }
            })
        </script>
    @endpush
@endif
