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

	var destinationsSlider = function() {
		$('.destinations-slider').slick({
			arrows: true,
			prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.3 58" style="enable-background:new 0 0 19.3 58;" xml:space="preserve"><polygon points="7.5,29 19.3,58 0,29 19.2,0 "/></svg></button>',
			nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.3 58" style="enable-background:new 0 0 19.3 58;" xml:space="preserve"><polygon points="11.8,29 0,0 19.3,29 0.1,58 "/></svg></button>',
			dots: false,
			speed: 1000,
			// autoplay: true,
			// autoplaySpeed: 4000,
			pauseOnHover: false,
			adaptiveHeight: true
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

	var destinationsList = function() {
		$('[data-action="destination-location"]').on('click', function(e) {
			var parent = $(this).parents('li');
			parent.toggleClass('open');
			$('.locations-list').find('li').not(parent).removeClass('open');
		});

		// $('[data-action="destination-map-location"]').on('click', function(e) {
		// 	var target = $(this).attr('data-target');
		// 	var targetItem = $('#location-item-'+target);
		// 	targetItem.addClass('open');
		// 	$('.locations-list').find('li').not(targetItem).removeClass('open');

			
		// 	var anchorPosition = targetItem.offset().top;
		// 	var finalPosition = anchorPosition - $('.site-header').outerHeight() - 20;
		// 	$("html, body").animate({scrollTop: finalPosition}, 1000);
		// });
	};


	var destinationMap = function() {

		var markerIconUrl = $('#destination-map').data('marker');

		var infoWindow = null;

		var mapStyleJSON = [
		  {
		    "elementType": "labels",
		    "stylers": [
		      {
		        "visibility": "off"
		      }
		    ]
		  },
		  {
		    "featureType": "administrative",
		    "stylers": [
		      {
		        "visibility": "off"
		      }
		    ]
		  },
		  {
		    "featureType": "landscape",
		    "stylers": [
		      {
		        "color": "#038da3"
		      }
		    ]
		  },
		  {
		    "featureType": "poi",
		    "stylers": [
		      {
		        "visibility": "off"
		      }
		    ]
		  },
		  {
		    "featureType": "road",
		    "stylers": [
		      {
		        "color": "#00756d"
		      },
		      {
		        "visibility": "off"
		      }
		    ]
		  },
		  {
		    "featureType": "road",
		    "elementType": "labels.icon",
		    "stylers": [
		      {
		        "visibility": "off"
		      }
		    ]
		  },
		  {
		    "featureType": "transit",
		    "stylers": [
		      {
		        "visibility": "off"
		      }
		    ]
		  },
		  {
		    "featureType": "water",
		    "stylers": [
		      {
		        "color": "#75abdc"
		      }
		    ]
		  }
		];

		/**
		 * initMap
		 *
		 * Renders a Google Map onto the selected jQuery element
		 *
		 * @date    22/10/19
		 * @since   5.8.6
		 *
		 * @param   jQuery $el The jQuery element.
		 * @return  object The map instance.
		 */
		function initMap( $el ) {

		    // Find marker elements within map.
		    var $markers = $el.find('.marker');

		    // Create gerenic map.
		    var mapArgs = {
		        zoom : $el.data('zoom') || 16,
		        mapTypeId : google.maps.MapTypeId.ROADMAP,
		        styles : mapStyleJSON
		    };
		    var map = new google.maps.Map( $el[0], mapArgs );

		    infowindow = new google.maps.InfoWindow();

		    // Add markers.
		    map.markers = [];
		    $markers.each(function(){
		        initMarker( $(this), map );
		    });

		    // Center map based on markers.
		    centerMap( map );


		    // Return map instance.
		    return map;
		}

		/**
		 * initMarker
		 *
		 * Creates a marker for the given jQuery element and map.
		 *
		 * @date    22/10/19
		 * @since   5.8.6
		 *
		 * @param   jQuery $el The jQuery element.
		 * @param   object The map instance.
		 * @return  object The marker instance.
		 */
		function initMarker( $marker, map ) {

		    var markerId = $marker.data('id');
		    var lat = $marker.data('lat');
		    var lng = $marker.data('lng');
		    var latLng = {
		        lat: parseFloat( lat ),
		        lng: parseFloat( lng )
		    };

		    // Create marker instance.
		    var marker = new google.maps.Marker({
		        position : latLng,
		        map: map,
		        icon: {
						    url: markerIconUrl, // url
						    scaledSize: new google.maps.Size(40, 40), // scaled size
						    origin: new google.maps.Point(0,0), // origin
						    anchor: new google.maps.Point(20,20) // anchor
						}

		    });

		    // Append to reference for later use.
		    map.markers.push( marker );

		    // If marker contains HTML, add it to an infoWindow.
		    if( $marker.html() ){

		        //Create info window.
		       
		        // Show info window when marker is clicked.
		        google.maps.event.addListener(marker, 'click', function() {
		        	// console.log('clk', markerId);
						
			        infowindow.setContent($marker.html());
		          infowindow.open( map, marker );
		          // $('[data-action="destination-location"]')
           		$('[data-action="destination-location"][data-markerid="'+markerId+'"]').trigger('click');
		        });
		       
		        $('[data-markerid="'+markerId+'"]').on('click', function() {
		        		// console.log('clk2', markerId);
		            
			      	  infowindow.setContent($marker.html());
		            infowindow.open( map, marker );

		        });

		    }
		}

		/**
		 * centerMap
		 *
		 * Centers the map showing all markers in view.
		 *
		 * @date    22/10/19
		 * @since   5.8.6
		 *
		 * @param   object The map instance.
		 * @return  void
		 */
		function centerMap( map ) {

		    // Create map boundaries from all map markers.
		    var bounds = new google.maps.LatLngBounds();
		    map.markers.forEach(function( marker ){
		        bounds.extend({
		            lat: marker.position.lat(),
		            lng: marker.position.lng()
		        });
		    });

		    // Case: Single marker.
		    if( map.markers.length == 1 ){
		        map.setCenter( bounds.getCenter() );

		    // Case: Multiple markers.
		    } else{
		        map.fitBounds( bounds );
		    }
		}

    var map = initMap( $('#destination-map') );

	};

	$(document).ready(function(){
		homeHeroSlider();
		destinationsSlider();
		scrollAnim();
		scrollToAnchor();
		// yachtFeatures();
		mediaGallerySlider();
		yachtSlider();
		destinationsList();
	});

  window.addEventListener('load', function() {
      var videoContainer = $('.hero-video-container');
      videoContainer.addClass('vis');
		destinationMap();
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