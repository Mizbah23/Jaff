@extends('user.master')
@section('title'){{$title}}@stop
@section('style')
<style type="text/css">

</style>
@stop

@section('header')
    @include('user.layout.common_header')
@stop
@section('page') single-page @stop
@section('content')
<div class="content">

<div class="path-section" style='background-image: url(public/img/slide-1.jpg);'>
    <div class="bg-cover">
        <div class="container">
            <h3>News & Updates</h3>
        </div>
    </div>
</div>
				
    
    <div class="blog-section page_spacing">

	<div class="container">
	    <div class="row">
                
                
                
    <div class="col-md-9">
                    
        @foreach($list as $li)
            <article id="post-118" class="blog-entry post-118 post type-post status-publish format-standard has-post-thumbnail hentry category-fashion category-print tag-boxing tag-sport">
                <h2 class="sr-only">{{$li->title}}</h2>	
                <div class="entry-date"><span class="d-text-c">{{date('d',strtotime($li->created_at))}}</span>{{date('M',strtotime($li->created_at))}}</div>
                <div class="entry-cover">
                    <img width="900px" src="{{asset($li->post_img)}}" class="attachment-thumb-900-500 size-thumb-900-500 wp-post-image" alt=""  sizes="(max-width: 900px) 100vw, 900px" />
                </div>
                <div class="entry-hover d-bg-c">
                    <i class="fa fa-camera"></i>
                    <h2>
                        <a href="{{route('user.snews', $li->slug)}}">{{$li->title}}</a>
                    </h2>
                </div>
                <div class="entry-summary">
                    <p>{!!strlen($li->details) > 300 ? substr($li->details,0,300)." [&hellip;]" : $li->details!!} </p>
                    <a href="{{route('user.snews', $li->slug)}}" class="read-more d-border-c-h d-text-c">Continue reading...</a>
                </div>
            </article>
        @endforeach
				<div class="text-center">{{ $list->links() }}</div>	
		
  </div>

    
				
				
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
                
            <!--=========================recent=================================-->

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

            <!--=========================recent=================================--> 
               <!-- <aside id="recent-comments-2" class="widget widget_recent_comments">
                    <i class="ulysses_widget_icon"></i>
                    <h3 class="widget-title">Recent Comments</h3>
                    <i class="bottom_border"></i>
                    <ul id="recentcomments"></ul>
                </aside>-->
                
                
            <aside id="archives-2" class="widget widget_archive">
                <i class="ulysses_widget_icon"></i>
                <h3 class="widget-title">Archives</h3>
                <i class="bottom_border"></i>
                <ul>
                    <li><a href='../2015/01/index.html'>January 2015</a></li>
                </ul>
            </aside>



<!--                <aside id="categories-2" class="widget widget_categories">
                    <i class="ulysses_widget_icon"></i>
                    <h3 class="widget-title">Categories</h3>
                    <i class="bottom_border"></i>
                    <ul>
                        <li class="cat-item cat-item-6"><a href="../category/art/index.html" >art</a> </li>
                        <li class="cat-item cat-item-7"><a href="../category/design/index.html" >design</a></li>
                        <li class="cat-item cat-item-8"><a href="../category/fashion/index.html" >fashion</a></li>
                        <li class="cat-item cat-item-9"><a href="../category/marketing/index.html" >marketing</a></li>
                        <li class="cat-item cat-item-10"><a href="../category/print/index.html" >print</a></li>
		</ul>
                </aside>-->

<!--

                <aside id="meta-2" class="widget widget_meta"><i class="ulysses_widget_icon"></i><h3 class="widget-title">Meta</h3><i class="bottom_border"></i>			<ul>
			<li><a href="../wp-login0ddc.html?action=register">Register</a></li>			<li><a href="../wp-login.html">Log in</a></li>
			<li><a href="../feed/index.html">Entries <abbr title="Really Simple Syndication">RSS</abbr></a></li>
			<li><a href="../comments/feed/index.html">Comments <abbr title="Really Simple Syndication">RSS</abbr></a></li>
			<li><a href="https://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress.org</a></li>			</ul>
		
                </aside>-->



            <aside id="social_icons-1" class="widget widget_social_icons">
            	<i class="ulysses_widget_icon"></i>
            	<h3 class="widget-title">Social</h3><i class="bottom_border"></i>		
            	<ul class="socials">
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-facebook"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-twitter"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-instagram"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-google-plus"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-rss"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-pinterest"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-linkedin"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-vine"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-vk"></i></a></li>			
                    <li><a class="d-bg-c-h" href="#"><i class="fa fa-skype"></i></a></li>		
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
<!--                       
                        <div class="mini-post">
                            <div class="mini-post-cover"><a href="#">
                                    <img width="221" height="221" src="img/blog-f1-221x221.jpg" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image"
                                         alt="" sizes="(max-width: 221px) 100vw, 221px" /></a></div>
                            <h3><a href="details.html" class="d-text-c-h">Having fun at the lake</a></h3>
                            h6>5 days ago</h6
                        </div>

                        <div class="mini-post">
                            <div class="mini-post-cover"><a href="#">
                                    <img width="221" height="221" src="img/blog-f2-221x221.jpg" class="attachment-thumb-221-221 size-thumb-221-221 wp-post-image" alt="" 
                                                                          srcset="http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-221x221.jpg 221w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-150x150.jpg 150w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-180x180.jpg 180w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-300x300.jpg 300w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-495x495.jpg 495w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-263x263.jpg 263w, http://lolthemes.com/demo/geo/ulysses/wp-content/uploads/2015/01/blog-f2-120x120.jpg 120w" sizes="(max-width: 221px) 100vw, 221px" /></a></div>
                            <h3><a href="../having-fun-at-the-lake-2/index.html" class="d-text-c-h">Having fun at the lake</a></h3>
                                                        h6>5 days ago</h6
                        </div>-->
                    </div>
                </div>
            </div>
        </aside>
                
                
                
<!--                <aside id="my_twitter-1" class="widget twitter_widget">
                    <i class="ulysses_widget_icon"></i><h3 class="widget-title">Latest Tweets</h3>
                    <i class="bottom_border"></i>
                    <ul class='twitter'><li>No public Tweets found</li></ul>
                </aside>-->
                
                
                
<!--                <aside id="contact_info-1" class="widget widget_contact_info">
                    <i class="ulysses_widget_icon"></i><h3 class="widget-title">Contact Info</h3><i class="bottom_border"></i>
                    <div class="info-section">
			<div class="info-details d-bg-c">
                            <ul class="ul-contact">
                                <li class="ul-contact-1">
                                    <p>Bashundhara Main Gate,<br />Opposite of Jamuna Future Park Sidegate,Dhaka<br />
                                    </p>
                                </li>
                                <li class="ul-contact-2">
                                    <span>+8801304229158</span>
                                    <span>.</span>
                                </li>
                                <li class="ul-contact-3">
                                    <a href="mailto:info@jaff.com.bd">info@jaff.com.bd</a>
                                </li>
                            </ul>
			</div>
			<div class="under-button">
                            <span></span>
                            <a href="#" class="d-border-c d-bg-c-h d-text-c">Contact Us</a>
			</div>
		    </div> 
		</aside>-->
                
                
                
                <aside id="whats_next-1" class="widget widget_whats_next">
                    <i class="ulysses_widget_icon"></i><i class="bottom_border"></i>
                    <div class="info-section">
		<div class="info-details info-details-center d-bg-c">
					<h4>WHAT We OFFER ?</h4>
					<div class="info-image"><img src="{{$simg->offer_image}}" alt="image" style="width: 100%; height:251px" /></div>
					<ul class="ul-calendar">
                                            @foreach($offers as $off)
                                            <li>
                                                <span>{{$off->offer_title}}</span>
                                                <span>{{$off->details}}</span>
                                            </li>
                                            @endforeach
					</ul>
				</div>

			<div class="under-button">
				<span></span>
				<a href="#" class="d-border-c d-bg-c-h d-text-c">Call Now</a>
			</div>
		</div>
		</aside>
                
                
                
                
                
                
<!--                <aside id="text_working_hours-1" class="widget widget_working_hours"><i class="ulysses_widget_icon"></i><h3 class="widget-title">Book HRS</h3><i class="bottom_border"></i>		<div class="info-section">
                    <div class="info-details d-bg-c">
                            <ul class="ul-time">
                                            <li>Sunday 6:3 0AM - 12:30 AM</li>
                                            <li>Monday 6:30 AM - 12:30 AM</li>
                                            <li>Tuesday 6:30 AM - 12:30 AM</li>
                                            <li>Wednesday 6:30AM - 12:30AM</li>
                                            <li>Thursday 6:30AM - 12:30AM</li>
                                            <li>Friday 6:30 AM - 12:30 AM</li>
                                            <li>Saturday 6:30 AM - 12:30 AM</li>				
                                    </ul>
                    </div>
                    <div class="under-button">
                        <span></span>
                        <a href="#" class="d-border-c d-bg-c-h d-text-c">Book A Slot</a>
                    </div>
		</div>
		</aside>-->
            
            
            
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
































