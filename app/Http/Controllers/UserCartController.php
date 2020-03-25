<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Response;
use Jaff\Offerdetail;
use Jaff\Fullday;
use Jaff\Dropin;
use Jaff\Setting;
use Jaff\Member;
Use DB;
use Auth;

class UserCartController extends Controller
{
    public function showCart()
    {
        
        $data = array();
        if(Auth::guard('web')->check())
        {
           $member = Member::where('userid',Auth::guard('web')->user()->id)
                   ->where('status',1)->whereDate('end_date','>=',today())
                   ->exists();
           if($member){
               $data['member']='member';
           }
        }
        $data['od'] = $data['os'] = $data['fd'] = $data['dd'] =$data['ds']= array();
        $data['title'] = 'Cart History';
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')->where('offers.status',1)->get();
        $fdays= Fullday::where('status',1)->get();
        $dds= Dropin::where('status',1)->get();
        foreach($offers as $ofr)
        {
            $data['od'][$ofr->offer_date] = $ofr->percentage;
            $data['os'][$ofr->slot_id] = $ofr->percentage;
        }
        foreach($fdays as $fd)
        {
            $data['fd'][$fd->date]= $fd->price;
        }
        foreach($dds as $dd)
        {
            $data['dd'][$dd->date]= $dd->price;
            $data['ds'][$dd->slot_id]= $dd->price;
        }
        return view('user.pages.cart',$data);
    }
    public function addCart(Request $request)
    {
//        $max = Setting::where('id',1)->value('max_slot');
//        if(Cart::count()<$max)
//        {
            Cart::add(['id' => $request->date.$request->slot_id, 
                  'name' => $request->date.$request->slot_id, 'qty' => 1, 'price' => 500, 'weight' => 550, 
            'options' => ['date' => $request->date,'slot' => $request->slot_id,'price' => $request->price,'time' => $request->time]]);
            $output = '';
            $i = 1;
            foreach(Cart::content() as $content)
            {
                $output .= '<tr class="table-light">
                                <th scope="row">'.$i++.'</th>
                                <td>'.$content->options->date.'</td>
                                <td>'.$content->options->time.'</td>
                                <td>
                                    <a href="#" class="delRow" data-rowid="'.$content->rowId.'">
                                        <i class="ficon feather icon-trash-2 danger" style="font-size: 1.2rem;"></i>
                                    </a>
                                </td>
                            </tr>';
            }
            $msg = 'Added The Slot Into Cart';
            $typ = 'success';
//        }else{
//            $msg = 'Your are not allowed to add more slot';
//            $typ = 'warning';
//        }                                  
        $notify = array(
                'carttotal' => Cart::count(),
//                'cartdeatils' => $output,
                'message' => $msg,
                'type' => $typ
            );
        return $notify;
    }
    public function rmvCart(Request $request)
    {
        $list = array();
        $name = $request->date.$request->slot_id;
        foreach (Cart::content() as $cv)
        {
            $list[$cv->name]= $cv->rowId;
            if($cv->name==$name)
            {
             Cart::remove($cv->rowId) ;  
            }
        }
        $output = '';
        $i = 1;
        foreach(Cart::content() as $content){
            $output .= '<tr class="table-light">
                            <th scope="row">'.$i++.'</th>
                            <td>'.$content->options->date.'</td>
                            <td>'.$content->options->time.'</td>
                            <td>
                                <a href="#" class="delRow" data-rowid="'.$content->rowId.'">
                                    <i class="ficon feather icon-trash-2 danger" style="font-size: 1.2rem;"></i>
                                </a>
                            </td>
                        </tr>';
        }
        $notify = array(
                'carttotal' => Cart::count(),
                'cartdeatils' => $output,
                'message' => 'Removed The Slot From Cart',
                'type' => 'error'
            );
        return $notify;
    }
    
    
    
    
    public function delCart(Request $request)
    {
        Cart::remove($request->rowid);

        $od = $os= $fd = $dd =$ds = array();

        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')->where('offers.status',1)->get();
        $fdays= Fullday::where('status',1)->get();
        $dds= Dropin::where('status',1)->get();
        
        foreach($offers as $ofr)
        {
            $od[$ofr->offer_date] = $ofr->percentage;$os[$ofr->slot_id] = $ofr->percentage;
        }
        foreach($fdays as $fdy){$fd[$fdy->date]= $fdy->price;}
        foreach($dds as $drp)
        {
            $ds[$drp->date]= $drp->price;$ds[$drp->slot_id]= $drp->price;
        }
        
        $i=0;$total=0;$discount=0;$info='';
                                
        if(Cart::count()>0)
        {
            foreach(Cart::content() as $cart)
            {
                $info.='<tr>
                            <td>'.date('D,d M, Y',strtotime($cart->options->date)).'</td>
                            <td>'.$cart->options->time.'</td>';
                if(array_key_exists($cart->options->date, $fd))
                {   
                    $dis= $cart->options->price-$fd[$cart->options->date];
                    $info.= '<td>'.$cart->options->price.'</td><td>'.$dis.'</td><td>'.$fd[$cart->options->date].'</td>';
                    $discount+=$dis;$total+= $cart->options->price; 
                }else{
                    if(array_key_exists($cart->options->date, $dd) && array_key_exists($cart->options->slot, $ds))
                    {
                        $info.= '<td>'.$dd[$cart->options->date].'</td><td>0</td><td>'.$dd[$cart->options->date].'</td>';
                        $total+= $dd[$cart->options->date];
                    }else{
                        if(array_key_exists($cart->options->date, $od) && array_key_exists($cart->options->slot, $os)){
                            $info.= '<td>'.$cart->options->date.'</td>'
                                    . '<td>'.$od[$cart->options->date].'%'.'</td>'
                                    . '<td>'.$cart->options->price-(($od[$cart->options->date]/100)*$cart->options->price).'</td>';
                            $discount+=($od[$cart->options->date]/100)*$cart->options->price;
                            $total+=$cart->options->price;
                        }else{
                            $info.= '<td>'.$cart->options->price.'</td><td>0</td><td>'.$cart->options->price.'</td>';
                            $total+=$cart->options->price;
                        }
                    }
                }
                $info.=  '<td><a href="#" class="rmv" data-rowid="'.$cart->rowId.'"><i class="fa fa-trash font-small-3 text-danger" ></i></a></td>';        
                $i++;
            }
            
        }else{
            $info.= '<tr>
                        <td colspan="7" class="text-center"> No slot in cart</td>
                    </tr>';
        }
        $notify = array(
                'cartlist' => $info,
                'cslot' => $i,
                'ctotal' => $total,
                'cdis' => $discount,
                'cpay' => $total-$discount,
                'carttotal' => Cart::count(),
                'message' => 'Removed The Slot From Cart',
                'type' => 'error'
            );
        return $notify;
    }
    public function delCartRow(Request $request)
    {
        Cart::remove($request->rowid);
                $output = '';
        $i = 1;
        foreach(Cart::content() as $content){
            $output .= '<tr class="table-light">
                            <th scope="row">'.$i++.'</th>
                            <td>'.$content->options->date.'</td>
                            <td>'.$content->options->time.'</td>
                            <td>
                                <a href="#"  class="delRow" data-rowid="'.$content->rowId.'">
                                    <i class="ficon feather icon-trash-2 danger" style="font-size: 1.2rem;"></i>
                                </a>
                            </td>
                        </tr>';
        }
        $notify = array(
                'carttotal' => Cart::count(),
                'cartdeatils' => $output,
                'message' => 'Removed The Slot From Cart',
                'type' => 'error'
            );
        return $notify;
    }

    public function showAppsCart()
    {
        // dd('success');
        $data = array();
        if(Auth::guard('web')->check())
        {
           $member = Member::where('userid',Auth::guard('web')->user()->id)
                   ->where('status',1)->whereDate('end_date','>=',today())
                   ->exists();
           if($member){
               $data['member']='member';
           }
        }
        $data['od'] = $data['os'] = $data['fd'] = $data['dd'] =$data['ds']= array();
        $data['title'] = 'Cart History';
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')->where('offers.status',1)->get();
        $fdays= Fullday::where('status',1)->get();
        $dds= Dropin::where('status',1)->get();
        foreach($offers as $ofr)
        {
            $data['od'][$ofr->offer_date] = $ofr->percentage;
            $data['os'][$ofr->slot_id] = $ofr->percentage;
        }
        foreach($fdays as $fd)
        {
            $data['fd'][$fd->date]= $fd->price;
        }
        foreach($dds as $dd)
        {
            $data['dd'][$dd->date]= $dd->price;
            $data['ds'][$dd->slot_id]= $dd->price;
        }
        return view('user.pages.cart1',$data);
    }
}
