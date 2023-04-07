jQuery(document).ready(function( $ ) {

	$('.open-mobile-menu').on('click', function(e){
		e.preventDefault();
		$('.mobile-menu-wrapper').addClass('mobile-menu-wrapper__active');
		$('body').addClass('body__hidden');
	});

	$('.close-mobile-menu').on('click', function(e){
		e.preventDefault();
		$('.mobile-menu-wrapper').removeClass('mobile-menu-wrapper__active');
		$('body').removeClass('body__hidden');
	});
	
	$('.main-menu__mobile .menu-item-has-children > a').on('click', function(e) {
		e.preventDefault();
		$(this).parent('li').toggleClass('open-link');
		$(this).parent('li').find('.sub-menu').slideToggle();
	});

	$('.search-icon').on('click', function () {
		$(this).parents('form').submit();	
	});

	$('.order-select').on('change', function () {
		$(this).parents('form').submit();	
	});

	$('.slider-row').each(function(){
		let slider = $(this);
		slider.slick({
		  infinite: true,
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  arrows: false,
		  dots: true,
		  responsive: [
		    {
		      breakpoint: 1199,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 767,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		  ]
		});

		slider.parents('.slider-container').find('.slider-arrow-prev').on( 'click', function(e) {
			e.preventDefault();
		  	slider.slick('prev');
		});

		slider.parents('.slider-container').find('.slider-arrow-next').on( 'click', function(e) {
		  e.preventDefault();
		  slider.slick('next');
		});
	});


	$('.slider-row-video').each(function(){
		let slider = $(this);
		slider.slick({
		  infinite: true,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  arrows: false,
		  dots: true,
		  responsive: [
		    {
		      breakpoint: 1199,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 767,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		  ]
		});

		slider.parents('.slider-container').find('.slider-arrow-prev').on( 'click', function(e) {
			e.preventDefault();
		  	slider.slick('prev');
		});

		slider.parents('.slider-container').find('.slider-arrow-next').on( 'click', function(e) {
		  e.preventDefault();
		  slider.slick('next');
		});
	});

	$('.slider-row-events').each(function(){
		let slider = $(this);
		slider.slick({
		  infinite: true,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  arrows: false,
		  dots: true,
		  responsive: [
		    {
		      breakpoint: 1199,
		      settings: {
		        slidesToShow: 2,
		      }
		    },
		    {
		      breakpoint: 767,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		  ]
		});

		slider.parents('.slider-container').find('.slider-arrow-prev').on( 'click', function(e) {
			e.preventDefault();
		  	slider.slick('prev');
		});

		slider.parents('.slider-container').find('.slider-arrow-next').on( 'click', function(e) {
		  e.preventDefault();
		  slider.slick('next');
		});
	});

	function init_media_archive_sliders() {
		if( window.outerWidth <= 991) {
			$('.archive-media-slider').each(function () {
				let slider = $(this);
				let slides_counter = slider.find('.archive-media-item').length;
				if(slides_counter > 1){
					slider.not('.slick-initialized').slick({
						arrows: false,
						dots: false,
						infinite: true,
					});
				}
			});
		} else {
			$('.archive-media-slider').each(function () {
				let slider = $(this);
				slider.filter('.slick-initialized').slick('unslick');
			});
		}
	}

	init_media_archive_sliders();

	$( window ).resize(function() {
		init_media_archive_sliders();
	});

	$('.show-more-fights').on('click', function(e){
		e.preventDefault();
		$('.boxer-page-fights-wrapper table tr').addClass('active');
		$(this).hide();
	});

	$('.zoom-gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 0, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
		
	});

	$('.media-gallery-video').on('click', function(e){
		e.preventDefault();
		$('body').addClass('body__hidden');
		const videoid = $(this).attr('data-youtube_id');
		$('<iframe id="player" width="1200" height="675" frameborder="0" allowfullscreen></iframe>')
		    .attr("src", "http://www.youtube.com/embed/" + videoid + "?enablejsapi=1&rel=0&showinfo=0")
		    .appendTo('.watch-video__wrapper');
		$('.watch-video__overlay').addClass('active');
		$('.watch-video__wrapper').addClass('active');
	});

	$('.watch-video__close').on('click', function(e){
		e.preventDefault();
		$('body').removeClass('body__hidden');
		$('.watch-video__wrapper').removeClass('active');
		$('.watch-video__overlay').removeClass('active');
		$('.watch-video__wrapper iframe').detach();
	});
});