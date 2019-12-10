@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
     
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
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Information in Membership Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="addFrm" enctype="">   
            @csrf 
            <div class="modal-body" style="padding-top: 23px;">
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
                            <input type="number" id="user-floating-icon" class="form-control" name="duration" placeholder="Duration(month)" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-clock"></i></div>
                            <label for="user-floating-icon">Duration</label>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Fee</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="fee" class="sClass form-control" placeholder="Fee" autocomplete="off">
                               <div class="form-control-position"><i class="fa fa-money"></i></div>
                            </div>
                        </div>  
                    </div>          

                    <div class="col-sm-6 col-md-4">
                       
                        <div class="form-group">
                            <label for="first-name-icon">Discount Eligibility</label>
                            <select class="form-control" name="discount" id="discountChange" >
                                <option value="">Select Discount</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group" id="damountDiv" style="display:none;">
                            <label for="first-name-icon">Discount Amount(%)</label>
                            <div class="position-relative has-icon-left">
                               <input type="number" name="damount" id="damount" class="sClass form-control" placeholder="Discount Amount(%)" autocomplete="off">
                               <div class="form-control-position"><i class="fa fa-circle"></i></div>
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
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" id="editFrm" enctype="">  
                @csrf
                    <input type="hidden" name="id" id="id">
                      
            <div class="modal-body" style="padding-top: 23px;">
                <div class="row" >  
                    <div class="col-md-12 col-xl-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="hidden" id="typid" name="typid">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Name" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Name</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="number" id="duration" class="form-control" name="duration" placeholder="Duration(month)" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-clock"></i></div>
                            <label for="user-floating-icon">Duration</label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Fee</label>
                            <div class="position-relative has-icon-left">
                               <input type="text" name="fee" id="fee" class="sClass form-control" placeholder="Fee" autocomplete="off">
                               <div class="form-control-position"><i class="fa fa-money"></i></div>
                            </div>
                        </div>  
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="first-name-icon">Discount Eligibility</label>
                            <select class="form-control" name="discount" id="discount">
                                <option value="">Select Eligibility</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group" >
                            <label for="first-name-icon">Discount Amount(%)</label>
                            <div class="position-relative has-icon-left">
                               <input type="number" name="damount" id="dcamount" class="sClass form-control" placeholder="Discount Amount(%)" autocomplete="off">
                               <div class="form-control-position"><i class="fa fa-circle"></i></div>
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
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Program</h5>
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
                    <h4 class="card-title">Membership<a class="addButton" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i>
                                    </a></h4>
                   
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="memTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Name</th>
                                        <th>Duration(month)</th>
                                        <th>Fee</th>
                                        <th>Discountable</th>
                                        <th>Discount Amount(%)</th>
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


<script>
// $(document).on('change', '#discountChange', function()
// {
//   console.log('change');
//   if ($(this).val() == "yes") {
    
//     $('#damountDiv').show();
    
   
//   } else {
//     $('#damountDiv').hide();
 
//   }
// });
    
// $("#discount").change(function() {
//     console.log("check");
//   if ($(this).val() == "yes") {
//     $('#damountDiv').show();
//     $('#damount').attr('required', '');
   
//   } else {
//     $('#damountDiv').hide();
//     $('#otherField').removeAttr('required');
//     // $('#otherField').removeAttr('data-error');
//   }
// });
</script>

<script>
    $(document).ready(function()
    {
       $('.membership').addClass('active');
    });
    var table = $('#memTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('membership.list') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"name"},
        {"data":"duration"},
        {"data":"fee"},
        {"data":"discount"},
        {"data":"damount"},
        {"data":"status"},
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
        url: "{{route('save.membership')}}",
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
    $('#id').val($(this).data('id'));
    $('#name').val($(this).data('name'));
    $('#duration').val($(this).data('duration'));
    $('#fee').val($(this).data('fee'));
    $('#discount').val($(this).data('discount'));
    $('#dcamount').val($(this).data('damount'));
   
    $('.editMdl').modal('show');
});
  
$("#editFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.membership')}}",
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
      url: "{{route('delete.membership')}}",
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
    
</script>

@stop
