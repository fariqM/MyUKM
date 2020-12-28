@extends('layouts.app', ['page' => __('Tabel'), 'pageSlug' => 'Calendar'])

@section('before-css')
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">

@endsection

@section('page-css')
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body" style="background-color: mintcream">
            <div id="calendar"></div>
        </div>
    </div>
    
</div>

<div style="display: none" id="UpdateDialog" title="PERUBAHAN JADWAL! AGENDA TELAH BERUBAH HARI DAN TANGGAL">
    <h6>Perubahan jadwal harus sesuai standar SOP yang telah ditentukan.
        hubungi PUSTIPD jika ada pertanyaan</h6>
</div>
<div style="display: none" id="DeleteDialog" title="PERUBAHAN JADWAL! AGENDA TELAH DIHAPUS DARI KALENDER">

    <h5>Perubahan jadwal harus sesuai standar SOP yang telah ditentukan.
        hubungi PUSTIPD jika ada pertanyaan</h5>
</div>

<div style="display: none" id="dialog" class="dialog">
    <div id="dialog-body">
        <form id="dayClick" method="POST" action="{{ route('eventStore') }}">
            @csrf

            <div class="form-group">
                <label for="title">Event Title</label>
                <input type="text" class="form-control " name="title" id="title" placeholder="Event Title">

            </div>


            <div class="form-group">
                <label for="start">start date and time</label>
                <input type="text" class="form-control" name="start" id="start" placeholder="start date and time">
            </div>

            <div class="form-group">
                <label for="end">end date and time</label>
                <input type="text" class="form-control" name="end" id="end" placeholder="end date and time">
            </div>

            <div class="form-group">
                <label for="allDay">All Day</label>
                <input type="checkbox" value="1" name="allDay" checked>All Day
                <input type="checkbox" value="0" name="allDay">Half Day
            </div>

            <div class="form-group">
                <label for="color">Background Color</label>
                <input type="color" class="form-control" name="color" id="color">
            </div>

            <div class="form-group">
                <label for="textColor">Text Color</label>
                <input type="color" class="form-control" name="textColor" id="textColor">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>

        </form>
    </div>
</div>

@endsection


@section('page-js')
<script>
    
    $(document).ready(function(){
            $('#dropdownNotification').click(function(){
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url:"{{url('/notif/update')}}", 
                    type: "POST",
                    success: function(){
                       
                    }
                });
            }); 
    });

</script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {
  

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

      var dt = new Date();
            var konversi = `${dt.getFullYear().toString().padStart(4, '0')}/${(dt.getMonth()+1).toString().padStart(2, '0')}/${dt.getDate().toString().padStart(2, '0')} ${
            dt.getHours().toString().padStart(2, '0')}:${
            dt.getMinutes().toString().padStart(2, '0')}:${
            dt.getSeconds().toString().padStart(2, '0')}`
            var SA = konversi.replace('/', '-').replace('/', '-') ;
            let s= new Date().toLocaleString().slice(7, 19).replace('T', ' ')
            .replace(',', '').replace('/', '-').replace('/', '-');
  
  
        var calendar = $('#calendar').fullCalendar({
          selectable: true,
          height: 650,
          displayEventTime: false,
          showNonCurrentDates: false,
          
          yearColumns: 3,
          defaultView: 'month',
          dragabble: true,
          editable: true,
          droppable: true,
          header:{
            left: 'prev,next today',
            center: 'title',
            right: 'year,month,basicWeek,basicDay'
      
          },
          events:"{{ route('allEventAdmin') }}",
          dayClick:function(date, event, view){
            $('#start').val(SA),
            $("#dialog").dialog({
              title: 'Tambahkan Agenda',
              width:600,
              height:600,
            })
          },
          select:function(start, end, allDay){
            var start11 = $.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm:ss");
            var dt2 = $.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm:ss");
  
            var end11 = konversi;
            $('#start').val(start11),
            $('#end').val(dt2),
            $("#dialog").dialog({
              title: 'Tambahkan Agenda',
              width:600,
              height:600,
            })
          },
            eventDrop: function (event, delta) {    
            var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm:ss");
            $.ajax({
            url: "{{ route('updateEventAdmin') }}",
            data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
            type: "POST",
            success: function (response) {
                $( "#UpdateDialog" ).dialog({
                     width:600,
                     height:200,
                });   
            }
            });
            },
            eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
            $.ajax({type: "POST",
            url: "{{ route('deleteEventAdmin') }}",
            data: "&id=" + event.id,
            success: function (response) {
            if(parseInt(response) > 0) {
            $('#calendar').fullCalendar('removeEvents', event.id);
            $( "#DeleteDialog" ).dialog({
                     width:600,
                     height:200,
                });
            }
            }
            });
            }
            }

    
  
          
        })
      });
</script>

<script src="{{ asset('js/fullcalendar.js') }}"></script>
    
@endsection


@section('bottom-js')
@include('sweetalert::alert')
@endsection