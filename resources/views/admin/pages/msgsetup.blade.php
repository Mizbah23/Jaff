@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')

   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />


@stop
@section('content')
<style>
    .upimg{border: 1px solid gray;border-radius: 10px;width:180px; 
           height: 130px; line-height: 20px;}
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;} 
</style>

<!--***********************************addimage*******************************-->
       <section id="basic-tabs-components">
            <div class="row">
                <div class="col-sm-8">
                    <div class="card overflow-hidden">

                            
                       <div class="card-content">
                                    <div class="card-body">
                                        
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="offer-tab" data-toggle="tab" href="#offer" aria-controls="offer" role="tab" aria-selected="true">Customer SMS Setup</a>
                                            </li>
{{--                                             <li class="nav-item">
                                                <a class="nav-link" id="about-tab" data-toggle="tab" href="#about" aria-controls="about" role="tab" aria-selected="false">Customer Mail Setup</a>
                                            </li> --}}
  
                                        </ul>
                                        <div class="tab-content">
                                            
                                            <div class="tab-pane active" id="offer" aria-labelledby="offer-tab" role="tabpanel">
                                                <div class="row">
                                                <div class="col-sm-4 col-6">
                                                <form method="post" id="addFrm" > 
                                                    <input type="hidden" name="pid" id="pid" value="{{($messages->id)}}">
                                                @csrf
                                                <div>
                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="username" id="username" value="{{($messages->username)}}" placeholder="Username">
                                                <div class="form-control-position">
                                                    <i class="feather icon-phone"></i>
                                                </div>
                                                   
                                                </fieldset>

                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="password" id="password" value="{{($messages->password)}}" placeholder="Password">
                                                <div class="form-control-position">
                                                    <i class="feather icon-unlock"></i>
                                                </div>
                                                    
                                                </fieldset>

                                                <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                <input type="text" class="form-control" name="url" id="url" value="{{($messages->url)}}" placeholder="Url">
                                                <div class="form-control-position">
                                                    <i class="feather icon-link"></i>
                                                </div>
                                                   
                                                </fieldset>
                                                </div>
                                              <div>
                                              
                                              <button type="submit" class="btn btn-outline-info mr-1 mb-1 waves-effect waves-light"> Update 
                                              <span class="addbtn" role="status" aria-hidden="true"></span>
                                              </button>
                                              </div>
                                              </form>
                                      
                                               </div>
                                
                                            </div>
                                            </div>
{{--                                             <div class="tab-pane" id="about" aria-labelledby="about-tab" role="tabpanel">
                                           
                                            <label><code>Please select about us image</code></label>
                                              <div data-provides="fileupload" class="fileupload fileupload-new">
                                                <div  class="fileupload-new thumbnail upimg">
                                                    <img alt="" class="oldabout" src="">
                                                </div>
                                                    <div  class="fileupload-preview fileupload-exists upimg thumbnail"></div>
                                                    <div>
                                                       <span class="btn btn-sm btn-success btn-file"><span class="fileupload-new">Select</span>
                                                       <span class="fileupload-exists">Change</span>
                                                       <input type="file" name="about_image" class="default"></span>
                                                        <a data-dismiss="fileupload" class="btn btn-sm bg-maroon fileupload-exists btn-danger" href="#">Remove</a>
                                                    </div>
                                                </div>
                                            </div> --}}


                                          
                                        </div>
                                    </div>
                                </div>

                                                        </div>
                        </div>
                    </div>
                </section>

        
        

@stop
@section('script')


<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
 




<script>

    $(document).ready(function()
    {
       $('.msgsetting').addClass('active');
       countslot();
       
    });


$(document).on('click', '.addProg', function()
{
    document.getElementById("addFrm").reset();
    $('.sClass').removeClass('is-valid');
    $('.eClass').removeClass('is-valid');
    $('.addProgMdl').modal('show');
    
});   $(document).on('submit', '#addFrm', function(event)
{
    event.preventDefault();
    
});   
$("#addFrm").on('submit',function(event)
{  
 
    console.log()
    // $('.addbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    // formData.append('description', 
    $.ajax({
        type: 'POST',
        url: "{{route('save.msgform')}}",
        data:formData,
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            console.log(data);
            // table.ajax.reload( null, false );
            $('#username').val(data.username);
            $('#password').val(data.password);
            $('#url').val(data.url);
            toastr[data.type](data.message);
            document.getElementById("addFrm").reset();
            location.reload();
            
            // $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});   



// $(document).on('click', '.editmdl', function()
// {
//     document.getElementById("upProgFrm").reset();
    
//     $('#pid').val($(this).data('pid'));
//     $('#utitle').val($(this).data('utitle'));
//     $('#oldimg').val($(this).data('uimage'));
//     $('.oldimg').attr('src',$(this).data('uimage'));

//     $('#utime').val($(this).data('time'));
//     $('#ulocation').val($(this).data('loc'));
//     $('#uprice').val($(this).data('price'));
//     $('#uauthor').val($(this).data('author'));
//     $('.upProgMdl').modal('show');
// }); 
// $("#upProgFrm").on('submit',function(event)
// {  
//     event.preventDefault();
//     $('.upbtn').addClass('spinner-border spinner-border-sm');
//     var formData = new FormData(this);
   
//     $.ajax({
//         type: 'POST',
//         url: "{{route('update.program')}}",
//         data:formData,
//         dataType:'JSON',
//         contentType: false,
//         cache: false,
//         processData: false,
//         success:function(data)
//         {
//             table.ajax.reload( null, false);
//             $('.upProgMdl').modal('hide');
//             toastr[data.type](data.message);
//             document.getElementById("upProgFrm").reset();
//             $('.upbtn').removeClass('spinner-border spinner-border-sm');
//         }
//     });
// });
// $(document).on('click', '.csts', function()
// {
//     $.ajax({
//       type: 'POST',url: "{{route('status.program')}}",
//       data: {
//         _token: $('meta[name="csrf-token"]').attr('content'),
//         sid: $(this).data('sid'),sts: $(this).data('sts')},
//       success: function(data){
//       table.ajax.reload( null, false );
//       toastr[data.type](data.message);}
//     });
// });    
// $(document).on('click', '.delmdl', function()
// {
//     $('.delbtn').removeClass('spinner-border spinner-border-sm');
//     $('#delpid').val($(this).data('delpid'));
//     $('.ttl').html($(this).data('ttl'));
//     $('.delProgMdl').modal('show');
// });  
// $("#delprog").on('click',function(event)
// { 
//     event.preventDefault();
//     $('.delbtn').addClass('spinner-border spinner-border-sm');
//     $.ajax({
//       type: 'POST',
//       url: "{{route('delete.program')}}",
//       data: {
//         _token: $('meta[name="csrf-token"]').attr('content'),
//         delpid: $('#delpid').val()
//       },
//       success: function(data){
//          table.ajax.reload( null, false );
//          $('.delProgMdl').modal('hide');
//          toastr[data.type](data.message);
//       }
//     });
// }); 






</script>
@stop