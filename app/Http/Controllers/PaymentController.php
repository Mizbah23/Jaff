<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Balance;
use Jaff\Membership;
use Jaff\Member;
use Jaff\Booking;
use Jaff\Bookdetail;
use Jaff\PayMember;
use Jaff\PayCourse;
use Jaff\PayBooking;
use Jaff\Assign;
use Auth;
use Response;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function payMembership(Request $request)
    {
        $info = Membership::join('members','memberships.id','=','members.mid')
                ->select('memberships.duration','memberships.fee')
                ->where('members.id',$request->pid)->first();
        $start_date = $request->pdate;
        $end_date =($info->duration>0)?date('Y-m-d', strtotime("+$info->duration months -1day", strtotime($request->pdate))):null;

        if($request->pamount<=$request->damount)
        {
            $mpay = new PayMember;
            $mpay->member_id = $request->pid;
            $mpay->date = $request->pdate;
            $mpay->amount = $request->pamount;
            $mpay->details = $request->pdetails;
            $mpay->created_by = Auth::guard('admin')->user()->id;
            $mpay->save();
            
            $mem = Member::find($request->pid);
            $mem->start_date = $start_date;
            $mem->end_date = $end_date;
            $mem->ispaid=($request->pamount==$request->damount)?1:2;
            $mem->save();
            
            $msg = 'Membership Payment Done Successfully';
            $typ = 'success';
        }else{
            $msg = 'Payment should not be greater than '.$request->damount;
            $typ = 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
        );
        return Response::json($notification); 
    }
    
    
    public function showMpayment(Request $request)
    {
        $data = array();
        $data['title'] = 'Membership payment List';
        return view('admin.pages.mem.membership_payment',$data);
    }
    public function listMpayment(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        
        $columns = array(0 =>'date',1=> 'code',2=> 'amount',3=> 'details',4=> 'action'
        );
        $totalData = PayMember::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
                    ->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = PayMember::join('members','pay_members.member_id','=','members.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->select('pay_members.*','members.code','memberships.name')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_members.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_members.date','<=',$to);})
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  PayMember::join('members','pay_members.member_id','=','members.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_members.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_members.date','<=',$to);})
                    ->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = PayMember::join('members','pay_members.member_id','=','members.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->select('pay_members.*','members.code','memberships.name')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_members.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_members.date','<=',$to);})
                    ->where('memberships.name', 'like', "%{$search}%")
                    ->orwhere('members.code', 'like', "%{$search}%")
                    ->orwhere('pay_members.date', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = PayMember::join('members','pay_members.member_id','=','members.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_members.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_members.date','<=',$to);})
                    ->where('memberships.name', 'like', "%{$search}%")
                    ->orwhere('members.code', 'like', "%{$search}%")
                    ->orwhere('pay_members.date', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['name'] = $r->name;
            $nestedData['date'] = date('d M,Y', strtotime($r->date));
            $nestedData['code'] = $r->code;
            $nestedData['amount'] = $r->amount;
            $nestedData['details'] = $r->details;
            $action = '<a class="editmdl" data-id="'.$r->id.'" data-dtl="'.$r->details.'" data-amnt="'.$r->amount.'" data-date="'.$r->date.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a class="delmdl" data-delid="'.$r->id.'" data-code="'.$r->code.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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

    public function sumMpayment(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        $total= PayMember::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
        ->sum('amount');
        return number_format($total);
    }
    public function delMpayment(Request $request)
    {
        $del = PayMember::find($request->delid);
        $del->delete();
        $notification = array( 'message' => 'Payment Deleted Successfully','type' => 'error' );
        return Response::json($notification); 
    }
    public function updateMpayment(Request $request)
    {
        $up = PayMember::find($request->pid);
        $up->date = $request->pdate;
        $up->amount = $request->pamount;
        $up->details = $request->pdetails;
        $up->save();
        $notification = array( 'message' => 'Payment Updated Successfully','type' => 'warning' );
        return Response::json($notification); 
    }
    //==============================================================
    public function payBooking(Request $request)
    {
        if($request->pamount<=$request->damount)
        {
            if($request->pamount>0)
            {
                $bpay = new PayBooking;
                $bpay->book_id = $request->pid;
                $bpay->date = $request->pdate;
                $bpay->amount = $request->pamount;
                $bpay->details = $request->pdetails;
                $bpay->created_by = Auth::guard('admin')->user()->id;
                $bpay->save(); 
            }
            $book = Booking::find($request->pid);
            $book->less = ($request->damount==$request->pamount)?$book->less:$book->less+ $request->less;
            $book->status = ($request->due==0)?1:2;
            $book->save();
            
            $msg = 'Booking Payment Done Successfully';
            $typ = 'success';
        }else{
            $msg = 'Amount should not be greater than '.$request->damount;
            $typ = 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
        );
        return Response::json($notification); 
    }
    public function showBpayment(Request $request)
    {
        $data = array();
        $data['title'] = 'Booked Slots Payment List';
        return view('admin.pages.booking.booking_payment',$data);
    }
    public function listBpayment(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        
        $columns = array(0 =>'date',1=> 'book_code',2=> 'amount',3=> 'details',4=> 'action'
        );
        $totalData = PayBooking::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
                    ->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = PayBooking::join('bookings','pay_bookings.book_id','=','bookings.book_id')
                    ->select('pay_bookings.*','bookings.book_code')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  PayBooking::join('bookings','pay_bookings.book_id','=','bookings.book_id')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
                    ->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = PayBooking::join('bookings','pay_bookings.book_id','=','bookings.book_id')
                    ->select('pay_bookings.*','bookings.book_code')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
                    ->orwhere('bookings.book_code', 'like', "%{$search}%")
                    ->orwhere('pay_bookings.date', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = PayBooking::join('bookings','pay_bookings.book_id','=','bookings.book_id')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
                    ->orwhere('bookings.book_code', 'like', "%{$search}%")
                    ->orwhere('pay_bookings.date', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['name'] = $r->name;
            $nestedData['date'] = date('d M,Y', strtotime($r->date));
            $nestedData['code'] = $r->book_code;
            $nestedData['amount'] = $r->amount;
            $nestedData['details'] = $r->details;
            $action = '<a class="editmdl" data-id="'.$r->id.'"  style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a class="delmdl" data-delid="'.$r->id.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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

    public function sumBpayment(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        $total= PayBooking::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
        ->sum('amount');
        return number_format($total);
    }
    //==================================================================
    public function payCourse(Request $request)
    {
        $pc = new PayCourse;
        $pc->assign_id = $request->aid;
        $pc->date = $request->pdate;
        $pc->amount = $request->amount;
        $pc->details = $request->pdetails;
        $pc->created_by =Auth::guard('admin')->user()->id;
        $pc->save();
       
        $upas = Assign::find($request->aid);
        $upas->status = ($request->topay==$request->amount)?1:2;
        $upas->save();
        

        $notification = array(
                'message' => 'Course Payment Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function showCpayment()
    {
        $data = array();
        $data['title'] = 'Course payment List';
        return view('admin.pages.course.course_payment',$data);
    }
    public function listCpayment(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        
        $columns = array(0 =>'date',1=> 'code',2=> 'amount',3=> 'details',4=> 'action'
        );
        $totalData = PayCourse::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
                    ->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = PayCourse::join('assigns','pay_courses.assign_id','=','assigns.id')
                    ->join('courses','courses.id','=','assigns.course_id')
                    ->select('pay_courses.*','assigns.code','courses.title')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_courses.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_courses.date','<=',$to);})
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  PayCourse::join('assigns','pay_courses.assign_id','=','assigns.id')
                    ->join('courses','courses.id','=','assigns.course_id')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_courses.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_courses.date','<=',$to);})
                    ->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = PayCourse::join('assigns','pay_courses.assign_id','=','assigns.id')
                    ->join('courses','courses.id','=','assigns.course_id')
                    ->select('pay_courses.*','assigns.code','courses.title')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_courses.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_courses.date','<=',$to);})
                    ->where('courses.title', 'like', "%{$search}%")
                    ->orwhere('assigns.code', 'like', "%{$search}%")
                    ->orwhere('pay_courses.date', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = PayCourse::join('assigns','pay_courses.assign_id','=','assigns.id')
                    ->join('courses','courses.id','=','assigns.course_id')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_courses.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_courses.date','<=',$to);})
                    ->where('courses.title', 'like', "%{$search}%")
                    ->orwhere('assigns.code', 'like', "%{$search}%")
                    ->orwhere('pay_courses.date', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['date'] = date('d M,Y', strtotime($r->date));
            $nestedData['code'] = $r->code;
            $nestedData['amount'] = $r->amount;
            $nestedData['details'] = $r->details;
            $action = '<a class="editmdl" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->name.'" data-eml="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a class="delmdl" data-delid="'.$r->id.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    
    public function sumCpayment(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        $total= PayCourse::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
        ->sum('amount');
        return number_format($total);
    }
    
}
