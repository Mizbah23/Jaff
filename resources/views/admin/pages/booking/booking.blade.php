@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/app-ecommerce-shop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/wizard.css')}}">
  
    
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .table-hover-animation thead th {
    background-color: #05bbaa;
    color: #795548;}
</style>

<!-- *****************************add model**********************************-->

<!-- *****************************delete model**********************************-->

    <form action="#" class="icons-tab-steps checkout-tab-steps wizard-circle">
        <!-- Checkout Place order starts -->
        <h6><i class="step-icon step feather icon-shopping-cart"></i>Cart</h6>
            <fieldset class="checkout-step-1 px-0">
            <section id="place-order" class="list-view product-checkout">
           
<div class="row">
    <div class="col-md-9">                 
        <div class="checkout-items">
            <div class="card ecommerce-card">
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover-animation mb-0">
                            <thead> 
                                <tr>
                                    <th >Date</th>
                                    <th>Day</th>
                                    <th>Slot</th>
                                    <th>Regular Price</th>
                                    <th>Offer</th>
                                    <th>Book Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="cartlist">
                                @php $i=0;$total=0;$discount=0;@endphp
                                
                            @if(Cart::count()>0)
                            @foreach(Cart::content() as $cart)
                                    <tr>
                                        <td>{{$cart->options->date}}</td>
                                        <td>{{date('D',strtotime($cart->options->date))}}</td>
                                        <td>{{$cart->options->time}}</td>
                                        
                                @if(array_key_exists($cart->options->date, $fdays))
                                    <td>{{$cart->options->price}}</td>
                                    <td>{{$cart->options->price-$fdays[$cart->options->date]}} </td>
                                    <td>{{$fdays[$cart->options->date]}}</td>
                                    @php $discount+=($cart->options->price-$fdays[$cart->options->date]);
                                         $total+=$cart->options->price;
                                    @endphp
                                @else
                                
                                    @if(array_key_exists($cart->options->date, $drops) && array_key_exists($cart->options->slot, $dslot))
                                        <td>{{$drops[$cart->options->date]}}</td>
                                        <td>0</td>
                                        <td>{{$drops[$cart->options->date]}}</td>
                                        @php $discount+=0;$total+=$drops[$cart->options->date]; @endphp
                                    @else
                                        @if(array_key_exists($cart->options->date, $lists) && array_key_exists($cart->options->slot, $slots))
                                            <td>{{$cart->options->price}}</td>    
                                            <td>{{$lists[$cart->options->date].'%'}} </td>
                                            <td>{{$cart->options->price-(($lists[$cart->options->date]/100)*$cart->options->price)}}</td>
                                            @php $discount+=($lists[$cart->options->date]/100)*$cart->options->price;
                                                 $total+=$cart->options->price;
                                            @endphp
                                        @else
                                            <td>{{$cart->options->price}}</td>
                                            <td><i class="fa fa-times font-small-3 text-danger"></i></td>
                                            <td>{{$cart->options->price}}</td>
                                             @php $discount+=0;$total+=$cart->options->price; @endphp
                                        @endif
                                    
                                    @endif
                                @endif
                                        
                                        
                                    
                                    <td><a href="#" class="rmv" data-rowid="{{$cart->rowId}}"><i class="fa fa-trash font-small-3 text-danger" ></i></a></td>
                                    @php $i++;@endphp
                                    </tr>
                            @endforeach
                            @else
                                    <tr>
                                        <td colspan="7" class="text-center"> No slot in cart</td>
                                    </tr>
                            @endif
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="checkout-options">
            <div class="card">
                
                <div class="card-content">
                    <div class="card-body">

                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                            <span class="text-bold-600 ml-50">Total Slots</span>
                            </div>
                            <div class="product-result">
                                <span class="cslot">{{$i}}</span>
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                            <span class="text-bold-600 ml-50">Price</span>
                            </div>
                            <div class="product-result">
                                <span class="ctotal">{{$total}}</span><input type="hidden" value="{{$total}}" id="tamount">
                            </div>
                        </div>
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-primary"></i>
                            <span class="text-bold-600 ml-50">Discount</span>
                            </div>
                            <div class="product-result">
                                <span class="cdis">{{$discount}}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="chart-info d-flex justify-content-between mb-1">
                            <div class="series-info d-flex align-items-center">
                            <i class="fa fa-circle-o text-bold-700 text-success"></i>
                            <span class="text-bold-600 ml-50">Total</span>
                            </div>
                            <div class="product-result">
                                <span class="cpay">{{$total-$discount}}</span>
                            </div>
                        </div>
                        <div class="btn btn-primary btn-block place-order">PLACE ORDER</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
                   
    </section>
</fieldset>
       

                    <!-- Checkout Customer Address Starts -->
 <h6><i class="step-icon step feather icon-user"></i>User</h6>
    <fieldset class="checkout-step-2 px-0">
        
        <section id="checkout-address" class="list-view product-checkout">
            <div  class="row">
                <div class="col-md-6">
                    <div class="card">
                <div class="card-header flex-column align-items-start">
                    <h4 class="card-title">Select User For booking</h4>
                </div>
                <div class="card-content">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="add-type">Book for:</label>
                                    <select class="form-control required bookedfor select2" id="checkout-name">
                                        <option vlaue="" disabled="" selected>-select user-</option>
                                         @foreach($users as $usr)
                                          <option vlaue="{{$usr->id}}">{{$usr->username}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <div class="col-md-6">
                     <div class="customer-card">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title getname">Username</h4>
                                 <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>
                            </ul>
                        </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body actions">
                                <div class="usrcon">
                                    <p class="mb-0">name</p>
                                    <p>email</p>
                                    <p>phone</p><img class="rounded-circle" src="http://localhost/jaff/public/img/user/psdmosheur.jpg" alt="" height="100" width="100">
                                </div>
                                <hr>
                                <div class="btn btn-primary btn-block delivery-address">Book for this customer</div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
                 
            
               
            </section>
        </fieldset>

                    <!-- Checkout Customer Address Ends -->

                    <!-- Checkout Payment Starts -->
                    <h6><i class="step-icon step feather icon-credit-card"></i>Payment</h6>
                    <fieldset class="checkout-step-3 px-0">
                        <section id="checkout-payment" class="list-view product-checkout">
                            <div class="payment-type">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Payment options</h4>
                                        <p class="text-muted mt-25">Under constuction. Now it will be saved as due</p>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div class="vs-radio-con vs-radio-primary">
                                                <button type="submit" class="btn btn-primary btn-cvv ml-50 mb-50 confirm">Confirm</a></button>
                                                </div>
                                            </div>
                                         
                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                 
                        </section>
                    </fieldset>

                    <!-- Checkout Payment Starts -->
                </form>

          
      
 








@stop
@section('script')
<script src="{{asset('public/js/back/datatables.min.js')}}"></script>
<script src="{{asset('public/js/back/datatables.bootstrap4.min.js')}}"></script>

<script src="{{asset('public/js/back/datatable.min.js')}}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>



    <script src="{{asset('public/js/back/jquery.steps.min.js')}}"></script>
    <script src="{{asset('public/js/back/jquery.validate.min.js')}}"></script>

    <script src="{{asset('public/js/back/app-ecommerce-shop.js')}}"></script>
<script>
$(document).on('click', '.confirm', function()
{
    console.log("clicked");
    $('.cartlist').html('');
    $.ajax({
        type: 'POST',
        url: "{{route('save.book')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         bookedfor : $('.bookedfor').val(),
         tamount : $('#tamount').val()
        },
       success: function(data)
       {
           Toast.fire({type:data.type,title:data.message,position:'top-end'});
           $('.cartlist').html('');
       }
    });
});
$(document).on('click', '.rmv', function()
{
    var rowid = $(this).data('rowid');
    console.log(rowid);
//    $(this).closest("tr").remove();  
    $.ajax({
            type: 'POST',
            url: "{{route('del.bookrow')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             rowid: rowid
            },
           success: function(data)
           {
               $('.cartTotal').html(data.carttotal);
               $('#cartDeatils').html('');$('#cartDeatils').html(data.cartdeatils);
               Toast.fire({type:data.type,title:data.message,position:'top-end'});
               $('.cartlist').html(data.info);
               $('.cpay').html(data.cpay);$('.cslot').html(data.cslot);
               $('.cdis').html(data.cdis);$('.ctotal').html(data.ctotal);
           }
        });
});
$(document).on('change', '#checkout-name', function()
{
    $('.getname').html($(this).val());
    $.ajax({
            type: 'POST',
            url: "{{route('get.bookuser')}}",
            data: {
             _token: $('meta[name="csrf-token"]').attr('content'),
             uid: $(this).val()
            },
           success: function(data)
           {
               $('.usrcon').html(data);
           }
    });
});
</script>
    
    
@stop