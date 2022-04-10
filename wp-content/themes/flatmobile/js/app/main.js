"use strict";

jQuery(document).ready(function($){

	//ripple with default options
	$(".menu-list a, header a").ripple();
	setTimeout(function () {
		$('.legitRipple').on('click', function (e) {
			e.preventDefault();
			var href = $(this).attr('href');
			if( href != 'https://#' && href != 'http://#' && href != '#' ){
				setTimeout(function () {
					window.location = href;
				},250);
			}
		});
	},500);

	/**---------------------
	 *
	 * FastClick
	 *
	 *---------------------**/
	FastClick.attach(document.body);


	/**---------------------
	 *
	 * Scrolling and Navbar
	 *
	 *---------------------**/
	var pageScrollArea = $('.tc-page .inner');
	var navbar = $('.navbar'),
		currentScroll = 0,
		previousScroll = 0;

	pageScrollArea.scroll(function () {
		currentScroll = $(this).scrollTop();
		if( currentScroll > 55 && previousScroll < currentScroll && !navbar.hasClass('hidden') ){
			// hide
			navbar.addClass('hidden');
		}else if( previousScroll > currentScroll &&  navbar.hasClass('hidden')){
			//show
			navbar.removeClass('hidden');
		}

		var inside_header = ($(this).scrollTop() <= 51);

		if ( inside_header == true && navbar.hasClass('navbar-fixed') )
			navbar.removeClass('colored');
		else
			navbar.addClass('colored');

		previousScroll = currentScroll;
	});


	$('[data-panel],.overlay').click(function(e){
		e.preventDefault();

		if( $(this).data('panel') ){
			var location = $(this).data('panel');
			$('body').toggleClass('ms-panel-'+location);
			if( window.revapi1 ){
				revapi1.revpause();
			}
		}else{
			$('body').removeClass('ms-panel-left ms-panel-right');
			if( window.revapi1 ){
				revapi1.revresume();
			}
		}
	});



	/**---------------------
	 *
	 * Header Search
	 *
	 *---------------------**/
	var _search_toggler = $('.header-search-icon'),
			_header_search  = $('.tc-header-search');

	if( _header_search.length   > 0 &&
			_search_toggler.length  > 0 )

		_search_toggler.on('click', function () {
			_header_search.toggleClass('show');
			$(this).toggleClass('show');
		});



	/**---------------------
	 *
	 * Filterable Grid
	 *
	 *---------------------**/
	var _isotope = $('.tc-isotope');
	if( _isotope.get(0) )
		_isotope.imagesLoaded(function () {
			_isotope.each(function () {
				var ___this     = $(this),
					__filters   = ___this.prev().find('.tc-filters a');

				var iso = new Isotope( ___this.get(0), {
					itemSelector: '.tc-isotope-item'
				});

				if( __filters.get(0) )
					__filters.on( 'click', function(e) {
						e.preventDefault();
						var that        = $(this),
								filterValue = that.data('filter');

						if( !that.hasClass('active') ){
							__filters.filter(function(){
								return $(this).hasClass('active');
							}).removeClass('active');

							that.addClass('active');
							iso.arrange({
								filter: filterValue
							});
						}
					});
			});
		});



	/**---------------------
	 *
	 * Countdown
	 *
	 *---------------------**/
	var _countdown = $('.tc-countdown');
	function formatter(event,el){
		var days = event.strftime('<div><h4>%D</h4><span>'+el.data('days-label')+'</span></div>'),
				hours = event.strftime('<div><h4>%H</h4><span>'+el.data('hours-label')+'</span></div>'),
				minutes = event.strftime('<div><h4>%M</h4><span>'+el.data('minutes-label')+'</span></div>'),
				seconds = event.strftime('<div><h4>%S</h4><span>'+el.data('seconds-label')+'</span></div>');

		return days+hours+minutes+seconds;
	}

	if( _countdown.get(0) ){
		_countdown.each(function () {
			var __this      = $(this),
				__endDate   = __this.data('end-date');

			__this.countdown(__endDate, function(event) {
				$(this).html(formatter(event,__this));
			});
		});
	}



	/**---------------------
	 *
	 * Slider Carousel
	 *
	 *---------------------**/
	var __slider = $('.tc-slider');
	if( __slider.get(0) ){
		__slider.each(function () {
			var ___slider = $(this);

			___slider.owlCarousel({
				autoplay: 500,
				autoplayTimeout: 5000,
				loop:true,
				margin:0,
				smartSpeed: 450,
				nav:true,
				navText: ['<i class="uiicon-arrow427"></i>','<i class="uiicon-arrow413"></i>'],
				responsive:{
					0:{
						items:1
					}
				}
			});
		});
	}

	/**---------------------
	 *
	 * Testimonials
	 *
	 *---------------------**/
	var _testimonials = $('.ms-testimonials');
	if( _testimonials.get(0) )
		_testimonials.each(function(){

			var _this       = $(this),
					_nav        = _this.find('nav'),
					_details    = _this.find('.details'),
					_pipe       = _this.find('.pipe span');

			_nav.find('a').on('click', function (e) {
				e.preventDefault();

				if( !$(this).hasClass('active') ){
					_nav.find('.active').removeClass('active');
					_details.find('.active').removeClass('active').slideUp(400);
					_pipe.css('left', (16.66666666666667 * $(this).index())+'%');

					$(this).addClass('active');
					var _detail = _details.find('div:nth-child('+( $(this).index() + 1 )+')');

					_detail.addClass('active').slideDown(400);
				}
			});

			_nav.find('a:first-child').click();
		});




	/**---------------------
	 *
	 * Lightbox
	 *
	 *---------------------**/
	var _swipebox = $('.swipebox');
	if( _swipebox.get(0) ){
		_swipebox.swipebox( {
			useCSS : true, // false will force the use of jQuery for animations
			useSVG : true, // false to force the use of png for buttons
			initialIndexOnArray : 0, // which image index to init when a array is passed
			hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
			hideBarsDelay : 3000, // delay before hiding bars on desktop
			videoMaxWidth : 1140, // videos max width
			beforeOpen: function() {}, // called before opening
			afterOpen: null, // called after opening
			afterClose: function() {}, // called after closing
			loopAtEnd: false // true will return to the first image after the last image is reached
		} );
	}



	/**---------------------
	 *
	 * Flickr Feed
	 *
	 *---------------------**/
	var flickrfeed = $('.flickr-feed');
	if( flickrfeed.get(0) )
		flickrfeed.each(function () {
			var $this = $(this);
			$(this).jflickrfeed({
				flickrbase: '//api.flickr.com/services/feeds/',
				feedapi: 'photos_public.gne',
				limit: $this.data('post-count'),
				qstrings: {
					lang: 'en-us',
					format: 'json',
					jsoncallback: '?',
					id: $this.data('post-collection-key')
				},
				cleanDescription: true,
				useTemplate: true,
				itemTemplate: '<li><a href="{{image_b}}" class="swipebox"><img src="{{image_s}}" alt="{{title}}" /></a></li>',
				itemCallback: function(data) {
					$this.find('.swipebox').swipebox();
				}
			});
		});


	/**---------------------
	 *
	 * Menu
	 *
	 *---------------------**/
	var subMenu = $('.menu-list .sub-menu');
	if( subMenu.get(0) ){
		subMenu.hide();
		subMenu.find('.current-menu-item').parents('ul').show();
		subMenu.each(function(){
			var $this = $(this);
			var	$link = $this.prev('a');
			$link.append('<span class="menu-pill">'+$this.children().length+'</span>');

			$link.click(function (e) {
				e.preventDefault();

				if( $this.is(':visible') )
					$this.slideUp();
				else
					$this.slideDown();
			})
		});
	}



	/**---------------------
	 *
	 * Activity Toggle
	 *
	 *---------------------**/
	var activity_item = $('.ms-activity-item .content');
	if( activity_item.get(0) ){
		var container = activity_item.parent();
		container.on('click', function () {
			var content = $(this).find('.content');
			if( content.is(':visible') ){
				$(this).removeClass('open');
				content.slideUp(300);
			}else{
				$(this).addClass('open');
				content.slideDown(300);
			}
		});
	}



	/**---------------------
	 *
	 * Dismiss
	 *
	 *---------------------**/
	var dismiss = $('.dismiss');
	if( dismiss.get(0) ){
		dismiss.on('click', function () {
			$(this).parent().slideUp(function () {
				$(this).remove();
			});
		});
	}


	/**---------------------
	 *
	 * VC Progress Bar Animation
	 *
	 *---------------------**/
	var progressBars = $('[class*="vc_progress-bar-"]');
	var scrollArea = $('.tc-page .inner');
	if( progressBars.get(0) ){
		scrollArea.scroll(function () {
			progressBars.each(function () {
				if( $(this).is(':in-viewport') && !$(this).hasClass('ms-animated') ){
					$(this).addClass('ms-animated');
					var bar = $(this).find('.vc_bar');
					bar.css('width', bar.data('value')+'%');
				}
			});
		});
	}



	/**---------------------
	 *
	 * Navbar visibility and coloring
	 *
	 *---------------------**/
	scrollArea.scroll(function () {
		var currentScroll = $(this).scrollTop();
		if( currentScroll > 55 && previousScroll < currentScroll && !navbar.hasClass('hidden') ){
			// hide
			navbar.addClass('hidden');
		}else if( previousScroll > currentScroll &&  navbar.hasClass('hidden')){
			//show
			navbar.removeClass('hidden');
		}

		var inside_header = ($(this).scrollTop() <= 51);

		if ( inside_header == true && navbar.hasClass('navbar-fixed') )
			navbar.removeClass('colored');
		else
			navbar.addClass('colored');

		previousScroll = currentScroll;
	});


	$('.add_to_cart_button').click(function() {
		if( ! $(this).hasClass('loading') ){
			var _header_shop_icon = $('.header-shop-icon span:not(.legitRipple-ripple)');

			var added = parseInt(_header_shop_icon.html()) + 1;
			_header_shop_icon.html(added);
		}
	});

	$(window).load(function () {
		var _page_loading_box = $('.ms-page-loading');
		_page_loading_box.addClass('opacity-0');
		_page_loading_box.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
			function(e) {
				if( ! $('.wp-customizer', window.parent.document).get(0) )
					_page_loading_box.remove();
			});
	});
});