<?php

namespace Jaff\Http\Controllers;
use Illuminate\Http\Request;
use Jaff\Admin;
use Jaff\Balance;
use Jaff\Account;
use Illuminate\Support\Facades\Hash;
use Response;
use Auth;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function showIncome()
    {
        $data = array();
        $data['title'] = 'Income Entry';
        $data['accs'] = Account::where('type',1)->get();
        return view('admin.pages.balance.income',$data);
    }
    public function listIncome(Request $request)
    {
        $from =  ($request->from)? $request->from:'';
        $to =  ($request->to)? $request->to:''; 
        
        $columns = array(0 =>'date',1=> 'accid',2=> 'amount',3=> 'details',4=> 'created_by',5=>'created_by');
        $totalData = Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    
                    ->where('accounts.type',1)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Balance::join('accounts','balances.accid','=','accounts.accid')->where('accounts.type',1)
                    ->select('balances.*','accounts.acc_name')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                              ->where('accounts.type',1)->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Balance::join('accounts','balances.accid','=','accounts.accid')->where('accounts.type',1)
                    ->select('balances.*','accounts.acc_name')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->where('accounts.acc_name', 'like', "%{$search}%")
                    ->orwhere('balances.date', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->where('accounts.type',1)
                    ->where('accounts.acc_name', 'like', "%{$search}%")
                    ->orwhere('balances.date', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['date'] = $r->date;
            $nestedData['acc'] = $r->acc_name;
            $nestedData['amount'] = $r->amount;
            $nestedData['details'] = $r->details;
            $nestedData['created'] = $r->created_by;
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-accid="'.$r->accid.'" data-date="'.$r->date.'"'
                    . ' data-amount="'.$r->amount.'" data-dtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->date.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function saveIncome(Request $request)
    {
        $income = new Balance;
        $income->accid =  $request->accid;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->details = $request->details;
        $income->created_by = Auth::guard('admin')->user()->name;
        $income->save();
        $notification = array(
                'message' => 'Income Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function updateIncome(Request $request)
    {
        $income = Balance::find($request->iid);
        $income->accid =  $request->uaccid;
        $income->date = $request->udate;
        $income->amount = $request->uamount;
        $income->details = $request->udetails;
        $income->updated_by = Auth::guard('admin')->user()->name;
        $income->save();
        $notification = array(
                'message' => 'Income Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function delIncome(Request $request)
    {
        $acc = Balance::find($request->delid);
        $acc->delete();
        $notification = array(
                 'message' => 'Income Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    } 
    public function sumIncome(Request $request)
    {
        $from =  ($request->from)? $request->from:'';
        $to =  ($request->to)? $request->to:''; 
        $total= Balance::join('accounts','balances.accid','=','accounts.accid')
                ->where('accounts.type',1)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                ->sum('balances.amount');
        return number_format($total);
    }
    //===================================Expense================================
    
    public function showExpense()
    {
        $data = array();
        $data['title'] = 'Expense Entry';
        $data['accs'] = Account::where('type',2)->get();
        return view('admin.pages.balance.expense',$data);
    }
    public function listExpense(Request $request)
    {
        $from =  ($request->from)? $request->from:'';
        $to =  ($request->to)? $request->to:''; 
        
        $columns = array(0 =>'date',1=> 'accid',2=> 'amount',3=> 'details',4=> 'created_by',5=>'created_by');
        $totalData = Balance::join('accounts','balances.accid','=','accounts.accid')

                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                              ->where('accounts.type',2)->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->where('accounts.type',2)
                    ->select('balances.*','accounts.acc_name')
                    
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                              ->where('accounts.type',2)->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->where('accounts.type',2)
                    ->select('balances.*','accounts.acc_name')
                    ->where('accounts.acc_name', 'like', "%{$search}%")
                    ->orwhere('balances.date', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Balance::join('accounts','balances.accid','=','accounts.accid')
                    ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                    ->where('accounts.type',2)
                    ->where('accounts.acc_name', 'like', "%{$search}%")
                    ->orwhere('balances.date', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {
            $nestedData['date'] = $r->date;
            $nestedData['acc'] = $r->acc_name;
            $nestedData['amount'] = $r->amount;
            $nestedData['details'] = $r->details;
            $nestedData['created'] = $r->created_by;
            $nestedData['action'] = '<a class="editmdl" data-id="'.$r->id.'" data-accid="'.$r->accid.'" data-date="'.$r->date.'"'
                    . ' data-amount="'.$r->amount.'" data-dtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->date.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function saveExpense(Request $request)
    {
        $income = new Balance;
        $income->accid =  $request->accid;
        $income->date = $request->date;
        $income->amount = $request->amount;
        $income->details = $request->details;
        $income->created_by = Auth::guard('admin')->user()->name;
        $income->save();
        $notification = array(
                'message' => 'Expense Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function updateExpense(Request $request)
    {
        $income = Balance::find($request->iid);
        $income->accid =  $request->uaccid;
        $income->date = $request->udate;
        $income->amount = $request->uamount;
        $income->details = $request->udetails;
        $income->updated_by = Auth::guard('admin')->user()->name;
        $income->save();
        $notification = array(
                'message' => 'Expense Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function delExpense(Request $request)
    {
        $acc = Balance::find($request->delid);
        $acc->delete();
        $notification = array(
                 'message' => 'Expense Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    } 
    public function sumExpense(Request $request)
    {
        $from =  ($request->from)? $request->from:'';
        $to =  ($request->to)? $request->to:''; 
        $total= Balance::join('accounts','balances.accid','=','accounts.accid')
                ->where('accounts.type',2)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                ->sum('balances.amount');
        return number_format($total);
    }
    
    //================================================
    public function showBalance()
    {
        $data = array();
        $data['title'] = 'Balance Information';
//        $a= date('Y-m-d', strtotime(now()));
         $data['balances'] = Balance::join('accounts','balances.accid','=','accounts.accid')
        ->join('asections','accounts.secid','=','asections.secid')
        ->join('agroups','accounts.grpid','=','agroups.grpid')
        ->select('balances.*','accounts.acc_name','asections.sec_name','agroups.grp_name','accounts.type')
//        ->whereDate('balance.date','=',$a)
        ->get();
        return view('admin.pages.balance.balance',$data);
    }
    public function sumBalance(Request $request)
    {
        $data = array();
        $from =  ($request->from)? $request->from:'';
        $to =  ($request->to)? $request->to:''; 
        $income = Balance::join('accounts','balances.accid','=','accounts.accid')
                ->where('accounts.type',1)
                ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
                ->sum('balances.amount');
        $data["income"]=number_format($income);
        $expense = Balance::join('accounts','balances.accid','=','accounts.accid')
        ->where('accounts.type',2)
        ->when($from, function ($query, $from){return $query->whereDate('balances.date','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('balances.date','<=',$to);})
        ->sum('balances.amount');
        $data["expense"]=number_format($expense);
        return $data;
    }
    
}
