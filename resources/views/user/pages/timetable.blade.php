<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
@extends('user.master')
@section('title'){{$title}}@stop
@section('style')
<link rel="stylesheet" href="public/css/front/fullcalendar-3.4.0.css" charset="UTF-8" />
 {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" /> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> --}}
@stop

@section('header')
    @include('user.layout.common_header')
@stop

@section('content')
<div class="content">

<div class="path-section" style='background-image: url(public/img/slide-1.jpg);'>
    <div class="bg-cover" style="padding: 120px 0 20px">
        <div class="container">
            <h3>Time Table</h3>
        </div>
    </div>
</div>
				
<div class="blog-section page_spacing">
    <div class="container-fluid shortcode-view">
        <div class="row">
            <div class="col-md-12">

					
                <article id="post-360" class="page-post-entry post-360 page type-page status-publish hentry">
                    <h2 class="sr-only">Time Table</h2>
                    <header class="entry-header"></header>
                    <div class="entry-content">
                               <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Full calendar start -->
                <section id="basic-examples">
 
                  <div class="container" >
                        <div id="calendar" ></div>
                  </div>


                    <!-- calendar  ends-->
                </section>
                <!-- // Full calendar end -->

            </div>
        </div>

                          <div id='fc-default'></div>
                    </div>
                </article>

            </div>			
        </div>
    </div>

</div>
</div>
@stop

@section('footer')
    @include('user.layout.footer')
@stop
@section('script')

<script src="public/js/front/jqueryui-1.12.1.js"></script>
<script src="public/js/front/moment-2.18.1.min.js"></script>
<script src="public/js/front/fullcalendar-3.4.0.js"></script>

  
    <!-- BEGIN: Page JS-->

    <script>
   
$(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: '',
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"",
       type:"",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"",
      type:"",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"",
      type:"",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"",
       type:"",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
           }
          })
         }
        },

       });
    });
   
</script>

    {{-- END: Theme JS --}}
   

@stop