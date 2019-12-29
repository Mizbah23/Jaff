<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Jaff\Admin;
use Jaff\Slider;
use Response;
use Validator;
class SliderController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:admin');
    }
    public function sliderList()
    {
        $data = array();
        $data['title'] = 'Slider Settings';
        $data['sliders'] = Slider::where('status',1)->get();
        return view('admin.pages.sliders',$data);
    }
    public function getSliders(Request $request)
    {
        $columns = array(0 =>'title',1=> 'sub_title',2=> 'slider_img',3=> 'status',4=> 'action'
        );
        $totalData = Slider::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Slider::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Slider::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Slider::where('sliders.title', 'like', "%{$search}%")
                    ->orwhere('sliders.sub_title', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Slider::where('sliders.title', 'like', "%{$search}%")
                    ->orwhere('sliders.sub_title', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['title'] = $r->title;
//            $nestedData['sub'] = $r->sub_title;
            $nestedData['img'] = '<img src="'.asset($r->slider_img).'" alt="'.$r->name.'" height="60" width="60">';
            if( $r->status==0){
                $sts = '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Disabled</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="1" href="#">Live</a></div>
                </div>
                 </div>';
            }else{
                 $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Live</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-sid="'.$r->id.'" data-sts="0" href="#">Disable</a></div>
                </div>
                 </div>';
            }
            $nestedData['sts']=$sts;

            $nestedData['action'] = '<a class="editmdl" data-sid="'.$r->id.'" data-title="'.$r->title.'" data-img="'.asset($r->slider_img).'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-delsid="'.$r->id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function getPic(Request $request)
    {
        $slide = Slider::where('id',1)->first();
//        
//        $target_dir = "public/img/slider";
        $file_list = array();
//        $dir = $target_dir;
//        
//        if (is_dir($dir)){
//
//    if ($dh = opendir($dir)){

      // Read files
//      while (($file = readdir($dh)) !== false){
//
//        if($file != '' && $file != '.' && $file != '..'){

          // File path
//          $file_path = $target_dir.$file;

          // Check its not folder
//          if(!is_dir($file_path)){
        
               $size = filesize($slide->slider_img);

             $file_list[] = array('name'=> $slide->title,'size'=>$size,'path'=> asset($slide->slider_img));

             //
//          }
//        }
//
//      }
//      closedir($dh);
//    }
//  }

  echo json_encode($file_list);
//    }
}
    public function saveSlider(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'slider_img'=>'dimensions:min_width=5000,max_height=3000'
        ]);
         if ($validator->fails()) {      
           // return response()->json(['errors'=>$validator->errors()]);//
           $message='Maximum width,height must be between 5000X3000';
           $type='error';
        }else{
        $upload_path='public/img/slider/';
        $slider = new Slider;
        $slider->title = $request->title;
        $image=$request->file('slider_img');
        if($image)
        {
            $image_name=str_random(3).$request->uname;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $slider->slider_img=$image_url;
            }
        }
        $slider->save();
        $message='Slider Saved Successfully';
        $type='success';
    }
            $notification = array(
                'message' => $message,
                'type' => $type
        );
        return Response::json($notification); 

        

    }
    public function updateSlider(Request $request)
    {
         $validator = Validator::make($request->all(),[
        'uslider_img'=>'dimensions:min_width=5200,max_height=3000'
        ]);
        if ($validator->fails()) {      
           $message='Maximum width,height must be between 5000X3000';
           $type='error';
        }else{
        $upload_path='public/img/slider/';
        $slider = Slider::find($request->slider_id);
        $slider->title = $request->utitle;
        $image=$request->file('uslider_img');
        if($image)
        {
            $image_name= str_random(5).$request->privtyp;
            $ext= strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $slider->slider_img = $image_url;
                if(file_exists($request->old_img))
                {
                    unlink($request->old_img);
                }
            }
        }
        $slider->save();
        $message='Slider Updated Successfully';
        $type='error';
        }
        $notification = array(
                'message' =>$message,
                'type' => $type
        );
    
        return Response::json($notification); 
        
    }
    public function deleteSlider(Request $request)
    {
        $slider = Slider::find($request->delsid);
        $slider->delete();
        $notification = array(
                 'message' => 'Slider Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusSlider(Request $request)
    {
        $slider= Slider::find($request->sid);
        $slider->status = $request->sts;
        $slider->save();
        if($request->sts==1){
            $msg= 'Slider Is Live';
            $typ= 'success';
        }else{
            $msg= 'Slider Disabled';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    
}
