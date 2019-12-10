<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Slot;
use Jaff\Holiday;
use Illuminate\Support\Facades\Input;
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
}
