@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dataTables.checkboxes.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/pickadate.css')}}">
     
@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;} 
    .mrgn{margin-top: -20px;}
    .avatar .avatar-content {height: 46px;width: 46px;}
.picker__table {

    margin-bottom: 0px;
}
   .picker__header {
    padding-top: 10px;
    padding-bottom: 10px;
} 
.picker__table {
    font-size: 10px;
}
.picker {
    top: 68%;
}
</style>

<!--***********************************addNotice*******************************-->

<div class="modal fade text-left addMdl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add New Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
              
            
            <div class="modal-body" style="padding-top: 23px;">
                 <form method="post" id="addFrm" enctype=""> 
                     @csrf
                <div class="row" >  
                    <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                        <fieldset class="form-group">
                            <label for="basicInput">Notice Date</label>
                            <input type="text" class="form-control pickadate" name="notice_date" id="notice_date" placeholder="Notice to be shown">
                        </fieldset>   
                    </div>
                    <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="user-floating-icon" class="form-control" name="headline" placeholder="Headline" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Headline</label>
                        </div>
                    </div>
                    {{csrf_field()}} 
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Details</label>
                            <textarea name="description" id="description" rows="10" class="form-control" placeholder="Describe about notice" style="line-height: 0.8rem;"></textarea>
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

<!--*************edit Notice***************-->

<div class="modal fade upModel" id="editmdl" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="editFrm" enctype="multipart/form-data">    
                    <input type="hidden" class="form-control" name="id" id="id" placeholder="Holiday">
                <div class="row" >  
                    <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                        <fieldset class="form-group">
                            <label for="basicInput">Notice Date</label>
                            <input type="text" class="form-control pickadate" name="notice_date" id="unotice_date" placeholder="Notice to be shown">
                        </fieldset>   
                    </div>
                    <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                        <div class="form-label-group position-relative has-icon-left">
                            <input type="text" id="uheadline" class="form-control" name="headline" placeholder="Headline" autocomplete="off">
                            <div class="form-control-position"><i class="feather icon-file"></i></div>
                            <label for="user-floating-icon">Headline</label>
                        </div>
                    </div>
                    {{csrf_field()}} 
                    <div class="col-md-12 col-12">
                        <div class="form-group">
                            <label for="first-name-icon">Description</label>
                            <textarea name="description" id="udescription" rows="10" class="form-control" placeholder="Holiday Purpose"></textarea>
                        </div>
                    </div>
                    {{csrf_field()}}
                </div>
            </div>   
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
                    <h4 class="card-title">Notice<a class="addButton" style="padding: 4px;">
                                        <i class="ficon feather icon-plus-circle info "></i>
                                    </a></h4>
                   
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="ntcTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-info">
                                        <th>Notice Date</th>
                                        <th>Headline</th>
                                        <th>Description</th>
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
<script src="{{asset('public/js/back/picker.js')}}"></script>
<script src="{{asset('public/js/back/picker.date.js')}}"></script>

<script src="{{asset('public/js/back/datatable.min.js')}}"></script>


<script>
    $(function () {
        $('.pickadate').pickadate({
        format: 'yyyy-m-d'
//       ,min: [2019,10,20]
//       ,max: [2019,11,28]
        });
    });
</script>

<script>
    $(document).ready(function()
    {
       $('.notices').addClass('active');
    });
    var table = $('#ntcTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
        "processing" : true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('notice.list') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"notice_date"},
        {"data":"headline"},
        {"data":"description"},
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
        url: "{{route('save.notice')}}",
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
    $('#unotice_date').val($(this).data('notice_date'));
    $('#uheadline').val($(this).data('headline'));
    $('#udescription').val($(this).data('description'));
    $('#editmdl').modal('show');
});
  
$("#editFrm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.notice')}}",
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
      url: "{{route('delete.notice')}}",
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