@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
            <link rel="stylesheet" type="text/css" href="{{asset('public/css/select2.min.css')}}">
                <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/pickadate.css')}}">
     
@stop
@section('content')
<style>
        .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;}
    .avatar .avatar-content {height: 46px;width: 40px;}
</style>

<!--***********************************addButton*******************************-->

<div class="modal fade text-left addMdl"  role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Assign Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="addFrm"  enctype="multipart/form-data">   
                <div class="row">
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group">
                             <label for="first-name-icon">User</label>
                             <select class="form-control select2"  name="userid">
                                 @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->username}}</option>
                                 @endforeach
                             </select>
                        </div>   
                        <div class="form-group checkmail">
                            <label for="first-name-icon">Membership Package</label><span> 
                             <select class="form-control select2"  name="mid">
                                 @foreach($mp as $m)
                                 <option value="{{$m->id}}">{{$m->name}}</option>
                                 @endforeach
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="first-name-icon">Maximum Slot</label><span> 
                            <input type="number" class="form-control" name="max_slot" >
                        </div>
                        {{csrf_field()}}
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





<!--*************edit Hour***************-->
<div class="modal fade text-left upMdl"  role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Membership</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upFrm" enctype="multipart/form-data">   
                <div class="row">
                    <input type="hidden" name="member_id" id="member_id">
                    <div class="col-md-12 col-xl-12">
                        <div class="form-group">
                             <label for="first-name-icon">User</label>
                             <select class="form-control select2"  name="uuserid" id="uuserid">
                                 @foreach($users as $user)
                                 <option value="{{$user->id}}">{{$user->username}}</option>
                                 @endforeach
                             </select>
                        </div>   
                        <div class="form-group checkmail">
                            <label for="first-name-icon">Membership Package</label><span> 
                             <select class="form-control select2"  name="umid" id="umid">
                                 @foreach($mp as $m)
                                 <option value="{{$m->id}}">{{$m->name}}</option>
                                 @endforeach
                             </select>
                        </div>
                        <div class="form-group">
                            <label for="first-name-icon">Maximum Slot</label><span> 
                            <input type="number" class="form-control" name="umax_slot" id="umax_slot">
                        </div>
                        {{csrf_field()}}
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
<!--**************************************-->

<div class="modal fade text-left renewModel"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Renew Membership for (<span class="unm"></span>)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
               
            <div class="modal-body" style="padding-top: 23px;">
                 <form method="post" id="renewFrm" enctype="multipart/form-data">
                <div class="row" > 
                    <div class="col-md-12 col-xl-12">
                    <input type="hidden" name="newuid" id="newuid">
                    
                    <div class="form-group checkmail">
                            <label for="first-name-icon">Membership Package</label><span> 
                             <select class="form-control select2"  name="newmid" id="newmid">
                                 @foreach($mp as $m)
                                 <option value="{{$m->id}}">{{$m->name}}</option>
                                 @endforeach
                             </select>
                        </div>
                                                    
                    <div class="form-group">
                        <label for="first-name-icon">Maximum Slot</label><span> 
                        <input type="number" class="form-control" name="newmax_slot" id="newmax_slot">
                    </div>
                    {{csrf_field()}}
                    </div>

                </div>
                
            </div>
                
           <!--data-dismiss="modal"-->     
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Save <span class="upbtn" role="status" aria-hidden="true"></span>
                    
                </button>
                
            </div>
        </form>
        </div>
    </div>
</div>
<!--*************Delete Modal***************-->
<div class="modal fade delMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delid">                                        
        <div class="modal-body">
            Are You Sure You want to delete this Member<span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="del" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>

<!-- ---------------------------Payment model------------------------------- -->
<div class="modal fade payMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Membership Payment</h5>
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
                        <label for="first-name-icon">Date</label><span> 
                            <input type="text" class="form-control pickadate" name="pdate" id="pdate"  value="{{date('Y-m-d',strtotime(now()))}}" required="" placeholder="Enter Payment Date">
                        <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                         </div>
                    </div>
                    <div class="col-md-12 col-12 ">
                        <div class="form-group checkacc">
                        <label for="first-name-icon">Amount</label><span> 
                            <input type="text" class="form-control" name="pamount" id="pamount" required="" placeholder="Enter Amount to Pay">
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


<!--************Modal Ends****************-->

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Membership<a class="addButton" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i>
                                    </a></h4>
                   
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="muserTbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color:#1d4ac2;color: white;">
                                        <th>ID</th>
                                        <th>User</th>
                                        <!--<th>Membership</th>-->
                                        <th>Payment</th>
                                        <th>Duration</th>
                                        <!--<th>Start Date</th>-->
                                        <!--<th>Expiry Date</th>-->
                                        <th>Remaining</th>
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
  <script src="{{asset('public/js/select2.full.min.js')}}"></script>

<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>
<script src="{{asset('public/js/back/picker.js')}}"></script>
<script src="{{asset('public/js/back/picker.date.js')}}"></script>

<script>
    $(document).ready(function()
    {
       $('.mem').addClass('active');
       $('.m').addClass('has-sub sidebar-group-active open');
    });
        $(function ()
    {
        $('.pickadate').pickadate({
        format: 'yyyy-m-d'
//       ,min: [2019,10,20]
//       ,max: [2019,11,28]
        });
    });
    var table = $('#muserTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('member.list') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"code"},
        {"data":"user"},
//        {"data":"mship"},
        {"data":"payment"},
        {"data":"duration"},
        
//        {"data":"start_date"},
//        {"data":"end_date"},
        {"data":"remaining","searchable":false,"orderable":false},
        {"data":"status","searchable":false,"orderable":false},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[0, 'asc']]   
});



$(document).on('click', '.addButton', function()
{
    document.getElementById("addFrm").reset();
    $('.addMdl').modal('show');
});
//type
$("#addFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.member')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//type  
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upFrm").reset();
    $('#member_id').val($(this).data('id'));
    $('#uuserid').val($(this).data('uid'));$('#uuserid').trigger('change');
    $('#umid').val($(this).data('mid'));$('#umid').trigger('change');
    $('#umax_slot').val($(this).data('mxslt'));

    $('.upMdl').modal('show');
});
  
$("#upFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.member')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upFrm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});   

$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delid').val($(this).data('delid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 

$("#del").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.member')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delid: $('#delid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
});
$("#discountChange").on('change',function(event)
{  



    
     if ($(this).val() == 1) {
    
    $('#damountDiv').show();
    
   
  } else {
    $('#damountDiv').hide();
 
  }

});   
//Payment modal
$(document).on('click', '.paymdl', function()
{
    $("#pid").val($(this).data('pid'));
    $("#pamount").val($(this).data('amnt'));
    $("#damount").val($(this).data('amnt'));
    $('.payMdl').modal('show');
});
$("#payFrm").on('submit',function(event)
{  
    event.preventDefault();
//    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('pay.membership')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            if(data.type==="success"){
                $('.payMdl').modal('hide');
            }
            toastr[data.type](data.message);
//            document.getElementById("payFrm").reset();
//            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});



$(document).on('click', '.renewmdl', function()
{
    document.getElementById("renewFrm").reset();
    $("#newuid").val($(this).data('uid'));
    $(".unm").html($(this).data('unm')); 
    $('.renewModel').modal('show');
});
$("#renewFrm").on('submit',function(event)
{  
    event.preventDefault();
//    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('renew.member')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            if(data.type==="success"){
                $('.renewModel').modal('hide');
            }
            toastr[data.type](data.message);
//            document.getElementById("payFrm").reset();
//            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});


    
</script>

@stop
