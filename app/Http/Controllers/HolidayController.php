<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Ground;
use Jaff\Holiday;
use Auth;
use DB;
use Response;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function holidayList() 
    {
        $data = array();
        $data['grounds'] = Ground::get();
        $data['title'] = 'Holiday Management';
        return view('admin.pages.slot.holiday',$data);
    }
    public function getHoliday(Request $request) 
    {
        $from= $request->from;$to=$request->to;
        $columns = array(0 =>'holiday',1=> 'details',2=> 'ground_id',3=> 'status',4=> 'action'
        );
        $totalData = Holiday::when($from, function ($query, $from){return $query->whereDate('holiday','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('holiday','<=',$to);})->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Holiday::join('grounds','holidays.ground_id','=','grounds.id')
                    ->when($from, function ($query, $from){return $query->whereDate('holidays.holiday','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('holidays.holiday','<=',$to);})
                    ->select('holidays.*','grounds.name',DB::raw('grounds.id as gid'))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Holiday::when($from, function ($query, $from){return $query->whereDate('holiday','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('holiday','<=',$to);})->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Holiday::join('grounds','holidays.ground_id','=','grounds.id')
                    ->when($from, function ($query, $from){return $query->whereDate('holidays.holiday','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('holidays.holiday','<=',$to);})
                    ->select('holidays.*','grounds.name',DB::raw('grounds.id as gid'))
                    ->where('grounds.name', 'like', "%{$search}%")
                    ->orwhere('holidays.holiday', 'like', "%{$search}%")
                    ->orwhere('holidays.details', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Holiday::join('grounds','holidays.ground_id','=','grounds.id')
                    ->when($from, function ($query, $from){return $query->whereDate('holidays.holiday','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('holidays.holiday','<=',$to);})
                    ->where('grounds.name', 'like', "%{$search}%")
                    ->orwhere('holidays.holiday', 'like', "%{$search}%")
                    ->orwhere('holidays.details', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['hldy'] = $r->holiday;
            $nestedData['dtl'] = $r->details;
            $nestedData['grnd'] = $r->name;
            $nestedData['sts']=($r->status==1)?
                '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                    <input type="checkbox" class="custom-control-input changests" data-hid="'.$r->id.'" id="'.$r->id.'" checked>
                    <label class="custom-control-label" for="'.$r->id.'">
                        <span class="switch-text-left" style="color: white;">On</span>
                        <span class="switch-text-right" style="color: white;">Off</span>
                    </label>
                </div>':
                '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">          
                    <input type="checkbox" class="custom-control-input changests" data-hid="'.$r->id.'" id="'.$r->id.'">
                    <label class="custom-control-label" for="'.$r->id.'">
                        <span class="switch-text-left" style="color: white;">On</span>
                        <span class="switch-text-right" style="color: white;">Off</span>
                    </label>
                </div>';

            $nestedData['action'] = '<a class="editmdl" data-hid="'.$r->id.'" data-hday="'.$r->holiday.'" data-gid="'.$r->gid.'" data-hdtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delhid="'.$r->id.'" data-ttl="'.$r->holiday.'" style="padding: 4px;"><i class="ficon feather icon-trash danger"></i></a>';
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
    public function saveHoliday(Request $request)
    {
        $holiday =  new Holiday;
        $holiday->holiday = $request->holiday;
        $holiday->details = $request->details;
        $holiday->ground_id = $request->ground_id;
        $holiday->created_by = Auth::guard('admin')->user()->id;
        $holiday->save();
        $notification = array(
                'message' => 'Holiday saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification);
    }
    public function countHoliday(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        $total= Holiday::when($from, function ($query, $from){return $query->whereDate('holiday','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('holiday','<=',$to);})
        ->count();
        return number_format($total);
    }
    public function updateHoliday(Request $request)
    {
        $holiday = Holiday::find($request->hid);
        $holiday->holiday= $request->uholiday;
        $holiday->details= $request->udetails;
        $holiday->ground_id = $request->uground_id;
        $holiday->save();
        $notification = array(
                 'message' => 'Holiday Updated Successfully',
                 'type' => 'success'
             );
        return Response::json($notification);
    }
    public function deleteHoliday(Request $request)
    {
        $holiday = Holiday::find($request->delhid);
        $holiday->delete();
        $notification = array(
                 'message' => 'Holiday Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function stsHoliday(Request $request)
    {
        $slotStatus = Holiday::where('id',$request->hid)->value('status');
        $slot= Holiday::find($request->hid);
        $slot->status =($slotStatus==1)?0:1;
        $slot->save();
        $notification = array(
                'message' => ($slotStatus==1)?'Holiday Inactivated Successfully':'Holiday Activated Successfully',
                'type' => ($slotStatus==1)?'warning':'success'
            );
        return Response::json($notification);
    }}
