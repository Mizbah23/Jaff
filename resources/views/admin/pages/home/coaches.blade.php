@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
<!--   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/data-list-view.css')}}">-->
 <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/select2.min.css')}}">
   <link rel="stylesheet" href="{{asset('public/css/back/bootstrap-timepicker.css')}}">


@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;} 
</style>

<!--***********************************addhour*******************************-->
<div class="modal fade addCoachMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Coach</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="addCoachFrm" enctype="multipart/form-data"> 
        <div class="row">  
            <!--<div class="col-xl-6">-->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Name</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="name" class="sClass form-control" placeholder="Coach Name">
                               <div class="form-control-position"><i class="fa fa-user-circle-o"></i></div>
                            </div>
                        </div>  
                    </div>
             <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Designation</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="designation" class="sClass form-control" placeholder="Coach Designation">
                               <div class="form-control-position"><i class="fa fa-futbol-o"></i></div>
                            </div>
                        </div>  
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Facebook</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="facebook" class="sClass form-control" placeholder="Facebook link">
                               <div class="form-control-position"><i class="fa fa-facebook-square"></i></div>
                            </div>
                        </div>  
                    </div>          


                        
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Email</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="email" class="sClass form-control" placeholder="example@example.com">
                               <div class="form-control-position"><i class="fa fa-envelope-o"></i></div>
                            </div>
                        </div>  
                    </div>          
                        
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Phone</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="phone" class="sClass form-control" placeholder="Coach Phone Number">
                               <div class="form-control-position"><i class="fa fa-mobile"></i></div>
                            </div>
                    </div>  
            </div>    
                <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                    <label for="first-name-icon">Coach Details:</label>
                    <textarea name="details" id ="details" rows="5" class=" form-control" placeholder="Details"></textarea>
                </div> 
                    </div>
            <div class="col-sm-6 col-md-4">
            <div class="form-group">
                    <label for="exampleInputFile">Coach Image:</label>
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
    </div>
           
                {{csrf_field()}}      

            </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
        <button type="submit" class="btn btn-outline-info  waves-effect waves-light">Save
            <span class="addbtn" role="status" aria-hidden="true"></span> 
        </button>
         </form>
    </div>
   
    </div>
            </div>
</div>



<div class="modal fade upCoachMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Coach</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="upCoachFrm" enctype="multipart/form-data"> 
            <input type="hidden" name="cid" id="cid">
            <input type="hidden" name="oldimg" id="oldimg">
            
            
        <div class="row">  
            <!--<div class="col-xl-6">-->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Name</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="uname" id="uname" class="sClass form-control" placeholder="Coach Name">
                               <div class="form-control-position"><i class="fa fa-user-circle-o"></i></div>
                            </div>
                        </div>  
                    </div>
             <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Designation</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="udesignation" id="udesignation" class="sClass form-control" placeholder="Coach Designation">
                               <div class="form-control-position"><i class="fa fa-futbol-o"></i></div>
                            </div>
                        </div>  
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Facebook</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="ufacebook" id="ufacebook" class="sClass form-control" placeholder="Facebook link">
                               <div class="form-control-position"><i class="fa fa-facebook-square"></i></div>
                            </div>
                        </div>  
                    </div>          


                        
            <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Email</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="uemail"  id="uemail" class="sClass form-control" placeholder="example@example.com">
                               <div class="form-control-position"><i class="fa fa-envelope-o"></i></div>
                            </div>
                        </div>  
                    </div>          
                        
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="first-name-icon">Phone</label>
                    <div class="position-relative has-icon-left">
                       <input type="text" name="uphone" id="uphone" class="sClass form-control" placeholder="Coach Phone Number">
                       <div class="form-control-position"><i class="fa fa-mobile"></i></div>
                    </div>
                </div>  
            </div>    
            <div class="col-sm-6 col-md-8">
                <div class="form-group">
                    <label for="first-name-icon">Coach Details:</label>
                    <textarea name="udetails" id="udetails" rows="5" class=" form-control" placeholder="Details"></textarea>
                </div> 
            </div>
            <div class="col-sm-6 col-md-4">
            <div class="form-group">
                    <label for="exampleInputFile">Coach Image:</label>
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
    </div>
           
                {{csrf_field()}}      

            </div>
    </div>
    <div class="modal-footer">
        <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
        <button type="submit" class="btn btn-outline-info  waves-effect waves-light">Update
            <span class="upbtn" role="status" aria-hidden="true"></span> 
        </button>
         </form>
    </div>
   
    </div>
            </div>
</div>


<!--*************edit Hour***************-->
<div class="modal fade delCoachMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Program</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="text" value="" id="delcid">                                        
        <div class="modal-body">
            Are You Sure You want to delete <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delcoach" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>



<section id="basic-datatable" style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    
                    <h4 class="card-title">
                        <div class="row">
                            <!--<div class="col-md-3 form-group col-sm-6">-->
                                Academy Coaches List
                                <a class="addProg" style="padding-left: 8px;">
                                    <i class="ficon feather icon-plus-circle info "></i>
                                </a>

                             
                        </div>
                       
                          
                    </h4>
                    
                    
                </div>
                
                
                
                
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="coachTbl" class="table zero-configuration ">
                                <thead>
                                        <tr style="background-color: #8cb3d9;color:white;">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Contact</th>
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


<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
 


<script src="{{asset('public/js/back/select2.full.min.js')}}"></script>
<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>
<script src="{{asset('public/js/back/bootstrap-timepicker.js')}}"></script>



<script>
    $(document).ready(function()
    {
       $('.co').addClass('active');
       countslot();
       
    });
    $(function () {
        $('.timepicker').timepicker({
         showInputs: false
       });
     });
    var table = $('#coachTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('list.coach') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');          
                }
            },
        "columns":[
        {"data":"image"},
        {"data":"name"},
        {"data":"designation"},
        {"data":"contact"},
        {"data":"details"},
        {"data":"status"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});

$(document).on('click', '.addProg', function()
{
    document.getElementById("addCoachFrm").reset();
    $('.addCoachMdl').modal('show');
});   
$("#addCoachFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm disabled');
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{route('save.coach')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            $('.addCoachMdl').modal('hide');
            table.ajax.reload( null, false );toastr[data.type](data.message);
            document.getElementById("addCoachFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm disabled');
        }
    });
});   
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upCoachFrm").reset();
    $('#cid').val($(this).data('cid'));
    $('#uname').val($(this).data('uname'));
    $('#udesignation').val($(this).data('udesignation'));
    $('#utitle').val($(this).data('utitle'));
    $('#oldimg').val($(this).data('uimage'));
    $('.oldimg').attr('src',$(this).data('uimage'));
    $('#uemail').val($(this).data('uemail'));
    $('#uphone').val($(this).data('uphone'));
    $('#ufacebook').val($(this).data('ufacebook'));
    $('#utitle').val($(this).data('utitle'));
    $('#udetails').val($(this).data('udetails'));
    $('.upCoachMdl').modal('show');
}); 
$("#upCoachFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: "{{route('update.coach')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false);
            $('.upCoachMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upCoachFrm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.coach')}}",
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
    $('.delbtn').removeClass('spinner-border spinner-border-sm disabled');
    $('#delcid').val($(this).data('delcid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delCoachMdl').modal('show');
});  
$("#delcoach").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm disabled');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.coach')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delcid: $('#delcid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delCoachMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
}); 






</script>
@stop