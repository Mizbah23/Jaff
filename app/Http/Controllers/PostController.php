<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Jaff\Category;
use Jaff\Post;
use Auth;
class PostController extends Controller
{
    public function showAllposts() 
    {
        $data = array();
        $data['title'] = 'Latest Posts';
        $data['posts'] = Post::orderBy('post_id','desc')->paginate(3);
        return view('user.post.view_posts',$data); 
    }
    public function createPost() 
    {
        $data = array();
        $data['categories'] = Category::get();
        $data['title'] = 'Create Post';
        return view('user.post.create_post',$data);
    }
    public function savePost(Request $request) 
    {
        $upload_path='public/img/post/';
        $post = new Post;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::guard()->user()->id;
        $post->title = $request->title;
        $post->body = $request->body;

        $image1=$request->file('post_image');
        if($image1)
        {
            $image_name1=str_random(3).$request->title;
            $ext=strtolower($image1->getClientOriginalExtension());
            $image_full_name1=$image_name1.'.'.$ext;
            $image_url1=$upload_path.$image_full_name1;
            $success=$image1->move($upload_path,$image_full_name1);
            if($success)
            {
                $post->post_image = $image_url1;
            }
        }
        
        $image2=$request->file('post_image2');
        if($image2)
        {
            $image_name2=str_random(3).$request->title;
            $ext=strtolower($image2->getClientOriginalExtension());
            $image_full_name2=$image_name2.'.'.$ext;
            $image_url2=$upload_path.$image_full_name2;
            $success=$image2->move($upload_path,$image_full_name2);
            if($success)
            {
                $post->post_image2 = $image_url2;
            }
        }

        $image3=$request->file('post_image3');
        if($image3)
        {
            $image_name3=str_random(3).$request->title;
            $ext=strtolower($image3->getClientOriginalExtension());
            $image_full_name3=$image_name3.'.'.$ext;
            $image_url3=$upload_path.$image_full_name3;
            $success=$image3->move($upload_path,$image_full_name3);
            if($success)
            {
                $post->post_image3 = $image_url3;
            }
        }
        
        $image4 =$request->file('post_image4');
        if($image4)
        {
            $image_name4=str_random(3).$request->title;
            $ext=strtolower($image4->getClientOriginalExtension());
            $image_full_name4=$image_name4.'.'.$ext;
            $image_url4=$upload_path.$image_full_name4;
            $success=$image4->move($upload_path,$image_full_name4);
            if($success)
            {
                $post->post_image4 = $image_url4;
            }
        }
        $image5=$request->file('post_image5');
        if($image5)
        {
            $image_name5=str_random(3).$request->title;
            $ext=strtolower($image5->getClientOriginalExtension());
            $image_full_name5=$image_name5.'.'.$ext;
            $image_url5=$upload_path.$image_full_name5;
            $success=$image5->move($upload_path,$image_full_name5);
            if($success)
            {
                $post->post_image5 = $image_url5;
            }
        }
        $post->post_date = $request->post_date;
        $post->location = $request->location;
        $post->quantity = $request->quantity;
        $post->save();
        return back();
    }
    public function showSinglePost($slug)
    {
        $data = array();
        $data['post'] = Post::findBySlug($slug);
        return view('user.post.single_post',$data);
    }
}
