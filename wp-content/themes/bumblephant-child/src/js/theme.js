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


	var yachtFeatures = function() {
		$('[data-action="yacht-feature"]').on('click', function(e) {
			// e.preventDefault();
			var targetId = $(this).attr('data-target');
			$.magnificPopup.open({
				items: {
					src: '#'+targetId,
					type: 'inline'
				}
			})
		});
	};


	$(document).ready(function(){
		homeHeroSlider();
		scrollAnim();
		scrollToAnchor();
		yachtFeatures();
	});

    window.addEventListener('load', function() {
        var videoContainer = $('.hero-video-container');
        videoContainer.addClass('vis');
    }, false);

})(jQuery);

/* Lazy load bg images https://web.dev/lazy-loading-images/ */
// document.addEventListener("DOMContentLoaded", function() {
//   var lazyBackgrounds = [].slice.call(document.querySelectorAll(".lazy-background"));

//   if ("IntersectionObserver" in window) {
//     let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
//       entries.forEach(function(entry) {
//         if (entry.isIntersecting) {
//           entry.target.classList.add("visible");
//           lazyBackgroundObserver.unobserve(entry.target);
//         }
//       });
//     });

//     lazyBackgrounds.forEach(function(lazyBackground) {
//       lazyBackgroundObserver.observe(lazyBackground);
//     });
//   }
// });