@extends('user.master')
@section('title'){{$title}}@stop
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
td.table-border{
    border-top: 0px solid #fff!important;
}
.con{
    color: #ffffff;
}
.path-section .bg-cover {
    padding: 130px 0 60px;
   }
.path-section {
    height: 100px;
}
i.fa.fa-cart-plus {
    font-size: 22px;
    margin-top: -2px;
}
.path-section .bg-cover {
    padding: 130px 0 60px;
}
.path-section {
    height: 100px;
}
ul#menu-main-menu {
    float: right;
    position: relative;
}
@media(min-width: 320px){
  li#menu-item-305 {
    position: relative;
    float: right;
    margin-right: 21px;
    margin-top: -31px;
}
}
@media(min-width: 480px){
    li#menu-item-305 {
    position: relative;
    margin-top: -51px;
}
}
@media(min-width: 768px){
  li#menu-item-305 {
    position: relative;
    margin-top: -68px;
  }
}
@media (min-width: 992px){
li#menu-item-305 {
    position: relative;
    margin-top: -35px;
    float: right;
    margin-left: 970px;
}
}

</style>
@stop

@section('header')
 <header class="header sticky-wrapper sticky-bar">
      
            <div class="container">
              <div class="row">
                    
                    <div class="col-md-2 col-xs-3">
                        <div class="logo"><a class="to-top" href="#goto-top"><img src="{{asset('public/img/app-logo.png')}}">
                        </div>
                    </div>
                    
                    <div class="col-md-10 col-xs-9">
                        <ul class="user-menu">
<!--                            <li class="user-acc">
                                <a href="my-account/index.html"><i class="user-icon"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a class="d-text-c-h" href="user-account/index.html">Login</a></li>
                                </ul>
                            </li>
                            <li class="cart-ddl">
                                <a class="d-text-c-h" href="cart/index.html">
                                    <i class="cart-icon"></i>
                                </a>
                                <ul class="dropdown-menu cart-dropdown">
                                    <li>                  
                                        <span class="cart_details">0 items, Total of <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&pound;</span>0.00</span></span>
                                        <a class="checkout" title="View your shopping cart" href="cart/index.html">
                                                Checkout <span class="icon-chevron-right"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>-->
{{--                             <li class="menu-toggle">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </li> --}}
                      </ul>
                        
                        {{-- <nav id="navbar" class="nav menu navbar navbar-custom navbar-fixed-top" role="navigation"> --}}
                            <div {{-- class="collapse navbar-collapse navbar-right navbar-main-collapse" --}}>
                                <ul id="menu-main-menu" class="nav navbar-nav" style="margin-top: auto;">

                        <li id="menu-item-305" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-305 ">
                            <a title="Cart" href="{{route('usrappcart')}}" aria-haspopup="true">
                                <i class="fa fa-cart-plus"></i>
                                <span class="badge badge-pill badge-primary badge-up tcart" style="background-color: #024279;">{{Cart::count()}}</span>
                            </a>
                        </li> 

                                </ul>             
                            </div>
                       {{--  </nav> --}}
                    </div>
                    
                </div>
              </div>

        </header>
@stop

@section('content')

<div class="content">

<div class="path-section" style='background-image: url(public/img/black.png);'>
{{--     <div class="bg-cover">
        <div class="container">
            <h3>Slot Booking</h3>
        </div>
    </div> --}}
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
                <div class="row">
                   <div class="col-lg-8 col-sm-12 col-md-8 col-xs-12">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0">
                            <thead> 
                                <tr>
                                    <th>Date</th>
                                    <th>Slot</th>
                                    <th>Regular Price</th>
                                    <th>Discount</th>
                                    <th>Book Price</th>
                                    <th></th> 
                                </tr>
                            </thead>
                            <tbody class="cdtl">
                            @php $i=0;$total=0;$discount=0;@endphp
                            @if(Cart::count()>0)
                                @foreach(Cart::content() as $cart)
                                <tr>
                                    <td>{{date('D,d M, Y',strtotime($cart->options->date))}}</td>
                                    <td>{{$cart->options->time}}</td>
                                    
                                @if(array_key_exists($cart->options->date, $fd))
                                    <td>{{$cart->options->price}}</td>
                                    <td>{{$cart->options->price-$fd[$cart->options->date]}}</td>
                                    <td>{{$fd[$cart->options->date]}}</td>
                                    @php $discount+=($cart->options->price-$fd[$cart->options->date]);$total+=$cart->options->price;@endphp
                                @else
                                    @if(array_key_exists($cart->options->date, $dd) && array_key_exists($cart->options->slot, $ds))
                                        <td>{{$dd[$cart->options->date]}}</td>
                                        <td>0</td>
                                        <td>{{$dd[$cart->options->date]}}</td>
                                        @php $discount+=0;$total+=$dd[$cart->options->date]; @endphp
                                    @else
                                        @if(array_key_exists($cart->options->date, $od) && array_key_exists($cart->options->slot, $os))
                                            <td>{{$cart->options->price}}</td>    
                                            <td>{{$od[$cart->options->date].'%'}} </td>
                                            <td>{{$cart->options->price-(($od[$cart->options->date]/100)*$cart->options->price)}}</td>
                                            @php $discount+=($od[$cart->options->date]/100)*$cart->options->price;
                                                 $total+=$cart->options->price;
                                            @endphp
                                        @else
                                            <td>{{$cart->options->price}}</td>
                                            <td>0</td>
                                            <td>{{$cart->options->price}}</td>
                                             @php $discount+=0;$total+=$cart->options->price; @endphp
                                        @endif
                                    @endif
                                @endif
                                    <td>
                                        <a href="#" class="rmv" data-rowid="{{$cart->rowId}}">
                                            <i class="fa fa-trash font-small-3 text-danger"></i>
                                        </a>
                                    </td>
                                    @php $i++;@endphp
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center"> No slot in cart</td>
                                </tr>
                            @endif
                            
                            
                                <tr>
                                <td colspan="7" class="text-center"></td>
                                </tr>
                            </tbody>
                            
                         </table>
                    </div>

                    </div>

    <div class="col-lg-4 col-sm-12 col-md-12 col-xs-12">
        <form method="post" action="{{route('appbook')}}">
            
        
<div class="table-responsive mt-1">
                        <table class="table">
                            <thead> 
                                <tr>
                                    <td><div class="series-info d-flex align-items-center">
                                        <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                        <span class="text-bold-600 ml-50">Total Slots</span>
                                        </div>
                                    </td>
                                    <td class="cslot">{{$i}}</td>
                                </tr>
                                <tr>
                                    <td><div class="series-info d-flex align-items-center">
                                        <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                        <span class="text-bold-600 ml-50">Price</span>
                                        </div>
                                    </td>
                                    <td class="ctotal">{{number_format($total)}}</td>
                                </tr>
                                <tr>
                                    <td><div class="series-info d-flex align-items-center">
                                        <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                        <span class="text-bold-600 ml-50">Discount</span>
                                        </div>
                                    </td>
                                    <td class="cdis">{{number_format($discount)}}</td>
                                </tr>
                                @if(isset($member))
                                    <tr>
                                        <td><div class="series-info d-flex align-items-center">
                                            <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                                            <span class="text-bold-600 ml-50">Membership</span>
                                            </div>
                                        </td>
                                        <td class=""><input type="text" id="memcode" name="memcode" style="border:0px;" placeholder="enter code"></td>
                                    </tr>
                                @endif
                                
                        {{csrf_field()}}
                            </thead>
<!--                            
-->                            <tbody class="cartlist">
                                <tr>
                                    <th><div class="series-info d-flex align-items-center">
                                        <i class="fa fa-circle-o text-bold-700 text-success"></i>
                                        <span class="text-bold-600 ml-50">Amount To Pay</span>
                                        </div>
                                    </th>
                                    <td class="cpay">{{number_format($total-$discount)}}</td>
                                </tr>
<!--                                <tr>
                                    <td>10/11/12</td>
                                    <td>Mon</td>

                                    
                                </tr>
                                <tr>
                                <td colspan="7" class="text-center"> No slot in cart</td>
                                </tr>-->
                            </tbody>
                            
                         </table>
                    </div>
   <button type="submit" class="btn btn-primary btn-block place-order">Confirm Booking</button>
    </form>
</div>

               </div>
    </div>
</div>


@stop

@section('footer')
   {{--  @include('user.layout.footer') --}}
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