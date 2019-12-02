<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Weekday;
use Jaff\Type;
use Jaff\Slider;
use Jaff\Coach;
use Jaff\Offer;
use Jaff\Program;
use Jaff\About;
use Jaff\Singleimg;
use Jaff\Testimonial;
use DB;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getMainPage()
    {
        $data = array();
        $data['title'] = 'Jaff Sports';
        $data['sliders'] = Slider::where('status',1)->get();
        $data['simg'] = Singleimg::where('id',1)->first();
        $data['programs'] = Program::where('status',1)->get();
        $data['coaches']=Coach::where('status',1)->get();
        $data['abouts']=About::orderBy('id','asc')->get();
        $data['offers'] = Offer::where('status',1)->get();
        $data['testimonials'] = Testimonial::orderBy('id','desc')->limit(5)->get();
        $data['weeks'] = Weekday::select('weekdays.day','weekdays.id','weekdays.sts',DB::raw("(SELECT count(slots.slot_id) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as total_slot"),DB::raw("(SELECT MIN(slots.start) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as start"),DB::raw("(SELECT MAX(slots.end) FROM slots WHERE "
                            . "slots.`day_id`=weekdays.`id`) as end"))->get();
        $data['types'] = Type::get();
        return view('user.pages.home',$data);
    }
    public function programList()
    {
        $data = array();
        $data['title'] = 'Program & Clinics';
        return view('admin.pages.home.programs',$data);
    }
    public function saveProgram(Request $request)
    {
        $upload_path='public/img/program/';
        $prog = new Program;
        $prog->title = $request->title;
        $prog->description = $request->description;
        $prog->location = $request->location;
        $prog->time = $request->time;
        $prog->author = $request->author;
        $prog->price = $request->price;
        $image=$request->file('image');
        if($image)
        {
            $image_name=str_random(3).$request->title;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $prog->image=$image_url;
            }
        }
        $prog->save();
        $notification = array(
                'message' => 'Program Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function getTimeTable()
    {
        $data = array();
        $data['title'] = 'Slot Time Table';
        return view('user.pages.timetable',$data);
    }
    
    
}
