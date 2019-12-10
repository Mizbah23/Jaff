@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
<!--   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/data-list-view.css')}}">-->
         <link rel="stylesheet" type="text/css" href="{{asset('public/css/select2.min.css')}}">
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
<div class="modal fade addMdl" id="exampleModalScrollable" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
    <div class="modal-content">
            
    <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
                                                     
    <div class="modal-body" style="padding-top: 23px;">
        <form method="post"  id="addFrm" enctype="multipart/form-data"> 
            <div class="row">  
                <div class="col-sm-6 col-md-12">
                    <div class="form-group">
                        <label for="first-name-icon">News Category</label>
                        <input type="text" name="category" class=" form-control" placeholder="News Category">
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



<div class="modal fade upMdl" id="exampleModalScrollable" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post"  id="upFrm"> 
                    <input type="hidden" name="cid" id="cid">
                    <div class="row">  
                        <div class="col-sm-6 col-md-12">
                            <div class="form-group">
                                <label for="first-name-icon">News Category</label>
                                <input type="text" name="ucategory" id="ucategory" class=" form-control" placeholder="News Category">
                            </div>  
                        </div>
                        {{csrf_field()}}      
                    </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning  waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-success  waves-effect waves-light">Update
                    <span class="addbtn" role="status" aria-hidden="true"></span> 
                </button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade delMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="did">                                        
        <div class="modal-body">
            Are You Sure You want to delete- <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delCategory" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>
<!--*************edit Hour***************-->

<!--****************************-->





<section id="basic-datatable" style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    
                    
                    <h4 class="card-title">
                        <div class="row">
                            <!--<div class="col-md-3 form-group col-sm-6">-->
                                Category List
                                <a class="openAdd" style="padding-left: 8px;">
                                    <i class="ficon feather icon-plus-circle info "></i>
                                </a>

                             
                        </div>
                       
                          
                    </h4>
                    
                    
                </div>
                
                
                
                
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="catTbl" class="table zero-configuration ">
                                <thead>
                                        <tr class="bg-info">
                                        <th>Category</th>
                                        <th>Total News</th>
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
  <script src="{{asset('public/js/select2.full.min.js')}}"></script>

<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>


<script src="{{asset('public/js/back/bootstrap-timepicker.js')}}"></script>



<script>
//    $("#day_id").select2({
//    maximumSelectionLength: 1
//});
    $(document).ready(function()
    {
       $('.nc').addClass('active');
       countslot();
       
    });
    $(function () {
        $('.timepicker').timepicker({
         showInputs: false
       });
     });
    var table = $('#catTbl').DataTable(
    {
        "responsive" : true,"autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":{"url":"<?= route('list.ncat') ?>","dataType":"json",
            "type":"POST","data": function ( d )
            {d._token= $('meta[name="csrf-token"]').attr('content');}},
        "columns":[
        {"data":"cat"},
        {"data":"tpost"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});



//slot saving
$(document).on('click', '.openAdd', function()
{
    document.getElementById("addFrm").reset();
    $('.sClass').removeClass('is-valid');
    $('.eClass').removeClass('is-valid');
    $('.addMdl').modal('show');
    
});   
$("#addFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('save.ncat')}}",
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


$(document).on('change', '#searchday', function()
{countslot();table.ajax.reload( null, false ); });
$(document).on('change', '#searchgrnd', function()
{countslot();table.ajax.reload( null, false ); }); 
$(document).on('change', '#searchtyp', function()
{countslot();table.ajax.reload( null, false ); });
$(document).on('click', '.changests', function()
{
    console.log($(this).data('sid'));
    $.ajax({
        type: 'POST',
        url: "{{route('slot.sts')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         sid: $(this).data('sid')
        },
       success: function(data)
       {
            toastr[data.type](data.message);
           table.ajax.reload( null, false ); 
       }
    });  
});
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upFrm").reset();
    $('#cid').val($(this).data('cid'));
    $('#ucategory').val($(this).data('cat'));
    $('.upMdl').modal('show');
}); 
$("#upFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({type: 'POST',
        url: "{{route('update.ncat')}}",data:new FormData(this),
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
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
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.ncat')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        did: $(this).data('did'),sts: $(this).data('sts')},
      success: function(data){
      table.ajax.reload( null, false );
      toastr[data.type](data.message);}
    });
});
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#did').val($(this).data('did'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 

$("#delCategory").on('click',function(event)
{ 
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.ncat')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        did: $('#did').val()
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