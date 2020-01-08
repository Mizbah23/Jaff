@extends('user.master')
@section('title'){{$title}}@stop
@section('style')
    <link rel="stylesheet" href="{{asset('public/css/back/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/back/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/back/invoice.min.css')}}">
    <script src="{{asset('public/js/back/sweetalert2.min.js')}}"></script>
    <script src="{{asset('public/js/back/toastr.min.js')}}"></script>
       <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/bootstrap-extended.min.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/colors.min.css')}}">
    {{--  <link rel="stylesheet" type="text/css" href="{{asset('/public/css/back/components.min.css')}}"> --}}
  
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/style.css')}}">
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
 img.logo, figure {
    max-width: 100%;
    height: 100px;
}
</style>
@stop
@section('header')
    @include('user.layout.common_header')
@stop

@section('content')

<div class="content">

<div class="path-section" style='background-image: url({{asset('public/img/slide-1.jpg')}});'>
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

    <div class="content-body">
                <section class="card invoice-page">
                    <div id="invoice-template" class="card-body">
                      
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-md-6 col-sm-12 text-left pt-1">
                                <div class="media pt-1">
                                    <img src="{{asset('public/img/app-logo.png')}}" alt="Jaff logo" class="logo" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-right">
                                <h1>Invoice</h1>
                                <div class="invoice-details mt-2">
                                    <h6>INVOICE NO: {{$bookinfo->book_code}}</h6>
                                    
                                    <h6 class="mt-2">INVOICE DATE:{{date( "d.m.Y", strtotime($bookinfo->created_at))}}</h6>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->

                        <!-- Invoice Recipient Details -->
                        <div id="invoice-customer-details" class="row pt-2">
                            <div class="col-md-6 col-sm-12 text-left">
                                <h5>Recipient</h5>
                                <div class="recipient-info my-2">
                                    <p>{{Auth::guard('web')->user()->first_name}} {{Auth::guard('web')->user()->last_name}}</p>
                                    <p>{!!Auth::guard('web')->user()->address!!}</p>
                                  
                                </div>
                                <div class="recipient-contact pb-2">
                                    <p>
                                        <i class="fa fa-envelope"></i>
                                        {{Auth::guard('web')->user()->email}}
                                    </p>
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        {{Auth::guard('web')->user()->phone}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-right">
                                <h5>Jaff Sports</h5>
                                <div class="company-info my-2">
                                    <p>Jaff Street Bashundhara Main Gate,</p>
                                    <p>Opposite  of Jamuna Future Park Sidegate,Dhaka</p>
                                    <p>94203</p>
                                </div>
                                <div class="company-contact">
                                    <p>
                                        <i class="fa fa-envelope"></i>
                                        info@jaff.com.bd
                                    </p>
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        +8801304229158
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--/ Invoice Recipient Details -->

                        <!-- Invoice Items Details -->
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Date</th>
                        <th>Slot</th>
                        <th class="right">Price(Taka)</th>
                        <th class="center">Discount</th>
                        <th class="right">Booked Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $pay=$total_price=$total_discount=0;@endphp 
                    @foreach($bookdetail as $key=>$item)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{date( "D,M Y", strtotime($item->created_at))}}</td>
                        <td>{{date( "h:i A", strtotime($item->start))}}-{{date( "h:i A", strtotime($item->end))}}</td>
                        <td>{{number_format($item->price)}}</td>
                        <td>{{number_format($item->discount)}}</td>
                        <td>{{number_format($item->book_price)}}</td>
                    </tr>
                    @php $pay+=$item->book_price;
                         $total_price+=$item->price;
                         $total_discount+=$item->discount;
                    @endphp
                    @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">

                    </div>

                <div class="col-lg-6 col-sm-12 ml-auto">
                    <table class="table table-clear">
                    <tbody> 
                       <tr>
                        <td>
                        <strong>Total Slots</strong>
                        </td>
                        <td align="left">{{$bookdetail->count()}}</td>
                        </tr>
                        <tr>
                        <td>
                        <strong>Price</strong>
                        </td>
                        <td align="left">{{number_format($total_price)}}</td>
                        </tr>
                       <tr>
                        <td>
                        <strong>Discount</strong>
                        </td>
                        <td align="left">{{number_format($total_discount)}}</td>
                        </tr>
                       <tr>
                        <td>
                        <strong>Amount to Pay</strong>
                        </td>
                        <td align="left">
                        <strong>{{number_format($pay)}}</strong>
                        </td>
                       </tr>
           
                    </tbody>
                    </table>

                </div>
              
            </div>

                        <!-- Invoice Footer -->
                        <div id="invoice-footer" class="text-right pt-3">
                            <p> Please include invoice number on your check.</p>
                        </div>
                        <!--/ Invoice Footer -->
                        <center><fieldset style="margin-bottom: 0px;">    
                            <button class=" btn btn-outline-success mr-1 mb-1 waves-effect waves-light"><a href="{{route('report.bookInvoicePrint',['bookid'=>$bookinfo->book_id])}}" target="_blank"><i class="fa fa-printer"></i> Print
                            </a></button>
                        </fieldset></center>  
                
                    </div>
                </section>

            </div>

    </div>
</div>


@stop

@section('footer')
    @include('user.layout.footer')
@stop
@section('script')
<script src="{{asset('public/js/back/sweetalert2.min.js')}}"></script>
<script src="{{asset('public/js/back/toastr.min.js')}}"></script>
    <!-- BEGIN: Vendor JS-->
      <script src="{{asset('public/js/back/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
{{--     <script src="{{asset('public/js/back/app-menu.min.js')}}"></script>
    <script src="{{asset('public/js/back/app-menu.min.js')}}"></script>
    <script src="{{asset('public/js/back/app.min.js')}}"></script> --}}
    <script src="{{asset('public/js/back/components.min.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
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