<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Jaff\Member;
use Jaff\Booking;
use Jaff\Bookdetail;
use Jaff\Setting;
use Jaff\Offerdetail;
use Jaff\Fullday;
use Jaff\Dropin;

class UserBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function saveBooking($user_id,$available,$mdis,$memid)
    {
        $lists = $slots = $fdays = $drops = $dslot = array();
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')->where('status',1)->get();
        $fuldays= Fullday::where('status',1)->get();
        $dds= Dropin::where('status',1)->get();
        foreach($offers as $ofr)
        {$lists[$ofr->offer_date] = $ofr->percentage;
        $slots[$ofr->slot_id] = $ofr->percentage;}
        foreach($fuldays as $fd)
        {$fdays[$fd->date]= $fd->price;}
        foreach($dds as $dd)
        {$drops[$dd->date]= $dd->price;
        $dslot[$dd->slot_id]= $dd->price;}
        

        $book =  new Booking;
        $book->notes = 'null';
        $book->less = 0;
        $book->status = 0;
        $book->user_type = 2;
        $book->booked_for = $user_id;
        $book->save();
        
        $bookid = $book->book_id;
        if($bookid < 10){$book_code = "JFSB0000".$bookid;}
        else if ($bookid < 100){$book_code = "JFSB000".$bookid;}
        else if ($bookid < 1000){$book_code = "JFSB00".$bookid;}
        else if ($bookid < 10000){$book_code = "JFSB0".$bookid;}
        else {$book_code = "JFSB".$bookid;}
        $upcode = Booking::find($bookid);
        $upcode->book_code = $book_code;
        $upcode->save();
        
        
        $i=1;
        foreach(Cart::content() as $cart)
        {
            $exists = Bookdetail::where('slot_id',$cart->options->slot)->where('slot_date',$cart->options->date)->exists();
            if(!$exists){

            $bookdetail = new Bookdetail;
            $bookdetail->book_id = $bookid;
            $bookdetail->slot_date = $cart->options->date;
            $bookdetail->slot_id = $cart->options->slot;
            $bookdetail->ground_id = 1;

            if(array_key_exists($cart->options->date, $fdays))
            {
                
                $bookdetail->price = $cart->options->price;
                $bookdetail->discount = $cart->options->price-$fdays[$cart->options->date];
                $bookdetail->book_price = $fdays[$cart->options->date];
                $bookdetail->type= 3;
            }
            else{
                if(array_key_exists($cart->options->date, $drops) && array_key_exists($cart->options->slot, $dslot))
                {
                    $bookdetail->price = $drops[$cart->options->date];
                    $bookdetail->discount = 0;
                    $bookdetail->book_price = $drops[$cart->options->date];
                    $bookdetail->type= 4;
                    
                }else{
                    if(array_key_exists($cart->options->date, $lists) && array_key_exists($cart->options->slot, $slots))
                    {
                        $bookdetail->price = $cart->options->price;
                        $bookdetail->discount = ($lists[$cart->options->date]/100)*$cart->options->price;
                        $bookdetail->book_price = $cart->options->price-(($lists[$cart->options->date]/100)*$cart->options->price);
                        $bookdetail->type = 2;
                    }else{
                        $bookdetail->price = $cart->options->price;
                        if($i<=$available && $mdis>0){
                            $d= ($mdis/100)*$cart->options->price;
                            $bookdetail->discount = $d;
                            $i++;
                            $up = Member::find($memid);
                            $up->used_slot = $up->used_slot+1;
                            $up->save();
                        }else{
                            $bookdetail->discount = 0;
                        }
                        $bookdetail->book_price = $cart->options->price-$bookdetail->discount;
                        $bookdetail->type= 1;
                        
                    }
                }                        
            }
            $bookdetail->save(); 
        }
        }
        return 'ok';   
    }
    

    public function userConBook(Request $request)
    {
        $user_cart = Cart::count();
        $user_id= Auth::guard('web')->user()->id;
        $max_slot = Setting::where('id',1)->value('max_slot');
        $available = ""; $mdis= 0;$memid= 0;
        if($user_cart>$max_slot)
        {
            session()->flash('error', 'Your are not allowed to book more than '.$max_slot.' Slot');
            return redirect()->back();
        }
        else if(!is_null($request->memcode))
        {
            $code = Member::where('userid',Auth::guard('web')->user()->id)
                   ->where('code',$request->memcode)->where('status',1)
                   ->exists();
            if($code){
                $info = Member::join('memberships','members.mid','=','memberships.id')
                        ->where('members.userid',Auth::guard('web')->user()->id)->where('members.code',$request->memcode)
                        ->where('members.status',1)
                        ->select('members.*','memberships.discount')->first();
                $available = $info->max_slot-$info->used_slot;
                $mdis = $info->discount;
                $memid = $info->id;
                if($available<=0)
                {
                    session()->flash('error', 'You dont have enough slots to apply membership');
                    return redirect()->back();
                    
                }else{
                    $this->saveBooking($user_id,$available,$mdis,$memid);
                    Cart::destroy();
                    session()->flash('success', 'Booked Successfully! You have 48 hours to make the payments');
                    return redirect()->route('notify.success');
                }
            }else{
                session()->flash('error', 'Please Enter a valid Code');
                return redirect()->back();
            }
        }else{
            $this->saveBooking($user_id,$available,$mdis,$memid);
            Cart::destroy();
            session()->flash('success', 'Booked Successfully! You have 48 hours to make the payments');
            // return redirect()->back();
            return redirect()->route('notify.success');
        }
    }
    public function successNofity()
    {
        $data = array();
        $data['title'] = 'Booking Confirmed';
        session()->flash('success', 'Booked Successfully! You have 48 hours to make the payments');
        return view('user.pages.success');
    }
}
