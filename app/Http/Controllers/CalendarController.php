<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Holiday;
use Jaff\Weekday;
use Jaff\Fullday;
use Jaff\Dropin;
use Jaff\Bookdetail;
use Jaff\Offerdetail;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;
use Response;

class CalendarController extends Controller
{
    public function calender()
    {
        $data = array();
        $data['title'] = 'Calender Management';
        return view('admin.pages.calender',$data);
    }
    function getDatesRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d' )
    {
        $dates = array();
        $start = strtotime($first);
        $end= strtotime($last);
        while( $start <= $end )
        {
            $dates[] = date($output_format, $start);
            $start = strtotime($step, $start);
        }
        return $dates;
    }
    //********************Backup***************************
    public function loadEventB(Request $request)
    {
        $holidays = array();
        $hs = Holiday::where('status',1)->get();
        foreach ($hs as $h)
        {
            array_push($holidays, $h->holiday);
        }
        $list = array();$event = array();
        $arr_days = $this->getDatesRange($request->start, $request->end);
        foreach($arr_days as $d)
        {
            $cd = date('D', strtotime($d));
            if(in_array($d, $holidays))
            {
                $event['title'] = 'Holiday';
                $event['start'] = $d;
                $event['end'] = $d;
                $event['overlap'] = true;
                $event['rendering'] = 'background';
                $event['color'] = '#e6e600';
                array_push($list, $event);
            }else{
                $exists = Weekday::where('code',$cd)->where('sts',1)->exists();
//                $exists = DB::table('weekdays')->where('code',$cd)->where('sts',1)->exists();
                if($exists)
                {
                    $active_slots = DB::table('weekdays')->join('slots','weekdays.id','=','slots.day_id')
                            ->where('weekdays.code',$cd)->where('slots.status',1)->get();
                    foreach($active_slots as $value)
                    {
                        $is_booked = DB::table('bookdetails')->where('slot_id',$value->slot_id)
                                ->whereDate('slot_date','=',$d)->exists();
                        if($is_booked)
                        {
                            $event['id'] = $value->id;
                            $event['title'] = 'Booked';
                            $event['start'] = $d."T".$value->start;
                            $event['end'] = $d."T".$value->end;
                            $event['color'] = '#EA5455';
                            array_push($list, $event);
                        }else{
                            $event['id'] = 'null';
                            $event['title'] = 'Available';
                            $event['start'] = $d."T".$value->start;
                            $event['end'] = $d."T".$value->end;
                            $event['color'] = '#009900';
                            array_push($list, $event);
                        }
                    }
                }
            }
 
        }
        return response()->json($list);
    }
    //***********************************************
    
    public function loadEvent(Request $request)
    {
        $holidays = array();$fds = array();$drops = array();$dropd = array();
        $hs = Holiday::where('status',1)->get();
        $fday = Fullday::where('status',1)->get();
        $ddays = Dropin::where('status',1)->get();
        foreach ($hs as $h){array_push($holidays, $h->holiday);}
        foreach ($fday as $fd){array_push($fds, $fd->date);}
        foreach ($ddays as $dd){
            $dropd[$dd->date] = $dd->seat;
            $drops[$dd->slot_id] = $dd->taken;
        }
        
        $lts = array();$slts = array();
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')->get();
        foreach($offers as $ofr)
        {
            array_push($lts, $ofr->offer_date);
            $lts[$ofr->offer_date] = $ofr->percentage;
            $slts[$ofr->slot_id] = $ofr->percentage;
//            array_push($slts, $ofr->slot_id);
        }
        $list = array();$event = array();
        $arr_days = $this->getDatesRange($request->start, $request->end);
        foreach($arr_days as $d)
        {
            $cd = date('D', strtotime($d));
            if(in_array($d, $holidays))
            {
                $event['title'] = 'Holiday';
                $event['start'] = $d;
                $event['end'] = $d;
                $event['overlap'] = true;
                $event['rendering'] = 'background';
                $event['color'] = '#e68a00';
                array_push($list, $event);
            }
            
            else{
                $exists = Weekday::where('code',$cd)->where('sts',1)->exists();
                if($exists)
                {
                    $active_slots = Weekday::join('slots','weekdays.id','=','slots.day_id')
                            ->where('weekdays.code',$cd)->where('slots.status',1)->get();
                    
                    

                    
                    foreach($active_slots as $value)
                    {
                        $is_booked = DB::table('bookdetails')->where('slot_id',$value->slot_id)
                            ->whereDate('slot_date','=',$d)->exists();
                        if(in_array($d, $fds))
                        {
                                $event['id'] = ($is_booked)?$value->id:'null';
                                $event['title'] = ($is_booked)? 'Booked':'Available';
                                $event['start'] = $d."T".$value->start;
                                $event['end'] = $d."T".$value->end;
                                $event['color'] = ($is_booked)?'#5900b3':'#b366ff';
                                array_push($list, $event);
                        }else{              
                        if(array_key_exists($d, $dropd) && array_key_exists($value->slot_id, $drops))
                        {
                            $event['id'] = ($is_booked)?$value->id:'null';
                            $avail = $dropd[$d]-$drops[$value->slot_id];
                            $event['title'] = 'DropIn '.$avail.'('.$dropd[$d].')';
                            $event['start'] = $d."T".$value->start;
                            $event['end'] = $d."T".$value->end;
                            $event['color'] = '#990066';
                            array_push($list, $event); 
                        }
                        else{
                            if(array_key_exists($d, $lts) && array_key_exists($value->slot_id, $slts))
                            { 
                                $event['id'] = ($is_booked)?$value->id:'null';
                                $event['title'] = ($is_booked)? 'Offer Booked':'Offer Available';
                                $event['start'] = $d."T".$value->start;
                                $event['end'] = $d."T".$value->end;
                                $event['color'] = ($is_booked)?'#3333ff':'#00ace6';
                                array_push($list, $event); 
                            }else{
                                $event['id'] = ($is_booked)?$value->id:'null';
                                $event['title'] = ($is_booked)? 'Booked':'Available';
                                $event['start'] = $d."T".$value->start;
                                $event['end'] = $d."T".$value->end;
                                $event['color'] = ($is_booked)?'#EA5455':'#009900';
                                array_push($list, $event); 
                                }
                            }
                        }
                    }
                }
            }
 
        }
        return response()->json($list);
    }
    public function getAvailableSlot(Request $request)
    {
        $cart = array();$holidays = array();$drops = array();$dropd = array();
        foreach (Cart::content() as $cv)
        {
            array_push($cart, $cv->name);
        }
        $hs = Holiday::where('status',1)->get();
        foreach ($hs as $h)
        {
            array_push($holidays, $h->holiday);
        }
        $ddays = Dropin::where('status',1)->get();
        foreach ($ddays as $dd){
            $dropd[$dd->date] = $dd->seat;
            $drops[$dd->slot_id] = $dd->taken;
        }
        
        $slts = array();
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')
                ->whereDate('offerdetails.offer_date','=',$request->date)->get();
        foreach($offers as $ofr)
        {
            $slts[$ofr->slot_id] = $ofr->percentage;
        }
        $week = date('D', strtotime($request->date));
        $output = '';
        
        if(in_array($request->date, $holidays))
        {
            $info = Holiday::where('holiday',$request->date)->value('details');
            $output .= '<div class="alert alert-warning" role="alert">
                                <h4 class="alert-heading text-center" >Holiday</h4>
                                    <p class="mb-0 text-center">'.$info.'</p></div>';
        }else{
            
                $output .='<div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr >
                                                <th>SL</th>
                                                <th>Slots</th>
                                                <th>status</th>
                                                <th>book</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $exists = DB::table('weekdays')->where('code',$week)->where('sts',1)->exists();
        if($exists)
        {
            $active_slots = DB::table('weekdays')->join('slots','weekdays.id','=','slots.day_id')
                        ->where('weekdays.code',$week)->where('slots.status',1)->orderBy('slots.start','asc')->get();
            $i=1;
            foreach($active_slots as $value)
            {
                $is_booked = DB::table('bookdetails')->where('slot_id',$value->slot_id)
                        ->whereDate('slot_date','=',$request->date)->exists();
                $duration = date( "h:i A", strtotime($value->start)).'-'.date( "h:i A", strtotime($value->end));
                
                
              if(array_key_exists($request->date, $dropd) && array_key_exists($value->slot_id, $drops)){
                    $avail = $dropd[$request->date]-$drops[$value->slot_id];
                    $output .= '<tr class="table-light">
                                <th scope="row">'.$i.'</th>';
                    $output .= (array_key_exists($value->slot_id, $slts))? 
                            '<td>'.$duration.' <i class="vs-icon feather icon-gift"></i></td>':
                            '<td>'.$duration.'</td>';
                    $output .= '<td>Available <span class="badge badge-pill badge-glow bg-info">'.$avail.'</span></td>';
//                    .$drops[$value->slot_id].'('.$dropd[$request->date].')
                    
                    if($avail>0){
                        $output .= '<td>
                               <div class="vs-checkbox-con vs-checkbox-success">
                                        <input type="checkbox" class="cartslot" data-price="'.$value->price.'" data-date="'.$request->date.'" data-time='.date( "h:iA", strtotime($value->start)).'-'.date( "h:iA", strtotime($value->end)).' data-slot_id="'.$value->slot_id.'">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    </div>
                           </td>';
                    }else{
                        $output .='<td></td>';
                    }
                    $output .= '</tr>';
                    $i++;
              }else{
                  
                  if($is_booked)
                {
                    $output .= '<tr class="table-danger">
                                <th scope="row">'.$i.'</th>';
                    $output .= (array_key_exists($value->slot_id, $slts))? 
                            '<td>'.$duration.' <i class="vs-icon feather icon-gift"></i></td>':
                            '<td>'.$duration.'</td>';
                    $output .= '<td>Booked</td>
                                <td></td>
                            </tr>';
                }else{
                    
                    if(in_array($request->date.$value->slot_id, $cart)){
                        
                        $output .= '<tr class="table-light">
                                <th scope="row">'.$i.'</th>';
                        $output .= (array_key_exists($value->slot_id, $slts))? 
                            '<td>'.$duration.' <i class="vs-icon feather icon-gift"></i></td>':
                            '<td>'.$duration.'</td>';
                        
                        $output .= '<td><span class="badge badge-pill badge-glow bg-success float-left">checked</span></td>
                                <td>
                                    <div class="vs-checkbox-con vs-checkbox-success">
                                        <input type="checkbox" class="cartslot" checked data-price="'.$value->price.'" data-date="'.$request->date.'" data-time='.date( "h:iA", strtotime($value->start)).'-'.date( "h:iA", strtotime($value->end)).' data-slot_id="'.$value->slot_id.'">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                </td>
                            </tr>';
                    }else{
                        $output .= '<tr class="table-light">
                                <th scope="row">'.$i.'</th>';
                        $output .= (array_key_exists($value->slot_id, $slts))? 
                            '<td>'.$duration.' <i class="vs-icon feather icon-gift"></i></td>':
                            '<td>'.$duration.'</td>';
                        
                        $output .= '<td>Available</td>
                                <td>
                                    <div class="vs-checkbox-con vs-checkbox-success">
                                        <input type="checkbox" class="cartslot" data-price="'.$value->price.'" data-time='.date( "h:iA", strtotime($value->start)).'-'.date( "h:iA", strtotime($value->end)).' data-date="'.$request->date.'" data-slot_id="'.$value->slot_id.'">
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                </td>
                            </tr>';
                    }

                }
                $i++;
                  
                  
                  
              }
                
                
                
                
                
                
            }
        }
        $output .= '</tbody></table></div>';
    }
        
        return $output;
    }
}
