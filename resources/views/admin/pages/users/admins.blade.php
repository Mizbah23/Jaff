@extends('admin.master')
@section('title'){{$title}}@stop

@section('link')
   <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
   <link href="{{asset('public/css/back/bootstrap-fileupload.css')}}" rel="stylesheet" />

@stop
@section('content')

<style>
    .upimg{
        border: 1px solid gray;
        border-radius: 10px;
        width:180px; 
        height: 130px; 
        line-height: 20px;
    }

    .menuselect {
        padding-left: 7px;
        padding-top: 4px;
        border: 1px solid #CCCCCC;
        border-radius:4px; padding-bottom: 31px;
    }

</style>

<!-- *****************************add model**********************************-->
<div class="modal fade text-left addAminModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            
                <div class="modal-body" style="padding-top: 23px;">
                     <form method="post" id="addAminForm"  enctype="multipart/form-data">   
                <div class="row">
                    <div class="col-md-6 col-xl-6">
               
                 
                        
                <div class="form-group">
                     <label for="first-name-icon">Name</label>
                     <input type="text"  class="form-control" name="name" placeholder="Enter Admin Name">
                </div>
                        
                        
                <div class="form-group checkmail">
                    <label for="first-name-icon">Email </label><span> 
                     <input type="text"  class="form-control emark" id="checkmail" name="email" placeholder="Enter Email Address">
                    <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                </div>
                        
                        
                <div class="form-group checkphn">
                     <label for="first-name-icon">Phone</label><span class="etxt" style="color:red"></span>
                     <input type="number" class="form-control emark" name="phone" id="checkphn" placeholder="Enter Admin Phone">
                     <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                </div>
                        
                        
                <div class="form-group">
                     <label for="first-name-icon">Password</label>
                     <input type="password"  class="form-control" name="password" placeholder="Password">
                </div>


                <div class="form-group">
                    <label for="exampleInputFile">Profile Image *</label>
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
                    {{csrf_field()}}
          
            </div> 
                    
                    
                
    <div class="col-md-6 col-xl-6">
        <label>Admin Permission</label>
        <div class="form-group menuselect">
            <fieldset style="float:left; padding-right: 4px;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="wper[]" value="view">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Browse</span>
                </div>
            </fieldset>
            
            <fieldset style="float:left; padding-right: 4px;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="wper[]" value="add">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Add</span>
                </div>
            </fieldset>
            <fieldset style="float:left; padding-right: 4px;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="wper[]" value="up">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Update</span>
                </div>
            </fieldset>
             <fieldset style="float:left;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="wper[]" value="del">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Delete</span>
                </div>
            </fieldset>
        </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox"  class="select_access" value="false" style="float:left">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="" style="float:right;">Select all</span>
                    </div>
                </fieldset>
            </div>
        </div>
        
   </div>
    
    <hr style="margin: 0px;">
    <h6 style="background:#00CFE8">Website Setup</h6>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="user">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Users</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="slider">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Sliders</span>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="prog">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Programs</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="coach">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Coaches</span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    
    
    <hr style="margin: 0px;">
    <h6 style="background:#00CFE8">Administration</h6>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="admin">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span>
                        </span>
                        <span class="">Admin User</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="ground">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Grounds</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="cal">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Calender</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="book">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Bookings</span>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="week">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Weeks</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="slot">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Slots</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="hday">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                            <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Holidays</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="user_access[]" value="ofr">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span><span class="">Offers</span>
                    </div>
                </fieldset>
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

<!-- *****************************edit model**********************************-->
<div class="modal fade text-left upAminModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel130" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h5 class="modal-title" id="myModalLabel130" style="text-align: center;">Update Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            
                <div class="modal-body" style="padding-top: 23px;">
                     <form method="post" id="upAminForm"  enctype="multipart/form-data">   
                         
                <input type="hidden" name="adminid" id="adminid">
                <input type="hidden" name="oldimg" id="oldimg">
                         
                <div class="row">
                    <div class="col-md-6 col-xl-6">
               
                 
                        
                <div class="form-group">
                     <label for="first-name-icon">Name</label>
                     <input type="text"  class="form-control" name="uname" id="uname"  placeholder="Enter Admin Name">
                </div>
                        
                        
                <div class="form-group ucheckmail">
                    <label for="first-name-icon">Email </label><span> 
                     <input type="text"  class="form-control emark" id="ucheckmail" name="uemail" placeholder="Enter Email Address">
                    <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                </div>
                        
                        
                <div class="form-group ucheckphn">
                     <label for="first-name-icon">Phone</label><span class="etxt" style="color:red"></span>
                     <input type="number" class="form-control emark" name="uphone" id="ucheckphn" placeholder="Enter Admin Phone">
                     <div class="valid-feedback evtxt"></div><div class="invalid-feedback eitxt"></div>
                </div>
                        
                <div class="form-group">
                    <label for="exampleInputFile">Profile Image *</label>
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
                    {{csrf_field()}}
          
            </div> 
                    
                    
                
    <div class="col-md-6 col-xl-6">
        <label>Admin Permission</label>
        <div class="form-group menuselect">
            <fieldset style="float:left; padding-right: 4px;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="uwper[]" value="view">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Browse</span>
                </div>
            </fieldset>
            
            <fieldset style="float:left; padding-right: 4px;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="uwper[]" value="add">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Add</span>
                </div>
            </fieldset>
            <fieldset style="float:left; padding-right: 4px;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="uwper[]" value="up">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Update</span>
                </div>
            </fieldset>
             <fieldset style="float:left;">
                <div class="vs-checkbox-con vs-checkbox-info">
                    <input type="checkbox" name="uwper[]" value="del">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                    <span class="" style="float:right;">Delete</span>
                </div>
            </fieldset>
        </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox"  class="uselect_access" value="false" style="float:left">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="" style="float:right;">Select all</span>
                    </div>
                </fieldset>
            </div>
        </div>
        
   </div>
    
    <hr style="margin: 0px;">
    <h6 style="background:#00CFE8">Website Setup</h6>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]"  value="user">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Users</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="slider">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Sliders</span>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="prog">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Programs</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="coach">
                        <span class="vs-checkbox vs-checkbox-sm">
                            <span class="vs-checkbox--check">
                                <i class="vs-icon feather icon-check"></i>
                            </span>
                        </span>
                        <span class="">Coaches</span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    
    
    <hr style="margin: 0px;">
    <h6 style="background:#00CFE8">Administration</h6>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="admin">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span>
                        </span>
                        <span class="">Admin User</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="ground">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Grounds</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="cal">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Calender</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="book">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Bookings</span>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="week">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Weeks</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="slot">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Slots</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="hday">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                            <i class="vs-icon feather icon-check"></i></span></span>
                        <span class="">Holidays</span>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="vs-checkbox-con vs-checkbox-info">
                        <input type="checkbox" name="uuser_access[]" value="ofr">
                        <span class="vs-checkbox vs-checkbox-sm"><span class="vs-checkbox--check">
                        <i class="vs-icon feather icon-check"></i></span></span><span class="">Offers</span>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>       



          </div>
                    
        </div>
        
           <!--data-dismiss="modal"-->     
                
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                <button type="submit" class="btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                    Update <span class="upbtn" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
           
        </div>
    </div>
</div>


<!-- *****************************delete model**********************************-->
<div class="modal fade delMdl" id="animation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel6" aria-modal="true">
    <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" value="" id="delaid">                                        
        <div class="modal-body">
            Are You Sure You want to delete this Admin <span class="ttl" style="color:red;"></span>?
        </div>
        <div class="modal-footer">
            <button type="button" id="delAdmin" class="btn btn-outline-danger  waves-effect waves-light">
                Delete <span class="delbtn" role="status" aria-hidden="true"></span>
            </button>
        </div>
            </div>
        </div>
</div>








<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
<!--                                    <li class="breadcrumb-item"><a href="#">Components</a>
                        </li>-->
                        <li class="breadcrumb-item active">Admin Management
                        </li>
                        
                    </ol>

                    <button type="button" class="addnew btn btn-outline-primary waves-effect waves-light" data-toggle="modal">
                    <i class="feather icon-plus-circle"></i> add User
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard" style="padding-top: 0px;">
                        <div class="table-responsive">
                            <table id="userTbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color: #003366;color:white;">
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
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
<script src="{{asset('public/js/back/datatable.min.js')}}"></script>
<!--<script src="{{asset('public/js/back/dropzone.min.js')}}"></script>-->
<script src="{{asset('public/js/back/dropzone.js')}}"></script>
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
<script>

    $(document).ready(function()
    {
       $('.admn').addClass('active');
        $(document).on('click', '.select_access', function (event) 
        {
            var checked = $(this).prop('checked');
            $(document).find('input[name="user_access[]"]').prop('checked', checked);
        });
        $(document).on('click', '.uselect_access', function (event) 
        {
            var checked = $(this).prop('checked');
            $(document).find('input[name="uuser_access[]"]').prop('checked', checked);
        });
    });
    var table = $('#userTbl').DataTable(
    {
        "responsive" : true,
        "autoWidth"  : false,
//        "ordering": false,
//        "paging" : true,
        "processing" : true,"serverSide": true,
//        "columnDefs": [{ responsivePriority: 1, targets: 0 }],
        "ajax":
            {
                "url":"<?= route('userPro') ?>",
                "dataType":"json",
                "type":"POST",
                "data": function ( d )
                {
                    d._token= $('meta[name="csrf-token"]').attr('content');
                }
            },
        "columns":[
        {"data":"img"},
        {"data":"nm"},
        {"data":"phn"},
        {"data":"eml"},
        {"data":"sts"},
        {"data":"action","searchable":false,"orderable":false}
    ],
        "order": [[1, 'desc']]   
});
//******************************add*********************************************
$(".addnew").on('click',function()
{
    $('.emark').removeClass('is-valid').removeClass('is-invalid');
    $('.eitxt').html('');
    document.getElementById("addAminForm").reset();
    $('.addAminModel').modal('show');
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
            console.log(data);
            table.ajax.reload( null, false );
            $('.addAminModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addAminForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//******************************edit*********************************************
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upAminForm").reset();
    $('#uname').val($(this).data('nm'));
    $('#adminid').val($(this).data('id'));
    $('#oldimg').val($(this).data('img'));
    $('.oldimg').attr("src",$(this).data('img'));
    $('#ucheckmail').val($(this).data('eml'));
    $('#ucheckphn').val($(this).data('phn'));
    $.ajax({type: 'POST',url: "{{route('admin.info')}}",
    data:{_token: $('meta[name="csrf-token"]').attr('content'),aid: $(this).data('id')},
        success: function(data) 
        {
            $('input[name="uwper[]"]').each(function (index, element)
            {
                if(data.wdata.includes($(element).val()))
                {$(element).prop('checked', true);}
            }); 
            $('input[name="uuser_access[]"]').each(function (index, element)
            {
                if(data.mdata.includes($(element).val()))
                {$(element).prop('checked', true);}
            });
            $('.upAminModel').modal('show');
        }
    });
    
});
$("#upAminForm").on('submit',function(event)
{ 
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
        type: 'POST',
        url: "{{route('update.admin')}}",
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upAminModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upAminForm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});





$(document).on('keyup', '#checkmail', function()
{
    check("email",$(this).val(),".checkmail");
}); 
$(document).on('keyup', '#checkphn', function()
{
    check("phone",$(this).val(),".checkphn");
});
$(document).on('keyup', '#ucheckmail', function()
{
    var id = $('#adminid').val();
    check("email",$(this).val(),".ucheckmail",id);
}); 
$(document).on('keyup', '#ucheckphn', function()
{
    var id = $('#adminid').val();
    check("phone",$(this).val(),".ucheckphn",id);
});
function check(key,value,cls,id)
{
    $.ajax({
        type: 'POST',
        url: "{{route('check.admin')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         key: key,
         val: value,
         id:id
        },
       success: function(data)
       {
            if(data.error){
              $(cls).find('.emark').removeClass('is-valid').addClass('is-invalid');
              $(cls).find('.eitxt').html(data.error);
           }else if(data.success){
              $(cls).find('.emark').removeClass('is-invalid').addClass('is-valid');;
              $(cls).find('.evtxt').html(data.success);
           }
       }
    });
}
$(document).on('click', '.csts', function()
{
    $.ajax({
      type: 'POST',url: "{{route('status.admin')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        aid: $(this).data('id'),sts: $(this).data('sts')},
      success: function(data){
      table.ajax.reload( null, false );
      toastr[data.type](data.message);}
    });
});
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delaid').val($(this).data('delaid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 

$("#delAdmin").on('click',function(event)
{ 
    event.preventDefault();
    $('.delbtn').addClass('spinner-border spinner-border-sm');
    $.ajax({
      type: 'POST',
      url: "{{route('delete.admin')}}",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        delaid: $('#delaid').val()
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