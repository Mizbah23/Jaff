@extends('user.master')
@section('title'){{$info->title}}@stop
@section('style')
<style type="text/css">
	img.attachment-thumb-900-500.size-thumb-900-500.wp-post-image {
    height: 400px;
}
    img.attachment-thumb-221-221.size-thumb-221-221.wp-post-image{
    	height: 150px;
    }
   
</style>
 <link rel="stylesheet" type="text/css" href="public/css/front/jssocials.css" />
 <link rel="stylesheet" type="text/css" href="public/css/front/jssocials-theme-flat.css" />
@stop

@section('header')
    @include('user.layout.common_header')
@stop
@section('page') single-page single-post @stop
@section('content')
<div class="content">

<div class="path-section" style='background-image: url(public/img/slide-1.jpg);'>
    <div class="bg-cover">
        <div class="container">
            <h3>Time Table</h3>
        </div>
    </div>
</div>
				
                    
                    
                    
    <div class="blog-section page_spacing">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
			
                                    
                                    
                                    
    <article id="post-112" class="blog-entry post-112 post type-post status-publish format-standard has-post-thumbnail hentry category-art">
	        <h2 class="sr-only">{{$info->title}}</h2>
            
            <div class="entry-date"><span class="d-text-c">{{date('d',strtotime($info->created_at))}}</span>{{date('M',strtotime($info->created_at))}}
            </div>
		    
		    <div class="entry-cover">
			    <img width="600" height="500" src="{{asset($info->post_img)}}" class="attachment-thumb-900-500 size-thumb-900-500 wp-post-image" alt="" />		
		    </div>
					
			<div class="entry-hover d-bg-c">
					<i class="fa fa-camera"></i><h2>{{$info->title}}</h2>		
			</div>

            <div class="entry-content">
                {!!$info->details!!}
            </div>


		<div  class="entry-footer">
			<h6>{{date('d M',strtotime($info->created_at))}}/ {{$info->view_count}} Views </h6>
			
	
           
			<ul class="all-socials">
				<div id="share"></div>
				<li>Share Post</li>
				{{-- <li>
					<a href="" class="d-bg-c-h d-border-c-h"><i class="fa fa-facebook"></i>
					</a>
				</li>
				<li>
					<a href="http://twitter.com/intent/tweet?status=Live%20like%20a%20god+http://lolthemes.com/demo/geo/ulysses/live-like-a-god/" class="d-bg-c-h d-border-c-h">
						<i class="fa fa-twitter"></i>
					</a>
				</li>
				<li>
					<a href="https://plus.google.com/share?url=http://lolthemes.com/demo/geo/ulysses/live-like-a-god/" class="d-bg-c-h d-border-c-h">
						<i class="fa fa-google-plus"></i>
					</a>
				</li>
				<li>
					<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://lolthemes.com/demo/geo/ulysses/live-like-a-god/&amp;title=Live%20like%20a%20god&amp;source=http://lolthemes.com/demo/geo/ulysses/live-like-a-god/" class="d-bg-c-h d-border-c-h">
						<i class="fa fa-linkedin"></i>
					</a>
				</li>
				<li>
					<a href="http://www.newsvine.com/_tools/seed&amp;save?u=http://lolthemes.com/demo/geo/ulysses/live-like-a-god/&amp;h=Live%20like%20a%20god" class="d-bg-c-h d-border-c-h">
						<i class="fa fa-vine"></i>
					</a>
				</li> --}}
			</ul>
			
		</div>
	</article><!-- #post-## --> 
       
                
                
                <div class="post-navigation">
		<!--h1 class="screen-reader-text"></h1-->
		 	
	<ul class="pager">
		
		<li class="previous">
			
			<a href="" rel="prev">Previous Post</a>
			
		</li>
		
		<li class="next">
           
			<a href="" rel="next">Next Post</a>
			
		</li>	
	</ul>
	</div>
                
                
                

          </div>
	<!-- .comments-area -->
                


				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<aside id="search-2" class="widget widget_search">
							<form role="search" method="get" id="searchform" class="search-form" action="http://lolthemes.com/demo/geo/ulysses/" autocomplete="off">
	<div>
		<input type="text" class="search-line" placeholder="Search" value="" name="s" id="s" />
		<input type="submit" class="search-button" id="searchsubmit" value="" />
	</div>
                            </form>
                        </aside>		


            <aside id="recent-posts-2" class="widget widget_recent_entries">		
                <i class="ulysses_widget_icon"></i><h3 class="widget-title">Recent Posts</h3><i class="bottom_border"></i>
                <ul>
                    @foreach($recent as $rs)
                    <li>
                        <a href="{{route('user.snews', $rs->slug)}}">{{$rs->title}}</a>
                    </li>
                    @endforeach
                </ul>
            </aside>

		<aside id="social_icons-1" class="widget widget_social_icons">
					<i class="ulysses_widget_icon"></i>
					<h3 class="widget-title">Social</h3>
					<i class="bottom_border"></i>		

			<ul class="socials">
				<li><a class="d-bg-c-h" href="#"><i class="fa fa-facebook"></i></a></li>						
				<li><a class="d-bg-c-h" href="#"><i class="fa fa-instagram"></i></a></li>			
				<li><a class="d-bg-c-h" href="#"><i class="fa fa-google-plus"></i></a></li>						
				<li><a class="d-bg-c-h" href="#"><i class="fa fa-linkedin"></i></a></li>			
					
			</ul>
        </aside>

		<aside id="post_tabs-1" class="widget widget_post_tabs">		
			<div class="tab-widget">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#popular_posts" class="d-text-c-h" data-toggle="tab">Popular</a></li>
				<li><a href="#recent_posts" class="d-text-c-h" data-toggle="tab">Recent</a></li>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane fade in active" id="popular_posts">
                   @php $counter =0; @endphp
                   @foreach($popular as $arr)
                      @if($counter<2)
                <div class="mini-post">
                    <div class="mini-post-cover"><a href="#">
                    <img width="221" height="221" src="{{asset($arr->post_img)}}" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image"
                         alt="" sizes="(max-width: 221px) 100vw, 221px" /></a></div>
                    <h3><a href="{{route('user.snews', $arr->slug)}}" class="d-text-c-h">{{$arr->title}}</a></h3>
             <!--h6>5 days ago</h6-->
                </div>
                 @endif
                @php $counter++; @endphp
                @endforeach 
					            
                   
				</div>

			  <div class="tab-pane fade" id="recent_posts">
	
				@php $counter =0; @endphp
                   @foreach($recent as $arr)
                      @if($counter<2)
                <div class="mini-post">
                    <div class="mini-post-cover"><a href="#">
                    <img width="221" height="221" src="{{asset($arr->post_img)}}" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image"
                         alt="" sizes="(max-width: 221px) 100vw, 221px" /></a></div>
                    <h3><a href="{{route('user.snews', $arr->slug)}}" class="d-text-c-h">{{$arr->title}}</a></h3>
             <!--h6>5 days ago</h6-->
                </div>
                 @endif
                @php $counter++; @endphp
                @endforeach 
			  </div>
			</div>
		</div>
		</aside>
	</div>
    </div>
		</div>
		</div>
	    </div>
</div>


@stop

@section('footer')
@include('user.layout.footer')
@stop
@section('script')
<script src="jquery.js"></script>
<script src="public/js/front/jssocials.min.js"></script>
    <script>
        $("#share").jsSocials({
            shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
        });
    </script>
@stop



