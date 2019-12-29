<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Slot;
use Jaff\Holiday;
use Jaff\Booking;
use Jaff\Bookdetail;
use Jaff\Balance;
use Jaff\PayCourse;
use Jaff\PayMember;
use Jaff\PayBooking;
use Jaff\Fullday;
use Jaff\Dropin;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use PDF;


class ReportController extends Controller
{
    public function slotPrint(Request $request)
    {
        
        $day_id=Input::get('searchday');  //$request->searchday;
        $ground_id=Input::get('searchgrnd');
        $type_id=Input::get('searchtyp');
        // $limit = $request->input('length');
        // $start = $request->input('start');
        // $totalData = Slot::count();
        // $order = $columns[$request->input('order.0.column')];
        // $dir = $request->input('order.0.dir');
        // dd($day_id);
        $total= Slot::count();
                $posts = Slot::join('grounds','slots.ground_id','=','grounds.id')
                ->join('weekdays','slots.day_id','=','weekdays.id')
                ->join('types','slots.type_id','=','types.id')
                ->when($day_id, function ($query, $day_id)
                {return $query->where('day_id', $day_id);})
                ->when($ground_id, function ($query, $ground_id)
                {return $query->where('ground_id', $ground_id);})
                ->when($type_id, function ($query, $type_id)
                {return $query->where('type_id', $type_id);})
                ->select('slots.*','grounds.name','weekdays.day','types.type')->orderBy('day_id','asc')->get();
                $pdf = PDF::loadView('report.slotPrint',['posts'=>$posts,'total'=>count($posts)]);
            
        return $pdf->stream('Slot-Pdf.pdf');
    }
    
    
    /*********Holiday Print ************/

     public function holidayPrint(Request $request)
    {
        
        $from= Input::get('from');
        $to=   Input::get('to');
    
        $total= Holiday::count();
                $posts = Holiday::join('grounds','holidays.ground_id','=','grounds.id')
                        ->when($from, function ($query, $from){return $query->whereDate('holidays.holiday','>=',$from);})
                        ->when($to, function ($query, $to){return $query->whereDate('holidays.holiday','<=',$to);})
                        ->select('holidays.*','grounds.name',DB::raw('grounds.id as gid'))
                        ->get();
                $pdf = PDF::loadView('report.holidayPrint',['posts'=>$posts,'total'=>count($posts),'from'=>$from,'to'=>$to]);
        return $pdf->stream('Holiday-Pdf.pdf');
    }
    
    /********Booking List Print ************/
    public function bookingListPrint(Request $request)
    {
        
        $fromdate= Input::get('fromdate');
        $todate=   Input::get('todate');
    
//        $total= Booking::count();
                $posts = Booking::join('users','bookings.booked_for','=','users.id')
                 
                    ->select('bookings.*','users.username','users.email','users.phone',DB::raw("(SELECT count(bookdetails.id) FROM bookdetails WHERE "
                            . "bookdetails.`book_id`=bookings.`book_id`) as tslot"),DB::raw("(SELECT SUM(bookdetails.book_price) FROM bookdetails WHERE "
                            . "bookdetails.`book_id`=bookings.`book_id`) as total"))->get();
                $pdf = PDF::loadView('report.bookingPrint',['posts'=>$posts,'total'=>count($posts),'from'=>$fromdate,'to'=>$todate]);
        return $pdf->stream('Booking-Pdf.pdf');
    }

    /******* Booking Slot Prrint **********/

    public function bookslotPrint(Request $request)
    {
        $fromDate= Input::get('fromdate');
        $toDate=   Input::get('todate');
        $fromTime= Input::get('fromtime');
        $toTime=   Input::get('totime');
    
//        $total= Bookdetail::count();
            $posts =Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')
                ->when($fromDate, function ($query, $fromDate)
                {return $query->whereDate('bookdetails.slot_date','>=',$fromDate);})
                ->when($toDate, function ($query, $toDate)
                {return $query->whereDate('bookdetails.slot_date','<=', $toDate);})
                ->when($fromTime, function ($query, $fromTime)
                {return $query->whereRaw("TIME(slots.start) >= ?", $fromTime); })
                ->when($toTime, function ($query, $toTime)
                {return $query->whereRaw("TIME(slots.end) <= ?", $toTime);})->get();
                $pdf = PDF::loadView('report.bookslotPrint',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromDate,'todate'=>$toDate,'fromtime'=>$fromTime,'totime'=>$toTime]);
        return $pdf->stream('Booking_Slot-Pdf.pdf');
    }
    public function incomeReport()
    {
        $from= Input::get('fromdate');
        $to=   Input::get('todate');
        $fromdate = ($from)?date("d,M Y", strtotime($from)):'';
        $todate = ($to)?date("d,M Y", strtotime($to)):'';

        $posts = Balance::join('accounts','balances.accid','=','accounts.accid')->where('accounts.type',1)
                    ->select('balances.*','accounts.acc_name')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->orderBy('balances.date','asc')
                    ->get();
        $pdf = PDF::loadView('report.income_report',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        return $pdf->stream('Jaff-Income.pdf');
    }
    public function expenseReport()
    {
        $from= Input::get('fromdate');
        $to=   Input::get('todate');
        $fromdate = ($from)?date("d,M Y", strtotime($from)):'';
        $todate = ($to)?date("d,M Y", strtotime($to)):'';

        $posts = Balance::join('accounts','balances.accid','=','accounts.accid')->where('accounts.type',2)
                    ->select('balances.*','accounts.acc_name')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->orderBy('balances.date','asc')
                    ->get();
        $pdf = PDF::loadView('report.expense_report',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        return $pdf->stream('Jaff-Expense.pdf');
    }
    public function balanceReport()
    {
        $data = array();
        $from = Input::get('fromdate');
        $to = Input::get('todate');
        $data['from'] = $from;$data['to'] = $to;
        $data['mpay']= PayMember::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
        ->sum('amount');
        
        $data['bpay']= PayBooking::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
        ->sum('amount');
        
        $data['cpay']= PayCourse::when($from, function ($query, $from){return $query->whereDate('date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('date','<=',$to);})
        ->sum('amount');
        
        
        
        $data['income_group'] = Balance::join('accounts','accounts.accid','=','balances.accid')
                ->join('agroups','agroups.grpid','=','accounts.grpid')
                ->select('agroups.grp_name','agroups.grpid','agroups.secid',DB::raw('SUM(balances.amount) as group_total'))
                ->groupBy('agroups.grp_name','agroups.grpid','agroups.secid')
                ->where('accounts.type',1)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})  
                ->get();
        $data['inflow'] = Balance::join('accounts','accounts.accid','=','balances.accid')
                ->join('agroups','agroups.grpid','=','accounts.grpid')
                
                ->select('agroups.grpid','agroups.grp_name','accounts.accid',
                        'accounts.acc_name', DB::raw('SUM(balances.amount) as amount'))
                ->groupBy('agroups.grpid','agroups.grp_name','accounts.accid',
                        'accounts.acc_name')
                ->where('accounts.type',1)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);}) 
                ->get();
       
        $data['all_section'] =  Balance::join('accounts','accounts.accid','=','balances.accid')
                ->join('asections','accounts.secid','=','asections.secid')
                ->select('asections.sec_name','asections.secid',DB::raw('SUM(balances.amount) as sectotal'))
                ->groupBy('asections.sec_name','asections.secid')
                ->where('accounts.type',2)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);}) 
                ->get();
        $data['all_group'] = Balance::join('accounts','accounts.accid','=','balances.accid')
                ->join('agroups','accounts.grpid','=','agroups.grpid')
                ->select('agroups.grp_name','agroups.grpid','agroups.secid',DB::raw('SUM(balances.amount) as group_total'))
                ->groupBy('agroups.grp_name','agroups.grpid','agroups.secid')
                        ->where('accounts.type',2)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);}) 
                ->get();
        $data['all_account'] = Balance::join('accounts','accounts.accid','=','balances.accid')
                ->join('agroups','accounts.grpid','=','agroups.grpid')
                ->select('agroups.grpid','agroups.grp_name','accounts.accid',
                        'accounts.acc_name', DB::raw('SUM(balances.amount) as amount'))
                ->groupBy('agroups.grpid','agroups.grp_name','accounts.accid',
                        'accounts.acc_name')
                ->where('accounts.type',2)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);}) 
                ->get();
//     $pdf = PDF::loadView('report.balance_report',['all_section'=>$all_section,'all_group'=>$all_group,
//         'all_account'=>$all_account,
//         'income_group'=>$income_group,'inflow'=>$inflow,'from'=>$from,'to'=>$to]);
//        return $pdf->stream('Balance-report.pdf');  
        return view('report.balance_report',$data);

    }
    public function coursePaymentReport()
    {
        $from= Input::get('fromdate');
        $to=   Input::get('todate');
        $fromdate = ($from)?date("d,M Y", strtotime($from)):'';
        $todate = ($to)?date("d,M Y", strtotime($to)):'';

        $posts = PayCourse::join('assigns','pay_courses.assign_id','=','assigns.id')
                    ->join('courses','courses.id','=','assigns.course_id')
                    ->select('pay_courses.*','assigns.code','courses.title')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_courses.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_courses.date','<=',$to);})
                    ->orderBy('pay_courses.date','asc')
                    ->get();
                    
         $pdf = PDF::loadView('report.course_payment_report',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        // $excel= Excel::download(['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate], 'course_payment_report.xlsx');
        return $pdf->stream('Jaff-CoursePayment.pdf');
        // return $excel;
    }
    public function memberPaymentReport()
    {
        $from= Input::get('fromdate');
        $to=   Input::get('todate');
        $fromdate = ($from)?date("d,M Y", strtotime($from)):'';
        $todate = ($to)?date("d,M Y", strtotime($to)):'';

        $posts = PayMember::join('members','pay_members.member_id','=','members.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->select('pay_members.*','members.code','memberships.name')
                    ->when($from, function ($query, $from){return $query->whereDate('pay_members.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('pay_members.date','<=',$to);})
                    ->orderBy('pay_members.date','asc')
                    ->get();
                    
        $pdf = PDF::loadView('report.member_payment_report',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        return $pdf->stream('Jaff-MembershipPayment.pdf');
    }
    public function bookingPaymentReport()
    {
        $from= Input::get('fromdate');
        $to=   Input::get('todate');
        $fromdate = ($from)?date("d,M Y", strtotime($from)):'';
        $todate = ($to)?date("d,M Y", strtotime($to)):'';

        $posts = PayBooking::join('bookings','pay_bookings.book_id','=','bookings.book_id')
                ->select('pay_bookings.*','bookings.book_code')
                ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
                ->orderBy('pay_bookings.date','asc')
                ->get();
                    
        // $pdf = PDF::loadView('report.booking_payment_report',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        $excel= Excel::download($posts, 'booking_payment_report.xlsx');
        // return $pdf->stream('Jaff-SlotBookingsPayment.pdf');
        return $excel;
    }
    
        /****** Full day Print ********/
        public function fulldayPrint(Request $request)
    {
        $fromdate= Input::get('fromdate');
        $todate=   Input::get('todate');
    
        $total= Fullday::count();
            $posts = Fullday::join('grounds','fulldays.ground_id','=','grounds.id')
                    ->select('fulldays.*','grounds.name')->get();
                $pdf = PDF::loadView('report.fulldayPrint',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        return $pdf->stream('Fullday_slot-Pdf.pdf');
    }
    /******* Dropin Print ********/
        public function dropinPrint(Request $request)
    {
        $fromdate= Input::get('fromdate');
        $todate=   Input::get('todate');
    
        $total= Dropin::count();
            $posts = Dropin::join('slots','dropins.slot_id','=','slots.slot_id')
                    ->join('grounds','dropins.ground_id','=','grounds.id')
                    ->select('dropins.*','grounds.name','slots.start','slots.end',DB::raw("(SELECT count(bookdetails.id) FROM bookdetails WHERE "
                            . "bookdetails.`slot_id`=dropins.`slot_id` AND bookdetails.`slot_date`=dropins.`date`) as booked"))->get();
                $pdf = PDF::loadView('report.dropinPrint',['posts'=>$posts,'total'=>count($posts),'fromdate'=>$fromdate,'todate'=>$todate]);
        return $pdf->stream('Dropin-Pdf.pdf');
    }

    
}
