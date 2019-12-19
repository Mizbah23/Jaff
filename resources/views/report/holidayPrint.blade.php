

{{-- /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ --}}

<!DOCTYPE html>
<html>
<head>
    <title>Holidays</title>
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
        font-size: 14px;
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
    @if(!empty($from && $to))
    <h4>List of Holidays(from {{date('d-m-Y',strtotime($from))}} to {{date('d-m-Y',strtotime($to))}})</h4>
    @elseif(!empty($from))
    <h4>List of Holidays(from {{date('d-m-Y',strtotime($from))}})</h4>
    @elseif(!empty($to))
    <h4>List of Holidays(Till {{date('d-m-Y',strtotime($to))}})</h4>
    @else
    <h4>List of Holidays(All)</h4>
    @endif
    <br>
  </div>
  </div>
    </a> </center>

    <center>
     <table id="hldTbl" class="table zero-configuration ">
       <thead>
        <tr>
               <th>Holiday</th>
               <th>Purpose</th>
               <th>Ground</th>
               {{-- <th>Status</th> --}}    
       </tr>
       </thead>
       <tbody>
        @foreach ($posts as $item)  
        <tr>
            <td align="center">{{date('D ,d M Y',strtotime($item->holiday))}}</td>
            
            <td align="center">{{$item->details}}</td>
            <td align="center">{{$item->name}}</td>
            {{-- <td align="center">{{$item->status}}</td> --}}
        
        </tr>
        @endforeach
       </tbody>
   </table>
       
   </center>
 <br>
        <h4  style="text-align: center;font-size: 12px">Total Holidays {{$total}}</h4>

</body>

</html>

