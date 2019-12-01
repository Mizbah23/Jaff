
<section class="slider-section" id="home_slider-section">	
    <div class="home-slider-over">
        <div id="home-slider" class="flexslider home-flexslider">
            <ul class="slides">
                @foreach($sliders as $sl)
                    <li class="slider">
                        <div class="slide-text">
                            <h4 class="wow fadeInDown" data-wow-delay="1s">Jaff Sports</h4>
                            <h5 class="wow bounceInUp" data-wow-delay="2s">{{$sl->title}}</h5>
                            <!--<h5 class="wow bounceInUp" data-wow-delay="3s">yoga / cardio / power lifting / fitness / aerobics / pilates</h5>-->
                        </div>
                         <img src="{{asset($sl->slider_img)}}" style="width: 1263px; height: 640px;"alt="Jaff" />
                    </li>
                @endforeach
            </ul>
        </div>
    </div>			
</section>