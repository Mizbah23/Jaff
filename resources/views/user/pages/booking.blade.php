@extends('user.master')
@section('title'){{$title}}@stop
@section('style')
 <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/app-ecommerce-shop.css')}}">
 <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/wizard.css')}}">
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
            <h3>Time Table</h3>
        </div>
    </div>
</div>
                
  <div class="container-fluid">
  
  <div class="row">
  <div class="col-md-8 col-sm-8">
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
                                <tr>
                                    <td>10/11/12</td>
                                    <td>Mon</td>
                                     <td>6:30-8:00</td>
                                    <td>2500</td>
                                    <td></td>
                                    <td>5000</td>
                                    {{-- <td></td> --}}
                                    
                                </tr>
                                <tr>
                                <td colspan="7" class="text-center"> No slot in cart</td>
                                </tr>
                           
                                
                                
                            </tbody>
                         </table>
  </div>
    
    <div class="col-md-4 col-sm-4" style="background-color:orange;">
    <table class="table">
    <thead>
      <tr>
        <td colspan="3">Firstname</td>
        <td>Email</td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="3">John</td>
        <td>john@example.com</td>
      </tr>
      <tr>
        <td colspan="3">Mary</td>
        <td>mary@example.com</td>
      </tr>
      <tr>
        <td colspan="3"><b>Total</b></td>
        <td><b>1200</b></td>
      </tr>
    </tbody>

  </table>
    </div>
   
  </div>
</div>  




@stop

@section('footer')
    @include('user.layout.footer')
@stop
@section('script')

{{--  --}}
@stop