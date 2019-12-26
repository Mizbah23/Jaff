@extends('user.master')
@section('title'){{$title}}@stop
@section('style')
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.css" />-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/fullcalendar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/extra.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/back/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/back/toastr.min.css')}}">
@stop

@section('header')
    @include('user.layout.common_header')
@stop

@section('content')
<style>
body.modal-open {
    overflow: hidden;
}
</style>
<div class="content">

    
<div class="path-section" style='background-image: url(public/img/slide-1.jpg);'>
    <div class="bg-cover">
        <div class="container">
            <h3>Time Table</h3>
        </div>
    </div>
</div>

 <div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel21" style="text-align:center;" ><span class="bookDate mtl" style="color:#024279;"></span></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body aslot">

              </div>
<!--              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Add to cart</button>
                  <button type="button" class="btn btn-outline-primary mr-1 mb-1 waves-effect waves-light">
                      <i class="feather icon-shopping-cart"></i> Add</button>
              </div>-->
          </div>
      </div>
  </div>   
    
    
    
    
<div class="blog-section page_spacing">
    <div class="container-fluid shortcode-view" style="padding-right: 10%;
    padding-left: 10%;">
        <div class="row">
            <div class="col-md-12">

					
                <article id="post-360" class="page-post-entry post-360 page type-page status-publish hentry">
                    <h2 class="sr-only">Time Table</h2>
                    <header class="entry-header"></header>
                    <div class="entry-content">

                          <div id="calendar"></div>
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
<script src="{{asset('public/js/back/moment.min.js')}}"></script>
<script src="{{asset('public/js/back/fullcalendar.min.js')}}"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/qtip2/3.0.3/basic/jquery.qtip.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<script src="{{asset('public/js/back/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('public/js/back/toastr.min.js')}}"></script>


<script type="text/javascript">
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');var mm = String(today.getMonth() + 1).padStart(2, '0');var yyyy = today.getFullYear();
var cday = yyyy + '-' + mm + '-' + dd;

 Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "2000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
   </script>
   
<script>
    $('#calendar').fullCalendar({
        contentHeight: 1700,
        weekends: true,
        height: 1500,

//        editable: false,
//        eventClick :false,

        header    : {
            left  : 'prev,next today',
            center: 'title',
            right : 'month,agendaWeek,agendaDay,list'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week : 'week',
            day  : 'day'
        },
        dayClick: function(date, jsEvent, view, resourceObj)
        {
            var d = date.format();
            if(!date.isBefore(cday)){availableSlot(d);$('#onshow').modal('show');} 
        },
        
        eventClick: function(calEvent, jsEvent, view) {
           var dt = calEvent.start;
           var d = dt.format();
           if(!dt.isBefore(cday)){availableSlot(d);$('#onshow').modal('show');}
        },
        events: function(start, end, timezone, callback,cell)
        {
            jQuery.ajax({url: "{{route('load.usrevent')}}",type: 'POST',dataType: 'json',
            data: {start: start.format(),end: end.format(),_token: $('meta[name="csrf-token"]').attr('content')},
                success: function(doc) {
                    var events = [];
                    if(!!doc){
                        $.map( doc, function( r ) {
                            events.push({
                                id: r.id,
                                title: r.title,
                                start: r.start,
                                end: r.end,
                                color: r.color,
                                textColor: 'white'
                            });
                        });
                    }
                    callback(events);
                }
            });
        }
    });
    
function availableSlot(d){$.ajax({type: 'POST',
url: "{{route('avail.usrslot')}}",data: {_token: $('meta[name="csrf-token"]').attr('content'),date: d},
success: function(data){$('.aslot').html(data.output);$('.bookDate').html(data.title); }});}
</script>

<script>
$("#onshow").on("show", function () {
  $("body").addClass("modal-open");
}).on("hidden", function () {
  $("body").removeClass("modal-open");
});

$(document).on('change', '.cartslot', function()
{
    var slot_id = $(this).data('slot_id');var date = $(this).data('date');var time = $(this).data('time');var price = $(this).data('price');
    var ischecked= $(this).is(':checked');
    if(!ischecked)
    {
        $.ajax({
            type: 'POST',
            url: "{{route('rmv.usrcart')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             slot_id: slot_id,
             date : date,
             time:time,
             price:price
            },
           success: function(data)
           {
               $('.tcart').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
//               Toast.fire({type:data.type,title:data.message,position:'top-center'});
               toastr[data.type](data.message);
           }
        });
    }else{
        $.ajax({
            type: 'POST',
            url: "{{route('add.usrcart')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             slot_id: slot_id,
             date : date,
             time:time,
             price:price
            },
           success: function(data)
           {
               $('.tcart').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
//               Toast.fire({type:data.type,title:data.message,position:'top-center'});
               toastr[data.type](data.message);
           }
        });
    }
});


$(document).on('click', '.delRow', function()
{
    var rowid = $(this).data('rowid');
    
//    console.log(rowid);
    $.ajax({
            type: 'POST',
            url: "{{route('del.cartrow')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             rowid: rowid
            },
           success: function(data)
           {
               $('.cartTotal').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
//               Toast.fire({type:data.type,title:data.message,position:'top-end'});
               toastr[data.type](data.message);
               $('.cartDrop').addClass('show');
           }
        });
}); 
</script>
@stop