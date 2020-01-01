<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\User;
use Jaff\Booking;
use Jaff\Bookdetail;
use Jaff\Slot;
use Jaff\Offer;
use Jaff\Dropin;
use Jaff\Fullday;
use Jaff\Offerdetail;
use Cart;
use DB;
use Auth;
use Response;
use PDF;

class BookingController extends Controller
{
    public function booking()
    {
        $data = array();
        $data['lists'] = $data['slots'] = $data['fdays'] = $data['drops'] = $data['dslot'] = array();
        $data['title'] = 'Booking';
        $data['users'] = User::get();
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')
                ->where('status',1)->get();
        $fdays= Fullday::where('status',1)->get();
        $dds= Dropin::where('status',1)->get();
        
        foreach($offers as $ofr)
        {
            $data['lists'][$ofr->offer_date] = $ofr->percentage;
            $data['slots'][$ofr->slot_id] = $ofr->percentage;
        }
        foreach($fdays as $fd)
        {
            $data['fdays'][$fd->date]= $fd->price;
        }
        foreach($dds as $dd)
        {
            $data['drops'][$dd->date]= $dd->price;
            $data['dslot'][$dd->slot_id]= $dd->price;
        }
        return view('admin.pages.booking.booking',$data);
    }
    public function bookingList()
    {
        $data = array();
        $data['title'] = 'Booking List';
        $data['users'] = User::get();
        return view('admin.pages.booking.booking_list',$data);
    }
    public function getbookList(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        
        $columns = array(0 =>'created_at',1=> 'username',2=> 'phone',3=> 'email',4=> 'status',5=> 'action'
        );
        $totalData = Booking::when($from, function ($query, $from){return $query->whereDate('created_at','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('created_at','<=',$to);})->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Booking::join('users','bookings.booked_for','=','users.id')
                    
                    ->select('bookings.*','users.username','users.email','users.phone',DB::raw("(SELECT count(bookdetails.id) FROM bookdetails WHERE "
                            . "bookdetails.`book_id`=bookings.`book_id`) as tslot"),DB::raw("(SELECT SUM(bookdetails.book_price) FROM bookdetails WHERE "
                            . "bookdetails.`book_id`=bookings.`book_id`) as total"),
                            DB::raw("(SELECT SUM(pay_bookings.amount) FROM pay_bookings WHERE "
                            . "bookings.`book_id`= pay_bookings.`book_id`) as paid"))
                    ->when($from, function ($query, $from){return $query->whereDate('bookings.created_at','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('bookings.created_at','<=',$to);})
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Booking::when($from, function ($query, $from){return $query->whereDate('created_at','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('created_at','<=',$to);})->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Booking::join('users','bookings.booked_for','=','users.id')
                    ->select('bookings.*','users.username','users.email','users.phone',DB::raw("(SELECT count(bookdetails.id) FROM bookdetails WHERE "
                            . "bookdetails.`book_id`=bookings.`book_id`) as tslot"),DB::raw("(SELECT SUM(bookdetails.book_price) FROM bookdetails WHERE "
                            . "bookdetails.`book_id`=bookings.`book_id`) as total"),
                             DB::raw("(SELECT SUM(pay_bookings.amount) FROM pay_bookings WHERE "
                            . "bookings.`book_id`= pay_bookings.`book_id`) as paid"))
                    ->when($from, function ($query, $from){return $query->whereDate('bookings.created_at','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('bookings.created_at','<=',$to);})
                    ->where('users.name', 'like', "%{$search}%")
                    ->orwhere('users.phone', 'like', "%{$search}%")
                    ->orwhere('users.email', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Booking::where('name', 'like', "%{$search}%")
                    ->select('bookings.*','users.username','users.email','users.phone')
                    ->when($from, function ($query, $from){return $query->whereDate('bookings.created_at','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('bookings.created_at','<=',$to);})
                    ->where('users.name', 'like', "%{$search}%")
                    ->orwhere('users.phone', 'like', "%{$search}%")
                    ->orwhere('users.email', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['code'] = $r->book_code;
            $nestedData['date'] = date('d-m-y H:i a', strtotime($r->created_at));
            $nestedData['userinfo'] = 'Name: '.$r->username.'<br> Email:'.$r->email.'<br>Phone: '.$r->phone;
            $due = $r->total-($r->paid+$r->less);
            $nestedData['total'] = 'Total: '.$r->total;
            $nestedData['payment'] = 'Paid: '.$r->paid.'<br>Less: '.$r->less.'<br>Due: '.$due;
            
            $nestedData['slots'] = '<a href="#" class="listmdl" data-bookid="'.$r->book_id.'" ><span class="badge badge-pill badge-glow bg-primary">'.$r->tslot.'</span></a>';
            $nestedData['booked_for'] = $r->booked_for;

            if($r->status==0){
                $status = '<span class="badge badge-pill badge-glow bg-danger"><i class="feather icon-x"></i>Due</span>';
            }else if($r->status==1){
                $status = '<span class="badge badge-pill badge-glow bg-success"><i class="feather icon-check"></i>Paid</span>';
            }else{
                $status = '<span class="badge badge-pill badge-glow bg-warning"><i class="feather icon-alert-circle"></i>Partial</span>';
            }
            $nestedData['sts']=$status;
//            $action = '<a class="" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->name.'" data-eml="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
             $action =  '<a href="#" class="delmdl" data-delid="'.$r->book_id.'" data-ttl="'.$r->book_code.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
            
            if($r->status!=1)
            {
                $action.=  '<div class="badge badge-primary">
                    <a href="#" class="paymdl" data-pid="'.$r->book_id.'" data-amnt="'.$due.'" style="padding: 4px;">pay</a>
                </div>';
            }
            $nestedData['action'] = $action;
            
            
            $data[] = $nestedData;
        }
    }     
        $json_data = array(
            "draw"	      => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"	      => $data
        );
        echo json_encode($json_data);    
    }
    public function saveBook(Request $request)
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
        
        
        $user = User::where('username',$request->bookedfor)->value('id');
        $book =  new Booking;
        $book->notes = 'null';
        $book->less = 0;
        $book->status = 0;
        $book->user_type = 1;
        $book->booked_for = $user;
        $book->created_by = Auth::guard('admin')->user()->id;
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
        
        foreach(Cart::content() as $cart)
        {
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
                        $bookdetail->discount = 0;
                        $bookdetail->book_price = $cart->options->price;
                        $bookdetail->type= 1;
                    }
                }                        
            }
            $bookdetail->save();   
        }
        $notification = array(
                'message' => 'Booking Confirmed Successfully',
                'type' => 'success'
            );
        Cart::destroy();
        // $pdf=PDF::loadView('report.bookInvoicePrint');
        return Response::json($notification); 
    }
    
    
    public function countBooking(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        $total= Booking::when($from, function ($query, $from){return $query->whereDate('created_at','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('created_at','<=',$to);})
        ->count();
        return number_format($total);
    }

    public function bookedSlotList() 
    {
        $data = array();
        $data['title'] = 'Booked Slot List';
        $data['users'] = User::get();
        return view('admin.pages.booking.booking_slotlist',$data);
    }
    public function getBookSlot(Request $request)
    {
        $fromDate = $request->fromdate;
        $toDate = $request->todate;
        $fromTime = ($request->fromtime!="")?date("H:i:s", strtotime($request->fromtime)):'';
        $toTime = ($request->totime!="")?date("H:i:s", strtotime($request->totime)):'';
        $columns = array(0 =>'book_code',1 =>'slot_date',2=> 'start',3=> 'price',4=> 'discount',5=> 'book_price',6=> 'status',7=> 'action');
        $totalData = Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                ->when($fromDate, function ($query, $fromDate)
                {return $query->whereDate('bookdetails.slot_date','>=',$fromDate);})
                ->when($toDate, function ($query, $toDate)
                {return $query->whereDate('bookdetails.slot_date','<=', $toDate);})
                ->when($fromTime, function ($query, $fromTime)
                {return $query->whereRaw("TIME(slots.start) >= ?", $fromTime); })
                ->when($toTime, function ($query, $toTime)
                {return $query->whereRaw("TIME(slots.end) <= ?", $toTime);})
                ->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts =Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                   ->join('bookings','bookings.book_id','=','bookdetails.book_id')
                   ->select('bookdetails.*','bookings.book_code','slots.start','slots.end')
                ->when($fromDate, function ($query, $fromDate)
                {return $query->whereDate('bookdetails.slot_date','>=',$fromDate);})
                ->when($toDate, function ($query, $toDate)
                {return $query->whereDate('bookdetails.slot_date','<=', $toDate);})
                ->when($fromTime, function ($query, $fromTime)
                {return $query->whereRaw("TIME(slots.start) >= ?", $fromTime); })
                ->when($toTime, function ($query, $toTime)
                {return $query->whereRaw("TIME(slots.end) <= ?", $toTime);})
                ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                ->when($fromDate, function ($query, $fromDate)
                {return $query->whereDate('bookdetails.slot_date','>=',$fromDate);})
                ->when($toDate, function ($query, $toDate)
                {return $query->whereDate('bookdetails.slot_date','<=', $toDate);})
                ->when($fromTime, function ($query, $fromTime)
                {return $query->whereRaw("TIME(slots.start) >= ?", $fromTime); })
                ->when($toTime, function ($query, $toTime)
                {return $query->whereRaw("TIME(slots.end) <= ?", $toTime);})
                ->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                    ->join('bookings','bookings.book_id','=','bookdetails.book_id')
                   ->select('bookdetails.*','bookings.book_code','slots.start','slots.end')
                    ->when($fromDate, function ($query, $fromDate)
                    {return $query->whereDate('bookdetails.slot_date','>=',$fromDate);})
                    ->when($toDate, function ($query, $toDate)
                    {return $query->whereDate('bookdetails.slot_date','<=', $toDate);})
                    ->when($fromTime, function ($query, $fromTime)
                    {return $query->whereRaw("TIME(slots.start) >= ?", $fromTime); })
                    ->when($toTime, function ($query, $toTime)
                    {return $query->whereRaw("TIME(slots.end) <= ?", $toTime);})
                    ->where('bookdetails.slot_date', 'like', "%{$search}%")
                    ->orwhere('slots.start', 'like', "%{$search}%")
                    ->orwhere('slots.end', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                    ->when($fromDate, function ($query, $fromDate)
                    {return $query->whereDate('bookdetails.slot_date','>=',$fromDate);})
                    ->when($toDate, function ($query, $toDate)
                    {return $query->whereDate('bookdetails.slot_date','<=', $toDate);})
                    ->when($fromTime, function ($query, $fromTime)
                    {return $query->whereRaw("TIME(slots.start) >= ?", $fromTime); })
                    ->when($toTime, function ($query, $toTime)
                    {return $query->whereRaw("TIME(slots.end) <= ?", $toTime);})
                    ->where('bookdetails.slot_date', 'like', "%{$search}%")
                    ->orwhere('slots.start', 'like', "%{$search}%")
                    ->orwhere('slots.end', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['code'] = $r->book_code;  
            $nestedData['sltdate'] = date('d M, Y', strtotime($r->slot_date));
            $nestedData['duration'] = date( "h:iA", strtotime($r->start)).'-'.date( "h:iA", strtotime($r->end));
            $nestedData['price'] = $r->price;
            $nestedData['discount'] = $r->discount;
            $nestedData['book_price'] = $r->book_price;
            
            if($r->type==2){
                $type = '<div class="badge  badge-pill badge-info mr-1 badge-glow mb-1"><span>Offer</span></div>';
            }else if($r->type==3){
                $type = '<div class="badge  badge-pill badge-warning mr-1 badge-glow mb-1"><span>Fullday</span></div>';
            }else if($r->type==4){
                $type = '<div class="badge  badge-pill badge-primary mr-1 badge-glow mb-1"><span>DropIn</span></div>';
            }else{
                $type = '<div class="badge  badge-pill badge-secondary mr-1 badge-glow mb-1"><span>Regular</span></div>';
            }
            $nestedData['type']= $type;
            $nestedData['action'] = '<a class="" data-id="'.$r->id.'" data-nm="'.$r->slot_date.'" data-phn="'.$r->start.'" data-eml="'.$r->start.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="" style="padding: 4px;"><i class="ficon feather icon-trash danger"></i></a>';
            $data[] = $nestedData;
        }
    }     
        $json_data = array(
            "draw"	      => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"	      => $data
        );
        echo json_encode($json_data);    
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
//    public function delBookRow(Request $request) 
//    {
//        Cart::remove($request->rowid);
//        $output = '';
//        $i = 1;
//        foreach(Cart::content() as $content){
//            $output .= '<tr class="table-light">
//                            <th scope="row">'.$i++.'</th>
//                            <td>'.$content->options->date.'</td>
//                            <td>'.$content->options->time.'</td>
//                            <td>
//                                <a href="#"  class="delRow" data-rowid="'.$content->rowId.'">
//                                    <i class="ficon feather icon-trash-2 danger" style="font-size: 1.2rem;"></i>
//                                </a>
//                            </td>
//                        </tr>';
//        }
//        $notify = array(
//                'carttotal' => Cart::count(),
//                'cartdeatils' => $output,
//                'message' => 'Removed The Slot From Cart',
//                'type' => 'error'
//            );
//        return $notify;
//    }
    public function delBookRow(Request $request)
    {
        Cart::remove($request->rowid);
        $output = '';
        $t = 1;
        foreach(Cart::content() as $content)
        {
            $output .= '<tr class="table-light">
                            <th scope="row">'.$t++.'</th>
                            <td>'.$content->options->date.'</td>
                            <td>'.$content->options->time.'</td>
                            <td>
                                <a href="#"  class="delRow" data-rowid="'.$content->rowId.'">
                                    <i class="ficon feather icon-trash-2 danger" style="font-size: 1.2rem;"></i>
                                </a>
                            </td>
                        </tr>';
        }
        $lists = array();$slots = array();
//        $offers = Offer::get();
        $offers = Offerdetail::join('offers','offerdetails.offer_id','=','offers.id')->get();
        
        foreach($offers as $ofr)
        {
            $lists[$ofr->offer_date] = $ofr->percentage;
            $slots[$ofr->slot_id] = $ofr->percentage;
        }
        
        $i=0;$total=0;$discount=0;$info='';
                                
        if(Cart::count()>0)
        {
            foreach(Cart::content() as $cart)
            {
                $info.='<tr>
                            <td>'.$cart->options->date.'</td>
                            <td>'.date('D',strtotime($cart->options->date)).'</td>
                            <td>'.$cart->options->time.'</td>
                            <td>'.$cart->options->price.'</td>';
                if(array_key_exists($cart->options->date, $lists))
                {   
                    if(array_key_exists($cart->options->slot, $slots))
                    {
                        $p= $cart->options->price-(($lists[$cart->options->date]/100)*$cart->options->price);
                        $info.='<td>'.$lists[$cart->options->date].'%'.'</td>
                        <td>'.$p.'</td>';
                        $discount+=($lists[$cart->options->date]/100)*$cart->options->price; 
                    }
                    else{
                        $info.= '<td><i class="fa fa-times font-small-3 text-danger"></i></td>'
                            .'<td>'.$cart->options->price.'</td>';
                            $discount+=0;
                    }
                        
                }else{
                    $info.= '<td><i class="fa fa-times font-small-3 text-danger"></i></td>'
                            .'<td>'.$cart->options->price.'</td>';
                            $discount+=0;
                }
                $info.=  '<td><a href="#" class="rmv" data-rowid="'.$cart->rowId.'"><i class="fa fa-trash font-small-3 text-danger" ></i></a></td>';        
            
                $i++;$total+=$cart->options->price;
            }
            
        }else{
            $info.= '<tr>
                        <td colspan="7" class="text-center"> No slot in cart</td>
                    </tr>';
        }
        $notify = array(
                'info' => $info,
                'cslot' => $i,
                'ctotal' => $total,
                'cdis' => $discount,
                'cpay' => $total-$discount,
                'carttotal' => Cart::count(),
                'cartdeatils' => $output,
                'message' => 'Removed The Slot From Cart',
                'type' => 'error'
            );
        return $notify;
    }  
    public function userDetails(Request $request)
    {
        $user = User::where('username',$request->uid)->first();
        $output ='<p class="mb-0">'.$user->first_name.' '.$user->last_name.'</p>
                  <p>'.$user->email.'</p>
                  <p>'.$user->phone.'</p><img class="rounded-circle" src="'. asset($user->img).'" alt="" height="100" width="100">';
        return $output;
    }
    
    
    public function showBookSlots($bookid)
    {
        $output = '';
        $list = Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                ->where('bookdetails.book_id',$bookid)
                ->select('bookdetails.*','slots.start','slots.end')
                ->get();
        if(!empty($list))
        {
            foreach ($list as $li)
            {
               $output .= '<tr>
                        <td>'.$li->slot_date.'</td>
                        <td>'.date( "h:i A", strtotime($li->start)).'-'.date( "h:i A", strtotime($li->end)).'</td>
                        <td>'.$li->price.'</td>
                        <td>'.$li->discount.'</td>
                        <td>'.$li->book_price.'</td>';
               if($li->type==2){
                   $output .= '<td><div class="badge badge-info">Offered Slot</div></td>';
               }else if($li->type==3){
                   $output .= '<td><div class="badge badge-warning">Special Slot</div></td>';
               }else if($li->type==4){
                   $output .= '<td><div class="badge badge-primary">DropIn Slot</div></td>';
               }else {
                   $output .= '<td><div class="badge badge-secondary">Regular Slot</div></td>';
               }
                $output .=     ' <td><a href="#"  class="delbs" data-bookid="'.$bookid.'" data-booksid="'.$li->id.'">
                             <i class="ficon feather icon-trash-2 danger" style="font-size: 1.0rem;"></i>
                         </a>
                     </td>
                 </tr>';
            }
        }else{
            $output.='<tr>
                <td colspan="2">No slot available</td>
            </tr>';
        }
        return $output;
    }
    public function getbookMdl(Request $request)
    {
        $output = $this->showBookSlots($request->bookid);
        return $output;
    }
    public function delbookMdl(Request $request) 
    {
         $del = Bookdetail::find($request->booksid);
         $del->delete();
        $output = $this->showBookSlots($request->bookid);
        return $output;
        
    }
    public function delbook(Request $request){
        $book = Booking::find($request->delid);
        $book->delete();
        $notification = array(
                 'message' => 'Booking Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    
}
