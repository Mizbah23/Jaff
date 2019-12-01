<?php

namespace Jaff\Http\Controllers;
use Jaff\Singleimage;
use Response;
use Illuminate\Http\Request;

class SingleimageController extends Controller
{
        public function singleImage()
    {
        $data = array();
        $data['title'] = 'Single Images';
        $data['images']=Singleimage::where('id',1)->first();
        return view('admin.pages.home.singleImage',$data);
    }

        public function saveImages(Request $request)
    {
        // return($request->all());

        $upload_path='public/img/single_image/';
        $images = Singleimage::find(1);

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
}
