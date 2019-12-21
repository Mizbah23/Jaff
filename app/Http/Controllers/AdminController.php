<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Admin;
use Jaff\Post;
use Jaff\Category;
use Jaff\User;
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
        // $fromDate = new Carbon('last week'); 
        // $toDate = new Carbon('now');
        // dd($fromDate, $toDate); 

        $data = array();
        $data['title'] = 'Dashboard';
        // $data['users']=User::whereRaw('DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 7 DAY)')->get();
        $data['total']=User::where( 'created_at', '>=', Carbon::now()->subDays(7))->orderBy('created_at','desc')->get();
        // dd($data['total']);
        $dates = collect();
        foreach( range( 0, 6 ) as $i ) {
            $date = Carbon::now()->subDays( $i )->format( 'Y-m-d' );
            $dates->put( $date, 0);
         }

         $data['users']=User::where( 'created_at', '>=', Carbon::now()->subDays(7))->orderBy('created_at','desc')->groupBy(DB::raw('Date(created_at)'))->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('COUNT(*) as "count"')
                            ))->pluck( 'count', 'date' );
         // dd($data['users']);
         $dates = $dates->merge( $data['users'] );
         $data['dates']=$dates;
         //dd(Carbon::now()->subDays(7)->startOfDay());
        // foreach($data['users'] as $user)
        // {

        // }
        //  dd($data['users']);
         // $array = (array) $data['dates'];
        $dates = [];
         foreach ($data['dates'] as $date) {
             // dd($date);
            array_push($dates, $date);
         }
         $dates = implode(",",$dates);
         // dd($dates);
         $data['dates'] = $dates;
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

            $sts = ($r->status==1)?
                $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
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
            $nestedData['sts']=$sts;
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-nm="'.$r->name.'" data-phn="'.$r->phone.'" data-eml="'.$r->email.'" '
                    . 'data-img="'.asset($r->image).'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delaid="'.$r->id.'" data-ttl="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
