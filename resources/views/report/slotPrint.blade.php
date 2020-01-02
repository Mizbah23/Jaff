

{{-- /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ --}}

<!DOCTYPE html>
<html>
<head>
    <title>Slots</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
 

table{
        width: 100%;
        margin: 0 auto;
        border: 1px solid;
        border-collapse: collapse;
    }
table.footer{
  border: none;
}



th,td{
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
  width: 5%;
  height: 5%
}
@page {
  
  margin-top: 12%;
  header: page-header;
  footer: page-footer;
  odd-header-name: html_myHeader1;
  even-header-name: html_myHeader1;
  odd-footer-name: html_myFooter1;
  even-footer-name: html_myFooter2;
}
  
/*$mpdf->Image('/img/app-logo.png', 0, 0, 210, 297, 'jpg', '', true, false);
*/
</style>
</head>
<body>
  <htmlpageheader name="myHeader1" >
    <center style="margin-bottom:5px">
  <div style="text-align: center;font-size: 12px;padding-top: 15px">
  <div><img style="margin-top:10px;margin-left:280px;" src="public/img/app-logo.png" alt="">
        <span><h2 style="margin-left:-300px;padding-top:4px;" >Jaff Sports</h2></span></div>
    <div style="margin-top: -10px">Bashundhara Main Gate,
    Opposite of Jamuna Future Park Sidegate,<br>Bashundhara R/A,Dhaka.
    <br>Phone: +8801304229158, Email: info@jaff.com
     
 </div>
  </div>
  <h4 style="text-align:center;">Slots List</h4>
  <br> 
</center>


</htmlpageheader>


    <center style="margin-top:5px">
     <table style="margin-top:5px" id="slotTbl" class="table zero-configuration ">
       <thead>
        <tr>   
               <th>#Sl</thead>
               <th>Day</th>
               <th>Duration</th>
               <th>Type</th>
               <th>Price</th>
               <th>Ground</th>
            
       </tr>
       </thead>
       <tbody>
        @foreach ($posts as $key=>$item)  
        <tr>
            <td>{{++$key}}</td>
            <td>{{$item->day}}</td>
            <td>{{date( "h:i A", strtotime($item->start))}}-{{date( "h:i A", strtotime($item->end))}}</td>
            <td>{{$item->type}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->name}}</td>
        
        </tr>
        @endforeach
       </tbody>
   </table>
   
   </center>

       
    <htmlpagefooter name="myFooter1" style="display:none">
       {PAGENO}/{nbpg}
    </htmlpagefooter>
     <htmlpagefooter name="myFooter2" style="display:none">
       
        <table width="100%">
            <tr>
                <td width="33%">My document</td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">{DATE j-m-Y}</td>
            </tr>
        </table>
     </htmlpagefooter>
</body>
</html>
