

{{-- /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ --}}

<!DOCTYPE html>
<html>
<head>
    <title>Booking Invoice</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
 

table{
        width: 100%;
        margin: 0 auto;
        border: 1px solid;
        border-collapse: collapse;
    }

table.start{
  border: none;
}
table.table1{
        width: 30%;
        margin: 1px;
        border: 1px solid;
        border-collapse: collapse;
}  
table.footer{
  border: none;
}


th.data,td.data{
 border: 1px solid;
 padding-left: 5px;
 text-align: center;
}
h4{
        margin-bottom: 10px;
        border: 1px solid;
        border-radius: 10px;
        width: 60%;
        margin: 0 auto;
        font-size: 14px;
    }

img {
  float: left;
  width: 10%;
  height: 10%
}
@page {
  
  
  header: page-header;
  footer: page-footer;
/*  odd-header-name: html_myHeader1;
  even-header-name: html_myHeader1;*/
  odd-footer-name: html_myFooter1;
  even-footer-name: html_myFooter2;
}
  
/*$mpdf->Image('/img/app-logo.png', 0, 0, 210, 297, 'jpg', '', true, false);
*/
</style>
</head>
<body>

                          <div id="invoice-company-details" class="row">
                            <div class="col-md-6 col-sm-12 text-left pt-1">
                                <div class="media pt-1">
                                    <img src="{{asset('public/img/app-logo.png')}}" alt="Jaff logo" class="logo" />
                                    <span><h1 align="right">Invoice</h1></span>
                                </div>

                            </div>

         <table class="start">
           <thead>
             <tr>
               <th align="left"><h5>Recipient</h5></th>
               <th align="right"><h6>INVOICE NO: {{$bookinfo->book_code}}</h6></td>
             </tr>
           </thead>
           <tbody>
            <tr>     
               <td align="left"><p>{{Auth::guard('web')->user()->first_name}} {{Auth::guard('web')->user()->last_name}}</p></td>
               <td align="right"><h6>INVOICE DATE:{{date( "d.m.Y", strtotime($bookinfo->created_at))}}</h6></td>
            </tr>
            <tr>     
               <td align="left"><p>{!!Auth::guard('web')->user()->address!!}</p></td>
               <td align="right"></td>
            </tr>
            <tr>     
               <td align="left"><p>Mail:{{Auth::guard('web')->user()->email}}<br>Phone:{{Auth::guard('web')->user()->phone}}</p></td>
               <td align="right"><h3>Jaff Sports</h3></td>
            </tr>
            <tr>     
               <td align="left"></td>
               <td align="right"><p>Jaff Street Bashundhara Main Gate,<br>
                                    Opposite  of Jamuna Future Park Sidegate,Dhaka<br>
                                    94203</p></td>
            </tr>
            <tr>     
               <td align="left"></td>
               <td align="right">Mail: info@jaff.com.bd</td>
            </tr>
            <tr>     
               <td align="left"></td>
               <td align="right">Phone: +8801304229158</td>
            </tr>
                        <tr>     
               <td align="left"></td>
               <td align="right"></td>
            </tr>
           </tbody>


         </table>
         <br><br><br>
      <!--/ Invoice Recipient Details -->
  
      <!-- Invoice Items Details -->
                
                    <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="data">#</th>
                        <th class="data">Date</th>
                        <th class="data">Slot</th>
                        <th class="data">Price(Taka)</th>
                        <th class="data">Discount</th>
                        <th class="data">Booked Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $pay=$total_price=$total_discount=0;@endphp 
                    @foreach($bookdetail as $key=>$item)
                      
                    <tr>
                        <td class="data">{{++$key}}</td>
                        <td class="data">{{date( "D,M Y", strtotime($item->created_at))}}</td>
                        <td class="data">{{date( "h:i A", strtotime($item->start))}}-{{date( "h:i A", strtotime($item->end))}}</td>
                        <td class="data">{{number_format($item->price)}}</td>
                        <td class="data"> {{number_format($item->discount)}}</td>
                        <td class="data">{{number_format($item->book_price)}}</td>
                    </tr>
                    @php $pay+=$item->book_price;
                         $total_price+=$item->price;
                         $total_discount+=$item->discount;
                    @endphp
                    @endforeach
                    </tbody>
                    </table>
             
                <br>
    
                  

                    <table class="table1" align="right">
                    <tbody>
                  
                       <tr>
                        <td align="left">
                        <strong>Total Slots</strong>
                        </td>
                        <td align="center">{{$bookdetail->count()}}</td>
                        </tr>
                        <tr>
                        <td align="left">
                        <strong>Price</strong>
                        </td>
                        <td align="center">{{number_format($total_price)}}</td>
                        </tr>
                       <tr>
                        <td align="left">
                        <strong>Discount</strong>
                        </td>
                        <td align="center">{{number_format($total_discount)}}</td>
                        </tr>
                       <tr>
                        <td align="left">
                        <strong>Amount to Pay</strong>
                        </td>
                        <td align="center">
                        <strong>{{number_format($pay)}}</strong>
                        </td>
                       </tr>
                 
                    </tbody>
                    </table>

             
              
   

                        <!-- Invoice Footer -->

                        <!--/ Invoice Footer -->
{{--                         <center><fieldset style="margin-bottom: 0px;">    
                            <button type="submit" class=" btn btn-outline-success mr-1 mb-1 waves-effect waves-light"><i class="fa fa-printer"></i> Print
                            </a></button>
                        </fieldset></center>   --}}
                    </form>
                    </div>
                </section>

            </div>
       
{{--     <htmlpagefooter name="myFooter1" style="display:none">
                          <div id="invoice-footer" align="right">
                            <p>Transfer the amounts to the business amount below. Please include invoice number on your check.</p>
                        </div>
       {PAGENO} of {nbpg}
    </htmlpagefooter> --}}
     <htmlpagefooter name="myFooter1" style="display:none">
       
        <table width="100%" class="footer">
            <tr>
                <td width="33%">Invoice Document</td>
                <td width="33%" align="center">{PAGENO} of {nbpg}</td>
                <td width="33%" style="text-align: right;">{DATE j-m-Y}</td>
            </tr>
        </table>
     </htmlpagefooter>
</body>
</html>
