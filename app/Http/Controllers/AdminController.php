<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Admin;
use Jaff\Post;
use Jaff\Category;
use Jaff\User;
use Jaff\Booking;
use Jaff\Bookdetail;
use Jaff\Balance;
use Jaff\Membership;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }
    public function index()
    {
        $data = array();
        $data['title'] = 'Dashboard';
        $data['total']=User::where( 'created_at', '>=', Carbon::today()->subDays(7))->orderBy('created_at','desc')->get();
        // dd($data['total']);
        $dates = collect();
        foreach( range( 0, 6 ) as $i ) {
            $date = Carbon::today()->subDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
         }
        // dd($dates);
         $data['users']=User::where( 'created_at', '>=', Carbon::today()->subDays(7))->orderBy('created_at','desc')->groupBy(DB::raw('Date(created_at)'))->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('COUNT(*) as "count"')
                            ))->pluck( 'count', 'date' );
          // dd($data['users']);
         $dates = $dates->merge( $data['users'] );
         $data['dates']=$dates;
         $dates = [];
         $dcounts=[];
         foreach ($data['dates'] as $key=>$count) {
            // dd($data['dates']);
           array_push($dcounts, $count);
           array_push($dates, $key);
 
         }
         
         $dates = implode(",",$dates);
         $dcounts=implode(",",$dcounts);
         // dd($dates);
         $data['dcounts'] = $dcounts;
         //******bookings date chart************//

         $data['total_books']=Bookdetail::where( 'slot_date', '>=', Carbon::today()->subDays(7))->orderBy('slot_date','desc')->get();
         $book_dates = collect();
        foreach( range( 0, 6 ) as $i ) {
            $date = Carbon::today()->subDays( $i )->format( 'Y-m-d' );
            $book_dates->put( $date, 0);
         }
         $data['books']=Bookdetail::where( 'slot_date', '>=', Carbon::today()->subDays(7))->orderBy('slot_date','desc')->groupBy(DB::raw('Date(slot_date)'))->get(array(
                                DB::raw('Date(slot_date) as date'),
                                DB::raw('COUNT(*) as "count"')
                            ))->pluck( 'count', 'date' );

        $bookings = $book_dates->merge($data['books']);
        $data['bookings']=$bookings;
        //dd($bookings);
        $bookings = [];
        foreach ($data['bookings'] as $bdate) {
             // dd($date);
            array_push($bookings, $bdate);
         }
        $bookings = implode(",",$bookings);
         
        $data['bookings'] = $bookings;
       // dd($bookings);
        //*********Slot date-wise booking chart************////
        $data['total_count'] = Booking::where( 'created_at', '>=', Carbon::now()->subDays(30))->count();
        $data['paid_count'] = Booking::where( [['created_at', '>=', Carbon::now()->subDays(30)], ['status', '=', '1' ]])->count();
        $data['due_count'] = Booking::where( [['created_at', '>=', Carbon::now()->subDays(30)], ['status', '=', '0' ]])->count();
        $data['partial_count'] = Booking::where( [['created_at', '>=', Carbon::now()->subDays(30)], ['status', '=', '2' ]])->count();
        
        $data['paid_percent']=($data['paid_count']>0)? number_format($data['paid_count']/($data['total_count'])*100, 0, '.', ''):0.0;
        $data['partial_percent']= ($data['partial_count']>0)? number_format($data['partial_count']/($data['total_count'])*100, 0, '.', ''):0.0;
        $data['due_percent']= ($data['due_count']>0)? number_format($data['due_count']/($data['total_count'])*100, 0, '.', ''):0.0;

        // dd($data);
        ///**********Slot type wise booking*********'///
        // $data['peak_count']= Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')->where( [['bookdetails.created_at', '>=', Carbon::now()->subDays(30)], ['slots.type_id', '=', '2' ]])->count();
        // $data['offpeak_count']= Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')->where( [['bookdetails.created_at', '>=', Carbon::now()->subDays(30)], ['slots.type_id', '=', '3' ]])->count();
        // $data['normal_count']= Bookdetail::join('slots','bookdetails.slot_id','=','slots.slot_id')->where( [['bookdetails.created_at', '>=', Carbon::now()->subDays(30)], ['slots.type_id', '=', '4' ]])->count();
        // dd($data['normal_count']);
        //*********Paid Money************// 
        $paid= Bookdetail::join('pay_bookings','bookdetails.book_id','=','pay_bookings.book_id')
        ->where( 'pay_bookings.created_at', '>=', Carbon::now()->subDays(30))
        ->sum('pay_bookings.amount');
        $total_booking=Bookdetail::where( 'created_at', '>=', Carbon::now()->subDays(30))->sum('book_price');
        //dd($total_booking);
        $due=$total_booking-$paid;
        
        //dd($due);
        $data['total_booking']=$total_booking;
        $data['paid']=$paid;
        $data['due']=$due;
        ///**********User type wise booking*********'///
        $data['total_btcount'] = Bookdetail::where( 'slot_date', '>=', Carbon::now()->subDays(30))->count();
        $data['reg_count']=Bookdetail::where( [['slot_date', '>=', Carbon::now()->subDays(30)], ['type', '=', '1' ]])->count();
        $data['offer_count']=Bookdetail::where( [['slot_date', '>=', Carbon::now()->subDays(30)], ['type', '=', '2' ]])->count();
        $data['full_count']=Bookdetail::where( [['slot_date', '>=', Carbon::now()->subDays(30)], ['type', '=', '3' ]])->count();
        $data['drop_count']=Bookdetail::where( [['slot_date', '>=', Carbon::now()->subDays(30)], ['type', '=', '4' ]])->count();

        // Last 12 Month Income 
        
        $months = collect();
        foreach( range( 0, 5 ) as $i ) {
            $date = Carbon::today()->subMonths( $i )->format( 'M' );
            $months->put( $date, 0);
         }
         $data['bank_trans_date']=DB::table('bank_trans')->where([['date', '>=', Carbon::today()->subMonths(6)],['type','=','1'],['purpose','=','0']])->groupBy(DB::raw('Month(date)'),'month')->orderBy('date','desc')->get(array(DB::raw('date_format(date, "%b") as month'),DB::raw('SUM(amount) as total')))->pluck('total','month');
         // dd($data['bank_trans_date']);
         $data['bkash_trans_date']=DB::table('bkash_trans')->where([['date', '>=', Carbon::today()->subMonths(6)],['type','=','1'],['purpose','=','0']])->groupBy(DB::raw('Month(date)'),'month')->orderBy('date','desc')->get(array(DB::raw('date_format(date, "%b") as month'),DB::raw('SUM(amount) as total')))->pluck('total','month');

        
        // dd($data['bkash_trans_date']);
         $cash_trans_date =DB::table('cash_trans')->where([['date', '>=', Carbon::today()->subMonths(6)],['type','=','1'],['purpose','=','0']])->groupBy(DB::raw('Month(date)'),'month')->orderBy('date','desc')->get(array(DB::raw('date_format(date, "%b") as month'),DB::raw('SUM(amount) as total')))->pluck('total','month');
        // dd($data['cash_trans_date']);
         $assign_date =DB::table('assigns')->where('created_at', '>=', Carbon::today()->subMonths(6))->groupBy(DB::raw('Month(created_at)'),'month')->orderBy('created_at','desc')->get(array(DB::raw('date_format(created_at, "%b") as month'),DB::raw('SUM(price) as total')))->pluck('total','month');
         // dd($data['assign_date']);
        $member_date = Membership::join('members','memberships.id','=','members.mid')
        ->where('members.created_at', '>=', Carbon::today()->subMonths(6))
        ->groupBy(DB::raw('Month(members.created_at)'),'month')
        ->orderBy('members.created_at','desc')
        ->get(array(DB::raw('MONTH(members.created_at) as month'),DB::raw('SUM(fee) as total')))->pluck('total','month');
         // dd($member_date);
        
        $booking_date = Booking::join('bookdetails','bookings.book_id','=','bookdetails.book_id')
        ->where([['bookings.created_at', '>=', Carbon::today()->subMonths(6)],['bookings.status','!=','0']])
        ->groupBy(DB::raw('Month(bookings.created_at)'),'month')
        ->orderBy('bookings.created_at','desc')
        ->get(array(DB::raw('MONTH(bookings.created_at) as month'),DB::raw('SUM(book_price) as total')))
        ->pluck('total','month');
          dd($booking_date);
        // print_r($booking_date);
        $income = array();
       foreach ($booking_date as $key=>$value) {
   
         if(array_key_exists($key, $member_date)){
            $value+=$member_date[$key];
         }
 
         $income[$key] = $value;
       }
       


       $months=$months->merge($data['bank_trans_date']);
       $data['months']=$income=$months;
       // dd($data['months']);
       $months = [];
       $mcounts=[];
       foreach ($data['months'] as $key=>$mcount) {
           
           array_push($mcounts, $mcount);
           array_push($months, '"'.$key.'"');

         }

         $months =implode(",",$months);
         $mcounts=implode(",",$mcounts);
         // dd($months);
         // dd($mcounts);
         $data['mcounts'] = $mcounts;
         $data['months']=$months;

        //Last 12 months Expense
        
        $emonths = collect();
        foreach( range( 0, 5 ) as $i ) {
            $date = Carbon::today()->subMonths( $i )->format( 'M' );
            $emonths->put( $date, 0);
         }

        // $data['expense_date'] = Balance::join('accounts','balances.accid','=','accounts.accid')
        // ->where([['date', '>=', Carbon::today()->subMonths(6)],['accounts.type','=','2']])
        // ->groupBy(DB::raw('Month(balances.date)'),'month')
        // ->orderBy('balances.date','desc')
        // ->get(array(DB::raw('date_format(date, "%b") as month'),DB::raw('SUM(amount) as total')))
        // ->pluck('total','month');
        
        // $emonths=$emonths->merge( $data['expense_date'] );
        // $data['emonths']=$expense=$emonths; 
        // // dd($expense);
        // $emonths = [];
        // $ecounts=[];
        // foreach ($data['emonths'] as $key=>$ecount) {
           
        //    array_push($ecounts, $ecount);

        //  };
        // $ecounts=implode(",",$ecounts);
        // $data['ecounts'] = $ecounts;
        // // dd($income);
        // //Last 12 months Profit
        // $profits = array();
      
        // foreach ($income as $key => $value) {
      
        //     $profits[$key]= $value-$expense[$key];
        // }
        // $profits=implode(",",$profits);
        // $data['profits'] = $profits;
        // // LATEST Bookings
        // $data['latest']= Bookdetail::join('bookings','bookdetails.book_id','=','bookings.book_id')
        // ->join('users','users.id','=','bookings.booked_for')->join('slots','slots.slot_id','=','bookdetails.slot_id')
        // ->select('bookdetails.*','bookings.*','users.id','users.first_name','users.last_name','users.img','slots.start','slots.end')
        // ->orderBy('bookdetails.id','desc')->limit(5)->get();
        
        return view('admin.dashboard',$data);   
    }
    public function UserList()
    {
        $data = array();
        $data['title'] = 'Admin List';
        return view('admin.pages.users.admins',$data);
    }
    public function getUsers(Request $request)
    {
        $columns = array(
            0 =>'id',
            1=> 'name',
            2=> 'phone',
            3=> 'email',
            4=> 'status',
            5=> 'action'
        );
        
        $totalData = Admin::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
       
        if(empty($request->input('search.value')))
        {
            $posts = Admin::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            $totalFiltered =  Admin::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Admin::where('name', 'like', "%{$search}%")
                    ->orwhere('phone', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            $totalFiltered = Admin::where('name', 'like', "%{$search}%")
                    ->orwhere('phone', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['id'] = $r->id;
            $nestedData['nm'] = $r->name;
            $img = ($r->image)?asset($r->image):asset('public/img/avatar.png');
            $nestedData['img'] = '<img class="rounded-circle" src="'.$img.'" alt="admin image" height="80" width="80">';
            $nestedData['phn'] = $r->phone;
            $nestedData['eml'] = $r->email;
            
            
            if($r->level=='SA'){
                $sts = '<div class="badge badge-success">Active</div>';
            }else{
                $sts = ($r->status==1)?
                 '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="0" href="#">Disable</a></div>
                </div>
                 </div>':
                '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Disabled</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="1" href="#">Active</a></div>
                </div>
                </div>';
            }

            
            $nestedData['sts']= $sts;
            $action = '<a class="editmdl" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->phone.'" data-eml="'.$r->email.'" '
                    . 'data-img="'.asset($r->image).'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a>';
            if($r->level!='SA'){
               $action .= '<a href="#" class="delmdl" data-delaid="'.$r->id.'" data-ttl="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>'; 
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
    public function saveAdmin(Request $request) 
    {
        $mper = array();$wper = array();
        $admin = new Admin;
        $admin->name = $request->name;
        $admin->phone = $request->phone;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        if($request->user_access){
            foreach ($request->user_access as $menu)
            {$mper[]=$menu;}
            $mstring = implode(",", $mper);
            $admin->mper = $mstring; 
        }
        if($request->wper){
            foreach ($request->wper as $work)
            {$wper[]=$work;}
            $wstring = implode(",", $wper);
            $admin->wper = $wstring;
        }
        $image=$request->file('image');
        if($image)
        {
            $image_name=str_random(3).$request->name;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/img/admin/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $admin->image = $image_url;
            }
        }
        $admin->save();
        $notification = array(
                'message' => 'Admin User Added Successfully',
                'type' => 'success'
            );
        return Response::json($notification);  
    }
    public function adminCheck(Request $request)
    {

        $data = array();
        $key = $request->key;$value = $request->val;$id = $request->id;
        $val_exists = Admin::where($key,$value)
                     ->when($id,function($query,$id){
                         return $query->where('id','!=',$id);
                     })
                     ->exists();
        ($val_exists)?$data["error"]= 'already exists':$data["success"]= 'available';
        return $data;
    }
    public function getSingleUser(Request $request)
    {
        $data["mdata"] = array();$data["wdata"] = array();
        $admin_info = Admin::where('id',$request->aid)->first();
        $marray = preg_split("/,/", $admin_info->mper);
        $warray = preg_split("/,/", $admin_info->wper);
        if(count($marray)>0){
            foreach ($marray as $m_array){
                array_push($data["mdata"], $m_array);
           }
    }
        if(count($warray)>0){
            foreach ($warray as $w_array){
                array_push($data["wdata"], $w_array);
            }
        }
        return Response::json($data);
    }
    public function updateAdmin(Request $request)
    {
        $mper = array();$wper = array();
        $admin = Admin::find($request->adminid);
        $admin->name = $request->uname;
        $admin->phone = $request->uphone;
        $admin->email = $request->uemail;
        
        if($request->uuser_access){
            foreach ($request->uuser_access as $menu)
            {$mper[]=$menu;}
            $mstring = implode(",", $mper);
            $admin->mper = $mstring;
        }
        if($request->uwper){
            foreach ($request->uwper as $work)
            {$wper[]=$work;}
            $wstring = implode(",", $wper);
            $admin->wper = $wstring;
        }
        $image=$request->file('uimage');
        if($image)
        {
            $image_name=str_random(3).$request->uname;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/img/admin/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $admin->image = $image_url;
                if(file_exists($request->oldimg)){
                    unlink($request->oldimg); 
                }
            }
        }
        $admin->save();
        $notification = array(
                'message' => 'Admin User Updated Successfully',
                'type' => 'warning'
            );
        return Response::json($notification);  
    }
    public function statusAdmin(Request $request)
    {
        $user= Admin::find($request->aid);
        $user->status = $request->sts;
        $user->save();
        if($request->sts==1){
            $msg= 'Admin Activated Successfully';
            $typ= 'success';
        }else{
            $msg= 'Admin Inactivated Successfully';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    public function deleteAdmin(Request $request)
    {
        $user = Admin::find($request->delaid);
        if(file_exists($user->img)){unlink($user->img);}
        $user->delete();
        $notification = array(
                 'message' => 'Admin Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }

    
}
