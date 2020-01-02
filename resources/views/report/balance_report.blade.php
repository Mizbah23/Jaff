<!DOCTYPE html>
<html>
<head>
<title>Balance Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style >
    
table{
        width: 100%;
        margin: 0 auto;
        border: 1px solid;
        border-collapse: collapse;
    }
th,td{
 border: 1px solid;
 padding-left: 5px;
 font-size: 12px;
}
h4{
        margin-bottom: 5px;
        border: 1px solid;
        border-radius: 10px;
        width: 60%;
        margin: 0 auto;
        font-size: 12px;
    }

img {
  float: left;
  width: 5%;
  height: 5%
}
/*    *{
        padding: 0;
        margin: 0;
        outline: 0;
    }*/
      .page-head {
        text-align: center;
    }
    .page-head h2{
        margin: 0px;
        margin-bottom: 5px;
        font-size: 18px;
    }
    .page-head h3{
        margin-bottom: 5px;
        margin: 0px;
        font-size: 14px;
    }
    .page-head h4{
        margin-bottom: 5px;
        border: 1px solid;
        border-radius: 10px;
        width: 60%;
        margin: 0 auto;
        font-size: 14px;
    }
   .logo-img {
    width: 7%;
    float: left;
    position: absolute;
    height: 50px;
}
.logo-img img{
    width: 120px;
}
		

		.wrapper{
			width: 90%;
			margin: 0 auto;
		}
		.container-main{
			overflow: hidden;
			padding: 5px 0px;
			margin-top: 10px;
		}

		.label-title {
			border-bottom: 1px solid;
		}
		.table-main , .table-main2{
			border: 1px solid;
			width: 100%;
			border-collapse: collapse;
			margin: 20px 0;
                        font-size: 12px;
		}
		.table-main td , .table-main th,.table-main2 td , .table-main2 th{
			border: 1px solid;
		}
		.table-main th,.table-main2 th{
			text-align: left;
		}
		.table-main td,.table-main td{
			padding: 5px;
		}

		.title-head th,.title-head2 th{
			border: none;
		}
                
		.table-main td:last-child, .table-main th:last-child{
			text-align: right;
			padding-right: 10px;
		}
                
                .table-main td:last-child,.table-main td:nth-child(2){
                    border: none;

                }
                .table-main td:nth-child(2), .table-main th:nth-child(3), .table-main th:last-child{
			text-align: right;
			padding-right: 10px;
		}
                
                
                
                
                .table-main2 td:last-child, .table-main2 th:last-child{
			text-align: right;
			padding-right: 10px;
		}
                
                .table-main2 td:last-child,.table-main2 td:nth-child(3){
                    border: none;

                }
                .table-main2 td:nth-child(2), .table-main2 th:nth-child(3), .table-main2 th:last-child{
			text-align: right;
			padding-right: 10px;
		}
                .td-visible{
                    border-bottom: 1px solid !important;
                }
                
                .td-visible-top{
                    border-top: 1px solid !important;
                }
                .td-border-none{
                    border: 0 !important;
                }
                
                
                
                
@media print {
    #printbtn {
        display :  none;
    }
}
@media print {
  a[href]:after {
    content: none !important;
  }
}

		
	</style>
</head>
<body>
     <form>
         <input type = "button" value = "Print" id="printbtn" onclick = "window.print()" />
      </form> 
    <center>
        <!--<a class="brand-logo" href="">-->
        <div style="text-align: center;font-size: 12px" >
          <div>

              <span><h2 style="margin-right: 290px;padding-top: -8px; margin-left: 290px;">Jaff Sports</h2></span></div>
          <div style="margin-top: -10px">Bashundhara Main Gate,
          Opposite of Jamuna Future Park Sidegate,<br>Bashundhara R/A,Dhaka.
          <br>Phone: +8801304229158, Email: info@jaff.com
           @if(isset($month1) && isset($year))
              <h4>Balance Report For The Month of {{$month1}} -{{$year}}</h4>
              @else
              <h4>Balance Report ( {{$from}} To {{$to}})</h4>
          @endif
          <br>
        </div>
        </div>
       <!--</a>--> 
    </center>


	<div class="wrapper">


		<label class="label-title" for="">CASH INFLOW :</label>
                <section class="container-main" style="margin-top: 0px;">
			<table class="table-main">
			<thead>
				<tr >
                                        <th width="40%" style="text-align:center;">Head of Accounts</th>
                                        <th width="20%" style="text-align:center;">Amount in Tk.</th>
                                        <th width="20%" style="text-align:center;">Amount in Tk.</th>
                                        <th width="20%" style="text-align:center;">Amount in Tk.</th>
				</tr>
			</thead>
				<tbody>
<!--                                    <tr>
                                        <td colspan="3" style="height:35px">Opening Balance (Cash In Hand)</td>
                                        <td style="border:1px solid;" >1234tk</td>
				    </tr>-->
                                    @php $total_inflow=0;@endphp
                                    @foreach($income_group as $in_group)
                                        <tr class="title-head ">
                                            <th>{{$in_group->grp_name}}</th>
                                            <th class="td-visible"></th>
                                            <th></th>
                                            <th class="td-visible">{{number_format($in_group->group_total)}}</th>
                                            
					</tr>
                                          @foreach($inflow as $infl)
                                             @if($in_group->grpid==$infl->grpid)
                                             <tr class="title-head">
                                                <td >{{$infl->acc_name}} </td>
                                                 <td class="td-visible"></td>
                                                <td>{{number_format($infl->amount)}}</td>
                                                  @php $total_inflow=$total_inflow+$infl->amount;@endphp
                                                <td class="td-visible td-visible-top"></td>
                                             </tr>
                                            @endif

                                         @endforeach  
                                    @endforeach
                                        <tr class="title-head ">
                                            <th class="td-visible">Course Payment</th>
                                            <th class="td-visible"></th>
                                            <th class="td-visible"></th>
                                            <th class="td-visible">{{number_format($cpay)}}</th>
					</tr>
             
                                        <tr class="title-head ">
                                            <th class="td-visible">Membership Payment</th>
                                            <th class="td-visible"></th>
                                            <th class="td-visible"></th>
                                            <th class="td-visible">{{number_format($mpay)}}</th>
					</tr>
                          
                                        <tr class="title-head ">
                                            <th class="td-visible">Slot Booking Payment</th>
                                            <th class="td-visible"></th>
                                            <th class="td-visible"></th>
                                            <th class="td-visible">{{number_format($bpay)}}</th>
					</tr>
                                        @php $total_inflow +=$cpay+$mpay+$bpay;@endphp
                   
                                
                                 
				</tbody>

				
			</table>
                    
 <table class="table-main2">
    <thead>
        <tr class="title-head ">
            <th>Total Cash Inflow</th>
            <th class="td-visible"></th>
            <th></th>
            <th class="td-visible">{{number_format($total_inflow)}}</th>                        
        </tr>
    </thead>
</table>

                    
                    
                    
<label class="label-title" for="">CASH OUTFLOW :</label>
        

@php $total_outflow=0; @endphp
@foreach($all_section as $section)

          
<table class="table-main2">
    
    <thead>
        <tr>
            <th colspan="2" style="text-align:right; border-right: none;">{{$section->sec_name}}</th>
            <th style="border-left: none; border-right: none"></th>
            <th style="border-left: none; text-align:right;">{{$section->sectotal}}</th>
            @php $total_outflow=$total_outflow+$section->sectotal;@endphp
        </tr>
    </thead>
    <tbody>
 
     @foreach($all_group as $group)
     @if($group->secid==$section->secid)
          
        <tr class="title-head2">
            <th width='40%'>{{$group->grp_name}}</th>
            <th width='20%'></th>
            <th width='20%'>{{number_format($group->group_total)}}</th>
            <th width='20%'></th>
        </tr>
        @foreach($all_account as $account)
            @if($account->grpid==$group->grpid)
        <tr class="title-head2">
            <td>{{$account->acc_name}} </td>
           
            <td>{{number_format($account->amount)}}</td>
            <td></td>
            <td></td>
        </tr>
        @endif

     @endforeach  
     @endif
     @endforeach
       

       </tbody>

</table>
 
@endforeach
 

<table class="table-main2">
    <thead>
        <tr class="title-head ">
            <th>Total Cash Outflow</th>
            <th class="td-visible"></th>
            <th></th>
            <th class="td-visible">{{number_format($total_outflow)}}</th>                        
        </tr>
    </thead>
</table>


		</section>
                
                
                    <div class="row page-head">
        @if(isset($month1) && isset($year))
        <h4>Total Balance of {{$month1}} -{{$year}} - ({{$total_inflow-$total_outflow}} &#2547; ) </h4>
        @else
        <h4>Total Balance of ({{$from}} To {{$to}}) - ({{$total_inflow-$total_outflow}} &#2547; ) </h4>
        @endif
        
       
    </div>
                
                
                
                
                
	</div>
</body>
</html>