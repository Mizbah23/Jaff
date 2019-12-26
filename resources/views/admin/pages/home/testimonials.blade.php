
@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
     <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;} 
</style>

<!--***********************************addButton*******************************-->
<div class="modal fade text-left addMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable " role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Information in Testimonials Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="addFrm" enctype="">    
                <div class="row" >  
                    <div class="col-md-12 col-xl-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="name" placeholder="Name" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Name</label>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="designation" placeholder="Designation/Position" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Designation/Position</label>
                        </div>
                    </div>
                        <div class="col-md-12 col-12">
                          <div class="form-label-group position-relative has-icon-left">
                            <textarea id="phone-floating-icon" class="form-control" name="message" rows="4" placeholder="Message"></textarea>
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="phone-floating-icon">Message</label>
                          </div>
                        </div>
                    {{csrf_field()}}
                   <div class="col-sm-6 col-12">
                     <div class="form-group">
                        <label for="exampleInputFile">Add Image:</label>
                          <div class="controls">
                            <div data-provides="fileupload" class="fileupload fileupload-new ">
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
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="editFrm" enctype="">  
                    <input type="hidden" name="tid" id="tid">
                    <input type="hidden" name="oldimg" id="oldimg">  
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-xl-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="hidden" id="typid" name="typid">
                            <input type="text" id="uname" class="form-control" name="uname" placeholder="Name" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="udesignation" class="form-control" name="udesignation" placeholder="Designation/Position" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Designation/Position</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <textarea id="umessage" class="form-control" name="umessage" rows="4" placeholder="Message"></textarea>
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="phone-floating-icon">Message</label>
                        </div>
                    </div>
            {{csrf_field()}}

            <div class="col-sm-6 col-md-12">
            <div class="form-group">
                    <label for="exampleInputFile">Image:</label>
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

<!--*************Delete Modal***************-->
<div class="modal fade delMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Testimonial</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delid">                                        
        <div class="modal-body">
            Are You Sure You want to delete <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="del" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>

<!--************Modal Ends****************-->

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Testimonials List <a class="addButton" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i>
                                    </a></h4>
                   
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="testmTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Designation/Position</th>
                                        <th>Message</th>
                                        <th>action</th>
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
       $('.testimonials').addClass('active');
    });
    var table = $('#testmTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('testimonials.list') ?>",
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
        {"data":"message"},
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
        url: "{{route('save.testimonial')}}",
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

    document.getElementById("editFrm").reset();
    $('#tid').val($(this).data('tid'));
    $('#uname').val($(this).data('uname'));
    $('#udesignation').val($(this).data('udesignation'));
    $('#umessage').val($(this).data('umessage'));
    $('#oldimg').val($(this).data('uimage'));
    $('.oldimg').attr('src',$(this).data('uimage'));
    $('.editMdl').modal('show');
});
  
$("#editFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.testimonial')}}",
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
      url: "{{route('delete.testimonial')}}",
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
    
</script>
@stop
