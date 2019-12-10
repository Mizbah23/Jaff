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
			<h6>Jan 24, 15 / NO COMMENTS / 1012 Views </h6>
			
			<div class="entry-author">
				<img alt='' src='http://0.gravatar.com/avatar/c28eda72756bf916c7bfcbaba6b129c4?s=90&amp;d=mm&amp;r=g' srcset='http://0.gravatar.com/avatar/c28eda72756bf916c7bfcbaba6b129c4?s=180&#038;d=mm&#038;r=g 2x' class='avatar avatar-90 photo' height='90' width='90' />				
				<h6>Ulysses</h6>
				<p></p>
			</div>

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
			<a href="../having-fun-at-the-lake-2/index.html" rel="prev">Previous Post</a>
		</li>
			
		<li class="next">
			<a href="details.html" rel="next">Next Post</a>
			</li>	
		</ul>
	</div>
                
                
                
	<div id="comments" class="comments-area">
	
	        <div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title">
					Leave a Reply 
					<small>
						<a rel="nofollow" id="cancel-comment-reply-link" href="index.html#respond" style="display:none;">Cancel reply
						</a>
					</small>
				</h3>
		<form action="http://lolthemes.com/demo/geo/ulysses/wp-comments-post.php" method="post" id="commentform" class="form-horizontal comment-form" novalidate role="form">
						<div class="alert alert-info comment-notes">Your email address will not be published. Required fields are marked 
							<span class="required">*</span>
						</div>

						<div class="form-group">
							<div class="col-sm-6 comment-form-author">
								<input class="form-control"  id="author" placeholder="Name" name="author" type="text" value=""  aria-required='true' />
							</div>
                            <div class="col-sm-6 comment-form-email">
	                            <input id="email" class="form-control" name="email" placeholder="Email" type="email" value=""  aria-required='true' required />
                            </div>
                        </div>

<div class="form-group">
	<div class=" col-sm-12 comment-form-url">
		<input class="form-control" placeholder="Website"  id="url" name="url" type="url" value="" />
	</div>
</div>
<div class="form-group comment-form-comment">
	<div class="col-sm-12">
		<textarea class="form-control" id="comment" name="comment" placeholder="Comment" rows="8" aria-required="true">
		</textarea>
	</div>
</div>
<div class="form-allowed-tags">You may use these 
	<abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:  
	<code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;s&gt; &lt;strike&gt; &lt;strong&gt; 
	</code>
</div>
				
				<div class="form-submit">
							<input class="btn btn-danger btn-lg" name="submit" type="submit" id="submit" value="Post Comment" />
							<input type='hidden' name='comment_post_ID' value='112' id='comment_post_ID' />
                            <input type='hidden' name='comment_parent' id='comment_parent' value='0' />
				</div>
		</form>
			</div><!-- #respond -->
			
	</div>

	<!-- .comments-area -->
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

		<aside id="recent-comments-2" class="widget widget_recent_comments">
			<i class="ulysses_widget_icon"></i>
			<h3 class="widget-title">Recent Comments</h3>
			<i class="bottom_border"></i>
			<ul id="recentcomments">
			</ul>
		</aside>

		<aside id="archives-2" class="widget widget_archive">
			<i class="ulysses_widget_icon"></i>
			<h3 class="widget-title">Archives</h3>
			<i class="bottom_border"></i>		
			<ul>
			    <li><a href='../2015/01/index.html'>January 2015</a></li>
		    </ul>
		</aside>

		<aside id="categories-2" class="widget widget_categories">
			<i class="ulysses_widget_icon"></i>
			<h3 class="widget-title">Categories</h3>
			<i class="bottom_border"></i>		
		  <ul>
	          <li class="cat-item cat-item-6">
	          	<a href="../category/art/index.html" >art</a>
              </li>
	          <li class="cat-item cat-item-7">
	          	<a href="../category/design/index.html" >design</a>
              </li>
	          <li class="cat-item cat-item-8">
	          	<a href="../category/fashion/index.html" >fashion</a>
              </li>
	          <li class="cat-item cat-item-9">
	          	<a href="../category/marketing/index.html" >marketing</a>
              </li>
	          <li class="cat-item cat-item-10">
 	          	<a href="../category/print/index.html" >print</a>
              </li>
		  </ul>
        </aside>

        <aside id="meta-2" class="widget widget_meta">
        	<i class="ulysses_widget_icon"></i>
        	<h3 class="widget-title">Meta</h3>
        	<i class="bottom_border"></i>			
        	<ul>
			    <li><a href="../wp-login0ddc.html?action=register">Register</a></li>			
			    <li><a href="../wp-login.html">Log in</a></li>
			    <li><a href="../feed/index.html">Entries <abbr title="Really Simple Syndication">RSS</abbr></a>
			    </li>
			    <li><a href="../comments/feed/index.html">Comments<abbr title="Really Simple Syndication">RSS</abbr></a>
			    </li>
			    <li><a href="https://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress.org</a>
			    </li>			
			</ul>
		</aside>

		<aside id="social_icons-1" class="widget widget_social_icons">
					<i class="ulysses_widget_icon"></i>
					<h3 class="widget-title">Social</h3>
					<i class="bottom_border"></i>		

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

		<aside id="my_twitter-1" class="widget twitter_widget">
			<i class="ulysses_widget_icon"></i>
			<h3 class="widget-title">Latest Tweets</h3><i class="bottom_border"></i>
			<ul class='twitter'><li>No public Tweets found</li></ul>
		</aside>
		<aside id="contact_info-1" class="widget widget_contact_info">
			<i class="ulysses_widget_icon"></i><h3 class="widget-title">Contact Info</h3>
			<i class="bottom_border"></i>		

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
        </aside>

        <aside id="whats_next-1" class="widget widget_whats_next">
        	<i class="ulysses_widget_icon"></i>
        	<h3 class="widget-title">WHATS NEXT?</h3>
        	<i class="bottom_border"></i>		
        	<div class="info-section">
			<div class="info-details info-details-center d-bg-c">
				<div class="info-image">
					<img src="img/favicon.png" alt="image" />
				</div>

				<ul class="ul-calendar">
					<li>
					<span>90 Minutesd GameHour</span>
					<span>Booking</span>
					</li>
					
				    <li>
					<span>Tournament And Event Booking</span>
					</li>
						
					<li>
					  <span>Drop In games</span>
					</li>
						
					<li>
					   <span>Jaff Academy Programs</span>
					</li>
						
					<li>
					   <span>Fitness Training</span>
					</li>
				</ul>
			</div>

			<div class="under-button">
				<span></span>
				<a href="#" class="d-border-c d-bg-c-h d-text-c">Call Now</a>
			</div>
		    </div>
		</aside>

		<aside id="text_working_hours-1" class="widget widget_working_hours">
			<i class="ulysses_widget_icon"></i>
			<h3 class="widget-title">Working HRS</h3>
			<i class="bottom_border"></i>		
			<div class="info-section">
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



