@extends('admin.master')
@section('title')
    {{$title}}
@stop
@section('link')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/datatables.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/back/pickadate.css')}}">
@stop
@section('content')
<style>
    .picker--opened .picker__holder{width: 245px;}
    .mrgn{margin-top: -20px;}
    .avatar .avatar-content {height: 46px;width: 46px;}
</style>
<!-- *****************************add model**********************************-->


<!-- *****************************delete model**********************************-->

<section id="basic-input" style="margin-top: -20px;">
    <div class="row">
        <div class="col-xl-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="card-content">
                    <div class="card-body " style="padding-bottom: 0px;">
                        <form method="get" action="{{route('balance.report')}}" target="_blank">
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">From Date</label>
                                    <input type="text" class="form-control pickadate" name="fromdate" id="fromdate" placeholder="From Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <fieldset class="form-group">
                                    <label for="basicInput">To Date</label>
                                    <input type="text" class="form-control pickadate" name="todate" id="todate" placeholder="To Date">
                                </fieldset>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1"  style="padding-top: 18px;">
                                <fieldset class="form-group" style="margin-bottom: 0px;">    
                                    <button type="submit" class=" btn btn-outline-success mr-1 mb-1 waves-effect waves-light">
                                        <i class="feather icon-printer"></i> Print
                                    </button>
                                </fieldset>               
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 col-md-6 col-xs-6" style="margin-top: 0px;">
            <div class="card">
                <div class="card-content">
                    <div class="card-body " >
                        <div class="row">
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <div>
                            <h2 class="text-bold-700 inCount">0</h2>
                            <p class="mb-0">Total Income</p>
                        </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <div class="avatar bg-rgba-warning p-0">
                            <div class="avatar-content">
                                <i class="fa fa-money text-success font-medium-5"></i>
                            </div>
                        </div>
                            </div>
                            <div class="col-xl-4 col-md-6 col-12 mb-1">
                                <div>
                            <h2 class="text-bold-700 exCount">0</h2>
                            <p class="mb-0">Total Expense</p>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="basic-datatable" style="margin-top: -20px;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header " style="padding-top:3px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active"><span class="badge badge-success"><b>Balance List</b></span>
                           
                        </li>
                    </ol>
<!--<button type="button" class="addnew btn btn-outline-primary waves-effect waves-light" data-toggle="modal">
                    <i class="feather icon-plus-circle"></i> add User</button>-->
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard"  style="padding-top:0px;">
                        <div class="table-responsive">
                            <table id="bltbl" class="table zero-configuration ">
                                <thead>
                                    <tr style="background-color: #33001a;color: white;">
                                        <th>Date</th>
                                        <th>Account</th>
                                        <th>Details</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                     <tbody>
            @php $balance=0;@endphp
            @foreach($balances as $ab)
            <tr>
                <td>{{$ab->date}}</td>
                <td>{{$ab->acc_name}}</td>
                <td>{{$ab->details}}</td>
                @if($ab->type==1)
                   <td>{{$ab->amount}}</td>
                   <td>0.0</td>
                @else
                   <td>0.0</td>
                   <td>{{$ab->amount}}</td>
                   
                @endif
                
                <td>
                    @if($ab->acc_type==0)
                    {{$balance=$balance+$ab->amount}}
                    @else
                      {{$balance=$balance-$ab->amount}}
                    @endif
               
                </td>
         
            </tr>
            @endforeach
        </tbody>
                <tfoot>
            <tr>
                <th colspan="3" style="text-align:left">Total:</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Balance</th>
            </tr>
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
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{asset('public/js/back/bootstrap-fileupload.js')}}"></script>
<script src="{{asset('public/js/back/select2.full.min.js')}}"></script>
<script src="{{asset('public/js/back/form-select2.min.js')}}"></script>
<script src="{{asset('public/js/back/picker.js')}}"></script>
<script src="{{asset('public/js/back/picker.date.js')}}"></script>
<script>
    $(function ()
    {
        $('.pickadate').pickadate({
        format: 'yyyy-m-d'
//       ,min: [2019,10,20]
//       ,max: [2019,11,28]
        });
    });
    $(document).ready(function()
    {
       $('.bl').addClass('active');
       $('.blnc').addClass('has-sub sidebar-group-active open');
      sumMethod();
    });
    
    
    var table = $('#bltbl').DataTable({
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
        
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            credit = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            debit = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
                
            totalcredit = api
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );    
                
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            creditpageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            debitpageTotal = api
            .column( 4, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );
            
            
            
            
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            $( api.column( 3).footer() ).html(
                
                ''+creditpageTotal +' ( '+ credit +')'
            );
    
           $( api.column( 4).footer() ).html(
               ''+debitpageTotal+ '( '+ debit +')'
            );
        
        
            $( api.column( 5).footer() ).html(
                ''+(creditpageTotal-debitpageTotal) +' ( '+ (credit-debit) +' total)'
            );
        }

} );

//******************************add*********************************************
$(".addnew").on('click',function(){
    document.getElementById("addForm").reset();
    $('.addModel').modal('show');
});
$("#addForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.addbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('save.income')}}",
        data:formData,
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.addModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("addForm").reset();
            $('.addbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//******************************edit*********************************************
$(document).on('click', '.editmdl', function()
{
    document.getElementById("upForm").reset();
    $('#iid').val($(this).data('id'));$('#uaccid').val($(this).data('accid'));$('#uaccid').trigger('change');
    $('#udate').val($(this).data('date'));$('#uamount').val($(this).data('amount'));
    $('#udetails').val($(this).data('dtl'));
    $('.upModel').modal('show');
});

$("#upForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('update.income')}}",
        data:formData,
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.upModel').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("upForm").reset();
            $('.upbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//===============================delete==============================
$(document).on('click', '.delmdl', function()
{
    $('.delbtn').removeClass('spinner-border spinner-border-sm');
    $('#delid').val($(this).data('delid'));
    $('.ttl').html($(this).data('ttl'));
    $('.delMdl').modal('show');
}); 
$("#delForm").on('submit',function(event)
{  
    event.preventDefault();
    $('.upbtn').addClass('spinner-border spinner-border-sm');
    var formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    $.ajax({
        type: 'POST',
        url: "{{route('delete.income')}}",
        data:formData,
        dataType:'JSON',contentType: false,
        cache: false,processData: false,
        success:function(data)
        {
            table.ajax.reload( null, false );
            $('.delMdl').modal('hide');
            toastr[data.type](data.message);
            document.getElementById("delForm").reset();
            $('.delbtn').removeClass('spinner-border spinner-border-sm');
        }
    });
});
//=================================================  
$('#fromdate').change(function()
{
    sumMethod();
});
$('#todate').change(function()
{
    sumMethod();
}); 

 function sumMethod()
 {
    $.ajax({
        type: 'POST',
        url: "{{route('sum.balance')}}",
        data: {
         _token: $('meta[name="csrf-token"]').attr('content'),
         from: $('#fromdate').val(),
         to: $('#todate').val()
        },
       success: function(data){
        $('.inCount').html(data.income);
        $('.exCount').html(data.expense);
       }
    });
 }   
</script>
@stop