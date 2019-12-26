<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Course;
use Jaff\Coach;
use Jaff\Slot;
use Jaff\Schedule;
use Jaff\User;
use Jaff\Assign;
use Jaff\Weekday;
use Jaff\PayCourse;
use Response;
use Auth;
use DB;
class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function courseList() 
    {
        $data = array();
        $data['coaches'] = Coach::get();
        $data['title'] = 'Course Management';
        return view('admin.pages.course.courses',$data);
    }
    public function getCourse(Request $request) 
    {
        $columns = array(0 =>'title',1=> 'coach_id',2=> 'price',3=> 'seat',4=> 'admit',5=> 'batch',6=> 'details',7=> 'status',8=> 'action');
        $totalData = Course::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Course::leftJoin('coaches','courses.coach_id','=','coaches.id')
                    ->select('courses.*','coaches.name',DB::raw('(SELECT SUM(assigns.course_id) FROM assigns WHERE assigns.course_id = courses.id) as total'))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Course::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Course::leftJoin('coaches','courses.coach_id','=','coaches.id')
                    ->select('courses.*','coaches.name',DB::raw('(SELECT SUM(assigns.course_id) FROM assigns WHERE assigns.course_id = courses.id) as total'))
                    ->where('courses.title', 'like', "%{$search}%")
                    ->orwhere('coaches.name','like',"%{$search}")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Course::leftJoin('coaches','courses.coach_id','=','coaches.id')
                            ->select('courses.*','coaches.name')
                            ->orwhere('courses.title', 'like', "%{$search}%")
                            ->orwhere('coaches.name','like',"%{$search}")
                            ->count();
        }
    $data = array();

    if($posts)
    {
        foreach($posts as $r)
        {     
            $nestedData['title'] = $r->title;
            $nestedData['coach'] = $r->name;        
            $nestedData['batch'] = $r->batch;
            $nestedData['price'] = $r->price;
            $nestedData['details'] = $r->details;
            $nestedData['seat'] = $r->seat;
            $nestedData['admit'] = $r->total;
            if( $r->status==0){
                $status = '<div class="btn-group"><div class="badge badge-warning dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Inactive</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="1" href="#">Active</a></div>
                </div>
                 </div>';
            }else{
                $status = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="0" href="#">Inactive</a></div>
                </div>
                </div>';
            }
            $nestedData['status'] = $status;
            $nestedData['action'] = '<a href="#" class="editmdl" data-id="'.$r->id.'" data-title="'.$r->title.'"'
                    . ' data-coachid="'.$r->coach_id.'" data-price="'.$r->price.'" data-seat="'.$r->seat.'" data-batch="'.$r->batch.'" data-dtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>'
                    ;
            
            $data[] = $nestedData;
        }
    }     
        $json_data = array(
            "draw"        => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"        => $data
        );
        echo json_encode($json_data);    
    }
    public function saveCourse(Request $request) {
        $course = new Course;
        $course->coach_id= $request->coach_id;
        $course->title= $request->title;
        $course->price = $request->price;
        $course->details= $request->details;
        $course->seat= $request->seat;
        $course->batch = $request->batch;
        $course->created_by = Auth::guard('admin')->user()->id;
        $course->save();
        $notification = array(
                'message' => 'Course Added Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function updateCourse(Request $request)
    {
        $course = Course::find($request->courid);
        $course->coach_id= $request->ucoach_id;
        $course->title= $request->utitle;
        $course->price = $request->uprice;
        $course->details= $request->udetails;
        $course->seat= $request->useat;
        $course->batch = $request->ubatch;
        $course->updated_by = Auth::guard('admin')->user()->id;
        $course->save();
        $notification = array(
                'message' => 'Course Updated Successfully',
                'type' => 'warning'
        );
        return Response::json($notification); 
    }
    public function deleteCourse(Request $request)
    {
        $course = Course::find($request->delid);
        $course->delete();
        $notification = array(
                 'message' => 'Course Info Deleted',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusCourse(Request $request)
    {
        $course= Course::find($request->sid);
        $course->status = $request->sts;
        $course->save();
        $notification = array(
                'message' => ($request->status==1)?'Status Activated':'Status Disabled',
                'type' => ($request->status==1)?'success':'warning',
            );
        return Response::json($notification); 
    }
    //==========================================================================
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
    public function scheduleList()
    {
        $data = array();
        $data['courses'] = Course::get();
        $data['slots'] = Slot::join('weekdays','slots.day_id','=','weekdays.id')
                ->select('slots.*','weekdays.day')->get();
        $data['title'] = 'Academy Course Schedules';
        return view('admin.pages.course.schedules',$data);
    }
    public function saveSchedule(Request $request)
    {
        $code = Slot::join('weekdays','weekdays.id','=','slots.day_id')->where('slots.slot_id',$request->slot_id)->first();
        $arr_days = $this->getDateList($request->from_date, $request->to_date,$code->code);
        foreach($arr_days as $date)
        {
            $sch  = new Schedule;
            $sch->course_id = $request->course_id;
            $sch->slot_id = $request->slot_id;
            $sch->date = $date;
            $sch->created_by = Auth::guard('admin')->user()->id;
            $sch->save();
        }
        $notification = array(
                'message' => 'Course Schedule Added Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function getDaylist(Request $request)
    {
        $code = date('D', strtotime($request->udate));
        $dayid = Weekday::where('code',$code)->value('id');
        $data= Slot::select('slot_id','start','end')->where('day_id',$dayid)->orderBy('start', 'asc')->get();
        return response()->json($data);
    }
    public function updateschedule(Request $request)
    {
        $sch  = Schedule::find($request->schid);
        $sch->course_id = $request->ucourse_id;
        $sch->date = $request->udate;
        $sch->slot_id = $request->uslot_id;
        $sch->updated_by = Auth::guard('admin')->user()->id;
        $sch->save();
        $notification = array(
                'message' => 'Course Schedule Updated Successfully',
                'type' => 'warning'
        );
        return Response::json($notification); 
    }
    public function getSchedule(Request $request) 
    {
        $columns = array(0 =>'title',1=> 'name',2=> 'date',3=> 'start',4=> 'status',5=> 'action');
        $totalData = Schedule::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Schedule::join('courses','courses.id','=','schedules.course_id')
                    ->join('coaches','coaches.id','=','courses.coach_id')
                    ->join('slots','slots.slot_id','=','schedules.slot_id')
                    ->select('schedules.*','coaches.name','courses.title','slots.start','slots.end')
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Schedule::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Schedule::join('courses','courses.id','=','schedules.course_id')
                    ->join('coaches','coaches.id','=','courses.coach_id')
                    ->join('slots','slots.slot_id','=','schedules.slot_id')
                    ->select('schedules.*','coaches.name','courses.title','slots.start','slots.end')
                    ->where('courses.title', 'like', "%{$search}%")
                    ->orwhere('coaches.name','like',"%{$search}")
                    ->orwhere('schedules.date','like',"%{$search}")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Schedule::join('courses','courses.id','=','schedules.course_id')
                            ->join('coaches','coaches.id','=','courses.coach_id')
                            ->join('slots','slots.slot_id','=','schedules.slot_id')
                            ->where('courses.title', 'like', "%{$search}%")
                            ->orwhere('coaches.name','like',"%{$search}")
                            ->orwhere('schedules.date','like',"%{$search}")
                            ->count();
        }
    $data = array();

    if($posts)
    {
        foreach($posts as $r)
        {     
            
            $nestedData['title'] = $r->title;
            $nestedData['name'] = $r->name;
            $nestedData['sch'] = date('D, d M Y', strtotime($r->date));
            $nestedData['duration'] = date('h:ia', strtotime($r->start)).'-'.date('h:ia', strtotime($r->end));
            
            if( $r->status==0){
                $status = '<div class="btn-group"><div class="badge badge-warning dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Inactive</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="1" href="#">Active</a></div>
                </div>
                 </div>';
            }else{
                $status = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="0" href="#">Inactive</a></div>
                </div>
                </div>';
            }
            $nestedData['status'] = $status;
            $nestedData['action'] = '<a href="#" class="editmdl" data-id="'.$r->id.'" data-date="'.$r->date.'"'
                    . ' data-slot="'.$r->slot_id.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>'
                    ;
            $data[] = $nestedData;
        }
    }     
        $json_data = array(
            "draw"        => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"        => $data
        );
        echo json_encode($json_data);    
    }
    public function statusSchedule(Request $request)
    {
        $course= Schedule::find($request->sid);
        $course->status = $request->sts;
        $course->save();
        $notification = array(
                'message' => ($request->status==1)?'Status Activated':'Status Disabled',
                'type' => ($request->status==1)?'success':'warning',
            );
        return Response::json($notification); 
    }
    public function deleteschedule(Request $request)
    {
        $sch= Schedule::find($request->delid);
        $sch->delete();
        $notification = array(
                'message' => 'Course Schedule Deleted',
                'type' => 'error'
        );
        return Response::json($notification); 
    }
    
    //==========================================================================
    public function userCourse()
    {
        $data = array();
        $data['courses'] = Course::get();
        $data['users'] = User::get();
        $data['title'] = 'Assign Course To User';
        return view('admin.pages.course.course_user',$data);
    }
    public function getPrice(Request $request)
    {
        $price = Course::where('id',$request->course_id)->value('price');
        return $price;
    }
    public function saveAssign(Request $request)
    {
        $assign = new Assign;
        $assign->user_id = $request->user_id;
        $assign->course_id = $request->course_id;
        $assign->price = $request->price;
        $assign->discount = $request->discount;
        $assign->details = $request->details;
        $assign->created_by =Auth::guard('admin')->user()->id;
        $assign->save();
        $cid =$assign->id;
        if($cid < 10)
        {
            $code = "JCS000".$cid;
        } else if ($cid < 100){
            $code = "JCS00".$cid;
        } else if($cid < 1000){
            $code = "JCS0".$cid;
        }else {
            $code = "JCS".$cid;
        }
        $umem = Assign::find($cid);
        $umem->code = $code;
        $umem->save();
        
        $notification = array(
                'message' => 'Course Assigned Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function updateAssign(Request $request)
    {
        $assign = Assign::find($request->assign_id);
        $assign->user_id = $request->uuser_id;
        $assign->course_id = $request->ucourse_id;
        $assign->price = $request->uprice;
        $assign->discount = $request->udiscount;
        $assign->details = $request->udetails;
        $assign->updated_by =Auth::guard('admin')->user()->id;
        $assign->save();
        $notification = array(
                'message' => 'Updated Successfully',
                'type' => 'warning'
        );
        return Response::json($notification); 
    }
    public function getAssign(Request $request) 
    {
        $columns = array(0 =>'username',1=> 'title',2=> 'discount',3=> 'price',4=> 'details',5=> 'status',6=> 'action');
        $totalData = Assign::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Assign::join('courses','courses.id','=','assigns.course_id')
                    ->join('users','users.id','=','assigns.user_id')
                    ->select('assigns.*','courses.title','users.username','users.phone','users.email'
                      ,DB::raw('(SELECT SUM(pay_courses.amount) FROM pay_courses WHERE pay_courses.assign_id = assigns.id) as paid'))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Assign::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Assign::join('courses','courses.id','=','assigns.course_id')
                    ->join('users','users.id','=','assigns.user_id')
                    ->select('assigns.*','courses.title','users.username','users.phone','users.email',
                            DB::raw('(SELECT SUM(pay_courses.amount) FROM pay_courses WHERE pay_courses.assign_id = assigns.id) as paid'))
                    ->where('courses.title', 'like', "%{$search}%")
                    ->orwhere('assigns.price','like',"%{$search}")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered =  Assign::join('courses','courses.id','=','assigns.course_id')
                            ->join('users','users.id','=','assigns.user_id')
                            ->where('courses.title', 'like', "%{$search}%")
                            ->orwhere('assigns.price','like',"%{$search}")
                            ->count();
        }
    $data = array();

    if($posts)
    {
        foreach($posts as $r)
        {     
            $due=$r->price-$r->paid;
            $nestedData['user'] = 'Name: '.$r->username.'<br>Phone:'.$r->phone.'<br>Email:'.$r->email;
            $nestedData['info'] = 'Title: '.$r->title.'<br>Price: <b>'.(100*$r->price)/(100-$r->discount).'</b><br>Discount: <b>'.$r->discount.'</b>%';
            $nestedData['payment'] = 'Amount: '.$r->price.'<br>Paid:'.$r->paid.'<br>Due: <b>'.$due.'</b>';
            $nestedData['details'] = $r->details;
            $nestedData['date'] = date('D, d M Y', strtotime($r->created_at));
            
            if( $r->status==0){
                $status = '<div class="badge badge-danger">Due</div>';
            }else if($r->status==1){
                $status = '<div class="badge badge-success">Paid</div>';
            }else{
                $status = '<div class="badge badge-warning">Partial</div>';
            }
            $nestedData['status'] = $status;
            $action='';
           if($r->paid==0)
           {
               $action .= '<a href="#" class="editmdl" data-id="'.$r->id.'" data-user="'.$r->user_id.'"'
                    . ' data-course="'.$r->course_id.'" data-price="'.$r->price.'" data-dis="'.$r->discount.'" data-dtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>'
                    ;
           }
           
            if($r->status!=1)
            {
              $action .= '<div class="badge badge-primary" >
                    <a href="#" class="paymdl" data-aid="'.$r->id.'" data-amnt="'.$due.'" style="padding: 4px;">pay</a>
                </div>';
            }
            $nestedData['action'] = $action;
            $data[] = $nestedData;
        }
    }     
        $json_data = array(
            "draw"        => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"        => $data
        );
        echo json_encode($json_data);    
    }
    
    public function deleteAssign(Request $request)
    {
        $assign = Assign::find($request->delid);
        $assign->delete();
        $notification = array(
                'message' => 'Assign info deleted',
                'type' => 'error'
        );
        return Response::json($notification); 
    }

}
