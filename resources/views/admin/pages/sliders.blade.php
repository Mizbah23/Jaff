@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/dropzone.css')}}">
@stop
@section('content')
<style>
    .dropzone {
    min-height: 190px;
    border: 2px dashed rgba(0, 0, 0, 0.3);
    background: white;
    padding: 20px 20px;}
    .dropzone .dz-preview{
        margin: 0px;
    }
.dz-preview .dz-image img{
  width: 100% !important;
  height: 100% !important;
  object-fit: cover;
}
    .upimg{
            border: 1px solid gray;
            border-radius: 10px;
            width:180px; 
            height: 130px; 
            line-height: 20px;
        }
</style>




<!-- *****************************add model**********************************-->
<div class="modal fade addSliderModel" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white text-center">
                <h5 class="modal-title text-center" id="exampleModalScrollableTitle">Add Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="addSliderForm" enctype="multipart/form-data">    
                <div class="row" >  
                    <div class="col-md-12 col-xl-12"> 
                        <div class="form-group">
                        <label for="first-name-icon">Title</label>
                            <div class="position-relative has-icon-left">
                                 <input type="text" id="title" class="form-control" name="title" placeholder="Slider Title">
                                <div class="form-control-position">
                                    <i class="feather icon-edit"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{csrf_field()}}
                    <div class="col-md-12 col-xl-12"> 
                        <div class="form-group">
                            <label for="first-name-icon">Slider Image *</label>
                            <label><code>Image dimension should be within 5000X3000</code></label>
                            <div class="dropzone" id="addDrop"></div>
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








<div class="modal fade upSliderModel" id="exampleModalScrollable2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white text-center">
                <h5 class="modal-title text-center" id="exampleModalScrollableTitle">Update Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 23px;">
                <form method="post" id="upSliderForm" enctype="multipart/form-data"> 
                    <input type="hidden" id="slider_id" class="form-control" name="slider_id" placeholder="Slider Title">
                    <input type="hidden" id="old_img" class="form-control" name="old_img" placeholder="Slider Title">
                <div class="row" >  
                    <div class="col-md-12 col-xl-12"> 
                        <div class="form-group">
                        <label for="first-name-icon">Title</label>
                            <div class="position-relative has-icon-left">
                                 <input type="text" id="utitle" class="form-control" name="utitle" placeholder="Slider Title">
                                <div class="form-control-position">
                                    <i class="feather icon-edit"></i>
                                </div>
                            </div>
                        </div>
                    </div> 
                    {{csrf_field()}}
                    <div class="col-md-12 col-xl-12"> 
       
                <div class="form-group">
                    <label for="exampleInputFile">Slider Image:</label><br>
                    <label><code>Image dimension should be within 5000X3000</code></label>
                    <br>
                    <div class="controls">
                        <div data-provides="fileupload" class="fileupload fileupload-new">
                            <div  class="fileupload-new thumbnail upimg">
                                <img alt="" class="old_img" src="">
                            </div>
                            <div  class="fileupload-preview fileupload-exists upimg thumbnail"></div>
                            <div>
                               <span class="btn btn-sm btn-success btn-file"><span class="fileupload-new">select</span>
                               <span class="fileupload-exists">Change</span>
                               <input type="file" name="uslider_img" class="default"></span>
                                <a data-dismiss="fileupload" class="btn btn-sm bg-maroon fileupload-exists btn-danger" href="#">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
       
                    </div>
                </div>
            </div>   
            <div class="modal-footer" style="padding-bottom: 0px;">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                    Update <span class="upbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- *****************************edit model**********************************-->
<div class="modal fade delSliderMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Slider</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delsid">                                        
        <div class="modal-body">
            Are You Sure You want to delete the Slider <span class="" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delslider" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>





<section id="basic-carousel">
                    <div class="row">
<!--                        <div class="col-12 mt-1 mb-1">
                            <div class="alert alert-info">
                                <p> <i class="feather icon-info mr-1 align-middle"></i> Nested carousels are not supported.</p>
                            </div>
                        </div>-->
                    </div>
                    <div class="row">
                        
                        
                        <div class="col-md-4 col-sm-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Slider Preview</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @php $i=0;@endphp
                                                @foreach($sliders as $sl)
                                                <li data-target="#carousel-example-caption" data-slide-to="{{$i}}" class="@php echo($i==1)?'active':''; @endphp"></li>
                                                @php $i++;@endphp
                                                @endforeach
<!--                                                <li data-target="#carousel-example-caption" data-slide-to="0" class=""></li>
                                                <li data-target="#carousel-example-caption" data-slide-to="1" class="active"></li>
                                                <li data-target="#carousel-example-caption" data-slide-to="2" class=""></li>-->
                                            </ol>
                                            <div class="carousel-inner" role="listbox">
                                            @php $j=0;@endphp
                                            @foreach($sliders as $sl)    
                                                <div class="carousel-item @php echo($j==1)?'active':''; @endphp">
                                                    <img class="img-fluid" src="{{asset($sl->slider_img)}}" alt="First slide">
                                                    <div class="carousel-caption">
                                                        <h3>Jaff</h3>
                                                        <p>{{$sl->title}}</p>
                                                    </div>
                                                </div>
                                            @php $j++;@endphp
                                            @endforeach
<!--                                                <div class="carousel-item active">
                                                    <img class="img-fluid" src="{{asset('public/img/slider/slider2.jpg')}}" alt="Second slide">
                                                    <div class="carousel-caption">
                                                        <h3>Jaff</h3>
                                                        <p>Tart macaroon marzipan I love soufflé apple pie wafer. Chocolate bar jelly caramels jujubes
                                                            chocolate cake gummies. Cupcake cake I love cake danish carrot cake.</p>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <img class="img-fluid" src="{{asset('public/img/slider/slider1.jpg')}}" alt="Third slide">
                                                    <div class="carousel-caption">
                                                        <h3>Jaff</h3>
                                                        <p>Pudding sweet pie gummies. Chocolate bar sweet tiramisu cheesecake chocolate cotton candy pastry
                                                            muffin. Marshmallow cake powder icing.</p>
                                                    </div>
                                                </div>-->
                                            </div>
                                            <a class="carousel-control-prev" href="#carousel-example-caption" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carousel-example-caption" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="col-8">
            <div class="card">
     <div class="card-header" style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
<!--                                    <li class="breadcrumb-item"><a href="#">Components</a>
                        </li>-->
                        <li class="breadcrumb-item active">Slider Management
                        </li>
                        
                    </ol>

                    <button type="button" class="btn btn-sm btn-info waves-effect waves-light" data-toggle="modal" data-target="#exampleModalScrollable">
                    add new
                </button>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="sliderTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-primary">
                                        <th>Title</th>
                                        <!--<th>Sub-Title</th>-->
                                        <th>Image</th>
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















<!-- *****************************delete model**********************************-->









<!--<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Management</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table id="sliderTbl" class="table zero-configuration ">
                                <thead>
                                    <tr class="bg-gradient-primary">
                                        <th>Title</th>
                                        <th>Sub-Title</th>
                                        <th>Image</th>
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
</section>-->



@stop
@section('script')
<script src="{{asset('public/js/back/datatables.min.js')}}"></script>
<script src="{{asset('public/js/back/datatables.bootstrap4.min.js')}}"></script>

<script src="{{asset('public/js/back/datatable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
<script src="{{asset('public/js/back/dropzone.js')}}"></script>
<script>
    $(document).ready(function()
    {
       $('.sldr').addClass('active');
    });
    var table = $('#sliderTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//        "ordering": false,
//        "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('slidePro') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"title"},
//        {"data":"sub"},
        {"data":"img"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});
Dropzone.autoDiscover = false;


var Dropzone1 = new Dropzone(
    '#addDrop',{
    autoProcessQueue : false,
    addRemoveLinks : true,
    uploadMultiple : false,
    paramName: "slider_img",
    maxFiles : 1,
    url : "{{route('save.slider')}}",
    init : function () 
    {
        var myDropzone = this;
        $("#addSliderForm").submit(function (e) 
        {
            e.preventDefault();
            myDropzone.processQueue();
        });
        this.on('sending', function(file, xhr, formData)
        {
            var data = $('#addSliderForm').serializeArray();
            $.each(data, function(key, el)
            {
             if(data.errors){
             alert('The image width must be greater than 5000');
             location.reload();
             }else
                formData.append(el.name, el.value);
            });
        });
        this.on("success", function(file, responseText)
        {
            $('.addSliderModel').modal('hide');
            document.getElementById("addSliderForm").reset();
            myDropzone.removeAllFiles(true);
            console.log(responseText);
//          toastr[responseText.type](responseText.message);
            table.ajax.reload( null, false );
        });
        myDropzone.on("maxfilesexceeded", function(file) {
        myDropzone.removeFile(file);
        });

    }
}); 


$(document).on('click', '.editmdl', function()
{
    document.getElementById("upSliderForm").reset();
    $('#slider_id').val($(this).data('sid'));
    $('#utitle').val($(this).data('title'));
    $('#old_img').val($(this).data('img'));
    $('.old_img').attr('src',$(this).data('img'));
    $('.upSliderModel').modal('show');

});  
$("#upSliderForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.slider')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            if(data.errors){
             alert('The image width must be greater than 5000');
             // location.reload();
            }else
            table.ajax.reload( null, false );
            $('.upSliderModel').modal('hide');
            toastr[data.type](data.message);
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
            document.getElementById("upSliderForm").reset();
        }
    });
});

$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.slider')}}",
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
    $('#delsid').val($(this).data('delsid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delSliderMdl').modal('show');
});  
$("#delslider").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.slider')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delsid: $('#delsid').val()
      },
      success: function(data){
         table.ajax.reload( null, false );
         $('.delSliderMdl').modal('hide');
         toastr[data.type](data.message);
      }
    });
}); 
    
</script>
@stop