@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
<!--   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/data-list-view.css')}}">-->
 <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/select2.min.css')}}">
   <link rel="stylesheet" href="{{asset('public/css/back/bootstrap-timepicker.css')}}">
   <!--<script src="{{asset('public/ckeditor/ckeditor.js')}}"></script>-->
   <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;} 
</style>

<!--***********************************addhour*******************************-->
<div class="modal fade addProgMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="addProgFrm" enctype="multipart/form-data"> 
        <div class="row">  
            <!--<div class="col-xl-6">-->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Title</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="title" class="sClass form-control" placeholder="Program Title">
                               <div class="form-control-position"><i class="fa fa-edit"></i></div>
                            </div>
                        </div>  
                    </div>
             <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Location</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="location" class="sClass form-control" placeholder="Program Location">
                               <div class="form-control-position"><i class="fa fa-map-marker"></i></div>
                            </div>
                        </div>  
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Time</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="time" class="sClass form-control" placeholder="Program Time">
                               <div class="form-control-position"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>  
                    </div>          


                        
            <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Author</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="author" class="sClass form-control" placeholder="Author Name">
                               <div class="form-control-position"><i class="fa fa-user-circle"></i></div>
                            </div>
                        </div>  
                    </div>          
                        
            <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="price" class="sClass form-control" placeholder="Program Price">
                               <div class="form-control-position"><i class="fa fa-money"></i></div>
                            </div>
                        </div>  
            </div>    
                <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                    <label for="first-name-icon">Description :</label>
                    <textarea name="description" id ="description"  cols="150" placeholder="Description"></textarea>
                </div> 
                    </div>
            <div class="col-sm-6 col-md-4">
            <div class="form-group">
                    <label for="exampleInputFile">Program Image:</label>
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




<div class="modal fade upProgMdl" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-success">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Update Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="upProgFrm" enctype="multipart/form-data">
            <input type="hidden" name="pid" id="pid"><input type="hidden" name="oldimg" id="oldimg">
        <div class="row">  
            <!--<div class="col-xl-6">-->
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Title</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="utitle" id="utitle" class="sClass form-control" placeholder="Program Title">
                               <div class="form-control-position"><i class="fa fa-edit"></i></div>
                            </div>
                        </div>  
                    </div>
             <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="first-name-icon">Location</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="ulocation" id="ulocation" class="sClass form-control" placeholder="Program Location">
                               <div class="form-control-position"><i class="fa fa-map-marker"></i></div>
                            </div>
                        </div>  
                    </div>
                     <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Time</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="utime" id="utime" class="sClass form-control" placeholder="Program Time">
                               <div class="form-control-position"><i class="fa fa-clock-o"></i></div>
                            </div>
                        </div>  
                    </div>          


                        
            <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Author</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="uauthor" id="uauthor" class="sClass form-control" placeholder="Author Name">
                               <div class="form-control-position"><i class="fa fa-user-circle"></i></div>
                            </div>
                        </div>  
                    </div>          
                        
            <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Price</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="uprice" id="uprice" class="sClass form-control" placeholder="Program Price">
                               <div class="form-control-position"><i class="fa fa-money"></i></div>
                            </div>
                        </div>  
            </div>    
                <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                    <label for="first-name-icon">Description :</label>
                    <textarea name="udescription" id ="udescription" cols="150" placeholder="Description"></textarea>
                </div> 
                    </div>
            <div class="col-sm-6 col-md-4">
            <div class="form-group">
                    <label for="exampleInputFile">Program Image:</label>
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
<div class="modal fade delProgMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Program</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delpid">                                        
        <div class="modal-body">
            Are You Sure You want to delete <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delprog" class="btn btn-outline-danger  waves-effect waves-light">
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
                                Academy programs and clinics List
                                <a class="addProg" style="padding-left: 8px;">
                                    <i class="ficon feather icon-plus-circle info "></i>
                                </a>

                             
                        </div>
                       
                          
                    </h4>
                    
                    
                </div>
                
                
                
                
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="progTbl" class="table zero-configuration ">
                                <thead>
                                        <tr class="bg-info">
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Info</th>
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
    CKEDITOR.replace('description');CKEDITOR.replace('udescription');
    $(document).ready(function()
    {
       $('.prog').addClass('active');
       countslot();
       
    });
    $(function () {
        $('.timepicker').timepicker({
         showInputs: false
       });
     });
    var table = $('#progTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('program.list') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');          
                }
            },
        "columns":[
        {"data":"title"},
        {"data":"img"},
        {"data":"description"},
        {"data":"info"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});

$(document).on('click', '.addProg', function()
{
    document.getElementById("addProgFrm").reset();
    $('.sClass').removeClass('is-valid');
    $('.eClass').removeClass('is-valid');
    $('.addProgMdl').modal('show');
    
});   
$("#addProgFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('description', CKEDITOR.instances['description'].getData());
    $.ajax({
        type: 'POST',
        url: "{{route('save.program')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addProgMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addProgFrm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});   


$(document).on('change', '#searchday', function()
{countslot();table.ajax.reload( null, false ); });
$(document).on('change', '#searchgrnd', function()
{countslot();table.ajax.reload( null, false ); }); 
$(document).on('change', '#searchtyp', function()
{countslot();table.ajax.reload( null, false ); });

$(document).on('click', '.editmdl', function()
{
    document.getElementById("upProgFrm").reset();
    
    $('#pid').val($(this).data('pid'));
    $('#utitle').val($(this).data('utitle'));
    $('#oldimg').val($(this).data('uimage'));
    $('.oldimg').attr('src',$(this).data('uimage'));
    CKEDITOR.instances['udescription'].setData($(this).data('des'));
    $('#utime').val($(this).data('time'));
    $('#ulocation').val($(this).data('loc'));
    $('#uprice').val($(this).data('price'));
    $('#uauthor').val($(this).data('author'));
    $('.upProgMdl').modal('show');
}); 
$("#upProgFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('udescription', CKEDITOR.instances['udescription'].getData());
    $.ajax({
        type: 'POST',
        url: "{{route('update.program')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false);
            $('.upProgMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upProgFrm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.program')}}",
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
    $('#delpid').val($(this).data('delpid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delProgMdl').modal('show');
});  
$("#delprog").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.program')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delpid: $('#delpid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delProgMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
}); 






</script>
@stop