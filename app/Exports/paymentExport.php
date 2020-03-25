<?php

namespace Jaff\Exports;

use Jaff\PayBooking;
use Jaff\Booking;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class paymentExport implements FromCollection,WithHeadings,WithColumnFormatting,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
        use Exportable;
     public function collection()
    {
    	$from= Input::get('fromdate');
        $to=   Input::get('todate');
        $fromdate = ($from)?date("d,M Y", strtotime($from)):'';
        $todate = ($to)?date("d,M Y", strtotime($to)):'';
    	$posts = PayBooking::join('bookings','pay_bookings.book_id','=','bookings.book_id')
                ->select('pay_bookings.id','pay_bookings.date','bookings.book_code','pay_bookings.amount')
                ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
                ->when($to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
                ->orderBy('pay_bookings.date','asc')
                ->get();
            
        return $posts;
     }
    // public function __construct( $fromdate, $todate, $from, $to)
    // {
    //     $this->fromdate = $fromdate;
    //     $this->todate=$todate;
    //     $this->from=$from;
    //     $this->to=$to;
    // }
    // public function query()
    // {
    // 	$from=$this->from;
    //     $to=$this->to;
    //     // dd($to);
    //     return PayBooking::query()->join('bookings','pay_bookings.book_id','=','bookings.book_id')
    //             ->select('pay_bookings.id','pay_bookings.date','bookings.book_code','pay_bookings.amount')
    //             ->when($from, function ($query, $from){return $query->whereDate('pay_bookings.date','>=',$from);})
    //             ->when( $to, function ($query, $to){return $query->whereDate('pay_bookings.date','<=',$to);})
    //             ->orderBy('pay_bookings.date','asc')
    //             ;
    // }
    public function headings(): array
    {
        return [
            'Sl',
            'Date',
            'Booking ID',
            'Amount'
        ];
    }

        public function columnFormats(): array
    {
        return [
            'b' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

}