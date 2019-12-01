<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Jaff\User;
use Jaff\Ground;
use Hash;

class UserController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }
    public function UserList()
    {
        $data = array();
        $data['title'] = 'User Management';
        return view('admin.pages.users.users',$data);
    }
    public function getUsers(Request $request)
    {
        $columns = array(0 =>'username',1=> 'phone',2=> 'email',3=> 'status',4=> 'action'
        );
        $totalData = User::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = User::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  User::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = User::where('username', 'like', "%{$search}%")
                    ->orwhere('phone', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = User::where('name', 'like', "%{$search}%")
                    ->orwhere('username', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts)
    {
        foreach($posts as $r)
        {     
            $nestedData['name'] = $r->username;
            $nestedData['phone'] = $r->phone;
            $nestedData['email'] = $r->email;
            $nestedData['img'] = '<img class="rounded-circle" src="'.asset($r->img).'" alt="'.$r->name.'" height="60" width="60">';
            if( $r->status==0){
                $sts = '<div class="btn-group"><div class="badge badge-warning dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Hold</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="1" href="#">Active</a><a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="2" href="#">Block</a></div>
                </div>
                 </div>';
            }else if($r->status==1){
                 $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="0" href="#">Hold</a><a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="2" href="#">Block</a></div>
                </div>
                 </div>';
            }else{
                 $sts = '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Blocked</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="1" href="#">Active</a><a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="0" href="#">Hold</a></div>
                </div>
                 </div>';
            }
            $nestedData['sts']=$sts;
//        '<div class="btn-group"><div class="badge badge-success dropdown">
//            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
//            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
//                <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="0" href="#">Hold</a><a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="2" href="#">Block</a></div>
//            </div>
//        </div>':'<div class="btn-group"><div class="badge badge-warning dropdown">
//            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Hold</span></a>
//            <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
//                <a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="1" href="#">Active</a><a class="dropdown-item csts" data-id="'.$r->id.'" data-sts="2" href="#">Block</a></div>
//            </div>
//        </div>';    
//                '<div class="badge  badge-pill badge-success mr-1 badge-glow mb-1"><span>Active</span></div>':
//                '<div class="badge  badge-pill badge-warning mr-1 badge-glow mb-1"><span>Hold</span></div>';
//            $nestedData['sts']=($r->status==1)?'<div class="badge  badge-pill badge-success mr-1 badge-glow mb-1"><i class="feather icon-check"></i><span>Active</span></div>':
//                '<div class="badge badge-pill  badge-danger mr-1 badge-glow mb-1"><i class="feather icon-x"></i><span>Active</span></div>';
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-fnm="'.$r->first_name.'" data-lnm="'.$r->last_name.'" data-nm="'.$r->username.'" '
                    . 'data-eml="'.$r->email.'" data-phn="'.$r->phone.'" data-addrs="'.$r->address.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" style="padding: 4px;" data-deluid="'.$r->id.'"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function saveUser(Request $request)
    {
        $user = new User;
        $user->first_name = $request->fname;
        $user->last_name = $request->lname;
        $user->username = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $image=$request->file('image');
        if($image)
        {
            $image_name=str_random(3).$request->uname;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/img/user/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $user->img=$image_url;
            }
        }
        $user->save();
        
        $postUrl = "http://api.bulksms.icombd.com/api/v3/sendsms/xml";
        $smsbody = "Dear $request->name, Your Jaff Account is created successfully.Your Phone: $request->phone and Password:$request->password."
                . " For any query call us 0011223344.  Regards, Jaff.";

        $xmlString =
           "
           <SMS>
           <authentification>
           <username>jakia</username>
           <password>Jakiasms786</password>
           </authentification>
           <message>
           <sender>jakia</sender>
           <text>$smsbody</text>
           </message>
           <recipients>
           <gsm>$request->phone</gsm>
           </recipients>
           </SMS>
           ";
           $fields = "XML=" . urlencode($xmlString);
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $postUrl);
           curl_setopt($ch, CURLOPT_POST, 1);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
           curl_exec($ch);
           curl_close($ch);
          
        $notification = array(
                'message' => 'User Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification);  
    }
    public function updateUser(Request $request)
    {
        $user = User::find($request->uid);
        $user->first_name = $request->ufname;
        $user->last_name = $request->ulname;
        $user->username = $request->uname;
        $user->email = $request->uemail;
        $user->phone = $request->uphone;
        $user->address = $request->uaddress;
        if($request->upassword!=""){
            $user->password = $request->upassword;
        }
        $user->save();
        $notification = array(
                'message' => 'User Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function deleteUser(Request $request)
    {
        $user = User::find($request->deluid);
        $user->delete();
        $notification = array(
                 'message' => 'User Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusUser(Request $request)
    {
        $user= User::find($request->uid);
        $user->status = $request->sts;
        $user->save();
        if($request->sts==1){
            $msg= 'User Activated Successfully';
            $typ= 'success';
        }else if($request->sts==0){
            $msg= 'User Inactivated Successfully';
            $typ= 'warning';
        }else{
            $msg= 'User Account Has been blocked';
            $typ= 'error';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    
}
