(function($)
{
	"use strict";

	//might be selecting too many things
	$(".dropdown-toggle").click(function(e)
	{
		$(this).closest('li').toggleClass('open')
		e.stopPropagation(); //stops from hiding menu
	});

	/* Event - Window Scroll */
	$(window).scroll(function()
	{
		var scroll	=	$(window).scrollTop();
		var height	=	$(window).height();

		/*** set sticky menu ***/
		if( scroll >= 90 )
		{
			$('.header').addClass("is-sticky").delay( 2000 ).fadeIn();
		}
		else if ( scroll <= height )
		{
			$('.header').removeClass("is-sticky");
		}
		else
		{
			$('.header').removeClass("is-sticky");
		} // set sticky menu - end	
	});
	/* Event - Window Scroll /- */

	/* swipe box */
    // $( '.zoom-image' ).swipebox();

	/* $('.filter-tags > li a').click(function (e) {
		e.preventDefault();

		var tag = $(this).text();
		var filters = $(this).parent();

		$('.filter-tags > li').removeClass('active-filter');

		filters.addClass('active-filter');

		$('#sorted-tag').html(tag);

		$('.portfolio-items > li > div').each(function()
		{
			$(this).parent().removeClass('hidden-item');

			if ( $(this).hasClass(tag.toLowerCase()) == false && tag.toLowerCase() !== 'all' )
			{
				$(this).parent().addClass('hidden-item');
			}
		});
	}); */

	$('#back-to-top').click(function()
	{
		// When arrow is clicked
		$('body,html').animate(
		{
			scrollTop : 0 // Scroll to top of body
		},800);
	});

	/* Slider Section */
	$('.slider-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.slider-section .slide-text h4').addClass('animated wow bounceInUp');
			$('.slider-section .slide-text h2').addClass('animated wow bounceInUp');
			$('.slider-section .slide-text h5').addClass('animated wow bounceInUp');
		});
	});
	
	/* About Section */
	$('.about-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.img-box').addClass('animated wow bounceInLeft');			
			$('.services-mark-1').addClass('animated wow bounceInRight');				

		});
	});
	
	/* Statistics Section */
	$('.statistics-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.statistics-section .statistic').addClass('animated wow fadeInUp');			
		});
	});
	
	/* Classes Section*/
	$('.classes-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.classes-section .flex-direction-nav').addClass('animated wow bounceInRight');
		});
	});
	
	/* Trainers Section */
	$('.trainers-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.trainers-section .trainer').addClass('animated wow bounceInLeft');
		});
	});
	
	/* Purchase Section */
	$('.purchase-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.purchase-section').addClass('animated wow fadeInDown');
		});
	});
	
	/* Contact Section */
	$('.contact-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{
			$('.contact-section .contact-form').addClass('animated wow bounceInLeft');
		});
	});
	
	/* Statistics Section */
	$('.statistics-section').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");

		$this.appear(function()
		{			
			var statistics_item_count = 0;
			var statistics_count = 0;					
			statistics_item_count = $( "[id*='statistics_count-']" ).length;
			// alert(statistics_item_count);

			for(var i=1; i<=statistics_item_count; i++)
			{
				statistics_count = $( "[id*='statistics_count-"+i+"']" ).attr( "data-statistics_percent" );
				$("[id*='statistics_count-"+i+"']").animateNumber({ number: statistics_count }, 2000);
				// $("[id*='skill_count-"+i+"']").css('width', skills_count);
			}
		});
	});

	$('.dial').each(function ()
	{
		var $this = $(this);
		var myVal = $(this).data("value");		

		$this.appear(function()
		{
			// alert(myVal);
			$this.knob({ });
			$({ value: 0 }).animate({ value: myVal },
			{
				duration: 2000,
				easing: 'swing',
				step: function ()
				{
					$this.val(Math.ceil(this.value)).trigger('change');
				}
			});
		});
	});

	/* Event - Document Ready /- */	
	jQuery(document).ready(function($)
	{
		$(".tab_content_login").hide();
		$("ul.tabs_login li:first").addClass("active_login").show();
		$(".tab_content_login:first").show();
		$("ul.tabs_login li").click(function()
		{
			$("ul.tabs_login li").removeClass("active_login");
			$(this).addClass("active_login");
			$(".tab_content_login").hide();

			var activeTab = $(this).find("a").attr("href");
			$(activeTab).show();

			return false;
		});

		/* ******************************************************************** */


		// local url of page (minus any hash, but including any potential query string)
		var url = location.href.replace(/#.*/,'');

		// Find all anchors
		$('#navbar').find('a[href]').each( function( i,a ) {

			var $a = $(a);
			var href = $a.attr('href');

			// check is anchor href starts with page's URI
			if ( href.indexOf(url+'#') == 0 ) {

				// remove URI from href
				href = href.replace(url,'');

				// update anchors HREF with new one
				$a.attr('href',href);
			}
		});
		
		$('.navbar-nav li a[href*="#"]:not([href="#"]), .logo a[href*="#"]:not([href="#"])').click( function() {

			if ( location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {

				var target = $( this.hash );

				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				if ( target.length ) {

					if( $('#wpadminbar').outerHeight() == null ) {
						$('html, body').animate( { scrollTop: target.offset().top - $('#navbar').outerHeight() + 25 }, 1000, 'easeInOutExpo' );
					}
					else {
						$('html, body').animate( { scrollTop: target.offset().top - $('#navbar').outerHeight() - $('#wpadminbar').outerHeight() + 25 }, 1000, 'easeInOutExpo' );
					}
					return false;
				}
			}
		} );

		/* Trainers Section owlCarousel */
		if($("#trainers-slider").length)
		{
			$("#trainers-slider").owlCarousel(
			{
				// autoPlay: 1000, //Set AutoPlay to 3 seconds
				items : 3,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [990,2],
				itemsTablet: [767,1],
				navigation:true
			});
		}

		/* Blog Post Section owlCarousel */
		if($("#blog-post").length)
		{
			$("#blog-post").owlCarousel(
			{
				// autoPlay: 1000, //Set AutoPlay to 3 seconds
				items : 2,
				itemsDesktop : [1199,2],
				itemsDesktopSmall : [991,1],
				itemsTablet: [767,1],
				navigation:true
			});
		}

		/* Client Logo */
		if($("#clients-logo").length)
		{
			$("#clients-logo").owlCarousel(
			{
				items : 6,
				itemsDesktop : [1199,6],
				itemsDesktopSmall : [991,3],
				itemsTablet: [767,3],
				itemsMobile: [480,3],
				navigation:true
			});
		}
	});
	/* document.ready /- */

	var wow = new WOW(
	{
		boxClass:     'wow',      // animated element css class (default is wow)
		animateClass: 'animated', // animation css class (default is animated)
		offset:       0,          // distance to the element when triggering the animation (default is 0)
		mobile:       true,       // trigger animations on mobile devices (default is true)
		live:         true        // act on asynchronously loaded content (default is true)
	});
	wow.init();

	/* Event - Window Load */
	$(window).load(function()
	{		
		/* Loader */
		$(".load-complete").delay(2000).fadeOut("slow");
		
		/* Flexslider */
		if($("#home-slider").length)
		{
			$('#home-slider').flexslider();
		}
		if($("#classes-slider").length)
		{
			$('#classes-slider').flexslider();
		}
		if($("#testimonial-slider").length)
		{
			$('#testimonial-slider').flexslider();
		}
	});
	/* Event - Window Load /- */

})(jQuery);
