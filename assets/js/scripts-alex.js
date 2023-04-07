jQuery(document).ready(function( $ ) {
	var lazyLoadInstance = new LazyLoad({
        elements_selector: 'img'
    });
    document.addEventListener( 'wpcf7mailsent', function( event ) {
    	if (jQuery('.form-validate-wrapper').length > 0){
    		$('body').addClass('blured');
    		$('.thank-you-overlay').addClass('active');
		}
	}, false );
	jQuery('.thank-you-overlay .close, .thank-you-overlay .close-form').on('click', function(e){
		e.preventDefault();
		$('body').removeClass('blured');
    	$('.thank-you-overlay').removeClass('active');
	})
	$('.slider-row-photo').each(function(){
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

	$('.slider-row-video-about').each(function(){
		let slider_video = $(this);
		slider_video.slick({
		  infinite: true,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  arrows: false,
		  dots: true,
		 	responsive: [
		    {
		      breakpoint: 1199,
		      settings: {
		        slidesToShow: 1,
		      }
		    }
		  ]
		});

		slider_video.parents('.slider-container').find('.slider-arrow-prev').on( 'click', function(e) {
			e.preventDefault();
		  	slider_video.slick('prev');
		});

		slider_video.parents('.slider-container').find('.slider-arrow-next').on( 'click', function(e) {
		  e.preventDefault();
		  slider_video.slick('next');
		});
	});

	jQuery('input[type="email"]').keyup(function() {
	    var raw_text =  jQuery(this).val();
	    var return_text = raw_text.replace(/[^a-zA-Z0-9_.@-]/g,'');
	    jQuery(this).val(return_text);
	});
	jQuery('input[name="pib"]').keyup(function() {
	    var raw_text =  jQuery(this).val();
	    var return_text = raw_text.replace(/[^a-zA-Zа-яА-ЯіІ ]/g,'');
	    jQuery(this).val(return_text);
	});
	function news_slider_init(){
		$('#home-news .home-news-wrapper .row').each(function(){
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
			    },
			    {
			      breakpoint: 549,
			      settings: {
			        slidesToShow: 1,
			      }
			    }
			  ]
			});
		});
	}
	if(window.innerWidth < 1199) {
		news_slider_init();
	}
	$(window).resize(function(e){
	    if(window.innerWidth < 1199) {
	        if(!$('.home-news-wrapper .row').hasClass('slick-initialized')){
	            news_slider_init();
	        }

	    }else{
	        if($('.home-news-wrapper .row').hasClass('slick-initialized')){
	            $('.home-news-wrapper .row').slick('unslick');
	        }
	    }
	});

});