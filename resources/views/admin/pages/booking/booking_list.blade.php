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
<div class="modal fade text-left addUserModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form method="post" id="addUserForm" enctype="multipart/form-data">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="name" placeholder="Name">
                            <div class="form-control-position"><i class="feather icon-user"></i></div>
                            <label for="user-floating-icon">Name</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="email-floating-icon" class="form-control" name="phone" placeholder="Email">
                            <div class="form-control-position"><i class="feather icon-mail"></i></div>
                            <label for="email-floating-icon">phone</label>
                        </div>
                    </div>
                    {{csrf_field()}}
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="phone-floating-icon" class="form-control" name="email" placeholder="Phone">
                            <div class="form-control-position"><i class="feather icon-phone"></i></div>
                            <label for="phone-floating-icon">Email</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="password" id="password-floating-icon" class="form-control" name="password" placeholder="Password">
                            <div class="form-control-position"><i class="feather icon-lock"></i></div>
                            <label for="password-floating-icon">Password</label>
                        </div>
                    </div>
                </div>
                <div class="row">  
                    <div class="col-md-3 col-xl-3">
                        <div class="form-group">
                            <label for="exampleInputFile">Featured Image:</label>
                            <div class="controls">
                                <div data-provides="fileupload" class="fileupload fileupload-new">
                                    <div class="fileupload-new thumbnail upimg">
                                        <img alt="" src="{{asset('public/img/empty.png')}}">
                                    </div>
                                    <div class="fileupload-preview fileupload-exists upimg thumbnail"></div>
                                    <div>
                                       <span class="btn btn-sm btn-success btn-file waves-effect waves-light"><span class="fileupload-new">select</span>
                                       <span class="fileupload-exists">Change</span>
                                       <input type="file" name="img" class="default"></span>
                                        <a data-dismiss="fileupload" class="btn btn-sm bg-maroon fileupload-exists btn-danger waves-effect waves-light" href="#">Remove</a>
                                    </div>
                                </div>
                            </div>
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
<div class="modal fade text-left upAminModel"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="upAminForm" enctype="multipart/form-data">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="uname" class="form-control" name="name" placeholder="Name">
                            <div class="form-control-position"><i class="feather icon-user"></i></div>
                            <label for="user-floating-icon">Name</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="uemail" class="form-control" name="email" placeholder="Email">
                            <div class="form-control-position"><i class="feather icon-mail"></i></div>
                            <label for="email-floating-icon">Email</label>
                        </div>
                    </div>
                    {{csrf_field()}}
                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" id="uphone" class="form-control" name="phone" placeholder="Phone">
                            <div class="form-control-position"><i class="feather icon-phone"></i></div>
                            <label for="phone-floating-icon">Phone</label>
                        </div>
                    </div>
                    

                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="password" id="password-floating-icon" class="form-control" name="password" placeholder="Password">
                            <div class="form-control-position"><i class="feather icon-lock"></i></div>
                            <label for="password-floating-icon">Password</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="file" id="image-floating-icon" class="form-control" name="image" placeholder="Image">
                            <div class="form-control-position"><i class="feather icon-image"></i></div>
                            <label for="image-floating-icon">Image</label>
                        </div>
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
                        <li class="breadcrumb-item active">Total Booking
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
                            <table id="bookTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-primary">
                                        <th>Book Date</th>
                                        <th>Name</th>
         
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
       $('.bk').addClass('active');
       $('.b').addClass('has-sub sidebar-group-active open');
    });
    var table = $('#bookTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//      "ordering": false,
//      "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('bookPro') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"date"},
        {"data":"name"},
        {"data":"email"},
        {"data":"phone"},
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
    $('.addbtn').addClass('spinner-border spinner-border-sm');
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
            $('.addUserModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addUserForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
    $('#title').val('');
    $('#body').val('');
});
//******************************edit*********************************************
$(document).on('click', '.editmdl', function()
{
    console.log($(this).data('nm'));

    $('#uname').val($(this).data('nm'));
    document.getElementById("upAminForm").reset();
    $('.upAminModel').modal('show');
});  
    
    
</script>
@stop