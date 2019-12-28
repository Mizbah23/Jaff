@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/pickadate.css')}}">
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;}
    .avatar .avatar-content {height: 46px;width: 46px;}
.picker__table {

    margin-bottom: 0px;
}
   .picker__header {
    padding-top: 10px;
    padding-bottom: 10px;
} 
.picker__table {
    font-size: 11px;
}
.picker {
    top: 78%;
}
</style>

<!-- *****************************add model**********************************-->

<div class="modal fade addModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Drop In Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="addForm" enctype="multipart/form-data">    
                <div class="row" >  
                    <div class="col-md-6 col-xs-6 ">
                        <fieldset class="form-group">
                            <label for="basicInput">Date</label>
                            <input type="text" class="form-control pickadate" name="date" id="date" placeholder="Effective Date">
                        </fieldset>   
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <select name="ground_id" id="ground_id" class="select2 form-control" placeholder="Type">
                                @foreach($grounds as $ground)
                                <option value="{{$ground->id}}">{{$ground->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Slots</label>
                            <select name="slot_id" id="slot_id" class="select2 form-control" placeholder="Type">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Person</label>
                            <input name="seat" id="seat" class=" form-control" placeholder="Total Seat availability ">
                        </div>
                    </div>
                     <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <input name="price" id="price" class=" form-control" placeholder="Price for this slot">
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
            </div>   
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-0 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-0 waves-effect waves-light">
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>


<!-- *****************************edit model**********************************-->
<div class="modal fade upModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Update Drop In Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upForm" enctype="multipart/form-data"> 
                <input type="hidden" name="updid" id="updid">
                <input type="hidden" name="sltid" id="sltid">
                <div class="row" >  
                    <div class="col-md-6 col-xs-6 ">
                        <fieldset class="form-group">
                            <label for="basicInput">Date</label>
                            <input type="text" class="form-control pickadate" name="udate" id="udate" placeholder="Effective Date">
                        </fieldset>   
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <select name="uground_id" id="uground_id" class="select2 form-control" placeholder="Type">
                                @foreach($grounds as $ground)
                                <option value="{{$ground->id}}">{{$ground->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Slots</label>
                            <select name="uslot_id" id="uslot_id" class="select2 form-control" placeholder="Type">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Person</label>
                            <input name="useat" id="useat" class=" form-control" placeholder="Total Seat availability ">
                        </div>
                    </div>
                     <div class="col-md-6 col-xs-6">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <input name="uprice" id="uprice" class=" form-control" placeholder="Price for this slot">
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
            </div>   
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-0 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-0 waves-effect waves-light">
                    Update <span class="upbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- *****************************delete model**********************************-->
<div class="modal fade delModel" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">    
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Delete DropIn Slot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" value="" id="deldropid">                                        
            <div class="modal-body">
                Are You Sure You want to delete this Slot <span class="ttl" style="color:red;"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" id="deldrop" class="btn btn-outline-danger  waves-effect waves-light">
                    Delete <span class="delbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade listModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning white">
                <h5 class="modal-title listTitle" id="exampleModalScrollableTitle">Create Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                  <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Applied date</th>
                                    <th scope="col">Slot</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="offerlist">

                            </tbody>
                        </table>
                    </div>
            </div>   
<!--            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>-->
        </form>
        </div>
    </div>
</div>
<!-- *****************************Page Content**********************************-->

<section id="basic-input" style="margin-top: -20px;">
    <div class="row">
        <div class="col-xl-8 col-md-8 col-sm-8 col-xs-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-body " style="padding-bottom: 0px;">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">From Date</label>
                                    <input type="text" class="form-control pickadate" id="fromdate" placeholder="From Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">To Date</label>
                                    <input type="text" class="form-control pickadate" id="todate" placeholder="To Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1"  style="padding-top: 18px;">
                                <fieldset class="form-group" style="margin-bottom: 0px;">    
                                    <button type="button" class=" btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                                        <i class="feather icon-printer"></i> Print
                                    </button>
                                </fieldset>               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-4 col-md-4 col-xs-4" style="margin-top: 0px;">
            <div class="card">
                <div class="card-content">
                    <div class="card-body " >
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                <div>
                            <h2 class="text-bold-700 dayCount">0</h2>
                            <p class="mb-0">Total Slots</p>
                        </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                <div class="avatar bg-rgba-warning p-0">
                            <div class="avatar-content">
                                <i class="feather icon-check-circle text-success font-medium-5"></i>
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






<section id="basic-datatable " style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
<!--                                    <li class="breadcrumb-item"><a href="#">Components</a>
                        </li>-->
                        <li class="breadcrumb-item active"><b>Drop In Slot Setting</b>
                            <a class="addnew" style="padding: 8px;">
                                <i class="ficon feather icon-plus-circle info "></i>
                            </a>
                        </li>
                        
                    </ol>
                    

<!--
                    <button type="button" class="addnew btn btn-outline-primary waves-effect waves-light" data-toggle="modal">
                    <i class="feather icon-plus-circle"></i> add User
                    </button>-->
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard"  style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="dropTbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color: #3973ac;color: white;">
                                        <th>Date</th>
                                        <th>Slot</th>
                                        <th>Price</th>
                                        <th>Seats</th>
                                        <th>Booked</th>
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
<script src="{{asset('public/js/back/datatable.min.js')}}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/js/back/picker.js')}}"></script>
<script src="{{asset('public/js/back/picker.date.js')}}"></script>
<script>
$(document).ready(function(){$('.drp').addClass('active');$('.s').addClass('has-sub sidebar-group-active open');
    countMethod();
});
$(function () {$('.pickadate').pickadate({format: 'yyyy-m-d'});});
    var table = $('#dropTbl').DataTable(
    {
        "responsive" : true,"autoWidth"  : false,
//      "ordering": false,"paging" : true,
        "processing" : true,"serverSide": true,
//       "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
        {
            "url":"<?= route('list.dropin') ?>",
            "dataType":"json",
            "type":"POST",
            "data": function ( d )
            {
                d._token= $('meta[name="csrf-token"]').attr('content');
                d.from= $('#fromdate').val();
                d.to= $('#todate').val();
            }
        },
        "columns":[
        {"data":"date"},
        {"data":"slot"},
        {"data":"price"},
        {"data":"person"},
        {"data":"taken"},
        {"data":"name"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
    "order": [[1, 'desc']]   
});
//***************************************************
$('#fromdate').change(function()
{
    table.ajax.reload( null, false );
    countMethod();
});
$('#todate').change(function()
{
    table.ajax.reload( null, false );
    countMethod();
}); 
function countMethod()
{
    $.ajax({
        type: 'POST',
        url: "{{route('count.dropin')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         from: $('#fromdate').val(),
         to: $('#todate').val()
        },
       success: function(data){
        $('.dayCount').html(data);
       }
    });
}


$('#date').on('change', function()
{      	
    var date=$(this).val();var div=$('.addModel').parent();var op=" ";
    $.ajax({
        type:'get',url:'{{route('fetchDropSlot')}}',data:{'date':date},
        success:function(data)
        {
            op+='<option value="" selected disabled>-chose-</option>';
            for(var i=0;i<data.length;i++)
            {
                op+='<option value="'+data[i].slot_id+'">'+data[i].start+'-'+data[i].end+'</option>';
            }
            div.find('#slot_id').html(" ");
            div.find('#slot_id').append(op);
        },
        error:function(){}});
});

$('#udate').on('change', function()
{      	
    var date=$(this).val();var div=$('.upModel').parent();var op=" ";var sltid=$('#sltid').val();
    $.ajax({
        type:'get',url:'{{route('fetchDropSlot')}}',data:{'date':date},
        success:function(data)
        {
            op+='<option value="" selected disabled>-chose-</option>';
            for(var i=0;i<data.length;i++)
            {
                op+='<option value="'+data[i].slot_id+'">'+data[i].start+'-'+data[i].end+'</option>';
            }
            div.find('#uslot_id').html(" ");
            div.find('#uslot_id').append(op);
            div.find('#uslot_id').val(sltid);
        },
        error:function(){}});
});

//******************************add*********************************************
$(".addnew").on('click',function(){
    document.getElementById("addForm").reset();
    $('.addModel').modal('show');
});
$("#addForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.dropin')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});

//******************************edit*********************************************
$(document).on('click', '.editmdl', function()
{
    $('#updid').val($(this).data('updid'));
    $('#sltid').val($(this).data('sltid'));
    $('#udate').val($(this).data('date'));$('#udate').trigger('change');
    $('#useat').val($(this).data('seat'));
    $('#uprice').val($(this).data('price'));
  
    $('.upModel').modal('show');
});
$("#upForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.dropin')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload(null,false);
            $('.upModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//*******************************delete***********************************
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#deldropid').val($(this).data('delid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delModel').modal('show');
});  
$("#deldrop").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('del.dropin')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        deldropid: $('#deldropid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delModel').modal('hide');
         toastr[data.type](data.message);
      }
    });
});
//*******************************Status***********************************
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('sts.dropin')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        aid: $(this).data('id'),sts: $(this).data('sts')},
      success: function(data){
      table.ajax.reload( null, false );
      toastr[data.type](data.message);}
    });
});

$(document).on('click', '.listmdl', function()
{
    $('.listModel').modal('show');
    $('.listTitle').html($(this).data('ttl'));
    $.ajax({
        type: 'POST',
        url: "{{route('fetch.offer')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         ofrid: $(this).data('ofrid')
        },
       success: function(data)
       {
            $('.offerlist').html(data); 
       }
    });
});
$(document).on('click', '.ofslt', function()
{
    $.ajax({
        type: 'POST',
        url: "{{route('del.ofslt')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         ofslt: $(this).data('ofslt'),
         ofid: $(this).data('ofid')
        },
       success: function(data)
       {
            $('.offerlist').html(data.output);
            toastr[data.type](data.message);
            table.ajax.reload( null, false );
       }
    });
});
</script>
@stop