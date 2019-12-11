@extends('user.master')
@section('title'){{$info->title}}@stop
@section('style')
<style type="text/css">
	img.attachment-thumb-900-500.size-thumb-900-500.wp-post-image {
    height: 400px;
}
</style>
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
            
            <div class="entry-date"><span class="d-text-c">24</span>Jan</div>
		    
		    <div class="entry-cover">
			    <img width="600" height="500" src="{{asset($info->post_img)}}" class="attachment-thumb-900-500 size-thumb-900-500 wp-post-image" alt="" />		
		    </div>
					
			<div class="entry-hover d-bg-c">
					<i class="fa fa-camera"></i><h2>{{$info->title}}</h2>		
			</div>

            <div class="entry-content">
                {!!$info->details!!}
            </div>


		<div class="entry-footer">
			<h6>Jan 24, 15 / 1012 Views </h6>
			
	

			<ul class="all-socials">
				<li>Share Post</li>
				<li>
					<a href="http://www.facebook.com/share.php?u=http://lolthemes.com/demo/geo/ulysses/live-like-a-god/&amp;title=Live%20like%20a%20god" class="d-bg-c-h d-border-c-h"><i class="fa fa-facebook"></i>
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
				</li>
			</ul>
		</div>
	</article><!-- #post-## --> 
       
                
                
                <div class="post-navigation">
		<!--h1 class="screen-reader-text"></h1-->
		 	
	<ul class="pager">
		
		<li class="previous">
			
			<a href="{{$prev->slug}}" rel="prev">Previous Post</a>
			
		</li>
		
		<li class="next">
           
			<a href="{{$next->slug}}" rel="next">Next Post</a>
			
		</li>	
	</ul>
	</div>
                
                
                

          </div>
	<!-- .comments-area -->
                


				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<aside id="search-2" class="widget widget_search">
							<form role="search" method="get" id="searchform" class="search-form" action="http://lolthemes.com/demo/geo/ulysses/">
	<div>
		<input type="text" class="search-line" placeholder="Search" value="" name="s" id="s" />
		<input type="submit" class="search-button" id="searchsubmit" value="" />
	</div>
                            </form>
                        </aside>		


        <aside id="recent-posts-2" class="widget widget_recent_entries">		
        	<i class="ulysses_widget_icon"></i>
        	<h3 class="widget-title">Recent Posts</h3>
        	<i class="bottom_border"></i>		
          <ul>
			<li>
			    <a href="details.html">Working abdominal muscules</a>
			</li>
			
			<li>
				<a href="index.html">Live like a god</a>
			</li>
			
			<li>
				<a href="../having-fun-at-the-lake-2/index.html">Having fun at the lake</a>
			</li>
			
			<li>
				<a href="../having-fun-at-the-lake/index.html">Having fun at the lake</a>
			</li>
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
					<div class="mini-post">
								<div class="mini-post-cover">
									<a href="#">
										<img width="221" height="221" src="../wp-content/uploads/2015/01/blog-f1-221x221.jpg" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image" alt="" srcset="http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-221x221.jpg 221w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-150x150.jpg 150w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-180x180.jpg 180w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-300x300.jpg 300w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-495x495.jpg 495w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-263x263.jpg 263w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-120x120.jpg 120w" sizes="(max-width: 221px) 100vw, 221px" />
									</a>
								</div>

								<h3><a href="details.html" class="d-text-c-h">Working abdominal muscules</a></h3>
					</div>
					            
                                <div class="mini-post">
								<div class="mini-post-cover">
									<a href="#">
										<img width="221" height="221" src="../wp-content/uploads/2015/01/latest-blog-new-221x221.jpg" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image" alt="" srcset="http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-221x221.jpg 221w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-150x150.jpg 150w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-300x300.jpg 300w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-180x180.jpg 180w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-495x495.jpg 495w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-263x263.jpg 263w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new-120x120.jpg 120w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/latest-blog-new.jpg 600w" sizes="(max-width: 221px) 100vw, 221px" />
									</a></div>
								  <h3><a href="index.html" class="d-text-c-h">Live like a god</a></h3>
							    </div>
				</div>

			  <div class="tab-pane fade" id="recent_posts">
						<div class="mini-post">
								<div class="mini-post-cover">
									<a href="#">
										<img width="221" height="221" src="../wp-content/uploads/2015/01/blog-f1-221x221.jpg" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image" alt="" srcset="http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-221x221.jpg 221w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-150x150.jpg 150w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-180x180.jpg 180w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-300x300.jpg 300w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-495x495.jpg 495w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-263x263.jpg 263w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f1-120x120.jpg 120w" sizes="(max-width: 221px) 100vw, 221px" />
									</a>
								</div>
								
								<h3>
									<a href="../having-fun-at-the-lake/index.html" class="d-text-c-h">Having fun at the lake</a>
								</h3>
								<!--h6>5 days ago</h6-->
						</div>
														
						<div class="mini-post">
								<div class="mini-post-cover">
									<a href="#"><img width="221" height="221" src="../wp-content/uploads/2015/01/blog-f2-221x221.jpg" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image" alt="" srcset="http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-221x221.jpg 221w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-150x150.jpg 150w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-180x180.jpg 180w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-300x300.jpg 300w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-495x495.jpg 495w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-263x263.jpg 263w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-120x120.jpg 120w" sizes="(max-width: 221px) 100vw, 221px" />
									</a>
								</div>
								<h3>
									<a href="../having-fun-at-the-lake-2/index.html" class="d-text-c-h">Having fun at the lake</a>
								</h3>
								<!--h6>5 days ago</h6-->
			     		</div>
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
@stop



