@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
<!--   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/data-list-view.css')}}">-->
 <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/select2.min.css')}}">
 <link rel="stylesheet" href="{{asset('public/css/back/bootstrap-timepicker.css')}}">
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;} 
</style>

<!--***********************************addhour*******************************-->
<div class="modal fade addSlotMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Slot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="addSlotFrm" enctype="multipart/form-data"> 
        <div class="row">  
            <div class="col-xl-6">
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <div class="position-relative has-icon-left">
                                <select name="ground_id" class="select2 form-control" >
                                    @foreach($grounds as $grnd)
                                    <option value="{{$grnd->id}}">{{$grnd->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                        
                        <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Day</label>
                            <div class="position-relative has-icon-left">
                                <select name="day_id" id="day_id" class="select2 form-control" >
                                    <option value="">select</option>
                                    @foreach($weekdays as $wd)
                                    <option value="{{$wd->id}}">{{$wd->day}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
    
            <div class="col-md-12 col-sm-12">
                <label for="phone-floating-icon">Start Time</label>
                <div class="form-label-group position-relative has-icon-left">
                     <input type="text" name="start" id="startTime" class="sClass form-control timepicker" placeholder="Start Time">
                    <div class="form-control-position"><i class="fa fa-clock-o"></i></div>
                    <div class="valid-feedback sFeed"></div><div class="invalid-feedback sFeed"></div>
                </div>
            </div>           


                        
            <div class="col-md-12 col-sm-12">
                <label for="phone-floating-icon">End Time</label>
                <div class="form-label-group position-relative has-icon-left">
                    <input type="text" name="end" id="endTime" class="eClass form-control timepicker" placeholder="End Time">
                    <div class="form-control-position"><i class="fa fa-clock-o"></i></div>
                    <div class="valid-feedback eFeed"></div><div class="invalid-feedback eFeed"></div>
                </div>
            </div>          
                        
                <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Type</label>
                            <div class="position-relative has-icon-left">
                                <select id="slotTyp" name="slottyp" class="select2 form-control" >
                                    @foreach($types as $ty)
                                    <option value="{{$ty->id}}">{{$ty->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                {{csrf_field()}}      
                <div class="col-md-12 col-xl-12">
                    <fieldset>
                        <label for="first-name-icon">Change Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <div class="vs-checkbox-con">
                                        <input type="checkbox" id="changePrice" >
                                        <span class="vs-checkbox vs-checkbox-sm">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="slotPrice" name="slotprice" class="form-control" readonly aria-label="Text input with checkbox">
                        </div>
                    </fieldset>     
                </div>     
            </div>
                <div class="col-xl-6">
  <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Slot duration</th>
                                                <th scope="col">price</th>
                                            </tr>
                                        </thead>
                                        <tbody class="existing">
                                            
                                        </tbody>
                                    </table>
                                </div>
                    </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
        <button type="submit" class="btn btn-outline-info  waves-effect waves-light">Save
            <span class="addbtn" role="status" aria-hidden="true"></span> 
        </button>
         </form>
    </div>
   
    </div>
            </div>
</div>





<div class="modal fade upSlotMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Slot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post" id="upSlotFrm" enctype="multipart/form-data"> 
            <input type="hidden" name="upslotid" id="upslotid">
        <div class="row">  
            <div class="col-xl-6">
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <div class="position-relative has-icon-left">
                                <select name="uground_id" id="uground_id" class="select2 form-control" >
                                    @foreach($grounds as $grnd)
                                    <option value="{{$grnd->id}}">{{$grnd->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                        
                        <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Day</label>
                            <div class="position-relative has-icon-left">
                                <select name="uday_id" id="uday_id" class="select2 form-control" >
                                    <option value="">select</option>
                                    @foreach($weekdays as $wd)
                                    <option value="{{$wd->id}}">{{$wd->day}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
    
            <div class="col-md-12 col-sm-12">
                <label for="phone-floating-icon">Start Time</label>
                <div class="form-label-group position-relative has-icon-left">
                     <input type="text" name="ustart" id="ustartTime" class="usClass form-control timepicker" placeholder="Start Time">
                    <div class="form-control-position"><i class="fa fa-clock-o"></i></div>
                    <div class="valid-feedback usFeed"></div><div class="invalid-feedback usFeed"></div>
                </div>
            </div>           


                        
            <div class="col-md-12 col-sm-12">
                <label for="phone-floating-icon">End Time</label>
                <div class="form-label-group position-relative has-icon-left">
                    <input type="text" name="uend" id="uendTime" class="ueClass form-control timepicker" placeholder="End Time">
                    <div class="form-control-position"><i class="fa fa-clock-o"></i></div>
                    <div class="valid-feedback eFeed"></div><div class="invalid-feedback eFeed"></div>
                </div>
            </div>          
                        
                <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Type</label>
                            <div class="position-relative has-icon-left">
                                <select id="uslottyp" name="uslottyp" class="select2 form-control" >
                                    @foreach($types as $ty)
                                    <option value="{{$ty->id}}">{{$ty->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                </div>
                {{csrf_field()}}      
                <div class="col-md-12 col-xl-12">
                    <fieldset>
                        <label for="first-name-icon">Change Price</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <div class="vs-checkbox-con">
                                        <input type="checkbox" id="uchangePrice" >
                                        <span class="vs-checkbox vs-checkbox-sm">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <input type="text" id="uslotPrice" name="uslotprice" class="form-control" readonly aria-label="Text input with checkbox">
                        </div>
                    </fieldset>     
                </div>     
            </div>
                <div class="col-xl-6">
  <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Slot duration</th>
                                                <th scope="col">price</th>
                                            </tr>
                                        </thead>
                                        <tbody class="existing2">
                                            
                                        </tbody>
                                    </table>
                                </div>
                    </div>
            </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
        <button type="submit" class="btn btn-outline-info  waves-effect waves-light">Save
            <span class="addbtn" role="status" aria-hidden="true"></span> 
        </button>
         </form>
    </div>
   
    </div>
            </div>
</div>




<div class="modal fade pickMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-warning">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Pick for Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="pickFrm" enctype="multipart/form-data"> 
            <input type="hidden" name="slotid" id="slotid">
            <input type="hidden" name="dayid" id="dayid">
        <div class="row">  
            <!--<div class="col-xl-6">-->
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Offers</label>
                            <div class="position-relative has-icon-left">
                                <select name="offer_id" id="offer_id" class="select2 form-control" >
                                    <option value="">select</option>
                                    @foreach($offers as $off)
                                    <option value="{{$off->id}}">{{$off->offer_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                        
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            <label for="first-name-icon">Select For</label>
                            <div class="position-relative has-icon-left">
                                <select name="datelist[]" id="datelist" class="select2 form-control" multiple="">
                                    <option value="">select</option>
                                </select>
                            </div>
                        </div>  
                    </div>

            
           
                {{csrf_field()}}      
   
            <!--</div>-->
 
            </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
        <button type="submit" class="btn btn-outline-info  waves-effect waves-light">Save
            <span class="addbtn" role="status" aria-hidden="true"></span> 
        </button>
         </form>
    </div>
   
    </div>
            </div>
</div>




<div class="modal fade text-left addHourMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Hour Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="addHourFrm" enctype="">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="type" placeholder="Hour Pack">
                            <div class="form-control-position"><i class="feather icon-package"></i></div>
                            <label for="user-floating-icon">Hour Pack</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" id="phone-floating-icon" class="form-control" name="price" placeholder="Price">
                            <div class="form-control-position"><i class="fa fa-money"></i></div>
                            <label for="phone-floating-icon">Price</label>
                        </div>
                    </div>
                    {{csrf_field()}}

                </div>
                
            </div>
                
           <!--data-dismiss="modal"-->     
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>
                    
                </button>
                
            </div>
        </form>
        </div>
    </div>
</div>
<!--*************edit Hour***************-->

<div class="modal fade text-left editHourMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Hour Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="editHourFrm" enctype="">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="hidden" id="typid" name="typid">
                            <input type="text" id="utype" class="form-control" name="utype" placeholder="Hour Pack">
                            <div class="form-control-position"><i class="feather icon-package"></i></div>
                            <label for="user-floating-icon">Hour Pack</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-12 col-12">
                        
                            <input type="number" id="uprice" class="form-control" name="uprice" placeholder="Price">
                            <div class="form-control-position"><i class="fa fa-money"></i></div>
                            
                       
                    </div>
                    {{csrf_field()}}

                </div>
                
            </div>
                
           <!--data-dismiss="modal"-->     
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Update <span class="upbtn" role="status" aria-hidden="true"></span>  
                </button>
                
            </div>
        </form>
        </div>
    </div>
</div>

<!--****************************-->

<!--*************Slot Model***************-->

<!--**************************************************-->
<!--<section id="content-types">
    <div class="row match-height">
        
        <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="card" style="height: auto;">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center;">Week Days</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        
           
                        
                        @foreach($weekdays  as $w)
                           @if($w->sts==1)
                                <li class="list-group-item" style="text-align: center;">
                                    <span class="badge badge-pill badge-glow bg-success float-left">{{date( "h:i A", strtotime($w->start))}}</span>
                                    <span class="badge badge-pill bg-success badge-glow float-right">{{date( "h:i A", strtotime($w->end))}} </span>
                                    <a href="#" class="tued">{{$w->day}}</a>
                                </li>
                            @else
                                <li class="list-group-item" style="text-align: center;">
                                    <span class="badge badge-pill badge-glow bg-danger float-left">{{date( "h:i A", strtotime($w->start))}}</span>
                                    <span class="badge badge-pill badge-glow bg-danger float-right">{{date( "h:i A", strtotime($w->end))}} </span>
                                    <a href="#" class="tued">{{$w->day}}</a>
                                </li>
                            @endif
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
        
        
        
        
        <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header" >
                                <h4 class="card-title">Hours Type
                                    <a class="addHour" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i>
                                    </a>
                                </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover-animation mb-0">
                                            <thead >
                                                <tr>
                                                    <th scope="col" style="background-color: #8FE2B4;">Type</th>
                                                    <th scope="col" style="background-color: #8FE2B4;">Price</th>
                                                    <th scope="col" style="background-color: #8FE2B4;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($types as $ty)
                                                
                                                <tr>
                                                    <td>{{$ty->type}}</td>
                                                    <td> <span class="badge badge-pill badge-glow bg-primary">{{$ty->price}}</span></td>
                                                    <td>
                                                        <a class="editHour" style="padding: 4px;" data-typid="{{$ty->id}}" data-typ="{{$ty->type}}" data-prc="{{$ty->price}}">
                                                            <i class="ficon feather icon-edit success"></i>
                                                        </a>
                                                        <a class="" style="padding: 4px;" data-typid="{{$ty->id}}">
                                                            <i class="ficon feather icon-trash-2 danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                                
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

    </div>
</section>-->



<section id="basic-input" style="margin-top: -20px;">
    <div class="row">
        
              
        
        
        
        <div class="col-xl-9 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                
                <div class="card-content">
                    <div class="card-body " style="padding-bottom: 0px;">
                        <form method="get" action="{{route('report.slotPrint')}}" target="_blank">
                           
                        <div class="row">
                            
                            
                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Day</label>
                                    <select id="searchday" name="searchday" class=" form-control">
                                    <option value="">- all -</option>
                                    @foreach($weekdays as $wd)
                                    <option value="{{$wd->id}}">{{$wd->day}}</option>
                                    @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Ground</label>
                                    <select id="searchgrnd" name="searchgrnd" class=" form-control">
                                    <option value="">- all -</option>
                                    @foreach($grounds as $gd)
                                    <option value="{{$gd->id}}">{{$gd->name}}</option>
                                    @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            
                            <div class="col-xl-3 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">Pricing type</label>
                                    <select id="searchtyp" name="searchtyp" class=" form-control">
                                        <option value="">- all -</option>
                                        @foreach($types as $ty)
                                        <option value="{{$ty->id}}">{{$ty->type}}</option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-xl-3 col-md-6 col-12 mb-1" style="padding-top: 17px;">
                                <fieldset class="form-group" style="margin-bottom: 0px;">    
                                    <button type="submit" class=" btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                                        
                                        <i class="feather icon-printer"></i> Print
                                        </a></button>
                                </fieldset>               
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
          <div class="col-xl-3 col-sm-4 col-md-4 col-xs-4" style="margin-top: 0px;">
            <div class="card">
                <div class="card-content">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                <div>
                            <h2 class="text-bold-700 dayCount">2</h2>
                            <p class="mb-0">Total Slots</p>
                        </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                <div class="avatar bg-rgba-primary p-0">
                            <div class="avatar-content">
                                <i class="feather icon-clock text-info font-medium-5"></i>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<section id="basic-datatable" style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    
                    <h4 class="card-title">
                        <div class="row">
                            <!--<div class="col-md-3 form-group col-sm-6">-->
                                Slot List
                                <a class="addSlot" style="padding-left: 8px;">
                                    <i class="ficon feather icon-plus-circle info "></i>
                                </a>
                            <!--</div>-->
<!--                            <div class="col-md-3 form-group col-sm-6">
                                <select id="searchday" class=" form-control">
                                    <option value="">- all -</option>
                                    @foreach($weekdays as $wd)
                                    <option value="{{$wd->id}}">{{$wd->day}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 form-group col-sm-6">
                                <select id="searchgrnd" class=" form-control">
                                    <option value="">- all -</option>
                                    @foreach($grounds as $gd)
                                    <option value="{{$gd->id}}">{{$gd->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group col-sm-6">
                                <select id="searchtyp" class=" form-control">
                                    <option value="">- all -</option>
                                    @foreach($types as $ty)
                                    <option value="{{$ty->id}}">{{$ty->type}}</option>
                                    @endforeach
                                </select>
                            </div>-->
                             
                        </div>
                       
                          
                    </h4>
                    
                    
                </div>
                
                
                
                
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="slotTbl" class="table zero-configuration ">
                                <thead>
                                        <tr class="bg-info">
                                        <th>Day</th>
                                        <th>Duration</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Ground</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



        
        

@stop
@section('script')
<script src="{{asset('public/js/back/datatables.min.js')}}"></script>

<script src="{{asset('public/js/back/datatables.bootstrap4.min.js')}}"></script>


<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
 
<script src="{{asset('public/js/back/select2.full.min.js')}}"></script>
<script src="{{asset('public/js/back/form-select2.js')}}"></script>
<script src="{{asset('public/js/back/bootstrap-timepicker.js')}}"></script>



<script>
    $(document).ready(function()
    {
       $('.slt').addClass('active');
       countslot();
       
    });
    $(function () {
        $('.timepicker').timepicker({
         showInputs: false
       });
     });
    var table = $('#slotTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('slotPro') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                    d.searchday = $('#searchday').val();
                    d.searchgrnd = $('#searchgrnd').val();
                    d.searchtyp = $('#searchtyp').val();              
                }
            },
        "columns":[
        {"data":"day"},
        {"data":"duration"},
        {"data":"typ"},
        {"data":"price"},
        {"data":"grnd"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});

function countslot()
{
    $.ajax({
        type: 'POST',
        url: "{{route('count.slots')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         day : $('#searchday').val(),
         grnd : $('#searchgrnd').val(),
         typ : $('#searchtyp').val()
        },
       success: function(data){
        $('.dayCount').html(data);
       }
    });
}

$('#changePrice').on('change', function()
{
    ($("#changePrice").prop('checked') == true)?
    $('#slotPrice').attr("readonly",false):$('#slotPrice').attr("readonly",true);
});
$('#uchangePrice').on('change', function()
{
    ($("#uchangePrice").prop('checked') == true)?
    $('#uslotPrice').attr("readonly",false):$('#slotPrice').attr("readonly",true);
});

$('#slotTyp').on('change', function()
{
    $.ajax({type: 'POST',url: "{{route('set.price')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),typid: $(this).val()},
    success: function(data)
    {$('#slotPrice').val(data);}});  
});
$('#uslottyp').on('change', function()
{
    $.ajax({type: 'POST',url: "{{route('set.price')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),typid: $(this).val()},
    success: function(data)
    {$('#uslotPrice').val(data);}});  
});

//slot saving
$(document).on('click', '.addSlot', function()
{
    document.getElementById("addSlotFrm").reset();
    $('.sClass').removeClass('is-valid');
    $('.eClass').removeClass('is-valid');
    $('.addSlotMdl').modal('show');
    
});   
$("#addSlotFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.slot')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addSlotMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addHourFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});   


$(document).on('change', '#searchday', function()
{countslot();table.ajax.reload( null, false ); });
$(document).on('change', '#searchgrnd', function()
{countslot();table.ajax.reload( null, false ); }); 
$(document).on('change', '#searchtyp', function()
{countslot();table.ajax.reload( null, false ); });
$(document).on('click', '.changests', function()
{
    console.log($(this).data('sid'));
    $.ajax({
        type: 'POST',
        url: "{{route('slot.sts')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         sid: $(this).data('sid')
        },
       success: function(data)
       {
            toastr[data.type](data.message);
           table.ajax.reload( null, false ); 
       }
    });  
});
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upSlotFrm").reset();
    $('#upslotid').val($(this).data('sid'));
    $('#uground_id').val($(this).data('gid'));
    $('#uday_id').val($(this).data('dayid'));
    $('#uday_id').trigger('change'); 
    $('#ustartTime').val($(this).data('start'));
    $('#uendTime').val($(this).data('end'));
    $('#uslottyp').val($(this).data('typid'));$('#uslottyp').trigger('change'); 
    $('#uslotPrice').val($(this).data('price'));
    $('.upSlotMdl').modal('show');
}); 
$("#upSlotFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.slot')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upSlotMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upSlotFrm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});



$(document).on('click', '.pickmdl', function()
{
//    document.getElementById("addSlotFrm").reset();
    $('.pickMdl').modal('show');
    $('#slotid').val($(this).data('sid'));
    $('#dayid').val($(this).data('did'));

});
$("#pickFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('pickSlot')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.pickMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("pickFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
    $('#offer_id').on('change', function()
    {      	
            var offerid=$(this).val();var slotid=$('#slotid').val();
            var dayid=$('#dayid').val();
            var div=$('.pickMdl').parent();
            var op=" ";
            $.ajax({
                type:'get',
                url:'{{route('findDates')}}',
                data:{'offerid':offerid,'slotid':slotid,'dayid':dayid},
                success:function(data)
                {
                    op+='<option value="" disabled>-chose-</option>';
                    data.forEach(function(index) 
                    {
                        op+='<option value="'+index+'">'+index+'</option>';
                    }, this);
                    div.find('#datelist').html(" ");
                    div.find('#datelist').append(op);
                },
                error:function(){}
            });
	}); 


$('#day_id').on('change', function()
{
    $.ajax({type: 'POST',url: "{{route('fetch.slots')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),dayid: $('#day_id').val()},
    success: function(data)
    {$('.existing').html(data);}}); 
});
$('#uday_id').on('change', function()
{
    $.ajax({type: 'POST',url: "{{route('fetch.slots')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),dayid: $('#uday_id').val()},
    success: function(data)
    {$('.existing2').html(data);}}); 
});

$('#startTime').on('change', function()
{
    
    console.log($('#startTime').val());
    $.ajax({
        type: 'POST',
        url: "{{route('check.start')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         startTime: $('#startTime').val(),
         endTime: $('#endTime').val(),
         dayId: $('#day_id').val()
        },
       success: function(data)
       {
           if(data.error){
               $('.sClass').removeClass('is-valid');$('.sFeed').html('');
              $('.sClass').addClass('is-invalid');
              $('.sFeed').html(data.error);
              
           }else if(data.success){
               $('.sClass').removeClass('is-invalid');$('.sFeed').html(''); 
              $('.sClass').addClass('is-valid');
              $('.sFeed').html(data.success);
              
           }
       }
    }); 
});
$('#endTime').on('change', function()
{
    console.log($('#endTime').val());
    $.ajax({
        type: 'POST',
        url: "{{route('check.end')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         startTime: $('#startTime').val(),
         endTime: $('#endTime').val(),
         dayId: $('#day_id').val()
        },
       success: function(data)
       {
            if(data.error){
              $('.eClass').removeClass('is-valid');$('.eFeed').html('');
              $('.eClass').addClass('is-invalid');
              $('.eFeed').html(data.error);
              
           }else if(data.success){
              $('.eClass').removeClass('is-invalid');$('.eFeed').html(''); 
              $('.eClass').addClass('is-valid');
              $('.eFeed').html(data.success);
              
           }
       }
    }); 
});

$('#ustartTime').on('change', function()
{
    $.ajax({type: 'POST',url: "{{route('check.start')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),startTime: $('#ustartTime').val(),
         uendTime: $('#uendTime').val(),dayId: $('#uday_id').val(),slotid: $('#upslotid').val()},
    success: function(data)
    {if(data.error){
        $('.usClass').removeClass('is-valid');$('.usFeed').html('');$('.usClass').addClass('is-invalid');$('.usFeed').html(data.error);
    }else if(data.success){
        $('.usClass').removeClass('is-invalid');$('.usFeed').html(''); $('.usClass').addClass('is-valid');$('.usFeed').html(data.success);}
    }}); 
});
$('#uendTime').on('change', function()
{
    $.ajax({
        type: 'POST',
        url: "{{route('check.end')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         startTime: $('#ustartTime').val(),
         endTime: $('#uendTime').val(),
         dayId: $('#uday_id').val(),
         slotid: $('#upslotid').val()
        },
       success: function(data)
       {
            if(data.error){
              $('.ueClass').removeClass('is-valid');$('.ueFeed').html('');
              $('.ueClass').addClass('is-invalid');
              $('.ueFeed').html(data.error);
              
           }else if(data.success){
              $('.ueClass').removeClass('is-invalid');$('.ueFeed').html(''); 
              $('.ueClass').addClass('is-valid');
              $('.ueFeed').html(data.success);
              
           }
       }
    }); 
});
</script>
@stop