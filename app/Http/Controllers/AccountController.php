<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Asection;
use Jaff\Agroup;
use Response;
use Auth;
use Jaff\Account;

class AccountController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }
    public function showAsections()
    {
        $data = array();
        $data['title'] = 'Parent Account Management';
        return view('admin.pages.account.account_section',$data);
    }
    public function listAsections(Request $request)
    {
        $columns = array(0 =>'sec_name',1=> 'details',2=> 'created_by',3=> 'status',4=> 'action');
        $totalData = Asection::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Asection::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Asection::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Asection::offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Asection::where('sec_name', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['secname'] = $r->sec_name;
            $nestedData['details'] = $r->details;
            $nestedData['created'] = $r->created_by;
            $sts = ($r->status==1)?
                $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->secid.'" data-sts="0" href="#">Disable</a></div>
                </div>
                 </div>':
            '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Disable</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->secid.'" data-sts="1" href="#">Active</a></div>
                </div>
            </div>';
            $nestedData['sts'] = $sts;
            $nestedData['action'] = '<a class="editmdl" data-secid="'.$r->secid.'" data-secname="'.$r->sec_name.'" data-secdtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delsec="'.$r->secid.'" data-ttl="'.$r->sec_name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function checkAccount(Request $request)
    {
        $data = array();
        $key = $request->key;$value = $request->val;$id = $request->id;
        $val_exists = Asection::where($key,$value)
                     ->when($id,function($query,$id){
                         return $query->where('id','!=',$id);
                     })
                     ->exists();
        ($val_exists)?$data["error"]= 'already exists':$data["success"]= 'available';
        return $data;
    
    }
    public function saveAsection(request $request)
    {
        $section = new Asection;
        $section->sec_name =  $request->sec_name;
        $section->details = $request->details;
        $section->created_by = Auth::guard('admin')->user()->id;
        $section->save();
        $notification = array(
                'message' => 'Saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function updateAsection(Request $request)
    {
        $section = Asection::find($request->secid);
        $section->sec_name =  $request->usec_name;
        $section->details = $request->udetails;
        $section->updated_by = Auth::guard('admin')->user()->id;
        $section->save();
        $notification = array(
                'message' => 'Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function statusAsection(Request $request)
    {
        $acc= Asection::find($request->sid);
        $acc->status = $request->sts;
        $acc->save();
        if($request->sts==1){
            $msg= 'Acount Activated Successfully';
            $typ= 'success';
        }else{
            $msg= 'Acount Inactivated Successfully';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    public function deleteAsection(Request $request)
    {
        $acc = Asection::find($request->delsec);
        $acc->delete();
        $notification = array(
                 'message' => 'Acount Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    } 
    
    //==========================================================================
    public function showAgroups()
    {
        $data = array();
        $data['title'] = 'Child Account Management';
        $data['secs'] = Asection::where('status',1)->get();
        return view('admin.pages.account.account_group',$data);
    }
    public function listAgroups(Request $request)
    {
        $columns = array(0 =>'grp_name',1 =>'sec_name',2=> 'details',3=> 'created_by',4=> 'status',5=> 'action');
        $totalData = Agroup::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Agroup::join('asections','agroups.secid','=','asections.secid')
                    ->select('agroups.*','asections.sec_name','asections.secid')
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Agroup::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Agroup::join('asections','agroups.secid','=','asections.secid')
                    ->select('agroups.*','asections.sec_name','asections.secid')
                    ->where('asections.sec_name', 'like', "%{$search}%")
                    ->orwhere('agroups.grp_name', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Agroup::join('asections','agroups.secid','=','asections.secid')
                    ->where('asections.sec_name', 'like', "%{$search}%")
                    ->orwhere('agroups.grp_name', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['grpname'] = $r->grp_name;
            $nestedData['secname'] = $r->sec_name;
            $nestedData['details'] = $r->details;
            $nestedData['created'] = $r->created_by;
            $sts = ($r->status==1)?
                $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->grpid.'" data-sts="0" href="#">Disable</a></div>
                </div>
                 </div>':
            '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Disable</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->grpid.'" data-sts="1" href="#">Active</a></div>
                </div>
            </div>';
            $nestedData['sts'] = $sts;
            $nestedData['action'] = '<a class="editmdl" data-grpid="'.$r->grpid.'" data-secid="'.$r->secid.'" data-grpname="'.$r->grp_name.'" data-dtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delsec="'.$r->grpid.'" data-ttl="'.$r->grp_name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function checkAgroup(Request $request)
    {
        $data = array();
        $key = $request->key;$value = $request->val;$id = $request->id;
        $val_exists = Asection::where($key,$value)
                     ->when($id,function($query,$id){
                         return $query->where('id','!=',$id);
                     })
                     ->exists();
        ($val_exists)?$data["error"]= 'already exists':$data["success"]= 'available';
        return $data;
    
    }
    public function saveAgroup(request $request)
    {
        $group = new Agroup;
        $group->secid =  $request->secid;
        $group->grp_name =  $request->grp_name;
        $group->details = $request->details;
        $group->created_by = Auth::guard('admin')->user()->id;
        $group->save();
        $notification = array(
                'message' => 'Saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function updateAgroup(Request $request)
    {
        $group = Agroup::find($request->grpid);
        $group->secid =  $request->usecid;
        $group->grp_name =  $request->ugrp_name;
        $group->details = $request->udetails;
        $group->updated_by = Auth::guard('admin')->user()->id;
        $group->save();
        $notification = array(
                'message' => 'Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function statusAgroup(Request $request)
    {
        $acc= Agroup::find($request->sid);
        $acc->status = $request->sts;
        $acc->save();
        if($request->sts==1){
            $msg= 'Acount Activated Successfully';
            $typ= 'success';
        }else{
            $msg= 'Acount Inactivated Successfully';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    public function deleteAgroup(Request $request)
    {
        $acc = Agroup::find($request->delsec);
        $acc->delete();
        $notification = array(
                 'message' => 'Acount Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    //=======================================================================
    public function showAccounts()
    {
        $data = array();
        $data['title'] = 'Child Account Management';
        $data['secs'] = Asection::where('status',1)->get();
        return view('admin.pages.account.account',$data);
    }
    public function findGroup(Request $request)
    {
        $data= Agroup::where('secid',$request->secid)
                ->select('grpid','grp_name')
                ->orderBy('grp_name', 'asc')->get();
        return response()->json($data);
    }
    public function saveAccount(request $request)
    {
        $account = new Account;
        $account->secid =  $request->secid;
        $account->grpid =  $request->grpid;
        $account->acc_name =  $request->acc_name;
        $account->type =  $request->type;
        $account->details = $request->details;
        $account->created_by = Auth::guard('admin')->user()->id;
        $account->save();
        $notification = array(
                'message' => 'Saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function listAccounts(Request $request)
    {
        $columns = array(0 =>'acc_name',1 =>'sec_name',2=> 'grp_name',3=> 'type',4=> 'details',5=> 'status',6=> 'action');
        $totalData = Account::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Account::join('asections','asections.secid','=','accounts.secid')
                    ->leftJoin('agroups','agroups.grpid','=','accounts.grpid')
                    ->select('accounts.*','asections.sec_name','agroups.grp_name')
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Account::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Account::join('asections','asections.secid','=','accounts.secid')
                    ->leftJoin('agroups','agroups.grpid','=','accounts.grpid')
                    ->select('accounts.*','asections.sec_name','agroups.grp_name')
                    ->where('accounts.acc_name', 'like', "%{$search}%")
                    ->orwhere('asections.sec_name', 'like', "%{$search}%")
                    ->orwhere('agroups.grp_name', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Account::join('asections','asections.secid','=','accounts.secid')
                    ->leftJoin('agroups','agroups.grpid','=','accounts.grpid')
                    ->where('accounts.acc_name', 'like', "%{$search}%")
                    ->orwhere('asections.sec_name', 'like', "%{$search}%")
                    ->orwhere('agroups.grp_name', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['accname'] = $r->acc_name;
            $nestedData['secname'] = $r->sec_name;
            $nestedData['grpname'] = $r->grp_name;
            $nestedData['type'] = ($r->type==1)?'<div class="badge badge-info">Income</div>':
                    '<div class="badge badge-primary">Expense</div>';
            $nestedData['details'] = $r->details;
            $nestedData['created'] = $r->created_by;
            $sts = ($r->status==1)?
                $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->accid.'" data-sts="0" href="#">Disable</a></div>
                </div>
                 </div>':
            '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Disable</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->accid.'" data-sts="1" href="#">Active</a></div>
                </div>
            </div>';
            $nestedData['sts'] = $sts;
            $nestedData['action'] = '<a class="editmdl" data-accid="'.$r->accid.'" data-secid="'.$r->secid.'" data-grpid="'.$r->grpid.'" data-acc_name="'.$r->acc_name.'" data-dtl="'.$r->details.'"'
                    . ' data-typ="'.$r->type.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->accid.'" data-ttl="'.$r->acc_name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function updateAccount(Request $request)
    {
        $account = Account::find($request->accid);
        $account->secid =  $request->usecid;
        $account->grpid =  $request->ugrpid;
        $account->acc_name =  $request->uacc_name;
        $account->type =  $request->utype;
        $account->details = $request->udetails;
        $account->updated_by = Auth::guard('admin')->user()->id;
        $account->save();
        $notification = array(
                'message' => 'Updated Successfully',
                'type' => 'warning'
            );
        return Response::json($notification); 
    }
    public function statusAccount(Request $request)
    {
        $acc= Account::find($request->sid);
        $acc->status = $request->sts;
        $acc->save();
        if($request->sts==1){
            $msg= 'Acount Activated Successfully';
            $typ= 'success';
        }else{
            $msg= 'Acount Inactivated Successfully';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    public function deleteAccount(Request $request)
    {
        $acc = Account::find($request->delid);
        $acc->delete();
        $notification = array(
                 'message' => 'Acount Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }

}
