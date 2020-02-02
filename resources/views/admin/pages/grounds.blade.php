@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/data-list-view.css')}}">
@stop
@section('content')


<!--***********************************addhour*******************************-->
<div class="modal fade text-left addGroundMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Playground Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="addGroundFrm" enctype="">    
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-xl-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="name" placeholder="Ground Name">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Play Ground</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="phone-floating-icon" class="form-control" name="address" placeholder="Location">
                            <div class="form-control-position"><i class="fa fa-location-arrow"></i></div>
                            <label for="phone-floating-icon">Location</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <textarea id="phone-floating-icon" class="form-control" name="details" placeholder="Details"></textarea>
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="phone-floating-icon">Details</label>
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
<!--*************edit Hour***************-->

<div class="modal fade text-left editMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Ground</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="editFrm" enctype="">  
               <input type="hidden" name="gid" id="gid">  
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-xl-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Ground Name">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Play Ground</label>
                        </div>
                    </div>
                                                    
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="address" class="form-control" name="address"  placeholder="Location">
                            <div class="form-control-position"><i class="fa fa-location-arrow"></i></div>
                            <label for="phone-floating-icon">Location</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <textarea id="details" class="form-control" name="details" placeholder="Details"></textarea>
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="phone-floating-icon">Details</label>
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
                
            </div>
                
           <!--data-dismiss="modal"-->     
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light">
                    Update <span class="upbtn" role="status" aria-hidden="true"></span>  
                </button>
                
            </div>
        </form>
        </div>
    </div>
</div>

<!--****************************-->

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Playground List <a class="addHour" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i>
                                    </a></h4>
                   
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="grndTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Ground Name</th>
                                        <th>Address</th>
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
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>

<script>
    $(document).ready(function()
    {
       $('.grnd').addClass('active');
    });
    var table = $('#grndTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('groundPro') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"gname"},
        {"data":"gadd"},
        {"data":"gdtl"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});

$("#addAminForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save-admin')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addAminModel').modal('hide');
            toastr[data.type](data.message);
            countMethod();
            document.getElementById("addAminForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
    $('#title').val('');
    $('#body').val('');
});

$(document).on('click', '.addHour', function()
{
    document.getElementById("addGroundFrm").reset();
    $('.addGroundMdl').modal('show');
});
//type
$("#addGroundFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.ground')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addGroundMdl').modal('hide');
//            toastr[data.type](data.message);
            document.getElementById("addGroundFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//type  
 $(document).on('click', '.editmdl', function()
{
    document.getElementById("editFrm").reset();
    $('#gid').val($(this).data('gid'));
    $('#name').val($(this).data('name'));
    $('#address').val($(this).data('address'));
    $('#details').val($(this).data('details'));
    $('.editMdl').modal('show');
});   
$("#editFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.ground')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.editMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("editFrm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});   
    
</script>
@stop