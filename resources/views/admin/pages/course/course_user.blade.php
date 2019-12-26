@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/select2.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/pickadate.css')}}">
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
</style>

<!-- *****************************add model**********************************-->
<div class="modal fade text-left addModel" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Assign Course To User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
              
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="addForm" > 
                <div class="row"> 
                    
                    <input type="hidden" name="cp" id="cp">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Assign User</label>
                            <select class="form-control select2"  name="user_id">
                                @foreach($users as $usr)
                                <option value="{{$usr->id}}">{{$usr->username}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Course Title</label>
                             <select class="form-control select2"  id="course_id" name="course_id">
                                 <option value="" >chose</option>
                                @foreach($courses as $co)
                                <option value="{{$co->id}}">{{$co->title}}</option>
                                @endforeach
                             </select>
                        </div> 
                    </div>
                     {{csrf_field()}}                              
                    
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Course price" readonly="">
                        </div> 
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Discount(%)</label>
                             <input type="text" class="form-control" name="discount" value="0" id="discount" placeholder="course discount">
                        </div> 
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
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
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Assigned Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
              
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upForm" > 
                <div class="row"> 
                    
                    <input type="hidden" name="ucp" id="ucp">
                    <input type="hidden" name="assign_id" id="assign_id">
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Assign User</label>
                            <select class="form-control select2" name="uuser_id" id="uuser_id"  >
                                @foreach($users as $usr)
                                <option value="{{$usr->id}}">{{$usr->username}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Course Title</label>
                             <select class="form-control select2"  id="ucourse_id" name="ucourse_id">
                                 <option value="" >chose</option>
                                @foreach($courses as $co)
                                <option value="{{$co->id}}">{{$co->title}}</option>
                                @endforeach
                             </select>
                        </div> 
                    </div>
                     {{csrf_field()}}                              
                    
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <input type="text" class="form-control" name="uprice" id="uprice" placeholder="Course price" readonly="">
                        </div> 
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Discount(%)</label>
                             <input type="text" class="form-control" name="udiscount"  id="udiscount" placeholder="course discount">
                        </div> 
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Details</label>
                              <textarea class="form-control" name="udetails" id="udetails"></textarea>
                        </div> 
                    </div>
                </div>
               
            </div>
           <!--data-dismiss="modal"-->        
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                    update <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- *****************************Payment model**********************************-->


<div class="modal fade payMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">  
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Course Admission Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>                           
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="payFrm" enctype="">
                    <input type="hidden" name="aid" id="aid">
                    <input type="hidden" name="topay" id="topay">
                <div class="row" >  
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Payment Date</label><span> 
                            <input type="text" class="form-control pickadate" name="pdate" id="pdate"  value="{{date('Y-m-d',strtotime(now()))}}" required="" placeholder="Enter Payment Date">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-6 col-6 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Due Amount</label><span> 
                            <input type="text" class="form-control" name="due" id="due" readonly placeholder="">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-6 col-6 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Pay Amount</label><span> 
                            <input type="text" class="form-control" name="amount" id="amount" required="" value="0" placeholder="Enter Amount to Pay">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Details</label>
                         <textarea class="form-control" name="pdetails" id="pdetails" ></textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Payment <span class="addbtn" role="status" aria-hidden="true"></span>
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
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Assigned Course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
                                               
        <div class="modal-body">
            <form method="post" id="delForm">
                <input type="hidden" value="" name="delid" id="delid"> 
            Are You Sure You want to delete the Assigned Course <span class="ttl" style="color:red;"></span>?
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




<section id="basic-datatable" style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
<!--                                    <li class="breadcrumb-item"><a href="#">Components</a>
                        </li>-->
                    <li class="breadcrumb-item active"><span class="badge badge-glow badge-primary"><b>Course Assign List</b></span>
                        <a class="addnew" style="padding: 4px;">
                            <i class="ficon feather icon-plus-circle info"></i>
                        </a> 
                    </li>
                        
                    </ol>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard"  style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="cuTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-primary">
                                        <th>User</th>
                                        <th>Course Info</th>
                                        <th>Payments</th>
                                        <th>Details</th>
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
<script src="{{asset('public/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>
<script src="{{asset('public/js/back/picker.js')}}"></script>
<script src="{{asset('public/js/back/picker.date.js')}}"></script>
<script>
    $(function(){$('.pickadate').pickadate({format: 'yyyy-m-d'});});
    $(document).ready(function()
    {
       $('.cu').addClass('active');
       $('.cour').addClass('has-sub sidebar-group-active open');
    });
    var table = $('#cuTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//      "ordering": false,
//      "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('assign.list') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"user"},
        {"data":"info"},
        {"data":"payment"},
        {"data":"details"},
        {"data":"status"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});
//******************************add*********************************************
$(".addnew").on('click',function(){
//    document.getElementById("addForm").reset();
    $('.addModel').modal('show');
});
$("#addForm").on('submit',function(event)
{  
    event.preventDefault();$('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({type: 'POST',url: "{{route('save.assign')}}",data:new FormData(this),
    dataType:'JSON',contentType: false,cache: false,processData: false,
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
    $('#assign_id').val($(this).data('id'));$('#ucourse_id').val($(this).data('course'));

    $('#uuser_id').val($(this).data('user'));$('#uuser_id').trigger('change');$('#uprice').val($(this).data('price'));
    $('#udetails').val($(this).data('dtl'));$('#udiscount').val($(this).data('dis'));
    $('.upModel').modal('show');
});  
$("#upForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.assign')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//=====================================Extra==================================
$("#course_id").on('change',function()
{
   $.ajax({type: 'POST',url: "{{route('get.cprice')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),
    course_id: $(this).val()},
    success: function(data){$('#price').val(data);$('#cp').val(data);$('#discount').val(0);}});
});
$("#discount").on('keyup',function()
{
    var p = ($('#cp').val()!="")? parseInt($('#cp').val()):0;
    var dis = $(this).val();
    var less = (dis/100)*p;
    var np = p-less;
    $('#price').val(np); 
});
$("#amount").on('keyup',function()
{
    var topay = ($('#topay').val()!="")? parseInt($('#topay').val()):0;
    var due = ($('#due').val()!="")? parseInt($('#due').val()):0;
    var amount = ($('#amount').val()!="")? parseInt($('#amount').val()):0;
    var nd = topay-amount;
    $('#due').val(nd);
    if(amount>topay){
       $('#due').val(topay);  $('#amount').val(0); 
    }
});

$("#ucourse_id").on('change',function()
{
   $.ajax({type: 'POST',url: "{{route('get.cprice')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),
    course_id: $(this).val()},
    success: function(data){$('#uprice').val(data);$('#ucp').val(data);$('#udiscount').val(0);}});
});
$("#udiscount").on('keyup',function()
{
    var p = ($('#ucp').val()!="")? parseInt($('#ucp').val()):0;
    var dis = $(this).val();
    var less = (dis/100)*p;
    var np = p-less;
    $('#uprice').val(np); 
});
//=======================================================================

$(document).on('click', '.csts', function()
{
    $.ajax({type: 'POST',url: "{{route('status.course')}}",
    data: {_token: $('meta[name="csrf-token"]').attr('content'),sid: $(this).data('sid'),sts: $(this).data('sts')},
    success: function(data){table.ajax.reload( null, false );toastr[data.type](data.message);} });
}); 
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delid').val($(this).data('delid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 
$("#delForm").on('submit',function(event)
{  
    event.preventDefault();$('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({type: 'POST',
        url: "{{route('delete.assign')}}",
        data:formData,dataType:'JSON',contentType: false,
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
//=====================================Payment==================================   
$(document).on('click', '.paymdl', function()
{
    document.getElementById("payFrm").reset();
    $("#aid").val($(this).data('aid'));
    $("#topay").val($(this).data('amnt'));
    $("#due").val($(this).data('amnt'));
    $('.payMdl').modal('show');
});
$("#payFrm").on('submit',function(event)
{  
    event.preventDefault();$('.paybtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',url: "{{route('pay.course')}}",
        data:formData,dataType:'JSON',contentType: false,cache: false,
        processData: false,success:function(data)
        {
            table.ajax.reload( null, false );
            if(data.type==="success"){
                $('.payMdl').modal('hide');
            }
            toastr[data.type](data.message);
//            document.getElementById("payFrm").reset();
            $('.paybtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
  
   
    
</script>
@stop