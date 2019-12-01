<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Slot;
use PDF;


class ReportController extends Controller
{
    public function slotPrint(Request $request)
    {
        
        $day_id=$request->searchday;
        $ground_id=$request->searchgrnd;
        $type_id=$request->searchtyp;
        // $limit = $request->input('length');
        // $start = $request->input('start');
        // $totalData = Slot::count();
        // $order = $columns[$request->input('order.0.column')];
        // $dir = $request->input('order.0.dir');
        
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
                    $pdf = PDF::loadView('report.slotPrint',['posts'=>$posts,'total'=>$total]);
                   
        return $pdf->stream('Slot-Pdf.pdf');
    }
}
