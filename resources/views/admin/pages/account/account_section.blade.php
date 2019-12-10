@extends('admin.master')
@section('title')
    {{$title}}
@stop
@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
@stop
@section('content')
<!-- *****************************add model**********************************-->
<div class="modal fade text-left addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Parent Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form method="post" id="addForm" enctype="multipart/form-data">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Parent Account</label><span> 
                            <input type="text" class="form-control emark" id="checkacc" name="sec_name" required="" placeholder="Enter Parent Account">
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
<div class="modal fade text-left upModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Parent Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form method="post" id="upForm" enctype="multipart/form-data">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row"> 
                    <input type="hidden" class="form-control" name="secid" id="secid">
                    <div class="col-md-12 col-12 ">
                        <div class="form-group ucheckacc">
                        <label for="first-name-icon">Parent Account</label><span> 
                            <input type="text" class="form-control emark" id="ucheckacc" name="usec_name" required="" placeholder="Enter Parent Account">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div> 
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Details</label>
                         <textarea class="form-control" name="udetails" id="udetails"></textarea>
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



<div class="modal fade delMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Parent Account</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delsec">                                        
        <div class="modal-body">
            Are You Sure You want to delete the <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delSection" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>

<!-- *****************************delete model**********************************-->

<section id="basic-datatable" style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><b>Parent Accounts</b>
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
                            <table id="secTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-dark">
                                        <th>Account Name</th>
                                        <th>Details</th>
                                        <!--<th>Created By</th>-->
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
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
<script>
    $(document).ready(function()
    {
       $('.asec').addClass('active');
       $('.acc').addClass('has-sub sidebar-group-active open');
    });
    var table = $('#secTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//      "ordering": false,
//      "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('list.aslist') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"secname"},
        {"data":"details"},
//        {"data":"created"},
        {"data":"sts"},
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
        url: "{{route('save.asec')}}",
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
    console.log($(this).data('secid'));
    $('#secid').val($(this).data('secid'));
    $('#ucheckacc').val($(this).data('secname'));
    $('#udetails').val($(this).data('secdtl'));
    $('.upModel').modal('show');
});  
$("#upForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('update.asec')}}",
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
$(document).on('keyup', '#checkacc', function()
{
    var sec_name = $('#checkacc').val();
    check("sec_name",sec_name,".checkacc");
});
function check(key,value,cls,id)
{
    $.ajax({
        type: 'POST',
        url: "{{route('check.account')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         key: key,
         val: value,
         id:id
        },
       success: function(data)
       {
            if(data.error){
              $(cls).find('.emark').removeClass('is-valid').addClass('is-invalid');
              $(cls).find('.eitxt').html(data.error);
           }else if(data.success){
              $(cls).find('.emark').removeClass('is-invalid').addClass('is-valid');;
              $(cls).find('.evtxt').html(data.success);
           }
       }
    });
}
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.asec')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        sid: $(this).data('sid'),sts: $(this).data('sts')},
      success: function(data){
      table.ajax.reload( null, false );
      toastr[data.type](data.message);}
    });
});
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delsec').val($(this).data('delsec'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 

$("#delSection").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.asec')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delsec: $('#delsec').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
});
   
   
   
   
    
</script>
@stop