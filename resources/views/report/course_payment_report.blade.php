

{{-- /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ --}}

<!DOCTYPE html>
<html>
<head>
<title>Expense Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
 

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
  
/*$mpdf->Image('/img/app-logo.png', 0, 0, 210, 297, 'jpg', '', true, false);
*/
</style>
</head>
<body>
    <center><a class="brand-logo" href="">
  <div style="text-align: center;font-size: 12px" >
   
    <div><img style="margin-top: -15px; margin-left: 260px;" src="public/img/app-logo.png" alt="">
        <span><h2 style="margin-right: 290px;padding-top: -8px; margin-left: 290px;">Jaff Sports</h2></span></div>
    <div style="margin-top: -10px">Bashundhara Main Gate,
    Opposite of Jamuna Future Park Sidegate,<br>Bashundhara R/A,Dhaka.
    <br>Phone: +8801304229158, Email: info@jaff.com
    <h4>Course Payment Report ({{($fromdate)? 'From '.$fromdate:'.'}} {{($todate)?'To '.$todate:'.'}})</h4>
    <br>
  </div>
  </div>
    </a> </center>

    <center>
     <table id="slotTbl" class="table zero-configuration ">
       <thead>
        <tr>
            <th>SL</th>
            <th>Date</th>
            <th>ID</th>
            <th>Amount</th>
            <th>Details</th>
            
       </tr>
       </thead>
       <tbody>
        @php $i=1;$total=0;@endphp
        @foreach ($posts as $item)  
        <tr>
            <td>{{$i++}}</td>
            <td>{{date( "d,M Y", strtotime($item->date))}}</td>
            <td>{{$item->code}}</td>
            <td>{{number_format($item->amount)}}</td>
            <td>{{$item->details}}</td>
        </tr>
        @php $total+=$item->amount;@endphp
        @endforeach
       </tbody>
   </table>
       
   </center>
 <br>
        <h4  style="text-align: center;font-size: 12px">Total Payments: {{number_format($total).' BDT'}}</h4>
</body>
</html>
