@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
</style>

<!-- *****************************add model**********************************-->
<div class="modal fade text-left addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form method="post" id="addForm" enctype="multipart/form-data">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row"> 
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Trainer Name</label>
                             <select class="form-control select2"  name="coach_id">
                                @foreach($coaches as $co)
                                <option value="{{$co->id}}">{{$co->name}}</option>
                                @endforeach
                             </select>
                        </div> 
                    </div>
                     {{csrf_field()}}                              
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Course Title</label>
                              <input type="text" class="form-control" name="title" placeholder="Course Title">
                        </div> 
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <input type="text" class="form-control" name="price" placeholder="Course price">
                        </div> 
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Seats</label>
                              <input type="text" class="form-control" name="seat" placeholder="Total Seats">
                        </div> 
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Batch</label>
                              <input type="text" class="form-control" name="batch" placeholder="Batch name">
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
<div class="modal fade text-left upModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upForm" enctype="multipart/form-data">    
                    <input type="hidden" name="courid" id="courid">
                    <div class="row"> 
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Trainer Name</label>
                             <select class="form-control select2"  name="ucoach_id" id="ucoach_id">
                                @foreach($coaches as $co)
                                <option value="{{$co->id}}">{{$co->name}}</option>
                                @endforeach
                             </select>
                        </div> 
                    </div>
                     {{csrf_field()}}                              
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Course Title</label>
                              <input type="text" class="form-control" name="utitle" id="utitle" placeholder="Course Title">
                        </div> 
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <input type="text" class="form-control" name="uprice" id="uprice" placeholder="Course price">
                        </div> 
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Seats</label>
                              <input type="text" class="form-control" name="useat" id="useat" placeholder="Total Seats">
                        </div> 
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                             <label for="first-name-icon">Batch</label>
                              <input type="text" class="form-control" name="ubatch" id="ubatch" placeholder="Batch name">
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
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- *****************************delete model**********************************-->
<div class="modal fade listModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning white">
                <h5 class="modal-title listTitle" id="exampleModalScrollableTitle">Booked Slots</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Booked date</th>
                                <th scope="col">Slot</th>
                                <th scope="col">Regular Price</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Booked Price</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="slotlist">

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


<div class="modal fade payMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">  
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Slot Booking Payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>                           
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="payFrm" enctype="">
                    <input type="hidden" name="pid" id="pid">
                    <input type="hidden" name="damount" id="damount">
                <div class="row" >  
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Payment Date</label><span> 
                            <input type="text" class="form-control pickadate" name="pdate" id="pdate"  value="{{date('Y-m-d',strtotime(now()))}}" required="" placeholder="Enter Payment Date">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Amount To Pay</label><span> 
                            <input type="text" class="form-control" name="pamount" id="pamount" required="" placeholder="Enter Amount to Pay">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-6 col-6 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Less</label><span> 
                            <input type="text" class="form-control" name="less" id="less" required="" value="0" placeholder="Less pay amount">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-6 col-6 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Due</label><span> 
                            <input type="text" class="form-control" name="due" id="due" value="0" required="" readonly placeholder="">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    
                    <div class="col-md-12 col-12">
                        <div class="form-group checkphn">
                         <label for="first-name-icon">Details</label>
                         <textarea class="form-control" name="pdetails" id="pdetails" name="udetails"></textarea>
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
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Course</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
                                               
        <div class="modal-body">
            <form method="post" id="delForm">
                <input type="hidden" value="" name="delid" id="delid"> 
            Are You Sure You want to delete the Course <span class="ttl" style="color:red;"></span>?
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
                    <li class="breadcrumb-item active"><span class="badge badge-glow badge-info"><b>Academy Course List</b></span>
                        <a class="addnew" style="padding: 4px;">
                            <i class="ficon feather icon-plus-circle info"></i>
                        </a> 
                    </li>
                        
                    </ol>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard"  style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="courTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-primary">
                                        <th>Course Title</th>
                                        <th>Trainer</th>
                                        <th>Course Price</th>
                                        <th>Seats</th>
                                        <th>Admitted</th>
                                        <th>Batch</th>
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
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
<script>
    $(document).ready(function()
    {
       $('.cl').addClass('active');
       $('.cour').addClass('has-sub sidebar-group-active open');
    });
    var table = $('#courTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//      "ordering": false,
//      "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('course.list') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"title"},
        {"data":"coach"},
        {"data":"price"},
        {"data":"seat"},
        {"data":"admit","searchable":false,"orderable":false},
        {"data":"batch"},
        {"data":"details"},
        {"data":"status"},
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
    event.preventDefault();$('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({type: 'POST',url: "{{route('save.course')}}",data:new FormData(this),
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
    $('#courid').val($(this).data('id'));$('#ucoach_id').val($(this).data('coachid'));
    $('#utitle').val($(this).data('title'));$('#uprice').val($(this).data('price'));
    $('#ubatch').val($(this).data('batch'));$('#udetails').val($(this).data('dtl'));
    $('#useat').val($(this).data('seat'));$('.upModel').modal('show');
});  
$("#upForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.course')}}",
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
//=====================================Payment==================================
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
        url: "{{route('delete.course')}}",
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
   
   
   
    
</script>
@stop