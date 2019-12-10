<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Slot;
use Jaff\Type;
use Jaff\Weekday;
use Jaff\Ground;
use Jaff\Holiday;
use Jaff\Offer;
use Jaff\Offerdetail;
use Jaff\Dropin;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jaff\Fullday;
Use DB;
use Auth;
use Response;

class SlotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    //*****************************Ground*************************************
    public function groundList() 
    {
        $data = array();
        $data['grounds'] = Ground::get();
        $data['title'] = 'Ground Management';
        return view('admin.pages.grounds',$data);
    }
    public function getGround(Request $request) 
    {
        $columns = array(0 =>'id',1=> 'name',2=> 'address',3=> 'details',4=> 'status',5=> 'action'
        );
        $totalData = Ground::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Ground::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Ground::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Ground::where('name', 'like', "%{$search}%")
                    ->orwhere('address', 'like', "%{$search}%")
                    ->orwhere('details', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Ground::where('name', 'like', "%{$search}%")
                    ->orwhere('address', 'like', "%{$search}%")
                    ->orwhere('details', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['gid'] = $r->id;
            $nestedData['gname'] = $r->name;
            $nestedData['gadd'] = $r->address;
            $nestedData['gdtl'] = $r->details;
            $nestedData['sts']=($r->status==1)?'<div class="badge  badge-pill badge-success mr-1 badge-glow mb-1"><i class="feather icon-check"></i><span>Active</span></div>':
                '<div class="badge badge-pill  badge-danger mr-1 badge-glow mb-1"><i class="feather icon-x"></i><span>Active</span></div>';
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->address.'" data-eml="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" style="padding: 4px;"><i class="ficon feather icon-trash danger"></i></a>';
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
    public function saveGround(Request $request) 
    {
        $ground =  new Ground;
        $ground->name = $request->name;
        $ground->address = $request->address;
        $ground->details = $request->details;
        $ground->save();
        $notification = array(
                'message' => 'Play Ground Info saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    //*****************************Ground*************************************
    public function slotList()
    {
        $data = array();
        $data['types'] = Type::get();
        $data['grounds'] = Ground::get();
        $data['weekdays'] = Weekday::get();
        $data['offers'] = Offer::get();
        $data['title'] = 'Slot Settings';
        return view('admin.pages.slots',$data);
    }
//    public function saveSlot()
//    {
//        $data = array();
//        $data['title'] = 'Slot Settings';
//        return view('admin.pages.slots',$data);
//    }
    public function saveType(Request $request) 
    {
        $type =  new Type;
        $type->type = $request->type;
        $type->price = $request->price;
        $type->save();
        $list = Type::get();
        $output= '';
        foreach($list as $ty){
            
            $output.='<tr>
                    <td>'.$ty->type.'</td>
                    <td> <span class="badge badge-pill badge-glow bg-primary">'.$ty->price.'</span></td>
                    <td>
                        <a class="editHour" style="padding: 4px;" data-typid="'.$ty->id.'" data-typ="'.$ty->type.'" data-prc="'.$ty->price.'">
                            <i class="ficon feather icon-edit success"></i>
                        </a>
                        <a class="" style="padding: 4px;" data-typid="'.$ty->id.'">
                            <i class="ficon feather icon-trash-2 danger"></i>
                        </a>
                    </td>
                </tr>';
            }
        $notification = array(
                'output' => $output,
                'message' => 'Hour Pack saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function updateType(Request $request) 
    {
        $type = Type::find($request->typid);
        $type->type = $request->utype;
        $type->price = $request->uprice;
        $type->save();
        $list = Type::get();
        $output= '';
        foreach($list as $ty)
        {
            $output.='<tr>
                    <td>'.$ty->type.'</td>
                    <td> <span class="badge badge-pill badge-glow bg-primary">'.$ty->price.'</span></td>
                    <td>
                        <a class="editHour" style="padding: 4px;" data-typid="'.$ty->id.'" data-typ="'.$ty->type.'" data-prc="'.$ty->price.'">
                            <i class="ficon feather icon-edit success"></i>
                        </a>
                        <a class="" style="padding: 4px;" data-typid="'.$ty->id.'">
                            <i class="ficon feather icon-trash-2 danger"></i>
                        </a>
                    </td>
                </tr>';
        }
        $notification = array(
                'output' => $output,
                'message' => 'Hour Pack Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    //slot
    public function setSlotPrice(Request $request)
    {
        $price = Type::where('id',$request->typid)->value('price');
        return $price; 
    }
    public function saveSlot(Request $request)
    {
        $check = 0;

        $from = date("H:i:s", strtotime($request->start));
//        $to = date("H:i:s", strtotime($request->endTime));
        $start_exists = Slot::whereRaw("TIME(start) <= ? AND TIME(end) > ?", array($from, $from))   
                        ->where('day_id', $request->day_id)
                        ->exists();
        if($start_exists){
           $check = 1;
        }

        $to = date("H:i:s", strtotime($request->end));
        $end_exists = Slot::whereRaw("TIME(start) < ? AND TIME(end) >= ?", array($to, $to))
                    ->where('day_id', $request->day_id)
                    ->exists();
        ($end_exists)?$data["error"]= 'Time Not Available':$data["success"]= 'Time Available';
        if($end_exists){
           $check = 1;
        }
        
        if($check==0)
        {
            $slot =  new Slot;
            $slot->day_id = $request->day_id;
            $slot->start = date("H:i:s", strtotime($request->start));
            $slot->end = date( "H:i:s", strtotime($request->end));
            $slot->type_id = $request->slottyp;
            $slot->price = $request->slotprice;
            $slot->ground_id = $request->ground_id;
            $slot->save();
            $notification = array(
                    'message' => 'Slot Saved Successfully',
                    'type' => 'success'
                );
            return Response::json($notification); 
        }
        else{
            $notification = array(
                    'message' => 'Can not add slot! Time Overlapping!',
                    'type' => 'error'
                );
            return Response::json($notification);
        }

    }
    public function updateSlot(Request $request)
    {
        $slot = Slot::find($request->upslotid);
        $slot->day_id = $request->uday_id;
        $slot->start = date("H:i:s", strtotime($request->ustart));
        $slot->end = date( "H:i:s", strtotime($request->uend));
        $slot->type_id = $request->uslottyp;
        $slot->price = $request->uslotprice;
        $slot->ground_id = $request->uground_id;
        $slot->save();
        $notification = array(
                'message' => 'Slot Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function getSlotList(Request $request)
    {
        $day_id=$request->searchday;
        $ground_id=$request->searchgrnd;
        $type_id=$request->searchtyp;
        $columns = array(0 =>'day_id',1=> 'start',2=> 'type_id',3=> 'price',4=> 'ground_id',5=> 'status',5=> 'action'
        );
        $totalData = Slot::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Slot::join('grounds','slots.ground_id','=','grounds.id')
                    ->join('weekdays','slots.day_id','=','weekdays.id')
                    ->join('types','slots.type_id','=','types.id')
                    ->when($day_id, function ($query, $day_id)
                    {return $query->where('day_id', $day_id);})
                    ->when($ground_id, function ($query, $ground_id)
                    {return $query->where('ground_id', $ground_id);})
                    ->when($type_id, function ($query, $type_id)
                    {return $query->where('type_id', $type_id);})
                    ->select('slots.*','grounds.name','weekdays.day','types.type')
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Slot::when($day_id, function ($query, $day_id)
                    {return $query->where('day_id', $day_id);})
                    ->when($ground_id, function ($query, $ground_id)
                    {return $query->where('ground_id', $ground_id);})
                    ->when($type_id, function ($query, $type_id)
                    {return $query->where('type_id', $type_id);})->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Slot::join('grounds','slots.ground_id','=','grounds.id')
                    ->join('weekdays','slots.day_id','=','weekdays.id')
                    ->join('types','slots.type_id','=','types.id')
                    ->select('slots.*','grounds.name','weekdays.day','types.type')
                    ->when($day_id, function ($query, $day_id)
                    {return $query->where('day_id', $day_id);})
                    ->when($ground_id, function ($query, $ground_id)
                    {return $query->where('ground_id', $ground_id);})
                    ->when($type_id, function ($query, $type_id)
                    {return $query->where('type_id', $type_id);})
                    ->where('slots.start', 'like', "%{$search}%")
                    ->orwhere('slots.end', 'like', "%{$search}%")
                    ->orwhere('grounds.name', 'like', "%{$search}%")
                    ->orwhere('weekdays.day', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Slot::join('grounds','slots.ground_id','=','grounds.id')
                    ->join('weekdays','slots.day_id','=','weekdays.id','types.type')
                    ->join('types','slots.type_id','=','types.id')
                    ->when($day_id, function ($query, $day_id)
                    {return $query->where('day_id', $day_id);})
                    ->when($ground_id, function ($query, $ground_id)
                    {return $query->where('ground_id', $ground_id);})
                    ->when($type_id, function ($query, $type_id)
                    {return $query->where('type_id', $type_id);})
                    ->where('slots.start', 'like', "%{$search}%")
                    ->orwhere('slots.end', 'like', "%{$search}%")
                    ->orwhere('grounds.name', 'like', "%{$search}%")
                    ->orwhere('weekdays.day', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['day'] = $r->day;
            $nestedData['duration'] = date( "h:i A", strtotime($r->start)). '-' .date( "h:i A", strtotime($r->end));
            $nestedData['typ'] = $r->type;
            $nestedData['price'] = $r->price;
            $nestedData['grnd'] = $r->name;
            $nestedData['sts']=($r->status==1)?
                '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                    <input type="checkbox" class="custom-control-input changests" data-sid="'.$r->slot_id.'" id="'.$r->slot_id.'" checked>
                    <label class="custom-control-label" for="'.$r->slot_id.'">
                        <span class="switch-text-left" style="color: white;">On</span>
                        <span class="switch-text-right" style="color: white;">Off</span>
                    </label>
                </div>':
                '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">          
                    <input type="checkbox" class="custom-control-input changests" data-sid="'.$r->slot_id.'" id="'.$r->slot_id.'">
                    <label class="custom-control-label" for="'.$r->slot_id.'">
                        <span class="switch-text-left" style="color: white;">On</span>
                        <span class="switch-text-right" style="color: white;">Off</span>
                    </label>
                </div>';

//            $nestedData['sts']=($r->status==1)?'<div class="badge  badge-pill badge-success mr-1 badge-glow mb-1"><i class="feather icon-check"></i><span>Active</span></div>':
//                '<div class="badge badge-pill  badge-danger mr-1 badge-glow mb-1"><i class="feather icon-x"></i><span>Active</span></div>';
            $nestedData['action'] = '<a class="editmdl" data-sid="'.$r->slot_id.'" data-start="'.$r->start.'" data-end="'.$r->end.'" data-price="'.$r->price.'" data-dayid="'.$r->day_id.'" data-typid="'.$r->type_id.'" data-gid="'.$r->ground_id.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>'.
                    '<div class="badge badge-primary" >
                                            <a href="#" class="pickmdl" data-sid="'.$r->slot_id.'" data-did="'.$r->day_id.'" style="padding: 4px;">
                                                <i class="feather icon-link"></i>
                                             
                                            </a>
                                        </div>';
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
    


//  
//        $list = array();
//        $event = array();
//        
//        
//        $arr_days = array();
//        $date_from = strtotime('2019-10-01'.'+1');
//        $date_to = strtotime('2019-10-30');
//        
//        $day_passed  = (($date_to - $date_from)/86400);
//        $counter = 1;
//        $day_to_display = $date_from;
//        while($counter < $day_passed)
//        {
//            $day_to_display += 86400;
//            $arr_days[] = date('o-m-d',$day_to_display);
//            $counter++;
//        }
//        foreach($arr_days as $d)
//        {
//            $cd = date('D', strtotime($d));
//            echo $d.'-'.$cd.'<br>';
//            $exists = DB::table('weekdays')->where('code',$cd)->where('sts',1)->exists();
//            if($exists)
//            {
//                echo $d.'-'.$cd.'days active'.'<br>';
//                $active_slots = DB::table('weekdays')
//                        ->join('slots','weekdays.id','=','slots.day_id')
//                        ->where('weekdays.code',$cd)
//                        ->where('slots.status',1)
//                        ->get();
//                print_r($active_slots);
//                foreach($active_slots as $key =>$value)
//                {
//                    $is_booked = DB::table('tbl_booking')->where('time_slot_id',$value->slot_id)
//                            ->whereDate('date','=',$d)->exists();
//                    if($is_booked)
//                    {
//
//                        $event['id'] = $value->id;
//                        $event['title'] = 'Booked';
//                        $event['start'] = $d."T".$value->start;
//                        $event['end'] = $d."T".$value->end;
//                        $event['color'] = '#ff531a';
//                         echo $d.'Booked <br>';
//                        array_push($list, $event);
//                    }else{
//                        $event['id'] = 'null';
//                        $event['title'] = 'Available';
//                        $event['start'] = $d."T".$value->start;
//                        $event['end'] = $d."T".$value->end;
//                        $event['color'] = '#ff531a';
//                        echo $d.'Available <br>';
//                        array_push($list, $event);
//                    }
//                }
//                
//                echo $cd.'<br>';
//            }else{
//                echo $d.'-'.$cd.'days not active'.'<br>';
//            }
//            
//            
//        }
        
        
        
//      return $arr_days;
//        foreach ($arr_days as $d)
//        {
//            $cd = date('D', strtotime($d));
//            $exists = DB::table('weekdays')->where('code',$cd)->where('sts',1)->exists();
//            if($exists)
//            {
//                $available_slots = DB::table('weekdays')->join('slots','weekdays.id','=','slots.day_id')
//                        ->where('weekdays.code',$cd)->get();
//                if($available_slots)
//                {
//                    $lists = DB::table('weekdays')->join('slots','weekdays.id','=','slots.day_id')
//                    ->leftjoin('tbl_booking','tbl_booking.time_slot_id','=','slots.slot_id')
//                    ->select('tbl_booking.id','slots.start','slots.end','tbl_booking.date')
//                    ->where('weekdays.code',$cd)
//                    ->whereDate('tbl_booking.date',$d)
//                    ->where('slots.status',1)
//                    ->get();
//                    print_r($lists);
//                    echo '<yes>';
//                }
                
//                    $lists = DB::table('weekdays')->join('slots','weekdays.id','=','slots.day_id')
//                    ->leftjoin('tbl_booking','tbl_booking.time_slot_id','=','slots.slot_id')
//                    ->select('tbl_booking.id','slots.start','slots.end','tbl_booking.date')
//                    ->where('weekdays.code',$cd)
//                    ->whereDate('tbl_booking.date',$d)
//                    ->where('slots.status',1)
//                    ->get();
//                    print_r($lists);
//                    echo '<br>';

//                if(!empty($lists))
//                {
//                    
//                    foreach ($lists as $li)
//                    {
//                        $event['id'] = $li->id;
//                        $event['title'] = 'Booked';
//                        $event['start'] = $d."T".$li->start;
//                        $event['end'] = $d."T".$li->end;
//                        $event['color'] = '#ff531a';
//                    }
//                }
//                
                
//                foreach ($lists as $li)
//                {
//                    $event['id'] = ($lists>date!="")?$lists->id:'';
//                    $event['title'] = ($lists>date!="")?'Booked':'Available';
//                    $event['start'] = $d."T".$lists->start;
//                    $event['end'] = $d."T".$lists->end;
//                    $event['color'] = ($lists>date!="")?'#009900':'#ff531a';
//                }
                
//                $event['id'] = $lists->id;
//                $event['title'] = ($lists>date)?'Booked':'Available';
//                $event['start'] = $d."T".$lists->start;
//                $event['end'] = $d."T".$lists->end;
//                $event['color'] = ($lists>date)?'#009900':'#ff531a';
//            }else{
//                echo $cd.'-inactive';echo '<br>';
//            }
//        }
//        print_r($list);
        

//        $day  = 0;
//        $days = array('Saturday','Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday');
//        echo date('Dd', strtotime('2019-10-23'));
        

    public function loadEventbackup(Request $request)
    {
//        $event = array();
//        $result=DB::table('tbl_booking')
//                ->join('slots','slots.slot_id','=','tbl_booking.time_slot_id')
//                ->select('tbl_booking.date','slots.start','slots.end','tbl_booking.id')
//                ->whereBetween('tbl_booking.date', [$request->start, $request->end])
//                ->get();
//        foreach ($result as $key =>$value) 
//        {
//            $event[$key]['id'] = $value->id;
//            $event[$key]['title'] = $value->date;
//            $event[$key]['start'] = $value->date."T".$value->start;
//            $event[$key]['end'] = $value->date."T".$value->end;
//        }
        return response()->json($event);
        $arr_days = array();
        $date_from = strtotime($request->start.'+1');
        $date_to = strtotime($request->end);
        $day_passed = (($date_to - $date_from)/86400);
        $counter = 1;
        $day_to_display = $date_from;
        while($counter < $day_passed){
            $day_to_display += 86400;
            //echo date("F j, Y \n", $day_to_display);
            $arr_days[] = date('o-m-d',$day_to_display);
            $counter++;
        }
        $arr_days;
  
    }
    public function loadEvent(Request $request)
    {
        $holidays = array();
        $hs = Holiday::where('status',1)->get();
        foreach ($hs as $h)
        {
            array_push($holidays, $h->holiday);
        }
        
        $arr_days = array();$list = array();$event = array();
        $date_from = strtotime($request->start.'+1');
        $date_to = strtotime($request->end);
        $day_passed = (($date_to - $date_from)/86400);
        $counter = 1;
        $day_to_display = $date_from;
        while($counter < $day_passed)
        {
            $day_to_display += 86400;
            $arr_days[] = date('o-m-d',$day_to_display);
            $counter++;
        }
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
                $exists = DB::table('weekdays')->where('code',$cd)->where('sts',1)->exists();
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
    public function fetchSlot(Request $request)
    {
        $output = '';
        $list = Slot::where('day_id',$request->dayid)->get();
        if(!empty($list)){
            foreach ($list as $li){
               $output .= '<tr>
                            <td>'.date( "h:i A", strtotime($li->start)).'-'.date( "h:i A", strtotime($li->end)).'</td>
                            <td>'.$li->price.'</td>
                        </tr>';
            }
        }else{
            $output.='<tr>
                <td colspan="2">No slot available</td>
            </tr>';
        }
        return $output;
    }
    function getDateList($first, $last, $code, $step = '+1 day', $output_format = 'Y-m-d' )
    {
        $dates = array();
        $start = strtotime($first);
        $end= strtotime($last);
        while( $start <= $end )
        {
            if(date('D', $start)==$code)
            {
                $dates[] = date($output_format, $start);
            }
            $start = strtotime($step, $start); 
        }
        return $dates;
    }
    public function fetchDates(Request $request)
    {
        $code = Weekday::where('id',$request->dayid)->value('code');
        $info = Offer::where('id',$request->offerid)->first();
        $arr_days = $this->getDateList($info->offer_start, $info->offer_end,$code);
        return response()->json($arr_days);
    }
    public function slotStatus(Request $request)
    {
        $slotStatus = Slot::where('slot_id',$request->sid)->value('status');
        $slot= Slot::find($request->sid);
        $slot->status =($slotStatus==1)?0:1;
        $slot->save();
        $notification = array(
                'message' => ($slotStatus==1)?'Slot Inactivated Successfully':'Slot Inactivated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function pickSlot(Request $request)
    {
        $status=0;
        if(!empty($request->datelist)){
            foreach ($request->datelist as $dt)
            {
                $od = new Offerdetail;
                $od->offer_id = $request->offer_id;
                $od->slot_id = $request->slotid;
                $od->offer_date = $dt;
                $od->save();
            }
            $status=1;
        }
        $notification = array(
                'message' => ($status==1)?'offer Actived Successfully':'must select a date',
                'type' => ($status==1)?'success':'warning'
            );
        return Response::json($notification);
    }
    public function checkStart(Request $request)
    {
        $slotid = $request->slotid;
        $from = date("H:i:s", strtotime($request->startTime));
//        $to = date("H:i:s", strtotime($request->endTime));
        $start_exists = Slot::whereRaw("TIME(start) <= ? AND TIME(end) > ?", array($from, $from))   
                        ->where('day_id', $request->dayId)
                        ->when($slotid, function ($query, $slotid)
                        {return $query->where('slot_id','!=',$slotid);})
                        ->exists();
        ($start_exists)?$data["error"]= 'Time Not Available':$data["success"]= 'Time Available';
        
        return $data;
    }
    public function checkEnd(Request $request)
    {
//        $from = date("H:i:s", strtotime($request->startTime));
        $slotid = $request->slotid;
        $to = date("H:i:s", strtotime($request->endTime));
        $end_exists = Slot::whereRaw("TIME(start) < ? AND TIME(end) >= ?", array($to, $to))
                    ->where('day_id', $request->dayId)
                    ->when($slotid, function ($query, $slotid)
                    {return $query->where('slot_id','!=',$slotid);})
                    ->exists();
        ($end_exists)?$data["error"]= 'Time Not Available':$data["success"]= 'Time Available';
        return $data;
    }
    public function getAvailableSlot(Request $request)
    {
        $cart = array();$holidays = array();
        foreach (Cart::content() as $cv)
        {
            array_push($cart, $cv->name);
        }
        $hs = Holiday::where('status',1)->get();
        foreach ($hs as $h)
        {
            array_push($holidays, $h->holiday);
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
                        ->where('weekdays.code',$week)->where('slots.status',1)->get();
            $i=1;
            foreach($active_slots as $value)
            {
                $is_booked = DB::table('bookdetails')->where('slot_id',$value->slot_id)
                        ->whereDate('slot_date','=',$request->date)->exists();
                $duration = date( "h:i A", strtotime($value->start)).'-'.date( "h:i A", strtotime($value->end));
                if($is_booked)
                {
                    $output .= '<tr class="table-danger">
                                <th scope="row">'.$i.'</th>
                                <td>'.$duration.'</td>
                                <td>Booked</td>
                                <td>
                                    <div class="vs-checkbox-con vs-checkbox-danger">
                                        <input type="checkbox"  checked disabled>
                                        <span class="vs-checkbox">
                                            <span class="vs-checkbox--check">
                                                <i class="vs-icon feather icon-check"></i>
                                            </span>
                                        </span>
                                    </div>
                                </td>
                            </tr>';
                }else{
                    $output .= (in_array($request->date.$value->slot_id, $cart))?
                            
                            '<tr class="table-light">
                                <th scope="row">'.$i.'</th>
                                <td>'.$duration.'</td>
                                <td><span class="badge badge-pill badge-glow bg-success float-left">checked</span></td>
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
                            </tr>':
                        '<tr class="table-light">
                                <th scope="row">'.$i.'</th>
                                <td>'.$duration.'</td>
                                <td>Available</td>
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
                $i++;
            }
        }
        $output .= '</tbody></table></div>';
    }
        
        return $output;
    }
    
    public function addCart(Request $request)
    {
        Cart::add(['id' => $request->date.$request->slot_id, 
                  'name' => $request->date.$request->slot_id, 'qty' => 1, 'price' => 500, 'weight' => 550, 
            'options' => ['date' => $request->date,'slot' => $request->slot_id,'price' => $request->price,'time' => $request->time]]);
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
                'message' => 'Added The Slot From Cart',
                'type' => 'success'
            );
        return $notify;
    }
    public function delCart(Request $request)
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
    
    //*****************************Week Type********************************
    public function getWeekTyp()
    {
        $data = array();
//        $data['weekdays'] = Weekday::get();
        $data['types'] = Type::get();
        $data['title'] = 'Weeks & Pricing Management';
        
        $data['weekdays'] = Weekday::select('weekdays.day','weekdays.id','weekdays.sts',DB::raw("(SELECT count(slots.slot_id) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as total_slot"),DB::raw("(SELECT MIN(slots.start) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as start"),DB::raw("(SELECT MAX(slots.end) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as end")
                )->get();
        return view('admin.pages.slot.week_pricing',$data);
    }
    public function weekStatus(Request $request)
    {
        $weekStatus = Weekday::where('id',$request->wid)->value('sts');
        $week= Weekday::find($request->wid);
        $week->sts =($weekStatus==1)?0:1;
        $week->save();
        $weekdays = Weekday::select('weekdays.day','weekdays.id','weekdays.sts',DB::raw("(SELECT count(slots.slot_id) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as total_slot"),DB::raw("(SELECT MIN(slots.start) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as start"),DB::raw("(SELECT MAX(slots.end) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as end"))->get();
        $output='';
        foreach($weekdays  as $w)
        {                  
                            $output.='<tr>
                                    <td>'.$w->day.'</td>
                                    <td> <span class="badge badge-pill badge-glow bg-info">'.date( "h:i A", strtotime($w->start)).'</span></td>
                                    <td> <span class="badge badge-pill badge-glow bg-info">'.date( "h:i A", strtotime($w->end)).'</span></td>
                                    <td> <span class="badge badge-pill badge-glow bg-primary">'.$w->total_slot.'</span></td>
                                    <td>';         
                            $output.=($w->sts==1)?
                                    '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                                        <input type="checkbox" class="custom-control-input changests" data-wid="'.$w->id.'" id="'.$w->id.'" checked>
                                        <label class="custom-control-label" for="'.$w->id.'">
                                            <span class="switch-text-left" style="color: white;">On</span>
                                            <span class="switch-text-right" style="color: white;">Off</span>
                                        </label>
                                    </div>':
                               '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                                                <input type="checkbox" class="custom-control-input changests" data-wid="'.$w->id.'" id="'.$w->id.'">
                                                <label class="custom-control-label" for="'.$w->id.'">
                                                    <span class="switch-text-left" style="color: white;">On</span>
                                                    <span class="switch-text-right" style="color: white;">Off</span>
                                                </label>
                                            </div>';
                            $output.='</td>                    
                                </tr>';
            }
        $notification = array(
                'output' => $output, 
                'message' => ($weekStatus==1)?'Weekday Inactivated':'Weekday Aactivated',
                'type' => ($weekStatus==1)?'warning':'success'
            );
        return Response::json($notification); 
    }
    public function countSlot(Request $request) 
    {
        $day= $request->day;
        $grnd=$request->grnd;
        $typ=$request->typ;
        $total= Slot::when($day, function ($query, $day){return $query->where('day_id',$day);})
        ->when($grnd, function ($query, $grnd){return $query->where('ground_id',$grnd);})
        ->when($typ, function ($query, $typ){return $query->where('type_id',$typ);})
        ->count();
        return number_format($total);
    }
    
    
    
    //*****************************Full Day********************************
    public function showFday() 
    {
        $data = array();
        $data['slots'] = Slot::get();
        $data['grounds'] = Ground::get();
        $data['title'] = 'Full Day Setting';
        return view('admin.pages.slot.fullday',$data);
    }
    public function getFday(Request $request) 
    {
        $columns = array(0 =>'date',1=> 'price',2=> 'details',3=> 'ground_id',4=> 'status',5=> 'action');
        $totalData = Fullday::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Fullday::join('grounds','fulldays.ground_id','=','grounds.id')
                    ->select('fulldays.*','grounds.name')
                    ->offset($start)->limit($limit)
                    ->orderBy($order,$dir)->get();
            $totalFiltered =  Fullday::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Fullday::join('grounds','fulldays.ground_id','=','grounds.id')
                    ->select('fulldays.*','grounds.name')
                    ->where('fulldays.date', 'like', "%{$search}%")
                    ->orwhere('fulldays.price', 'like', "%{$search}%")
                    ->orwhere('fulldays.details', 'like', "%{$search}%")
                    ->orwhere('grounds.name', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Fullday::join('grounds','fulldays.ground_id','=','grounds.id')
                    ->where('fulldays.date', 'like', "%{$search}%")
                    ->orwhere('fulldays.price', 'like', "%{$search}%")
                    ->orwhere('fulldays.details', 'like', "%{$search}%")
                    ->orwhere('grounds.name', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['date'] = date('D ,d M Y', strtotime($r->date));
            $nestedData['price'] = $r->price;
            $nestedData['details'] = $r->details;
            $nestedData['ground'] = $r->name;
            $nestedData['sts']=($r->status==1)?'<div class="badge  badge-pill badge-success mr-1 badge-glow mb-1"><i class="feather icon-check"></i><span>Active</span></div>':
                '<div class="badge badge-pill  badge-danger mr-1 badge-glow mb-1"><i class="feather icon-x"></i><span>Active</span></div>';
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->address.'" data-eml="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" style="padding: 4px;"><i class="ficon feather icon-trash danger"></i></a>';
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
    public function saveFday(Request $request)
    {
        $offer =  new Fullday;
        $offer->date = $request->date;
        $offer->details = $request->details;
        $offer->price = $request->price;
        $offer->ground_id = $request->ground_id;
        $offer->created_by = Auth::guard('admin')->user()->id;
        $offer->save();
        $notification = array(
                'message' => 'Full Day Set Successfully',
                'type' => 'success'
            );
        return Response::json($notification);
    }
    //*****************************Drop In*********************************
    public function showDropIn() 
    {
        $data = array();
        $data['slots'] = Slot::get();
        $data['days'] = Weekday::get();
        $data['grounds'] = Ground::get();
        $data['title'] = 'Drop In Slot Setting';
        return view('admin.pages.slot.dropin',$data);
    }
    public function fetchDropSlot(Request $request)
    {
        $dcode =  date('D', strtotime($request->date));
        $dayid = Weekday::where('code',$dcode)->value('id');
        $data=Slot::select('slot_id','start','end')
            ->where('day_id',$dayid)
            ->orderBy('start', 'asc')->get();

        return response()->json($data);
    }
    public function saveDropIn(Request $request)
    {
        $dropin =  new Dropin;
        $dropin->date = $request->date;
        $dropin->ground_id = $request->ground_id;
        $dropin->slot_id = $request->slot_id;
        $dropin->seat = $request->seat;
        $dropin->price = $request->price;
        $dropin->created_by = Auth::guard('admin')->user()->id;
        $dropin->save();
        $notification = array(
                'message' => 'Drop In Slot Created Successfully',
                'type' => 'success'
            );
        return Response::json($notification);
    }
    public function getDropIn(Request $request) 
    {
        $columns = array(0 =>'date',1=> 'slot_id',2=> 'price',3=> 'seat',4=> 'taken',5=> 'ground_id',6=>'status'
        );
        $totalData = Dropin::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Dropin::join('slots','dropins.slot_id','=','slots.slot_id')
                    ->join('grounds','dropins.ground_id','=','grounds.id')
                    ->select('dropins.*','grounds.name','slots.start','slots.end',DB::raw("(SELECT count(bookdetails.id) FROM bookdetails WHERE "
                            . "bookdetails.`slot_id`=dropins.`slot_id` AND bookdetails.`slot_date`=dropins.`date`) as booked"))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Dropin::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Dropin::join('slots','dropins.slot_id','=','slots.slot_id')
                    ->join('grounds','dropins.ground_id','=','grounds.id')
                    ->select('dropins.*','grounds.name','slots.start','slots.end',
                            DB::raw("(SELECT count(bookdetails.id) FROM bookdetails WHERE "
                            . "bookdetails.`slot_id`=dropins.`slot_id` AND bookdetails.`slot_date`=dropins.`date`) as booked"))
                    ->where('dropins.date', 'like', "%{$search}%")
                    ->where('grounds.name', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Dropin::join('grounds','dropins.ground_id','=','grounds.id')
                    ->where('dropins.date', 'like', "%{$search}%")
                    ->where('grounds.name', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['date'] = date('D ,d M Y', strtotime($r->date));
            $nestedData['slot'] = date('h:ia', strtotime($r->start)).'-'.date('h:ia', strtotime($r->end));
            $nestedData['price'] = $r->price;
            $nestedData['person'] = $r->seat;
            $nestedData['taken'] = $r->booked;
            $nestedData['details'] = $r->details;
            $nestedData['name'] = $r->name;
            $nestedData['sts']=($r->status==1)?'<div class="badge  badge-pill badge-success mr-1 badge-glow mb-1"><i class="feather icon-check"></i><span>Active</span></div>':
                '<div class="badge badge-pill  badge-danger mr-1 badge-glow mb-1"><i class="feather icon-x"></i><span>Active</span></div>';
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->address.'" data-eml="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" style="padding: 4px;"><i class="ficon feather icon-trash danger"></i></a>';
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
    
    
    
}
