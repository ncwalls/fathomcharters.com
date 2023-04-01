(function($){

	var homeHeroSlider = function() {
		$('.hero-slider').slick({
			arrows: false,
			dots: false,
			fade: true,
			speed: 2000,
			autoplay: true,
			autoplaySpeed: 4000,
			pauseOnHover: false
		});
	};


	var scrollAnim = function(){

		var win = $(window);

		var items = $('.scroll-animate-item');

		var itemScrollCheck = function(){

			var winHeight = win.innerHeight();
			var winTop = win.scrollTop();
			var scrollTriggerPos = (winHeight * .8) + winTop;

			items.each(function(i, el){

				var item = $(el);
				var itemTop = item.offset().top;

				if(itemTop <= scrollTriggerPos){
					item.addClass('vis');
				}
				else{
					item.removeClass('vis');
				}

			});

		};

		itemScrollCheck();
		optimizedScroll.add(itemScrollCheck);
	};


	var scrollToAnchor = function(){

		if( location.hash ){
			// window.scrollTo(0,0);

			$( 'body' ).removeClass( 'nav-open' );
			
			var locationHashObj = $(location.hash);
			
			if(locationHashObj.length > 0){
				//$('body').removeClass('nav-open');
				// $('body,html').animate({
				// 	scrollTop: locationHashObj.offset().top - 150
				// }, 500);

				var waitTime = 501;

				if(!$('body').hasClass('scrolled')){
					waitTime = 501;
					$('body').addClass('scrolled');
				}

				setTimeout(function(){
					var anchorPosition = locationHashObj.offset().top;
					var finalPosition = anchorPosition - $('.site-header').outerHeight() - 20;
					$("html, body").animate({scrollTop: finalPosition}, 1000);


				}, waitTime);
			}
		}

		$('.scroll-to-anchor a, a[href^="#"]').on('click', function(e){

			
			if($(this).hasClass('no-scroll')){
				return;
			}
			else if(this.hash){
				
				var hashTarget = $(this.hash);

				if( hashTarget.length ){
					e.preventDefault();
					var waitTime = 0;
					
					if(!$('body').hasClass('scrolled')){
						waitTime = 501;
						$('body').addClass('scrolled');
					}

					setTimeout(function(){
						var anchorPosition = hashTarget.offset().top;
						var finalPosition = anchorPosition - $('.site-header').outerHeight() - 20;
						$("html, body").animate({scrollTop: finalPosition}, 1000);

						$( 'body' ).removeClass( 'nav-open' );

					}, waitTime);
				}
			}
		});
	};


	// var yachtFeatures = function() {
	// 	$('[data-action="yacht-feature"]').on('click', function(e) {
	// 		// e.preventDefault();
	// 		var targetId = $(this).attr('data-target');
	// 		$.magnificPopup.open({
	// 			items: {
	// 				src: '#'+targetId,
	// 				type: 'inline'
	// 			}
	// 		})
	// 	});
	// };

	var mediaGallerySlider = function() {
		$('.media-gallery-slider').slick({
			arrows: true,
			prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.3 58" style="enable-background:new 0 0 19.3 58;" xml:space="preserve"><polygon points="7.5,29 19.3,58 0,29 19.2,0 "/></svg></button>',
			nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.3 58" style="enable-background:new 0 0 19.3 58;" xml:space="preserve"><polygon points="11.8,29 0,0 19.3,29 0.1,58 "/></svg></button>',
			dots: true,
			speed: 1000,
			// autoplay: true,
			// autoplaySpeed: 4000,
			pauseOnHover: false,
			adaptiveHeight: true
		});

		$('[data-action="gallery-nav"]').on('click', function(e) {
			e.preventDefault();
			var target = $(this).attr('data-target');
			$('.media-gallery-slider').slick('slickGoTo', target);

			$(this).addClass('current');
			$('.media-gallery-nav').find('[data-action="gallery-nav"]').not(this).removeClass('current');
		});

		$('.media-gallery-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
			var target = $('.media-gallery-nav').find('[data-action="gallery-nav"][data-target="'+nextSlide+'"]');
			target.addClass('current');
			$('.media-gallery-nav').find('[data-action="gallery-nav"]').not(target).removeClass('current');
		});


		$('.img-gallery').each(function(i,el){
			$(el).magnificPopup({
				delegate: 'a',
				type: 'image',
				gallery: {
					enabled: true
				}
			});
		});
	};

	var yachtSlider = function() {
		$('.yacht-slider').slick({
			arrows: true,
			prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.3 58" style="enable-background:new 0 0 19.3 58;" xml:space="preserve"><polygon points="7.5,29 19.3,58 0,29 19.2,0 "/></svg></button>',
			nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.3 58" style="enable-background:new 0 0 19.3 58;" xml:space="preserve"><polygon points="11.8,29 0,0 19.3,29 0.1,58 "/></svg></button>',
			dots: true,
			speed: 1000,
			// autoplay: true,
			// autoplaySpeed: 4000,
			pauseOnHover: false,
			adaptiveHeight: true
		});
	};


	$(document).ready(function(){
		homeHeroSlider();
		scrollAnim();
		scrollToAnchor();
		// yachtFeatures();
		mediaGallerySlider();
		yachtSlider();
	});

    window.addEventListener('load', function() {
        var videoContainer = $('.hero-video-container');
        videoContainer.addClass('vis');
    }, false);

})(jQuery);

/* Lazy load bg images https://web.dev/lazy-loading-images/ */
document.addEventListener("DOMContentLoaded", function() {
  var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

  if ("IntersectionObserver" in window) {
    let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          lazyBackgroundObserver.unobserve(entry.target);
        }
      });
    });

    lazyBackgrounds.forEach(function(lazyBackground) {
      lazyBackgroundObserver.observe(lazyBackground);
    });
  }
});