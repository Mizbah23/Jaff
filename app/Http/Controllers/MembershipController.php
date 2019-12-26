<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Membership;
use Jaff\Member;
use Jaff\User;
use Jaff\Balance;
use Response;
use DB;
class MembershipController extends Controller
{
    public function membershipList()
    {
        $data = array();
        $data['title'] = 'Membership';
        return view('admin.pages.mem.package',$data);
    }
    
    public function saveMembership(Request $request)
    {
        $membership = new Membership;
        $membership->name = $request->name;
        $membership->duration = $request->duration;
        $membership->fee = $request->fee;
        $membership->discount = ($request->discount==1)? $request->damount :  0;
        $membership->save();
        $notification = array(
                'message' => 'Membership Info Successfully Included',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function getMembership(Request $request) 
    {
        $columns = array(0 =>'name',1=> 'duration',2=> 'fee',3=> 'discount',4=> 'tmember',5=> 'status',6=> 'action');
        $totalData = Membership::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Membership::select('memberships.*',DB::raw("(SELECT count(members.id) FROM members WHERE "
                            . "members.`mid`=memberships.`id`) as tmember"))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Membership::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Membership::select('memberships.*',DB::raw("(SELECT count(members.id) FROM members WHERE "
                            . "members.`mid`=memberships.`id`) as tmember"))
                    ->where('name', 'like', "%{$search}%")
                    ->orwhere('duration', 'like', "%{$search}%")
                    ->orwhere('fee','like',"%{$search}")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
                    
            $totalFiltered = Membership::where('name', 'like', "%{$search}%")
                            ->orwhere('duration', 'like', "%{$search}%")
                            ->orwhere('fee','like',"%{$search}")
                            ->count();
        }
    $data = array();

    if($posts)
    {
        foreach($posts as $r)
        {     
            
            $nestedData['name'] = $r->name;
            $nestedData['duration'] = ($r->duration==0)?'<div class="badge badge-info">Unlimited</div>':$r->duration.' months';
            $nestedData['fee'] = $r->fee.' BDT';

            if( $r->discount==0){
                $discount = '<div class="badge badge-secondary">Not Applicable</div>';
            }else{
                $discount = '<div class="badge badge-secondary">'.$r->discount.' %</div>';
            }
            $nestedData['discount'] = $discount;
            $nestedData['members'] = '<span class="badge badge-pill badge-glow bg-primary">'.$r->tmember.'</span>';
            if( $r->status==0){
                $status = '<div class="btn-group"><div class="badge badge-warning dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Inactive</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-mid="'.$r->id.'" data-sts="1" href="#">Active</a></div>
                </div>
                 </div>';
            }else{
                 $status = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-mid="'.$r->id.'" data-sts="0" href="#">Inactive</a></div>
                </div>
                 </div>';
            }
            $nestedData['status'] = $status;
            $nestedData['action'] = '<a href="#" class="editmdl" data-id="'.$r->id.'" data-name="'.$r->name.'" data-duration="'.$r->duration.'" data-fee="'.$r->fee.'" data-discount="'.$r->discount.'" '
                    . 'style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>'
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
    
    public function updateMembership(Request $request)
    {
        $membership = Membership::find($request->id);
        $membership->name = $request->uname;
        $membership->duration = $request->uduration;
        $membership->fee = $request->ufee;
        $membership->discount = ($request->udiscount==1)? $request->udamount :  0;
        $membership->save();
        $notification = array(
                'message' => 'Membership Updated Successfully',
                'type' => 'success'
        );
        return Response::json($notification);
    }
    public function deleteMembership(Request $request)
    {
      
        $membership = Membership::find($request->delid);
        $membership->delete();
        $notification = array(
                 'message' => 'Membership Info Deleted ',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusMembership(Request $request)
    {
        $membership= Membership::find($request->mid);
        $membership->status = $request->sts;
        $membership->save();
        $notification = array(
                'message' => ($request->sts==1)?'Status Activated':'Status Disabled',
                'type' => ($request->sts==1)?'success':'warning',
            );
        return Response::json($notification); 
    }
   //=============================Member========================================
    public function memberList()
    {
        $data = array();
        $data['title'] = 'User Membership';
        $data['users'] = User::where('status',1)->get();
        $data['mp'] = Membership::where('status',1)->get();
        return view('admin.pages.mem.membership',$data);
    }
    public function saveMember(Request $request)
    {
        $member = new Member;
        $member->userid = $request->userid;
        $member->mid = $request->mid;
        $member->max_slot = $request->max_slot;
        $member->save();
 
        $cid =$member->id;
        
        $info = Membership::where('id',$request->mid)->first();
        
        $c="JM".strtoupper(substr($info->name, 0, 1)).$info->duration;
        
        if($cid < 10)
        {
            $code = $c."000".$cid;
        } else if ($cid < 100){
            $code = $c."00".$cid;
        } else if($cid < 1000){
            $code = $c."0".$cid;
        }else {
            $code = $c.$cid;
        }
        $umem = Member::find($cid);
        $umem->code = $code;
        $umem->save();
        $notification = array(
                'message' => 'Membership Assigned',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function getExpDate($date1, $date2)
    {
        $curdate=strtotime($date1);
        $expdate=strtotime($date2);
        if($curdate>$expdate){
            return 0;
        }else{
            $date1=date_create($date1);
            $date2=date_create(date('Y-m-d',strtotime($date2)));
            $diff=date_diff($date1,$date2);
            return $diff->format("%a");
        }
    } 
    public function getMember(Request $request) 
    {
        $columns = array(0 =>'created_at',1=> 'username',2=> 'ispaid',3=> 'end_date',4=> 'start_date',5=> 'status',6=> 'action');
        $totalData = Member::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Member::join('users','members.userid','=','users.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->select('members.*','users.username','users.img','users.phone','memberships.name','memberships.fee',
                            DB::raw("(SELECT SUM(pay_members.amount) FROM pay_members WHERE "
                            . "pay_members.`member_id`=members.`id`) as paid"))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Member::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Member::join('users','members.userid','=','users.id')
                    ->join('memberships','members.mid','=','memberships.id')
                    ->select('members.*','users.username','users.img','users.phone','memberships.name','memberships.fee',
                            DB::raw("(SELECT SUM(pay_members.amount) FROM pay_members WHERE "
                            . "pay_members.`member_id`=members.`id`) as paid"))
                    ->where('users.username', 'like', "%{$search}%")
                    ->orwhere('users.phone', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Member::join('users','members.userid','=','users.id')
                            ->join('memberships','members.mid','=','memberships.id')
                            ->select('members.*','users.username','users.img','users.phone','memberships.name')
                            ->where('users.username', 'like', "%{$search}%")
                            ->orwhere('users.phone', 'like', "%{$search}%")
                            ->count();
        }
    $data = array();

    if($posts)
    {
        foreach($posts as $r)
        {     
            $nestedData['code'] = $r->code;
            $nestedData['user'] = 'User: '.$r->username.'<br>Package: '.$r->name.'<br>Fee: '.$r->fee.'<br>Slots: '.$r->max_slot;
            $nestedData['mship'] = $r->name.'<br>Fee: '.$r->fee;
            $rem_slot = $r->max_slot-$r->used_slot;
            $due = $r->fee - $r->paid;
            $nestedData['payment'] = 'Paid: '.$r->paid.'<br>Due: '.$due;
            $start = (!is_null($r->start_date))? date('d M, Y',strtotime($r->start_date)):'not started';
            $end = (!is_null($r->end_date))? date('d M, Y', strtotime($r->end_date)):'';
            $duration = 'Start: '.$start.'<br>End : '.$end;
            $nestedData['duration'] = $duration;         
            $remaining = (!is_null($r->end_date)) ? $this->getExpDate(today(),$r->end_date).' days': '';
            $nestedData['remaining'] = $remaining.'<br>'.$rem_slot.' slots';
            if($remaining<=0 && is_null($r->start_date)){
                $status = '<div class="badge badge-secondary">Pending</div>';
            }else if($remaining<=0 && $r->status==1){
                $status = '<div class="badge badge-danger">Expired</div>';
            }
            else if($remaining<=0 && $r->status==0){
                $status = '<div class="badge badge-info">renewed</div>';
            }else if($remaining>0 && $remaining<=7){
                $status = '<div class="badge badge-warning">Expiring soon</div>';
            }else {
                $status = '<div class="badge badge-success">Active</div>';
            }
            $nestedData['status'] = $status;
            $action = '';
            $action .= ($r->paid<=0)? '<a href="#" class="editmdl" data-id="'.$r->id.'"  data-uid="'.$r->userid.'" data-mid="'.$r->mid.'" data-mxslt="'.$r->max_slot.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> ':'';
            $action .=  '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->code.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
            if($r->paid<$r->fee){
              $action.=  '<div class="badge badge-primary" >
                    <a href="#" class="paymdl" data-pid="'.$r->id.'" data-amnt="'.$due.'" style="padding: 4px;">pay</a>
                </div>';
            }
            if($remaining<=0 && $r->paid>0 && $r->status==1){
               $action.=  '<div class="badge badge-primary" >
                    <a href="#" class="renewmdl" data-uid="'.$r->userid.'" data-unm="'.$r->username.'" style="padding: 4px;">Renew</a>
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
    
    public function updateMember(Request $request)
    {
        $mid = Member::where('id',$request->member_id)->value('mid');
        
        $member = Member::find($request->member_id);
        $member->userid = $request->uuserid;
        $member->mid = $request->umid;
        $member->max_slot = $request->umax_slot;
        $member->save();
        if($mid!=$request->umid)
        {
            $mem = Member::find($request->member_id);
            $mem->start_date = null;
            $mem->end_date = null;
            $mem->save();
        }
        $notification = array(
                'message' => 'Membership Updated',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function deleteMember(Request $request)
    {
      
        $membership = Member::find($request->delid);
        $membership->delete();
        $notification = array(
                 'message' => 'Membership Info Deleted ',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusMember(Request $request)
    {
        $membership= Membership::find($request->id);
        $membership->status = $request->status;
        $membership->save();
        $notification = array(
                'message' => ($request->status==1)?'Status Activated':'Status Disabled',
                'type' => ($request->status==1)?'success':'warning',
            );
        return Response::json($notification); 
    }
    public function renewMember(Request $request)
    {
        Member::where('userid',$request->newuid)->update(['status'=>0]);
        
        $member = new Member;
        $member->userid = $request->newuid;
        $member->mid = $request->newmid;
        $member->max_slot = $request->newmax_slot;
        $member->save();
 
        $cid =$member->id;
        
        $info = Membership::where('id',$request->newmid)->first();
        
        $c="JM".strtoupper(substr($info->name, 0, 1)).$info->duration;
        
        if($cid < 10)
        {
            $code = $c."000".$cid;
        } else if ($cid < 100){
            $code = $c."00".$cid;
        } else if($cid < 1000){
            $code = $c."0".$cid;
        }else {
            $code = $c.$cid;
        }
        $umem = Member::find($cid);
        $umem->code = $code;
        $umem->save();
        $notification = array(
                'message' => 'Membership Assigned',
                'type' => 'success'
        );
        return Response::json($notification);
    }
    
    
    
}
