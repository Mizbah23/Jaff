@extends('user.master')
@section('title'){{$title}}@stop

@section('header')
    @include('user.layout.home_header')
@stop

@section('content')




<div class="content">		
    <div class="blog-section">
        <div class="container-fluid shortcode-view">
            <div class="row">
                <div class="col-md-12">
		    <article id="post-10" class="page-post-entry post-10 page type-page status-publish hentry">
                    <h2 class="sr-only">Jaff Homepage</h2>
                    <header class="entry-header"></header>
                            
                            
                            
                            
                            
    <div class="entry-content">
                     
        @include('user.layout.slider')
                       
                                
	
	
	<div class="info-section" id="shortinfo">
		<div class="container">
			<div class="col-md-4">
				<div class="info-details d-bg-c">
					<h4>Game Hours</h4>
					<ul class="ul-time">
                                            @foreach($weeks as $w)
						<li>{{$w->day}} {{date( "h:i A", strtotime($w->start))}} - {{date( "h:i A", strtotime($w->end))}}</li>
                                            @endforeach
					</ul>
				</div>
				<div class="under-button">
					<span></span>
					<a href="{{route('time')}}" class="d-border-c d-bg-c-h d-text-c">Book A Slot</a>
				</div>
			</div>
			<div class="col-md-4">
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
			<div class="col-md-4">
				<div class="info-details d-bg-c">
					<h4>Contact Info</h4>
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
		</div>
	</div>
	
        
        
        
	<div class="about-section" id="about_us-section">
		<div class="container">
			<div class="site-title wow fadeInDown">
				
				<h1>about us</h1>
				<div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="img-box">
					  <img src="{{asset($simg->about_image)}}" style="width: 100%; height:251px" alt="presentation" />
					</div>
				</div>
				<div class="col-md-8">
			<div class="services-mark-1">
                        @foreach($abouts as $about)
                                <div class="one-service">
                                        <img width="120" height="120" src="{{$about->image}}" class="attachment-thumb-120-120 size-thumb-120-120" alt="" /><h4><a href="#" style="color: #024279">{{$about->title}}</a></h4>
                                        <p>{{$about->details}}</p>
                                </div>
                        @endforeach
			</div>
				</div>
			</div>
		</div>
	</div>
        
        
        
        
	
	<div class="statistics-section" id="statistics-section">
		<div class="container">
			<div class="row">
							<div class="col-md-4">
							  <div class="statistic statistic-bg-2" style="background-image: url('public/img/blog-1.jpg');">
								<div class="bg-cover"></div>
								<div class="statistic-cut"></div>
								<h3 class="d-text-c counter-all" id="statistics_count-1" data-statistics_percent="9">&nbsp;</h3>
								<h6>TRAINING ROOMS</h6>
							</div>
						</div>
							<div class="col-md-4">
							  <div class="statistic statistic-bg-2" style="background-image: url('public/img/blog-2.jpg');">
								<div class="bg-cover"></div>
								<div class="statistic-cut"></div>
								<h3 class="d-text-c counter-all" id="statistics_count-2" data-statistics_percent="18">&nbsp;</h3>
								<h6>SKILLED TRAINERS</h6>
							</div>
						</div>
							<div class="col-md-4">
							  <div class="statistic statistic-bg-2" style="background-image: url('public/img/blog-3.jpg');">
								<div class="bg-cover"></div>
								<div class="statistic-cut"></div>
								<h3 class="d-text-c counter-all" id="statistics_count-3" data-statistics_percent="10">&nbsp;</h3>
								<h6>TRAINING CLASSES</h6>
							</div>
						</div>
				</div>
		</div>
	</div>
	
	<!-- Classes Section -->
        
        
        <!--........................Program Section..........................-->
        <div class="classes-section" id="classes-section">
            <div class="container">
                <div class="site-title">
                    <p>Take a look at</p>
                    <h1>Academy programs and clinics</h1>
                    <div class="site-dots d-text-c"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
                </div>
            </div>
            <div id="classes-slider" class="flexslider classes-slider">
                <ul class="slides slide-wrapper">
                    @foreach($programs as $p)
                    <li class="slide">
                        <div class="slide-text">
                            <div class="white-box">
                                <h4>{{$p->title}}</h4>
                                <p>{!!$p->description!!}</p>
                                <a href="#" class="button-box d-border-c d-bg-c-h d-text-c">view timetable</a>
                            </div>
                            <div class="box-2 d-bg-c">
                                <ul>
                                    <li class="i-1">{{$p->time}}</li>
                                    <li class="i-2">{{$p->author}}</li>
                                    <li class="i-3">{{$p->location}}</li>
                                    <li class="i-4">Starting from {{$p->price}}</li>
                                </ul>
                            </div>
                        </div>
                         <img style="width:1920px;height:356px;" src="{{asset($p->image)}}" alt=""  />
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

	
        <!--...........................Coach Section.........................-->
        <div class="trainers-section carousel" id="trainers-section" style="padding-top: 0px;">
            <div class="container">
                <div class="site-title">
                    <h1>Academy Coaches</h1>
                    <div class="site-dots d-text-c carousel-arrows"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
                </div>
                <div id="trainers-slider" class="trainers-slider">
                    @foreach($coaches as $c)
                    <div class="item">
                        <div class="trainer">
                            <ul class="socials d-bg-c">
                                <li><a target="_blank" href="{{$c->facebook}}"><i class="fa fa-facebook"></i></a></li>								 
                                <li><a target="_blank" href="{{$c->mail}}"><i class="fa fa-envelope-o"></i></a></li>								
                                <li><a target="_blank" href="{{$c->phone}}"><i class="fa fa-phone"></i></a></li>							
                            </ul>
                            <img src="{{asset($c->image)}}" alt="Bodybuilding instructor" style="height: 300px;"/>
                            <div class="trainer-info">
                                <h4>{{$c->name}}<span>{{$c->designation}}</span></h4>
                                <p>{{$c->details}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>		
            </div>
        </div>

	<!--..........................Purchase Section...........................-->
<!--        <div class="purchase-section" id="purchase-section">
            <div class="bg-cover">
                <div class="container">
                    <div class="site-title">
                        <p>Already excited with the seen?</p>
                        <h1>Purchase ulysses now</h1>
                        <a href="">Buy it now</a>
                    </div>
                </div>
            </div>
        </div>-->

        <!--..........................News Section...........................-->
        <div class="blog-post-section carousel" id="blog">
            <div class="container">
                <div class="site-title">
                    <!-- <p>Our thoughts</p> -->
                    <h1>Latest news and updates</h1>
                    <div class="site-dots d-text-c carousel-arrows"><i class="fa fa-times-2"></i><i class="fa fa-times-2"></i></div>
                </div>
                <div id="blog-post" class="trainers-slider blog-post">				
                    
                    <div class="item">
                        <div class="blog-entry">
                            <div class="entry-date"><span class="d-text-c">24</span>Jan</div>
                            <div class="entry-cover">
                                <a href="working-abdominal-muscules/index.html">
                                    <img width="495" height="495" src="public/img/blog-f1-495x495.jpg" class="attachment-thumb-495-495 size-thumb-495-495 wp-post-image" alt=""  />
                                </a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <i class="fa fa-eye"></i>
                                <h2><a href="working-abdominal-muscules/index.html"> News</a></h2>
                                <p>
                                    </i><a href="category/fashion/index.html" rel="category tag">Read More</a>
                                    <!--<a href="category/print/index.html" rel="category tag">print</a>-->
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="item">
                        <div class="blog-entry">
                            <div class="entry-date"><span class="d-text-c">24</span>Jan</div>
                            <div class="entry-cover">
                                <a href="live-like-a-god/index.html">
                                    <img width="495" height="495" src="public/img/latest-blog-new-495x495.jpg" class="attachment-thumb-495-495 size-thumb-495-495 wp-post-image" alt=""  sizes="(max-width: 495px) 100vw, 495px" />
                                </a>
                            </div>
                             <div class="entry-hover d-bg-c">
                                <!--<i class="fa fa-eye"></i>-->
                                <h2><a href="working-abdominal-muscules/index.html"> Updates</a></h2>
                                <!--<p>-->
                                    <!--</i><a href="category/fashion/index.html" rel="category tag">Read More</a>-->
                                    <!--<a href="category/print/index.html" rel="category tag">print</a>-->
                                <!--</p>-->
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="item">
                        <div class="blog-entry">
                            <div class="entry-date"><span class="d-text-c">24</span>Jan</div>
                            <div class="entry-cover">
                                <a href="having-fun-at-the-lake-2/index.html">
                                    <img width="495" height="495" src="public/img/blog-f2-495x495.jpg" class="attachment-thumb-495-495 size-thumb-495-495 wp-post-image" alt=""  />
                                </a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <i class="fa fa-camera"></i>
                                <h2>
                                    <a href="having-fun-at-the-lake-2/index.html">Having fun at the lake</a>
                                </h2>
                                <p>
                                    <a href="category/art/index.html" rel="category tag">art</a>,
                                    <a href="category/fashion/index.html" rel="category tag">fashion</a>
                                </p>
                            </div>
                        </div>
                    </div>				
                    <div class="item">
                        <div class="blog-entry">
                            <div class="entry-date"><span class="d-text-c">24</span>Jan</div>
                            <div class="entry-cover">
                                <a href="having-fun-at-the-lake/index.html">
                                    <img width="495" height="495" src="public/img/blog-f1-495x495.jpg" class="attachment-thumb-495-495 size-thumb-495-495 wp-post-image" alt=""  />
                                </a>
                            </div>
                            <div class="entry-hover d-bg-c">
                                <i class="fa fa-camera"></i>
                                <h2><a href="having-fun-at-the-lake/index.html">Having fun at the lake</a></h2>
                                <p><a href="category/design/index.html" rel="category tag">design</a>, <a href="category/marketing/index.html" rel="category tag">marketing</a></p>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    
    

	<!-- .........................Testimonial Section............................-->
	<div class="pricing-section" id="price-table-section">
	    <div class="container">
		<div class="row">
		    <div id="plan-86" class="col-md-4 wow rollIn">
			<div class="pricing-table ">
                            <h2 class="pricing-table-name">Silver</h2>	
                            <div class="pricing-table-price d-bg-c">
                                $25 /<span>per month</span>
                            </div>
                            <ul class="pricing-table-stuff">
                                <li>Yoga</li>
                                <li>Massage</li>
                                <li>Swimming Pool</li>
                                <li>Cardio</li>
                                <li>Aerobics</li>
                                <li>Solar</li>
                            </ul>
                            <p><a href="http://google.com/" class="button d-bg-c-h">Buy now</a></p>
			</div>
		    </div>
                    
		    <div id="plan-87" class="col-md-4 wow rollIn">
                        <div class="pricing-table popular-table d-bg-c">
                            <h2 class="pricing-table-name">Gold</h2>
                            <div class="pricing-table-price d-text-c">$25 /<span>per day</span></div>
                            <ul class="pricing-table-stuff">
                                <li>Cardio</li>
                                <li>Swimming Pool</li>
                                <li>Massage</li>
                                <li>Yoga</li>
                                <li>Aerobics</li>
                                <li>Solar</li>
                            </ul>
                            <p><a href="#" class="button d-bg-c-h">Buy now</a></p>
                        </div>
		    </div>
		    
                    <div id="plan-88" class="col-md-4 wow rollIn">
                        <div class="pricing-table ">
                            <h2 class="pricing-table-name">Platium</h2>	
                            <div class="pricing-table-price d-bg-c">$25 /<span>per year</span></div>
                            <ul class="pricing-table-stuff">
                                <li>Cardio</li>
                                <li>Swimming Pool</li>
                                <li>Massage</li>
                                <li>Yoga</li>
                                <li>Aerobics</li>
                                <li>Solar</li>
                            </ul>
                            <p><a href="http://google.com/" class="button d-bg-c-h">Buy now</a></p>
                        </div>
                    </div>
                    
		</div>
            </div>
	</div>
	
        
        <!-- .........................Map Section............................-->
        <div id="contact-section" class="contact-section" style="padding-top: 0px;">
            <div class="container" style="height: 105px;">
                <div class="site-title">
                    <p>Get in touch with us</p>
                    <h1>Contact</h1>
                    <div class="site-dots d-text-c">
                        <i class="fa fa-map-marker"></i>
                    </div>
                </div>
            </div>
            <div class="map-location">
                <div class="gmap" data-address="38-44 Amethyst Way, San Francisco, CA 94131, USA" data-marker="http://lolthemes.com/demo/geo/ulysses/wp-content/themes/ulysses/images/marker.png" data-markertxt="38-44 Amethyst Way, San Francisco, CA 94131, USA Email: example@mail.com">
                    <div id="map_addresses" class="map" style="height: 550px;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d912.5499713356118!2d90.42391960144158!3d23.811490184347694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7fc94b33923%3A0x3db1ebb68e2bd7b5!2sJAFF!5e0!3m2!1sen!2sbd!4v1574073592726!5m2!1sen!2sbd"  frameborder="0" style="border:0;width: 100%;height: 90%" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        
        
    </div>
        
        
	</article>
    </div>

                        
                        
                        
        </div>


</div>

                    </div>

            </div>
@stop





@section('footer')
    @include('user.layout.footer')
@stop
@section('script')@stop