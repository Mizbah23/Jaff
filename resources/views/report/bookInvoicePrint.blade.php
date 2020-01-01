
<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
 

table.list{
        width: 100%;
        
        border: 1px solid;
        border-collapse: collapse;
       /* margin-left: 200px;*/

   }
th{
  border: 1px solid black;
  height: 25px;
}
td.listrow{
  border: 1px solid black;
}

/*h4{
        margin-bottom: 5px;
        border: 1px solid;
        border-radius: 10px;
        width: 60%;
        margin: 0 auto;
        font-size: 14px;
    }*/

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
   <div></div> 
  <div style="text-align:font-size: 12px;margin-right: 10px" >
   
    <div><img style="margin-top: -5px; margin-left: 10px;" src="public/img/app-logo.png" alt="">
        <span><h2>Jaff Sports</h2></span>  </div>
  <div>Bashundhara Main Gate,
    Opposite of Jamuna Future Park Sidegate,<br>Bashundhara R/A,Dhaka.
    <br>Phone: +8801304229158, Email: info@jaff.com
    <br>
  </div>

  </div>
  <div>
      <div>
          <h2>Invoice</h2>
            <div class="invoice-details mt-2">
            <p>Invoice No:0012541</p>
            <p>Issue Date:1st Jan,2020</p>
            </div>
      </div>
  </div>
   
          <table class="list">
            <tr>   
           <th bgcolor="#3399ff">Description</th>
           <th bgcolor="#3399ff">Unit Cost</th>
           <th bgcolor="#3399ff">Quantity</th>
           <th bgcolor="#3399ff">Amount</th>
           </tr>
           <tr>
           <td class="listrow">Description</td>
           <td class="listrow">Unit Cost</td>
           <td class="listrow">Quantity</td>
           <td class="listrow">Amount</td>
           </tr>
         </table>
     <br>

  <table>
  <tr>
    <td>Billed to</td>
  </tr>
    <tr>
    <td>Client Name:Mr. John</td>
  </tr>
    <tr>
    <td>Phone:01521484948</td>
  </tr>
      <tr>
    <td>Address:Ka-120/A, Kuril Cowrasta,Vatara Dhaka.</td>
  </tr>
</table>

       
  
 <br>
      
  <footer>
    <p>E.g. Please pay invoice by MM/DD/YYYY</p>
  </footer>
</body>
</html>
