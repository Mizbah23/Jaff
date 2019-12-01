@extends('admin.master')
@section('title'){{$title}}@stop
@section('link')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<!--<link rel="stylesheet" href="{{asset('public/js/back/responsive.bootstrap4.min')}}">-->
@stop
@section('content')  
<div class="content-wrapper">
    
         <div class="modal fade addCategoryModel"  id="modal-lg" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Category Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <form method="post" class="addCategoryForm" role="form">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" name="category_name" placeholder="Enter ...">
                      </div>
                      {{csrf_field()}}
                    </div>
                </div>
            </div>   
        
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="sumbit" class="btn btn-primary">Save</button>
            </div>
        </form>       
          </div>
      
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

 
<!--*********************************************************--> 
    <div class="modal fade editCategoryModel"  id="modal-lg" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Category Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <form method="post" class="updateCategoryForm" role="form">
                  <input type="hidden" name="cat_id" id="cat_id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      {{csrf_field()}}
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" id="ucat_name" name="ucat_name" placeholder="Enter ...">
                      </div>
                      {{csrf_field()}}
                    </div>
                </div>
            </div>   
        
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="sumbit" class="btn btn-success">Update</button>
            </div>
        </form>       
          </div>
      
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
    
    <!--*********************************************************--> 
    <div class="modal fade delCategoryModel"  id="modal-lg" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Category Info</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
              <form method="post" class="delCategoryForm" role="form">
                  <input type="hidden" name="delcatid" id="delcatid">
            <div class="modal-body">
                Are You sure want to delete <b><span class="title" style="color:red;"></span></b> ?
            </div>   
        
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-danger delcat">Delete</button>
            </div>
        </form>       
          </div>
      
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
    
    
    
    
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!--<h1 class="m-0 text-dark">Dashboard v2</h1>-->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!--<li class="breadcrumb-item"><a href="#">Home</a></li>-->
              <!--<li class="breadcrumb-item active">Dashboard v2</li>-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->

      <div class="row">
        <div class="col-12">
          

          <div class="card">
             <div class="card-header" style="text-align: center;">
                  <h3 class="card-title" style="float: right;">Category List</h3>
                  <h3 class="card-title" style="float: left; color: white;"><a class="btn btn-primary btn-xs create-modal">Add New</a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="catTable" class="table table-bordered table-hover">
               
               <thead>
                   <tr class="bg-purple">
                      <th>ID</th>
                      <th>Category</th>
                      <th>Has Posts</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
         
            
                </tbody>
 
              </table>
            </div>
            <!-- /.card-body -->
          </div>

</div>
          </div>


        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@stop

@section('script')
<script src="{{asset('public/js/back/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/back/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/js/back/dataTables.responsive.min.js')}}"></script>
<script>
    $(document).ready(function(){
       $('.cmenu').addClass('active'); 
    });
</script>
<script>
   var table = $('#catTable').DataTable(
   {
        "responsive": true,
        "autoWidth"   : false,
        "processing": true,"serverSide": true,
        "ajax":
            {
                "url":"<?= route('getcats') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"id"},
        {"data":"catname"},
        {"data":"tposts","searchable":false,"orderable":false},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[0, 'desc']]   
    });
    
$(document).on('click','.create-modal', function() 
{
    $('.addCategoryModel').modal('show');
});
$(".addCategoryForm").on('submit',function(event)
{  
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: "{{route('save.acategory')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addCategoryModel').modal('hide');
            toastr[data.type](data.message);
        }
    });
    $('#title').val('');
    $('#body').val('');
});   

$(document).on('click','.edit-modal', function() 
{
    $('#ucat_name').val($(this).data('ucatname'));
    $('#cat_id').val($(this).data('catid'));
    $('.editCategoryModel').modal('show');
});
$(".updateCategoryForm").on('submit',function(event)
{  
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: "{{route('up.acategory')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.editCategoryModel').modal('hide');
            toastr[data.type](data.message);
        }
    });
    $('#title').val('');
    $('#body').val('');
}); 
$(document).on('click', '.delete-modal', function()
{
    $('.title').html($(this).data('delcatname'));
    $('#delcatid').val($(this).data('delcatid'));
    $('.delCategoryModel').modal('show');
});
$(".delcat").on('click',function()
{
  $.ajax({
    type: 'POST',
    url: "{{route('del.cat')}}",
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
      delcatid: $('#delcatid').val()
    },
    success: function(data){
       table.ajax.reload( null, false );
       $('.delCategoryModel').modal('hide');
       toastr[data.type](data.message);
    }
  });
});
    
</script>
@stop