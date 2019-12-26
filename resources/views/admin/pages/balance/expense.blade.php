@extends('admin.master')
@section('title')
    {{$title}}
@stop
@section('link')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/pickadate.css')}}">
@stop
@section('content')
<style>
        .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;}
    .avatar .avatar-content {height: 46px;width: 46px;}
</style>
<!-- *****************************add model**********************************-->
<div class="modal fade text-left addModel" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
        <form method="post" id="addForm" enctype="multipart/form-data">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Account</label>
                         <select name="accid" id="accid" class="form-control select2">
                           @foreach($accs as $ac)
                           <option value="{{$ac->accid}}">{{$ac->acc_name}}</option>
                           @endforeach
                         </select>
                        </div>
                    </div>

                    
                    
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Date</label><span> 
                            <input type="text" class="form-control pickadate" name="date" required="" placeholder="Enter Account Name">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Amount</label><span> 
                            <input type="number" class="form-control" name="amount" required="" placeholder="Enter Amount">
                            <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                        </div>
                    </div>
                   
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Details</label>
                         <textarea class="form-control" name="details"></textarea>
                        </div>
                    </div>
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


<!-- *****************************edit model**********************************-->
<div class="modal fade text-left upModel" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Expense</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
        <div class="modal-body" style="padding-top: 23px;">    
        <form method="post" id="upForm" enctype="multipart/form-data">    
            <input type="hidden" name="iid" id="iid">
                <div class="row" >
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Account</label>
                         <select name="uaccid" id="uaccid" class="form-control select2">
                           @foreach($accs as $ac)
                           <option value="{{$ac->accid}}">{{$ac->acc_name}}</option>
                           @endforeach
                         </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Date</label><span> 
                            <input type="text" class="form-control pickadate" name="udate" id="udate" required="" placeholder="Enter Account Name">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Amount</label><span> 
                            <input type="number" class="form-control" name="uamount" id="uamount" required="" placeholder="Enter Amount">
                            <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                        </div>
                    </div>
                   
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Details</label>
                         <textarea class="form-control" id="udetails" name="udetails"></textarea>
                        </div>
                    </div>
                </div>
            </div>
           <!--data-dismiss="modal"-->        
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Update <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>



<div class="modal fade delMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Expense</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
                                               
        <div class="modal-body">
            <form method="post" id="delForm">
                <input type="hidden" value="" name="delid" id="delid"> 
            Are You Sure You want to delete the income of <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="submit" id="delAccount" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
        </form>
            </div>
        </div>
</div>

<!-- *****************************delete model**********************************-->
<section id="basic-input" style="margin-top: -20px;">
    <div class="row">
        <div class="col-xl-8 col-md-8 col-sm-8 col-xs-8">
            <div class="card">
                <div class="card-content">
                    <div class="card-body " style="padding-bottom: 0px;">
                        <form method="get" action="{{route('expense.report')}}" target="_blank">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">From Date</label>
                                    <input type="text" class="form-control pickadate" id="fromdate" name="fromdate" placeholder="From Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">To Date</label>
                                    <input type="text" class="form-control pickadate" id="todate" name="todate" placeholder="To Date">
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
                            <p class="mb-0">Total Expense</p>
                        </div>
                            </div>
                            <div class="col-xl-6 col-md-6 col-12 mb-1">
                                <div class="avatar bg-rgba-warning p-0">
                            <div class="avatar-content">
                                <i class="fa fa-money text-danger font-medium-5"></i>
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
                <div class="card-header" style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"> <span class="badge badge-primary"><b>Expense List</b></span>
                            <a class="addnew" style="padding: 8px;">
                                <i class="ficon feather icon-plus-circle info "></i>
                            </a>
                        </li>
                    </ol>
<!--<button type="button" class="addnew btn btn-outline-primary waves-effect waves-light" data-toggle="modal">
                    <i class="feather icon-plus-circle"></i> add User</button>-->
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard"  style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="incTbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color: #33001a;color: white;">
                                        <th>Date</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Added By</th>
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
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
<script src="{{asset('public/js/back/select2.full.min.js')}}"></script>
<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>
<script src="{{asset('public/js/back/picker.js')}}"></script>
<script src="{{asset('public/js/back/picker.date.js')}}"></script>
<script>
    $(function ()
    {
        $('.pickadate').pickadate({
        format: 'yyyy-m-d'
//       ,min: [2019,10,20]
//       ,max: [2019,11,28]
        });
    });
    $(document).ready(function()
    {
       $('.exp').addClass('active');
       $('.blnc').addClass('has-sub sidebar-group-active open');sumMethod();
    });
    var table = $('#incTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//      "ordering": false,
//      "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('list.expense') ?>",
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
        {"data":"acc"},
        {"data":"amount"},
        {"data":"details"},
        {"data":"created"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
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
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('save.expense')}}",
        data:formData,
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
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
    document.getElementById("upForm").reset();
    $('#iid').val($(this).data('id'));$('#uaccid').val($(this).data('accid'));$('#uaccid').trigger('change');
    $('#udate').val($(this).data('date'));$('#uamount').val($(this).data('amount'));
    $('#udetails').val($(this).data('dtl'));
    $('.upModel').modal('show');
});

$("#upForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('update.expense')}}",
        data:formData,
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upForm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//===============================delete==============================
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delid').val($(this).data('delid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 
$("#delForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('delete.expense')}}",
        data:formData,
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.delMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("delForm").reset();
            $('.delbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//==============================================================
$('#fromdate').change(function()
{
    table.ajax.reload( null, false );
    sumMethod();
});
$('#todate').change(function()
{
    table.ajax.reload( null, false );
    sumMethod();
});
 function sumMethod()
 {
    $.ajax({
        type: 'POST',
        url: "{{route('sum.expense')}}",
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
    
</script>
@stop