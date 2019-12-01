<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Ground;
use Jaff\Offer;
use Jaff\Offerdetail;
use Jaff\Slot;
use Auth;
use DB;
use Response;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function offerList() 
    {
        $data = array();
        $data['grounds'] = Ground::get();
        $data['slots'] = Slot::select('slot_id','start','end')->where('status',1)->get();
        $data['title'] = 'Offer Management';
        return view('admin.pages.slot.offer',$data);
    }
    public function getOffer(Request $request) 
    {
        $from= $request->from;$to=$request->to;
        $columns = array(0 =>'offer_title',1=> 'offer_start',2=> 'offer_end',3=> 'percentage',4=> 'details',
            5=> 'name',6=> 'statue',7=> 'action'
        );
        $totalData = Offer::when($from, function ($query, $from){return $query->whereDate('offer_start','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('offer_end','<=',$to);})->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Offer::join('grounds','offers.ground_id','=','grounds.id')
                    ->when($from, function ($query, $from){return $query->whereDate('offers.offer_start','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('offers.offer_end','<=',$to);})
                    ->select('offers.*','grounds.name',DB::raw('grounds.id as gid'),DB::raw("(SELECT count(offerdetails.offer_id) FROM offerdetails WHERE "
                            . "offerdetails.`offer_id`=offers.`id`) as totalslot"))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Offer::when($from, function ($query, $from){return $query->whereDate('offer_start','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('offer_end','<=',$to);})->count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Offer::join('grounds','offers.ground_id','=','grounds.id')
                    ->when($from, function ($query, $from){return $query->whereDate('offers.offer_start','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('offers.offer_end','<=',$to);})
                    ->select('offers.*','grounds.name',DB::raw('grounds.id as gid'),DB::raw("(SELECT count(offerdetails.offer_id) FROM offerdetails WHERE "
                            . "offerdetails.`offer_id`=offers.`id`) as totalslot"))
                    ->where('grounds.name', 'like', "%{$search}%")
                    ->orwhere('offers.offer_title', 'like', "%{$search}%")
                    ->orwhere('offers.percentage', 'like', "%{$search}%")
                    ->orwhere('offers.details', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Offer::join('grounds','offers.ground_id','=','grounds.id')
                    ->when($from, function ($query, $from){return $query->whereDate('offers.offer_start','>=',$from);})
                    ->when($to, function ($query, $to){return $query->whereDate('offers.offer_end','<=',$to);})
                    ->where('grounds.name', 'like', "%{$search}%")
                    ->orwhere('offers.offer_title', 'like', "%{$search}%")
                    ->orwhere('offers.percentage', 'like', "%{$search}%")
                    ->orwhere('offers.details', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['title'] = $r->offer_title;
            $nestedData['start'] = $r->offer_start;
            $nestedData['end'] = $r->offer_end;
            $nestedData['per'] = $r->percentage.'%';
            $nestedData['ground'] = $r->name;
            $nestedData['dtl'] = $r->details;
            $nestedData['totalslot'] =  '<a href="#" class="listmdl" data-ofrid="'.$r->id.'" data-ttl="'.$r->offer_title.' ('.date('d,M Y', strtotime($r->offer_start)).' - '.date('d,M Y', strtotime($r->offer_end)).') " ><span class="badge badge-pill badge-glow bg-warning">'.$r->totalslot.'</span></a>';
            $nestedData['sts']=($r->status==1)?
                '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">         
                    <input type="checkbox" class="custom-control-input changests" data-oid="'.$r->id.'" id="'.$r->id.'" checked>
                    <label class="custom-control-label" for="'.$r->id.'">
                        <span class="switch-text-left" style="color: white;">On</span>
                        <span class="switch-text-right" style="color: white;">Off</span>
                    </label>
                </div>':
                '<div class="custom-control custom-switch custom-switch-success mr-2 mb-1">          
                    <input type="checkbox" class="custom-control-input changests" data-oid="'.$r->id.'" id="'.$r->id.'">
                    <label class="custom-control-label" for="'.$r->id.'">
                        <span class="switch-text-left" style="color: white;">On</span>
                        <span class="switch-text-right" style="color: white;">Off</span>
                    </label>
                </div>';

            $nestedData['action'] = '<a class="editmdl" data-oid="'.$r->id.'" data-ottl="'.$r->offer_title.'" data-gid="'.$r->gid.'" data-odtl="'.$r->details.'" data-ostrt="'.$r->offer_start.'" data-oend="'.$r->offer_end.'" data-oper="'.$r->percentage.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delofrid="'.$r->id.'" data-ttl="'.$r->offer_title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function saveOffer(Request $request)
    {
        $offer =  new Offer;
        $offer->offer_title = $request->offer_title;
        $offer->percentage = $request->percentage;
        $offer->offer_start = $request->offer_start;
        $offer->offer_end = $request->offer_end;
        $offer->ground_id = $request->ground_id;
        $offer->details = $request->details;
        $offer->created_by = Auth::guard('admin')->user()->id;
        $offer->save();
        $notification = array(
                'message' => 'Offer Created Successfully',
                'type' => 'success'
            );
        return Response::json($notification);
    }
    public function countOffer(Request $request)
    {
        $from= $request->from;
        $to=$request->to;
        $total= Offer::when($from, function ($query, $from){return $query->whereDate('offer_start','>=',$from);})
        ->when($to, function ($query, $to){return $query->whereDate('offer_start','<=',$to);})
        ->count();
        return number_format($total);
    }
    public function updateOffer(Request $request)
    {
        $offer = Offer::find($request->oid);
        $offer->offer_start= $request->uoffer_start;
        $offer->offer_end= $request->uoffer_end;
        $offer->offer_title = $request->uoffer_title;
        $offer->percentage= $request->upercentage;
        $offer->details= $request->udetails;
        $offer->ground_id = $request->uground_id;
        $offer->save();
        $notification = array(
                 'message' => 'Offer Updated Successfully',
                 'type' => 'success'
             );
        return Response::json($notification);
    }
    public function deleteOffer(Request $request)
    {
        $offer = Offer::find($request->delofrid);
        $offer->delete();
        $notification = array(
                 'message' => 'Offer Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function stsOffer(Request $request)
    {
        $slotStatus = Offer::where('id',$request->oid)->value('status');
        $slot= Offer::find($request->oid);
        $slot->status =($slotStatus==1)?0:1;
        $slot->save();
        $notification = array(
                'message' => ($slotStatus==1)?'Offer Inactivated Successfully':'Offer Activated Successfully',
                'type' => ($slotStatus==1)?'warning':'success'
            );
        return Response::json($notification);
    }
    public function fetchOffer(Request $request)
    {
        $output = '';
        $list = Offer::join('offerdetails','offers.id','=','offerdetails.offer_id')
                ->join('slots','slots.slot_id','=','offerdetails.slot_id')
                ->select('offerdetails.*','offers.percentage','slots.start','slots.end')
                ->where('offers.id',$request->ofrid)->get();
        if(!empty($list)){
            foreach ($list as $li){
                $output.='<tr>
                            <td>'.date( "D,d M, Y", strtotime($li->offer_date)).'</td>
                            <td>'.date( "h:i A", strtotime($li->start)).'-'.date( "h:i A", strtotime($li->end)).'</td>
                            <td>'.$li->percentage.'%</td>
                            <td><a href="#" class="ofslt" data-ofslt="'.$li->id.'" data-ofid="'.$li->offer_id.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a></td>
                        </tr>';
            }
        }
        else{
            $output.='<tr>
                <td colspan="3">Not Applied on any slot</td>
            </tr>';
        }
        return $output;
    }
    public function delOfslt(Request $request)
    {
        $del= Offerdetail::find($request->ofslt);
        $del->delete();
        $output = '';
        $list = Offer::join('offerdetails','offers.id','=','offerdetails.offer_id')
                ->join('slots','slots.slot_id','=','offerdetails.slot_id')
                ->select('offerdetails.*','offers.percentage','slots.start','slots.end')
                ->where('offers.id',$request->ofid)->get();
        if(!empty($list)){
            foreach ($list as $li){
                $output.='<tr>
                            <td>'.date( "D,d M, Y", strtotime($li->offer_date)).'</td>
                            <td>'.date( "h:i A", strtotime($li->start)).'-'.date( "h:i A", strtotime($li->end)).'</td>
                            <td>'.$li->percentage.'%</td>
                            <td><a href="#" class="ofslt" data-ofslt="'.$li->id.'" data-ofid="'.$li->offer_id.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a></td>
                        </tr>';
            }
        }
        else{
            $output.='<tr>
                <td colspan="3">Not Applied on any slot</td>
            </tr>';
        }
        $notification = array(
                'output' => $output,
                'message' => 'offer slot Removed',
                'type' => 'warning'
            );
        return Response::json($notification);

    }
}
