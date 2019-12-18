<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Program;
use Jaff\Coach;
use Jaff\About;
use Jaff\Singleimg;
use Jaff\Testimonial;
use Jaff\Membership;
use Jaff\Notice;
use Response;
class ProgramController extends Controller
{
    public function getProgram(Request $request) 
    {
        $columns = array(0 =>'title',1=> 'image',2=> 'description',3=> 'location',4=> 'status',5=> 'action'
        );
        $totalData = Program::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Program::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Program::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Program::where('title', 'like', "%{$search}%")
                    ->orwhere('location', 'like', "%{$search}%")
                    ->orwhere('author', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Program::where('title', 'like', "%{$search}%")
                    ->orwhere('location', 'like', "%{$search}%")
                    ->orwhere('author', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['title'] = $r->title;
            $nestedData['img'] = '<img src="'.asset($r->image).'" alt=" placeholder image" height="100" width="100">';
            $nestedData['description'] = $r->description;
            $nestedData['info'] = 'Time:'.$r->time.'<br>Location:'.$r->location.'<br>Author:'.$r->author.'<br>Price:'.$r->price;
            if( $r->status==0){
                $sts = '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Off</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="1" href="#">Live</a></div>
                </div>
                 </div>';
            }else{
                 $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Live</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="0" href="#">Off</a></div>
                </div>
                 </div>';
            }
            $nestedData['sts']=$sts;
            $nestedData['action'] = '<a class="editmdl" data-pid="'.$r->id.'" data-utitle="'.$r->title.'" data-uimage="'.asset($r->image).'" data-des="'.$r->description.'" '
                    . 'data-time="'.$r->time.'" data-loc="'.$r->location.'" data-author="'.$r->author.'" data-price="'.$r->price.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delpid="'.$r->id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function updateProgram(Request $request)
    {
        $upload_path='public/img/program/';
        $prog = Program::find($request->pid);
        $prog->title = $request->utitle;
        $prog->description = $request->udescription;
        $prog->location = $request->ulocation;
        $prog->time = $request->utime;
        $prog->author = $request->uauthor;
        $prog->price = $request->uprice;
        $image=$request->file('uimage');
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
                (file_exists($request->old))?unlink($request->old):'';
            }
        }
        $prog->save();
        $notification = array(
                'message' => 'Program Upadted Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function deleteProgram(Request $request)
    {
        $img = Program::where('id',$request->delpid)->value('image');
        if(file_exists($img)){unlink($img);}
        $prog = Program::find($request->delpid);
        $prog->delete();
        $notification = array(
                 'message' => 'Program Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusProgram(Request $request)
    {
        $prog= Program::find($request->sid);
        $prog->status = $request->sts;
        $prog->save();
        $notification = array(
                'message' => ($request->sts==1)?'Program Is Live':'Program Disabled',
                'type' => ($request->sts==1)?'success':'warning',
            );
        return Response::json($notification); 
    }
    //**************************Coaches************************************
    public function coachList()
    {
        $data = array();
        $data['title'] = 'Academy Coaches';
        return view('admin.pages.home.coaches',$data);
    }
    public function saveCoach(Request $request)
    {
        // var_dump('expression');
        
        $upload_path='public/img/coach/';
        $coach = new Coach;
        $coach->name = $request->name;
        $coach->designation = $request->designation;
        $coach->facebook = $request->facebook;
        $coach->email = $request->email;
        $coach->phone = $request->phone;
        $coach->details = $request->details;
        $image=$request->file('image');
        if($image)
        {
            $image_name=str_random(3).$request->name;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $coach->image=$image_url;
            }
        }
        $coach->save();
        $notification = array(
                'message' => 'Coach Info Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function getCoaches(Request $request) 
    {
        $columns = array(0 =>'id',1=> 'name',2=> 'designation',3=> 'email',4=> 'details',5=> 'status',6=> 'action');
        $totalData = Coach::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Coach::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Coach::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Coach::where('name', 'like', "%{$search}%")
                    ->orwhere('designation', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Coach::where('name', 'like', "%{$search}%")
                    ->orwhere('designation', 'like', "%{$search}%")
                    ->orwhere('email', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['image'] = '<img src="'.asset($r->image).'" alt=" placeholder image" height="100" width="100">';
            $nestedData['name'] = $r->name;
            $nestedData['designation'] = $r->designation;
            $nestedData['contact'] = 'Email:'.$r->email.'<br>Phone:'.$r->phone.'<br>Facebook:'.$r->facebook;
            $nestedData['details'] = $r->details;
            
            if( $r->status==0){
                $sts = '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Inactive</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="1" href="#">Active</a></div>
                </div>
                 </div>';
            }else{
                 $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="0" href="#">Inactive</a></div>
                </div>
                 </div>';
            }
            
            $nestedData['status']=$sts;
            $nestedData['action'] = '<a href="#" class="editmdl" data-cid="'.$r->id.'" data-uname="'.$r->name.'" data-uimage="'.asset($r->image).'" data-udesignation="'.$r->designation.'" '
                    . 'data-uemail="'.$r->email.'" data-uphone="'.$r->phone.'" data-ufacebook="'.$r->facebook.'" data-udetails="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delcid="'.$r->id.'" data-ttl="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function updateCoach(Request $request)
    {
        $upload_path='public/img/coach/';
        $coach = Coach::find($request->cid);
        $coach->name = $request->uname;
        $coach->designation = $request->udesignation;
        $coach->facebook = $request->ufacebook;
        $coach->email = $request->uemail;
        $coach->phone = $request->uphone;
        $coach->details = $request->udetails;
        $image=$request->file('uimage');
        if($image)
        {
            $image_name=str_random(3).$request->name;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $coach->image=$image_url;
                if($request->oldimg){
                    unlink($request->oldimg);
                }
            }
        }
        $coach->save();
        $notification = array(
                'message' => 'Coach Info Updated Successfully',
                'type' => 'success'
        );
        return Response::json($notification);
    }
     public function deleteCoach(Request $request)
    {
        $img = Coach::where('id',$request->delcid)->value('image');
        if(file_exists($img)){unlink($img);}
        $co = Coach::find($request->delcid);
        $co->delete();
        $notification = array(
                 'message' => 'Coach Info Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusCoach(Request $request)
    {
        $co= Coach::find($request->sid);
        $co->status = $request->sts;
        $co->save();
        $notification = array(
                'message' => ($request->sts==1)?'Coach Activated':'Coach Disabled',
                'type' => ($request->sts==1)?'success':'warning',
            );
        return Response::json($notification); 
    }
    
    /************about us***************/
    public function abouts()
    {
        $data = array();
        $data['title'] = 'About us';
        return view('admin.pages.home.about_us',$data);
    }
    
    public function saveAbouts(Request $request)
    {
        $upload_path='public/img/about_us/';
        $abouts = new About;
        $abouts->title = $request->title;
        $abouts->details = $request->details;
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
                $abouts->image=$image_url;
            }
        }
        $abouts->save();
        $notification = array(
                'message' => 'Information Saved Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }
    public function getAbouts(Request $request) 
    {
        $columns = array(0 =>'id',1=> 'title',2=> 'details',3=> 'action');
        $totalData = About::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = About::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  About::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = About::where('title', 'like', "%{$search}%")
                    ->orwhere('details', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = About::where('title', 'like', "%{$search}%")
                            ->orwhere('details', 'like', "%{$search}%")
                            ->count();
        }
    $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['image'] = '<img src="'.asset($r->image).'" alt="" height="100" width="100">';
            $nestedData['title'] = $r->title;
            $nestedData['details'] = $r->details;
            $nestedData['action'] = '<a href="#" class="editmdl" data-id="'.$r->id.'" data-title="'.$r->title.'" data-uimage="'.asset($r->image).'" data-details="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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

    public function updateAbout(Request $request)
    
    {
        $upload_path='public/img/about_us/';
        $abouts = About::find($request->id);
        $abouts->title = $request->title;
        $abouts->details = $request->details;

        $image=$request->file('uimage');
        if($image)
        {
            $image_name=str_random(3).$request->name;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $abouts->image=$image_url;
               (file_exists($request->oldimg))?unlink($request->oldimg):'';
            }
        }
        $abouts->save();
        $notification = array(
                'message' => 'About us Section Updated Successfully',
                'type' => 'success'
        );
        return Response::json($notification);
    }

    public function deleteAbout(Request $request)
    {
        $img = About::where('id',$request->delid)->value('image');
        if(file_exists($img)){unlink($img);}
        $abouts = About::find($request->delid);
        $abouts->delete();
        $notification = array(
                 'message' => 'About Info Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }


    
    //**************SINGLE IMAGE*************//
        public function singleImage()
    {
        $data = array();
        $data['title'] = 'Single Images';
        $data['images']=Singleimg::where('id',1)->first();
        return view('admin.pages.home.singleImage',$data);
    }

        public function saveImages(Request $request)
    {
        // return($request->all());

        $upload_path='public/img/single_image/';
        $images = Singleimg::find(1);

		$ofr = $request->oldoffer;
		$abt = $request->oldabout;


        $image=$request->file('offer_image');
        if($image)
        {
            $image_name=str_random(4).'offer';
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                 $images->offer_image=$image_url;
                 $ofr = $image_url;
                (file_exists($request->oldoffer))?unlink($request->oldoffer):'';//
            }
        }


        $image=$request->file('about_image');
        if($image)
        {
            $image_name=str_random(4).'about';
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                  $images->about_image=$image_url;
                  $abt =$image_url;
                 (file_exists($request->oldabout))?unlink($request->oldabout):'';
            }
        }

        $images->save();
        
        $notification = array(
        	    'offerimg'=>$ofr,
        	    'aboutimg'=>$abt,
                'message' => 'Image Saved Successfully',
                'type' => 'success'
        );
        return $notification; 
    }

    /************Testimonials**************/

    public function testimonialList()
    {
        $data = array();
        $data['title'] = 'Testimonials';
        return view('admin.pages.home.testimonials',$data);
    }

    public function saveTestimonial(Request $request)
    {

        $upload_path='public/img/testimonials/';
        $testimonials = new Testimonial;
        $testimonials->name = $request->name;
        $testimonials->designation = $request->designation;
        $testimonials->message = $request->message;
        $image=$request->file('image');
        if($image)
        {
            $image_name=str_random(3).$request->name;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $testimonials->image=$image_url;
            }
        }
        $testimonials->save();
        $notification = array(
                'message' => 'Testimonial Included Successfully',
                'type' => 'success'
        );
        return Response::json($notification); 
    }

    public function getTestimonial(Request $request) 
    
    {
        $columns = array(0 =>'id',1=> 'name',2=> 'designation',3=> 'image',4=> 'message',5=> 'action');
        $totalData = Testimonial::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Testimonial::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Testimonial::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Testimonial::where('name', 'like', "%{$search}%")
                    ->orwhere('designation', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Testimonial::where('name', 'like', "%{$search}%")
                            ->orwhere('designation', 'like', "%{$search}%")
                            ->count();
        }
    $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            
            $nestedData['name'] = $r->name;
            $nestedData['designation'] = $r->designation;
            $nestedData['image'] = '<img src="'.asset($r->image).'" alt="" height="100" width="100">';
            $nestedData['message'] = $r->message;
            $nestedData['action'] = '<a href="#" class="editmdl" data-tid="'.$r->id.'" data-uname="'.$r->name.'" data-uimage="'.asset($r->image).'" data-udesignation="'.$r->designation.'" data-umessage="'.$r->message.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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

    public function updateTestimonial(Request $request)
    
    {
        $upload_path='public/img/testimonials/';
        $testimonials = Testimonial::find($request->tid);
        $testimonials->name = $request->uname;
        $testimonials->designation = $request->udesignation;
        $testimonials->message = $request->umessage;

        $image=$request->file('uimage');
        if($image)
        {
            $image_name=str_random(3).$request->name;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $testimonials->image=$image_url;
               (file_exists($request->oldimg))?unlink($request->oldimg):'';
            }
        }
        $testimonials->save();
        $notification = array(
                'message' => 'Testimonial Info Updated Successfully',
                'type' => 'success'
        );
        return Response::json($notification);
    }

    public function deleteTestimonial(Request $request)
    {
        $img = Testimonial::where('id',$request->delid)->value('image');
        if(file_exists($img)){unlink($img);}
        $testimonials = Testimonial::find($request->delid);
        $testimonials->delete();
        $notification = array(
                 'message' => 'Testimonial Info Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }


    /*******Membership*************/

    public function membershipList()
    {
        $data = array();
        $data['title'] = 'Membership';
        return view('admin.pages.home.membership',$data);
    }

    public function saveMembership(Request $request)
    {

        $membership = new Membership;
        $membership->name = $request->name;
        $membership->duration = $request->duration;
        $membership->fee = $request->fee;
        $request->discount? $membership->discount=1 :  $membership->discount=0;
        $membership->damount = $request->damount;

        $membership->save();
        $notification = array(
                'message' => 'Membership Info Successfully Included',
                'type' => 'success'
        );
        return Response::json($notification); 
    }

        public function getMembership(Request $request) 
    
    {
        $columns = array(0 =>'id',1=> 'name',2=> 'duration',3=> 'fee',4=> 'discount',5=> 'damount',6=>'status',7=>'action');
        $totalData = Membership::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Membership::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Membership::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Membership::where('name', 'like', "%{$search}%")
                    ->orwhere('fee', 'like', "%{$search}%")
                    ->orwhere('duration','like',"%{$search}")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Membership::where('name', 'like', "%{$search}%")
                            ->orwhere('fee', 'like', "%{$search}%")
                            ->orwhere('duration','like',"%{$search}")
                            ->count();
        }
    $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            
            $nestedData['name'] = $r->name;
            $nestedData['duration'] = $r->duration;
            $nestedData['fee'] = $r->fee;

            if( $r->discount==0){
                $discount = '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Off</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-discount="'.$r->discount.'" data-discount="0" href="#">Activated</a></div>
                </div>
                 </div>';
            }else{
                 $discount = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Live</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-discount="'.$r->discount.'" data-discount="1" href="#">Deactivated</a></div>
                </div>
                 </div>';
            }
            $nestedData['discount'] = $r->discount;
            $nestedData['damount'] = $r->damount;

            if( $r->status==0){
                $status = '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Off</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-status="'.$r->status.'" data-status="1" href="#">Activated</a></div>
                </div>
                 </div>';
            }else{
                 $status = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Live</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-status="'.$r->status.'" data-status="0" href="#">Deactivated</a></div>
                </div>
                 </div>';
            }
            $nestedData['status'] = $r->status;
            $nestedData['action'] = '<a href="#" class="editmdl" data-id="'.$r->id.'" data-name="'.$r->name.'" data-duration="'.$r->duration.'" data-fee="'.$r->fee.'" data-discount="'.$r->discount.'" data-damount="'.$r->damount.'" data-status="'.$r->status.'"
            style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->name.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
        $membership->name = $request->name;
        $membership->duration = $request->duration;
        $membership->fee = $request->fee;
        $request->discount? $membership->discount=1 :  $membership->discount=0;
        $membership->damount = $request->damount;


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
        $membership= Membership::find($request->id);
        $membership->status = $request->status;
        $membership->save();
        $notification = array(
                'message' => ($request->status==1)?'Status Activated':'Status Disabled',
                'type' => ($request->status==1)?'success':'warning',
            );
        return Response::json($notification); 
    }

    /*************** Route for Notice ********************/
        public function noticeList()
    {
        $data = array();
        $data['title'] = 'Notice';
        return view('admin.pages.home.notices',$data);
    }
      
        public function saveNotice(Request $request)
    {

        $notice = new Notice;
        $notice->notice_date = $request->notice_date;
        $notice->headline = $request->headline;
        $notice->description = $request->description;
        $notice->created_by = Auth::guard('admin')->user()->id;

        $notice->save();
        $notification = array(
                'message' => 'New notice added!',
                'type' => 'success'
        );
        return Response::json($notification); 
    }

        public function getNotice(Request $request) 
    
    {
        $columns =array(0 =>'id',1=> 'notice_date',2=> 'headline',3=> 'description',4=> 'created_by',5=>'action');
        $totalData = Notice::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Notice::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered = Notice::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Notice::where('notice_date', 'like', "%{$search}%")
                    ->orwhere('headline', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Notice::where('notice_date', 'like', "%{$search}%")
                            ->orwhere('headline', 'like', "%{$search}%")
                            ->count();
        }
    $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            
            $nestedData['notice_date'] = $r->notice_date;
            $nestedData['headline'] = $r->headline;
            $nestedData['description'] = $r->description;
            $nestedData['action'] = '<a href="#" class="editmdl" data-id="'.$r->id.'" data-notice_date="'.$r->notice_date.'" data-headline="'.$r->headline.'" data-description="'.$r->description.'" 
            style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delid="'.$r->id.'" data-ttl="'.$r->headline.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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

    public function updateNotice(Request $request)
    
    {
        $notice = Notice::find($request->id);
        $notice->notice_date = $request->notice_date;
        $notice->headline = $request->headline;
        $notice->description = $request->description;
        $notice->created_by= Auth::guard('admin')->user()->id;
        $notice->save();
        $notification = array(
                'message' => 'Notice has been modified',
                'type' => 'success'
        );
        return Response::json($notification);
    }

    public function deleteNotice(Request $request)
    {
      
        $notice = Notice::find($request->delid);
        $notice->delete();
        $notification = array(
                 'message' => 'Notice Deleted ',
                 'type' => 'error'
             );
        return Response::json($notification);
    }

}
