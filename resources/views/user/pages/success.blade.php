@extends('user.master')

@section('style')
    <link rel="stylesheet" href="{{asset('public/css/back/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/back/toastr.min.css')}}">
    <script src="{{asset('public/js/back/sweetalert2.min.js')}}"></script>
    <script src="{{asset('public/js/back/toastr.min.js')}}"></script>
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .table-hover-animation thead th {
    background-color: #05bbaa;
    color: #795548;}
 .table-res1 {
    background: #fff;
    box-shadow: 0px 2px 25px 3px rgba(0,0,0,0.1);
    margin-top: -242px;

    float: right;
    width: 328px;

}
.table-responsive{
    margin-top: 25px;
}
i.fa.fa-circle-o.text-primary {
    margin-top: 4px;
    margin-right: 10px;
}
i.fa.fa-circle-o.text-bold-700.text-success {
    margin-top: 4px;
    margin-right: 10px;
}
.btn.btn-primary.btn-block.place-order {
    margin-top: 10px;
}
.table-res {
    background: #fff;
    box-shadow: 0px 2px 25px 3px rgba(0,0,0,0.1);
}
td.table-border{s
    border-top: 0px solid #fff!important;
}
.con{
    color: #ffffff;
}
</style>
@stop
@section('header')
    @include('user.layout.common_header')
@stop

@section('content')

<div class="content">

<div class="path-section" style='background-image: url(public/img/slide-1.jpg);'>
    <div class="bg-cover">
        <div class="container">
            <h3>Slot Booking</h3>
        </div>
    </div>
</div>
<div class="blog-section page_spacing">
        <div class="container">
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert">
                   {{session('error')}}
            </div>
        @elseif(session()->has('success'))
            <div class="alert alert-success" role="alert">
                   {{session('success')}}
            </div>
        @endif

    </div>
</div>


@stop

@section('footer')
    @include('user.layout.footer')
@stop
@section('script')
<script src="{{asset('public/js/back/sweetalert2.min.js')}}"></script>
<script src="{{asset('public/js/back/toastr.min.js')}}"></script>
<script type="text/javascript">
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
$(document).on('click', '.rmv', function()
{
    var rowid = $(this).data('rowid');
    console.log(rowid);
//    $(this).closest("tr").remove();  
    $.ajax({
            type: 'POST',
            url: "{{route('del.usrcart')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             rowid: rowid
            },
           success: function(data)
           {
               $('.tcart').html(data.carttotal);
               $('.cdtl').html('');$('.cdtl').html(data.cartlist);

               toastr[data.type](data.message);
               $('.cpay').html(data.cpay);$('.cslot').html(data.cslot);
               $('.cdis').html(data.cdis);$('.ctotal').html(data.ctotal);
           }
        });
});
</script>
@stop