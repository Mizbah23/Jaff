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

</style>

<!-- *****************************add model**********************************-->
<div class="modal fade addHolidayModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Add Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="addHolidayForm" enctype="multipart/form-data">    
                <div class="row" >  
                    <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                        <fieldset class="form-group">
                            <label for="basicInput">Holiday</label>
                            <input type="text" class="form-control pickadate" name="holiday" id="holiday" placeholder="Holiday ">
                        </fieldset>   
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <select name="ground_id" id="ground_id" class="select2 form-control" placeholder="Type">
                                @foreach($grounds as $ground)
                                <option value="{{$ground->id}}">{{$ground->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{csrf_field()}} 
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Details</label>
                            <textarea name="details" id="details" rows="10" class="form-control" placeholder="Holiday Purpose"></textarea>
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
            </div>   
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


<!-- *****************************edit model**********************************-->
<div class="modal fade upHolidayModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Add Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upHolidayForm" enctype="multipart/form-data">    
                    <input type="hidden" class="form-control pickadate" name="hid" id="hid" placeholder="Holiday">
                <div class="row" >  
                    <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                        <fieldset class="form-group">
                            <label for="basicInput">Holiday</label>
                            <input type="text" class="form-control pickadate" name="uholiday" id="uholiday" placeholder="Holiday ">
                        </fieldset>   
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <select name="uground_id" id="uground_id" class="select2 form-control" placeholder="Type">
                                @foreach($grounds as $ground)
                                <option value="{{$ground->id}}">{{$ground->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{csrf_field()}} 
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Details</label>
                            <textarea name="udetails" id="udetails" rows="10" class="form-control" placeholder="Holiday Purpose"></textarea>
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
            </div>   
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
<!-- *****************************delete model**********************************-->
<div class="modal fade delHolidayMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Holiday</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delhid">                                        
        <div class="modal-body">
            Are You Sure You want to delete the Holiday of <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delccat" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
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
                        <form method="get" action="{{route('report.holidayPrint')}}" target="_blank">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">From Date</label>
                                    <input type="text" class="form-control pickadate" id="fromdate" name="from" placeholder="From Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">To Date</label>
                                    <input type="text" class="form-control pickadate" id="todate" name="to" placeholder="To Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1"  style="padding-top: 18px;">
                                <fieldset class="form-group" style="margin-bottom: 0px;">    
                                    <button type="submit" class=" btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                                        <i class="feather icon-printer"></i> Print
                                    </button>
                                </fieldset>               
                            </div>
                        </div>
                    </form>
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
                            <p class="mb-0">Total Holidays</p>
                        </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                <div class="avatar bg-rgba-primary p-0">
                            <div class="avatar-content">
                                <i class="feather icon-clipboard text-primary font-medium-5"></i>
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
                        <li class="breadcrumb-item active"> Holidays
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
                            <table id="hdayTbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color: #030079;color: white;">
                                        <th>Holiday</th>
                                        <th>Purpose</th>
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
    $(document).ready(function()
    {
       $('.hld').addClass('active');
       $('.s').addClass('has-sub sidebar-group-active open');
       countHoliday();
    });
    $(function () {
        $('.pickadate').pickadate({
        format: 'yyyy-m-d'
//       ,min: [2019,10,20]
//       ,max: [2019,11,28]
        });
    });
    var table = $('#hdayTbl').DataTable(
    {
        "responsive" : true,"autoWidth"  : false,
//      "ordering": false,"paging" : true,
        "processing" : true,"serverSide": true,
//       "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
        {
            "url":"<?= route('get.holidays') ?>",
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
        {"data":"hldy"},
        {"data":"dtl"},
        {"data":"grnd"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
    "order": [[1, 'desc']]   
});
//***************************************************
$('#fromdate').change(function()
{
    table.ajax.reload( null, false );
    countHoliday();
});
$('#todate').change(function()
{
    table.ajax.reload( null, false );
    countHoliday();
}); 
function countHoliday()
{
    $.ajax({
        type: 'POST',
        url: "{{route('count.holiday')}}",
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
//******************************add*********************************************
$(".addnew").on('click',function(){
    document.getElementById("addHolidayForm").reset();
    $('.addHolidayModel').modal('show');
});
$("#addHolidayForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.holiday')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addHolidayModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addHolidayForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});

//******************************edit*********************************************
$(document).on('click', '.editmdl', function()
{
    $('#hid').val($(this).data('hid'));
    $('#uholiday').val($(this).data('hday'));
    $('#uground_id').val($(this).data('gid'));
    $('#udetails').val($(this).data('hdtl'));
    $('.upHolidayModel').modal('show');
});
$("#upHolidayForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.holiday')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload(null,false);
            $('.upHolidayModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addHolidayForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//*******************************delete***********************************
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delhid').val($(this).data('delhid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delHolidayMdl').modal('show');
});  
$("#delccat").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.holiday')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delhid: $('#delhid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delHolidayMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
});
//*******************************Status***********************************
$(document).on('click', '.changests', function()
{
    console.log($(this).data('hid'));
    $.ajax({
        type: 'POST',
        url: "{{route('sts.holiday')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         hid: $(this).data('hid')
        },
       success: function(data)
       {
            toastr[data.type](data.message);
           table.ajax.reload( null, false ); 
       }
    });  
});
</script>
@stop