<?php

namespace Jaff\Http\Controllers;

use Illuminate\Http\Request;
//use Cviebrock\EloquentSluggable\Services\SlugService;

use Jaff\Post;
use Response;
use DB;
use Auth;
class PostController extends Controller
{
    public function showCategory() 
    {
        $data = array();
        $data['title'] = 'News Category';
//        $data['posts'] = Post::orderBy('post_id','desc')->paginate(3);
        return view('admin.pages.news.news_category',$data); 
    }
    public function saveCategory(Request $request) 
    {
        $category = new Category;
        $category->category = $request->category;
        $category->save();
        $notification = array(
                'message' => 'Category Saved Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function getCatList(Request $request)
    {
        $columns = array(0 =>'category',1 =>'totalpost',2=> 'status',3=> 'action');
        $totalData = Category::count();
        $limit = $request->input('length');$start = $request->input('start');
        $order = $columns[$request->input('order.0.column')]; $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Category::select('categories.*',DB::raw("(SELECT count(post_id) FROM posts WHERE "
                            . "posts.`category_id`=categories.`id`) as totalpost"))
                    ->offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Category::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Category::select('categories.*',DB::raw("(SELECT count(post_id) FROM posts WHERE "
                            . "posts.`category_id`=categories.`id`) as totalpost"))
                    ->where('categories.category', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Category::select('categories.*',DB::raw("(SELECT count(post_id) FROM posts WHERE "
                            . "posts.`category_id`=categories.`id`) as totalpost"))
                        ->where('categories.category', 'like', "%{$search}%")
                        ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['cat'] = $r->category;
            $nestedData['tpost'] = $r->totalpost;
            $sts = ($r->status==1)?
                $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Active</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-did="'.$r->id.'" data-sts="0" href="#">Disable</a></div>
                </div>
                 </div>':
            '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Disabled</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-did="'.$r->id.'" data-sts="1" href="#">Active</a></div>
                </div>
            </div>';
            $nestedData['sts']=$sts;
            $nestedData['action'] = '<a class="editmdl" data-cid="'.$r->id.'" data-cat="'.$r->category.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-did="'.$r->id.'" data-ttl="'.$r->category.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function updateCategory(Request $request)
    {
        $category = Category::find($request->cid);
        $category->category = $request->ucategory;
        $category->save();
        $notification = array(
                'message' => 'Category Updated Successfully',
                'type' => 'success'
            );
        return Response::json($notification); 
    }
    public function delCategory(Request $request)
    {
        $cat = Category::find($request->did);
        $cat->delete();
        $notification = array(
                 'message' => 'Category Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusCategory(Request $request)
    {
        $user= Category::find($request->did);
        $user->status = $request->sts;
        $user->save();
        if($request->sts==1){
            $msg= 'Admin Activated Successfully';
            $typ= 'success';
        }else{
            $msg= 'Admin Inactivated Successfully';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }
    //==========================================================================
    public function showNews() 
    {
        $data = array();
        $data['title'] = 'News & Updates';
//        $data['posts'] = Post::orderBy('post_id','desc')->paginate(3);
        return view('admin.pages.news.news',$data); 
    }
    public function saveNews(Request $request) 
    {
        $news = new Post;
        $news->title = $request->title;
        $news->details = $request->details;
        $news->created_by = Auth::guard('admin')->user()->id;
        $image=$request->file('post_img');
        if($image)
        {
            $image_name=str_random(3).$request->title;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/img/news/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $news->post_img = $image_url;
            }
            $news->save();
            $msg = 'News Saved Successfully';
            $typ = 'success';      
        }else{
            $msg = 'Error While uploading Image';
            $typ = 'error'; 
        }
        $notification = array('message' => $msg,'type' => $typ);
        return Response::json($notification); 
    }
    public function getNewsList(Request $request)
    {
        $columns = array(0 =>'title',1 =>'post_img',2=> 'details',3 =>'created_at',4=> 'status',6=> 'action');
        $totalData = Post::count();
        $limit = $request->input('length');$start = $request->input('start');
        $order = $columns[$request->input('order.0.column')]; $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
        {
            $posts = Post::offset($start)->limit($limit)->orderBy($order,$dir)->get();
            $totalFiltered =  Post::count();
        }
        else{
            $search = $request->input('search.value');
            $posts = Post::where('title', 'like', "%{$search}%")
                    ->orwhere('details', 'like', "%{$search}%")
                    ->offset($start)->limit($limit)
                    ->orderBy($order, $dir)->get();
            $totalFiltered = Post::where('title', 'like', "%{$search}%")
                    ->orwhere('details', 'like', "%{$search}%")
                    ->count();
        }
        $data = array();

    if($posts){
        foreach($posts as $r)
        {     
            $nestedData['title'] = $r->title;
            $nestedData['post_img'] = '<img src="'.asset($r->post_img).'" alt=" placeholder image" height="100" width="100">';
            
            $nestedData['details'] = $r->details;
            $sts = ($r->status==1)?
                $sts = '<div class="btn-group"><div class="badge badge-success dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Live</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-pid="'.$r->post_id.'" data-sts="0" href="#">Hide</a></div>
                </div>
                 </div>':
            '<div class="btn-group"><div class="badge badge-danger dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true"><span>Hide</span></a>
                <div class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(4px, -165px, 0px);">
                    <a class="dropdown-item csts" data-pid="'.$r->post_id.'" data-sts="1" href="#">Live</a></div>
                </div>
            </div>';
            $nestedData['sts']=$sts;
            $nestedData['pdate']=date('D, d M, Y', strtotime($r->created_at));
            $nestedData['action'] = '<a class="editmdl" data-pid="'.$r->post_id.'" data-pttl="'.$r->title.'" data-pimg="'.asset($r->post_img).'" '
                    . 'data-dtl="'.$r->details.'" style="padding: 4px;"><i class="ficon feather icon-edit success"></i></a> '
                    . '<a href="#" class="delmdl" data-did="'.$r->post_id.'" data-ttl="'.$r->title.'" style="padding: 4px;"><i class="ficon feather icon-trash-2 danger"></i></a>';
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
    public function updateNews(Request $request)
    {
        $news = Post::find($request->post_id);
        $news->title = $request->utitle;
        $news->details = $request->udetails;
        $news->created_by = Auth::guard('admin')->user()->id;
        $image=$request->file('upost_img');
        if($image)
        {
            $image_name=str_random(3).$request->title;
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/img/news/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success)
            {
                $news->post_img = $image_url;
                if(file_exists($request->oldimg)){
                    unlink($request->oldimg);
                }
            }   
        }
        $news->save();
        $msg = 'News Updated Successfully';$typ = 'success';   
        $notification = array('message' => $msg,'type' => $typ);
        return Response::json($notification); 
    }
    public function deleteNews(Request $request)
    {
        $cat = Post::find($request->did);
        $cat->delete();
        $notification = array(
                 'message' => 'News Deleted Successfully',
                 'type' => 'error'
             );
        return Response::json($notification);
    }
    public function statusNews(Request $request)
    {
        $user= Post::find($request->pid);
        $user->status = $request->sts;
        $user->save();
        if($request->sts==1){
            $msg= 'News Activated Successfully';
            $typ= 'success';
        }else{
            $msg= 'News Inactivated Successfully';
            $typ= 'warning';
        }
        $notification = array(
                'message' => $msg,
                'type' => $typ
            );
        return Response::json($notification); 
    }

//    public function createPost() 
//    {
//        $data = array();
//        $data['categories'] = Category::get();
//        $data['title'] = 'Create Post';
//        return view('user.post.create_post',$data);
//    }
//    public function showSinglePost($slug)
//    {
//        $data = array();
//        $data['post'] = Post::findBySlug($slug);
//        return view('user.post.single_post',$data);
//    }
}
