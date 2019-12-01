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
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" id="uprice" class="form-control" name="uprice" placeholder="Price">
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
</section>
<section id="centered-pills">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Center Alignment</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <p>
                                            To force your nav items to center use class <code>.justify-content-center</code> with <code>.nav</code>
                                        </p>
                                        <ul class="nav nav-pills justify-content-center">
                                            <li class="nav-item">
                                                <a class="nav-link" id="home-tab-center" data-toggle="pill" href="#home-center" aria-expanded="true">Home</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="profile-tab-center" data-toggle="pill" href="#profile-center" aria-expanded="false">Profile</a>
                                            </li>
                                          
                                           
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane" id="home-center" aria-labelledby="home-tab-center" aria-expanded="true">
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
                                            <div class="tab-pane active" id="profile-center" role="tabpanel" aria-labelledby="profile-tab-center" aria-expanded="false">
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
                    </div>
                </section>-->

<section id="stacked-pills">
<div class="row match-height">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title ">Weekdays and Pricing Type Setting</h4>
            </div>
            <div class="card-content">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" id="stacked-pill-1" data-toggle="pill" href="#vertical-pill-1" aria-expanded="true">
                                        Weekdays
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="stacked-pill-2" data-toggle="pill" href="#vertical-pill-2" aria-expanded="false">
                                        Pricing type
                                    </a>
                                </li>

                            </ul>
                        </div>
            
            <div class="col-md-10 col-sm-12">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="vertical-pill-1" aria-labelledby="stacked-pill-1" aria-expanded="true">
                        <table class="table table-hover-animation mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" style="background-color: #8FE2B4;">Day</th>
                                    <th scope="col" style="background-color: #8FE2B4;">start</th>
                                    <th scope="col" style="background-color: #8FE2B4;">end</th>
                                    <th scope="col" style="background-color: #8FE2B4;">slots</th>
                                    <th scope="col" style="background-color: #8FE2B4;">status</th>
                                </tr>
                            </thead>
                            <tbody class="weekbody">
                            @foreach($weekdays  as $w)                  
                            <tr>
                                <td>{{$w->day}}</td>
                                <td> <span class="badge badge-pill badge-glow bg-info">{{date( "h:i A", strtotime($w->start))}}</span></td>
                                <td> <span class="badge badge-pill badge-glow bg-info">{{date( "h:i A", strtotime($w->end))}}</span></td>
                                <td> <span class="badge badge-pill badge-glow bg-primary">{{$w->total_slot}}</span></td>
                                <td>          
                                    @if($w->sts==1)
                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                                            <input type="checkbox" class="custom-control-input changests" data-wid="{{$w->id}}" id="{{$w->id}}" checked>
                                            <label class="custom-control-label" for="{{$w->id}}">
                                                <span class="switch-text-left" style="color: white;">On</span>
                                                <span class="switch-text-right" style="color: white;">Off</span>
                                            </label>
                                        </div>
                                    @else
                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                                            <input type="checkbox" class="custom-control-input changests" data-wid="{{$w->id}}" id="{{$w->id}}">
                                            <label class="custom-control-label" for="{{$w->id}}">
                                                <span class="switch-text-left" style="color: white;">On</span>
                                                <span class="switch-text-right" style="color: white;">Off</span>
                                            </label>
                                        </div>
                                    @endif
                                </td>                    
                            </tr>
                            @endforeach                  
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="vertical-pill-2" role="tabpanel" aria-labelledby="stacked-pill-2" aria-expanded="false">
                        <a class="addHour" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i> add new
                                    </a>
                        <table class="table table-hover-animation mb-0">
                            <thead>
                               <tr>
                                   <th scope="col" style="background-color: #8FE2B4;">Type</th>
                                   <th scope="col" style="background-color: #8FE2B4;">Price</th>
                                   <th scope="col" style="background-color: #8FE2B4;">Action</th>
                               </tr>
                            </thead>
                            <tbody class="typebody">
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
<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>
<script src="{{asset('public/js/back/bootstrap-timepicker.js')}}"></script>



<script>
    $(document).ready(function()
    {
       $('.wtyp').addClass('active');
    });

$("#addAminForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save-admin')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addAminModel').modal('hide');
            toastr[data.type](data.message);
            countMethod();
            document.getElementById("addAminForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
    $('#title').val('');
    $('#body').val('');
});

$(document).on('click', '.addHour', function()
{
    document.getElementById("addHourFrm").reset();
    $('.addHourMdl').modal('show');
});
//type
$("#addHourFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.type')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            $('.addHourMdl').modal('hide');
            toastr[data.type](data.message);
            $('.typebody').html('');
            $('.typebody').html(data.output);
            document.getElementById("addHourFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//type  
 $(document).on('click', '.editHour', function()
{
    document.getElementById("editHourFrm").reset();
    $('#utype').val($(this).data('typ'));
    $('#uprice').val($(this).data('prc'));
    $('#typid').val($(this).data('typid'));
    $('.editHourMdl').modal('show');
});   
$("#editHourFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.type')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            $('.editHourMdl').modal('hide');
            toastr[data.type](data.message);
            $('.typebody').html('');
            $('.typebody').html(data.output);
            Toast.fire({type:data.type,title:data.message});
            document.getElementById("editHourFrm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});   
$(document).on('click', '.changests', function()
{
    console.log($(this).data('wid'));
    $.ajax({
        type: 'POST',
        url: "{{route('week.sts')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         wid: $(this).data('wid')
        },
       success: function(data)
       {
           toastr[data.type](data.message);
           $('.weekbody').html('');
           $('.weekbody').html(data.output);
       }
    });  
});

</script>
@stop