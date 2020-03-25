@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
@stop
@section('content')
<style>
   .upimg{
        border: 1px solid gray;
        border-radius: 10px;
        width:180px; 
        height: 130px; 
        line-height: 20px;
    }
</style>

<!-- *****************************add model**********************************-->
<div class="modal fade addUserModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white text-center">
                <h5 class="modal-title text-center" id="exampleModalScrollableTitle">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="addUserForm" enctype="multipart/form-data">    
                <div class="row" >  
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text"  class="form-control" name="fname" required placeholder="First Name *">
                            <div class="form-control-position"><i class="feather icon-edit"></i></div>
                            <label for="user-floating-icon">First Name *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text"  class="form-control" name="lname" required  placeholder="Last Name*">
                            <div class="form-control-position"><i class="feather icon-edit-1"></i></div>
                            <label for="user-floating-icon">Last Name *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text"  class="form-control" name="name" required placeholder="User Name *">
                            <div class="form-control-position"><i class="feather icon-user"></i></div>
                            <label for="user-floating-icon">User Name *</label>
                        </div>
                        
                        
                        
                        
                  <div class="form-group">
                    <label for="exampleInputFile">Profile Image *</label>
                    <div class="controls">
                        <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div  class="fileupload-new thumbnail upimg">
                                <img alt="" class="old_img" src="">
                            </div>
                            <div  class="fileupload-preview fileupload-exists upimg thumbnail"></div>
                            <div>
                               <span class="btn btn-sm btn-success btn-file"><span class="fileupload-new">select</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" name="image" class="default"></span>
                                <a data-dismiss="fileupload" class="btn btn-sm bg-maroon fileupload-exists btn-danger" href="#">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                        
                        
                        
                        
                        
                        
                        {{csrf_field()}}
                    </div>   
                    <div class="col-md-6 col-xl-6"> 
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" id="email-floating-icon" class="form-control" name="phone" required placeholder="Phone *">
                            <div class="form-control-position"><i class="feather icon-phone"></i></div>
                            <label for="email-floating-icon">Phone *</label>
                        </div>
                        {{csrf_field()}} 
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="email" required placeholder="Email *">
                            <div class="form-control-position"><i class="feather icon-mail"></i></div>
                            <label for="phone-floating-icon">Email *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <textarea class="form-control" name="address" placeholder="Address of User"></textarea>
                            <div class="form-control-position"><i class="feather icon-map-pin"></i></div>
                            <label for="phone-floating-icon">Address</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="password" required placeholder="Password *">
                            <div class="form-control-position"><i class="feather icon-lock"></i></div>
                            <label for="phone-floating-icon">Password *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="password" required placeholder="Confirm Password *">
                            <div class="form-control-position"><i class="feather icon-lock"></i></div>
                            <label for="phone-floating-icon">Confirm Password</label>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="modal-footer" style="padding-bottom: 0px;">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Save <span class="addbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!--//*********************************************//-->

<div class="modal fade upUserModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white text-center">
                <h5 class="modal-title text-center" id="exampleModalScrollableTitle">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upUserForm" enctype="multipart/form-data">
                    <input type="hidden" id="uid" name="uid">
                    <input type="hidden" name="oldimg" id="oldimg">
                <div class="row" >  
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text"  class="form-control" name="ufname" id="ufname" required placeholder="First Name *">
                            <div class="form-control-position"><i class="feather icon-edit"></i></div>
                            <label for="user-floating-icon">First Name *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text"  class="form-control" name="ulname" id="ulname" required  placeholder="Last Name*">
                            <div class="form-control-position"><i class="feather icon-edit-1"></i></div>
                            <label for="user-floating-icon">Last Name *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text"  class="form-control" name="uname" id="uname" required placeholder="User Name *">
                            <div class="form-control-position"><i class="feather icon-user"></i></div>
                            <label for="user-floating-icon">User Name *</label>
                        </div>
                        <div class="form-group">
                            
                    <label for="exampleInputFile">Profile Image *</label>
                    <div class="controls">
                        <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div  class="fileupload-new thumbnail upimg">
                                <img alt="" class="oldimg" src="">
                            </div>
                            <div  class="fileupload-preview fileupload-exists upimg thumbnail"></div>
                            <div>
                               <span class="btn btn-sm btn-success btn-file"><span class="fileupload-new">select</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" name="uimage" class="default"></span>
                                <a data-dismiss="fileupload" class="btn btn-sm bg-maroon fileupload-exists btn-danger" href="#">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

                        {{csrf_field()}}
                    </div>   
                    <div class="col-md-6 col-xl-6"> 
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" class="form-control" name="uphone" id="uphone" required placeholder="Phone *">
                            <div class="form-control-position"><i class="feather icon-phone"></i></div>
                            <label for="email-floating-icon">Phone *</label>
                        </div>
                        {{csrf_field()}} 
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="uemail" id="uemail" required placeholder="Email *">
                            <div class="form-control-position"><i class="feather icon-mail"></i></div>
                            <label for="phone-floating-icon">Email*</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <textarea class="form-control" name="uaddress" id="uaddress" placeholder="Address of User"></textarea>
                            <div class="form-control-position"><i class="feather icon-map-pin"></i></div>
                            <label for="phone-floating-icon">Address</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="upassword" id="upassword" placeholder="Password *">
                            <div class="form-control-position"><i class="feather icon-lock"></i></div>
                            <label for="phone-floating-icon">Password *</label>
                        </div>
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="password" placeholder="Confirm Password *">
                            <div class="form-control-position"><i class="feather icon-lock"></i></div>
                            <label for="phone-floating-icon">Confirm Password</label>
                        </div>
                    </div>
                </div>
            </div>   
            <div class="modal-footer" style="padding-bottom: 0px;">
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
<div class="modal fade delUserMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="deluid">                                        
        <div class="modal-body">
            Are You Sure You want to delete the user <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delusr" class="btn btn-outline-danger  waves-effect waves-light">
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
<!--                                    <li class="breadcrumb-item"><a href="#">Components</a>
                        </li>-->
                        <li class="breadcrumb-item active">User Management
                        </li>
                        
                    </ol>

                    <button type="button" class="addnew btn btn-outline-primary waves-effect waves-light" data-toggle="modal">
                    <i class="feather icon-plus-circle"></i> add User
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard"  style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="userTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-primary">
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Phone</th>
                                        <th>Email</th>
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
       $('.usr').addClass('active');
    });
    var table = $('#userTbl').DataTable(
    {
        "responsive" : true,"autoWidth"  : false,
//      "ordering": false,
//      "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('get.users') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"name"},
        {"data":"img"},
        {"data":"phone"},
        {"data":"email"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});
//******************************add*********************************************
$(".addnew").on('click',function(){
    document.getElementById("addUserForm").reset();
    $('.addUserModel').modal('show');
});
$("#addUserForm").on('submit',function(event)
{  
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: "{{route('save.users')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upUserModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upUserForm").reset();
//            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});

//******************************edit*********************************************
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upUserForm").reset();
    $('#uid').val($(this).data('id'));
    $('#ufname').val($(this).data('fnm'));
    $('#ulname').val($(this).data('lnm'));
    $('#uname').val($(this).data('nm'));
    $('#uemail').val($(this).data('eml'));
    $('#uphone').val($(this).data('phn'));
    $('#uaddress').val($(this).data('addrs'));
    $('#oldimg').val($(this).data('img'));
    $('.oldimg').attr("src",$(this).data('img'));
    $('.upUserModel').modal('show');

});  
$("#upUserForm").on('submit',function(event)
{  
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: "{{route('update.user')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upUserModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upUserForm").reset();
//            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#deluid').val($(this).data('deluid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delUserMdl').modal('show');
});  
$("#delusr").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.user')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        deluid: $('#deluid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delUserMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
});
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.user')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        uid: $(this).data('id'),sts: $(this).data('sts')},
      success: function(data){
      table.ajax.reload( null, false );
      $('.delUserMdl').modal('hide');
      toastr[data.type](data.message);}
    });
});  
     
</script>
@stop