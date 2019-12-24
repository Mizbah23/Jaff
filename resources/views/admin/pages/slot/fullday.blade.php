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
                <h5 class="modal-title" id="exampleModalScrollableTitle">Full Day Pick</h5>
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
                    
                    
                    
                    <div class="col-md-6 col-xs-6 ">
                        <fieldset class="form-group">
                            <label for="basicInput">Price</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="Price for all slots">
                        </fieldset>   
                    </div>
                    
                    <div class="col-md-12 col-xs-12">
                        <div class="form-group">
                            <label for="first-name-icon">Playground</label>
                            <select name="ground_id" id="ground_id" class="select2 form-control" placeholder="Type">
                                @foreach($grounds as $ground)
                                <option value="{{$ground->id}}">{{$ground->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                     <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Details</label>
                            <textarea name="details" id="details" rows="5" class="form-control" placeholder="Full Day Details"></textarea>
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
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Update Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upForm" enctype="multipart/form-data">    
                <div class="row" >  
                    <input type="hidden" name="oid" id="oid">
                    <div class="col-md-4 col-xs-4 ">
                        <fieldset class="form-group">
                            <label for="basicInput">Start Date</label>
                            <input type="text" class="form-control pickadate" name="uoffer_start" id="uoffer_start" placeholder="Offer Start date">
                        </fieldset>   
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <fieldset class="form-group">
                            <label for="basicInput">End Date</label>
                            <input type="text" class="form-control pickadate" name="uoffer_end" id="uoffer_end" placeholder="Offer End date">
                        </fieldset>   
                    </div>
                    <div class="col-md-4 col-xs-4">
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
                    <div class="col-md-6 col-xs-6 ">
                        <fieldset class="form-group">
                            <label for="basicInput">Offer Title</label>
                            <input type="text" class="form-control" name="uoffer_title" id="uoffer_title" placeholder="Offer Applicable for the date">
                        </fieldset>   
                    </div>
                    <div class="col-md-6 col-xs-6 ">
                        <fieldset class="form-group">
                            <label for="basicInput">Percentage(%)</label>
                            <input type="number" class="form-control" name="upercentage" id="upercentage" placeholder="Offer Percetage Amount ">
                        </fieldset>   
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Details</label>
                            <textarea name="udetails" id="udetails" rows="10" class="form-control" placeholder="Offer Details"></textarea>
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
<div class="modal fade delModel" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">    
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Offer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" value="" id="delofrid">                                        
            <div class="modal-body">
                Are You Sure You want to delete this Offer <span class="ttl" style="color:red;"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" id="deloffer" class="btn btn-outline-danger  waves-effect waves-light">
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
                        <form method="get" action="{{route('report.fullday')}}" target="_blank">
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
                            <p class="mb-0">Total Days</p>
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
                        <li class="breadcrumb-item active"><b>Full Day Setting</b>
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
                            <table id="fdayTbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color: #3973ac;color: white;">
                                        <th>Pick Date</th>
                                        <th>Price</th>
                                        <th>Details</th>
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
       $('.fday').addClass('active');
       $('.s').addClass('has-sub sidebar-group-active open');
       countOffer();
    });
    $(function () {
        $('.pickadate').pickadate({
        format: 'yyyy-m-d'
//       ,min: [2019,10,20]
//       ,max: [2019,11,28]
        });
    });
    var table = $('#fdayTbl').DataTable(
    {
        "responsive" : true,"autoWidth"  : false,
//      "ordering": false,"paging" : true,
        "processing" : true,"serverSide": true,
//       "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
        {
            "url":"<?= route('list.fday') ?>",
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
        {"data":"price"},
        {"data":"details"},
        {"data":"ground"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
    "order": [[1, 'desc']]   
});
//***************************************************
$('#fromdate').change(function()
{
    table.ajax.reload( null, false );
    countOffer();
});
$('#todate').change(function()
{
    table.ajax.reload( null, false );
    countOffer();
}); 
function countOffer()
{
    $.ajax({
        type: 'POST',
        url: "{{route('count.offer')}}",
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
    document.getElementById("addForm").reset();
    $('.addModel').modal('show');
});
$("#addForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.fday')}}",
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
    $('#oid').val($(this).data('oid'));
    $('#uoffer_start').val($(this).data('ostrt'));
    $('#uoffer_end').val($(this).data('oend'));
    $('#uoffer_title').val($(this).data('ottl'));
    $('#upercentage').val($(this).data('oper'));
    $('#udetails').val($(this).data('odtl'));
    $('#uground_id').val($(this).data('gid'));
    $('.upOfferModel').modal('show');
});
$("#upOfferForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.offer')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload(null,false);
            $('.upOfferModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upOfferForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//*******************************delete***********************************
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delofrid').val($(this).data('delofrid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delOfferMdl').modal('show');
});  
$("#deloffer").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.offer')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delofrid: $('#delofrid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delOfferMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
});
//*******************************Status***********************************
$(document).on('click', '.changests', function()
{
    console.log($(this).data('oid'));
    
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

$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('sts.fday')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        oid: $(this).data('id'),sts: $(this).data('sts')},
      success: function(data){
      table.ajax.reload( null, false );
      toastr[data.type](data.message);}
    });
}); 
</script>
@stop