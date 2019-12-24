<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Weekday;
use Jaff\Type;
use Jaff\Slider;
use Jaff\Coach;
use Jaff\Offer;
use Jaff\Program;
use Jaff\Post;
use Jaff\About;
use Jaff\Singleimg;
use Jaff\Testimonial;
use Jaff\Notice;
use Jaff\User;
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
        $data['users']=User::where('status',1)->get();
        $data['sliders'] = Slider::where('status',1)->get();
        $data['simg'] = Singleimg::where('id',1)->first();
        $data['programs'] = Program::where('status',1)->get();
        $data['coaches']=Coach::where('status',1)->get();
        $data['abouts']=About::orderBy('id','asc')->get();
        $data['testimonials'] = Testimonial::orderBy('id','desc')->limit(5)->get();
        $data['latest'] = Post::where('status',1)->select('title','slug','post_img','created_at')
                ->orderBy('post_id','desc')->limit(6)->get();
        $data['offers'] = Offer::where('status',1)->get();
        $data['notices'] = Notice::orderby('notice_date','desc')->limit(4)->get();
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
    public function getBooking()
    {
        $data = array();
        $data['title'] = 'Jaff';
        return view('user.pages.booking',$data);
    }
    public function showAllNews()
    {
        $data = array();
        $data['title'] = 'News & Updates';
        $data['simg'] = Singleimg::where('id',1)->first();
        $data['offers'] = Offer::where('status',1)->get();
        $data['list'] = Post::where('status',1)->paginate(3);
        $data['recent'] = Post::where('status',1)->select('title','slug','post_img')
                ->orderBy('post_id','desc')->limit(4)->get();
        $data['popular'] = Post::where('status',1)->select('title','slug','post_img')
                           ->orderby('view_count','desc')->limit(2)->get();

        return view('user.pages.news',$data);
    }

    public function showSingleNews($slug) 
    {
        $data = array();
        $post = Post::findBySlug($slug);
        $post->view_count = $post->view_count + 1;
        $post->save();
        $data['info'] = $post;
        $data['recent'] = Post::where('status',1)->select('title','slug','post_img')
                ->orderBy('post_id','desc')->limit(4)->get();
        $data['popular'] = Post::where('status',1)->select('title','slug','post_img')
                           ->orderby('view_count','desc')->limit(2)->get();
        $data['prev'] =Post::where('post_id','<',$post->post_id)->orderBy('post_id', 'desc')->first();
        $data['next'] =Post::where('post_id','>',$post->post_id)->first();
        return view('user.pages.single_news',$data);
    }  

    public function showAllNotice()
    {
        $data = array();
        $data['title'] = 'Notice';
        $data['simg'] = Singleimg::where('id',1)->first();
        $data['offers'] = Offer::where('status',1)->get();
        $data['list'] = Notice::orderby('notice_date','desc')->paginate(6);
        $data['latest'] = Notice::select('headline')->orderBy('id','desc')->limit(4)->get();
        $data['recent'] = Post::where('status',1)->select('title','slug','post_img')
                ->orderBy('post_id','desc')->limit(4)->get();
        $data['popular'] = Post::where('status',1)->select('title','slug','post_img')
                           ->orderby('view_count','desc')->limit(2)->get();

        return view('user.pages.notice',$data);
    }
    
}
