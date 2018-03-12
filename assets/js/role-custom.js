jQuery.noConflict();
function setScrollOffset() {
	"use strict";
	var $dtScrollOffset = 89;
	if (Modernizr.mq('only all')) {

		//Large Screen
		if (Modernizr.mq('only screen and (min-width:960px) and (max-width:1920px)')) {
			$dtScrollOffset = 89;

			//"Desktops and laptops"
		} else if (Modernizr.mq('only screen and (min-width:768px) and (max-width:959px)')) {
			$dtScrollOffset = 69;

			//Smartphones (landscape)
		} else if (Modernizr.mq('only screen and (min-width: 480px) and (max-width: 767px)')) {
			$dtScrollOffset = 59;

			//Smartphones (portrait)
		} else if (Modernizr.mq('only screen and (max-width: 479px)')) {
			$dtScrollOffset = 0;
		}
	}
	return $dtScrollOffset;
}

(function($) {

	"use strict";

	$(window).load(function() {

		$("ul.products li").each(function() {
			//get the initial height of every div
			var liHeight = $(this).height();
			$(this).css("height", liHeight);
		});

		//Blog Carousel
		if ($('.dt-sc-full-width-blog-carousel').length) {
			$('.dt-sc-full-width-blog-carousel').each(function() {
				$(this).carouFredSel({
					responsive : true,
					auto : false,
					width : '100%',
					prev : $(this).parents(".blog-carousel-wrapper").find("a.prev-posts"),
					next : $(this).parents(".blog-carousel-wrapper").find("a.next-posts"),
					height : 'auto',
					scroll : 1,
					items : {
						visible : {
							min : 1,
							max : 1
						}
					}
				});
			});
		}

		if ($('.dt-sc-one-half-blog-carousel').length) {
			$('.dt-sc-one-half-blog-carousel').each(function() {
				$(this).carouFredSel({
					responsive : true,
					auto : false,
					width : '100%',
					prev : $(this).parents(".blog-carousel-wrapper").find("a.prev-posts"),
					next : $(this).parents(".blog-carousel-wrapper").find("a.next-posts"),
					height : 'auto',
					scroll : 1,
					items : {
						visible : {
							min : 1,
							max : 2
						}
					}
				});
			});
		}

		if ($('.dt-sc-one-third-blog-carousel').length) {
			$('.dt-sc-one-third-blog-carousel').each(function() {
				$(this).carouFredSel({
					responsive : true,
					auto : false,
					width : '100%',
					prev : $(this).parents(".blog-carousel-wrapper").find("a.prev-posts"),
					next : $(this).parents(".blog-carousel-wrapper").find("a.next-posts"),
					height : 'auto',
					scroll : 1,
					items : {
						visible : {
							min : 1,
							max : 3
						}
					}
				});
			});
		}
		//Blog Carousel End

		//Portfolio Carousel
		if (($(".portfolio-slider").length) && ($(".portfolio-slider li").length > 1)) {
			$('.portfolio-slider').bxSlider({
				auto : false,
				video : true,
				useCSS : false,
				pager : '',
				autoHover : true,
				adaptiveHeight : true
			});
		}

	});

	$(".animate").each(function() {
		$(this).bind('inview', function(event, visible) {
			var $this = $(this),
			    $animation = ($this.data("animation") !== undefined) ? $this.data("animation") : "slideUp";
			var $delay = ($this.data("delay") !== undefined) ? $this.data("delay") : 300;

			if (visible === true) {
				setTimeout(function() {
					$this.addClass($animation);
				}, $delay);
			} else {
				setTimeout(function() {
					$this.removeClass($animation);
				}, $delay);
			}
		});
	});

})(jQuery);

jQuery(document).ready(function($) {
	"use strict";

	$("#skills .dt-sc-arc-image").each(function() {
		var w = $(this).width();
		$(this).find(".c100").css({fontSize: w});
	})
	
	$(window).resize(function() {
		$("#skills .dt-sc-arc-image").each(function() {
			var w = $(this).width();
			$(this).find(".c100").css({fontSize: w});
		})
	})

	//Menu
	$('nav#main-menu').meanmenu({
		meanMenuContainer : $('header#header'),
		meanRevealPosition : 'right',
		meanScreenWidth : 767,
		meanRemoveAttrs : false,
		onePage : true
	});

	$('ul.products li.pif-has-gallery').hover(function() {
		var $item = $(this).find("a:first-child");
		$($item).children('.wp-post-image').removeClass('fadeInDown').addClass('animated fadeOutUp');
		$($item).children('.secondary-image').removeClass('fadeOutUp').addClass('animated fadeInDown');
	}, function() {
		var $item = $(this).find("a:first-child");
		$($item).children('.wp-post-image').removeClass('fadeOutUp').addClass('fadeInDown');
		$($item).children('.secondary-image').removeClass('fadeInDown').addClass('fadeOutUp');
	});
	/* Woo */

	/* To Top */
	$().UItoTop({
		easingType : 'easeOutQuart'
	});

	/* Nice Scroll */
	$("html").niceScroll({
		zindex : 9999999,
		cursorborder : "1px solid #424242"
	});

	/* Sticky Header */
	$("#header").sticky({
		topSpacing : 0
	});

	/* One Page Navigation */
	$('#main-menu').onePageNav({
		currentClass : 'current_page_item',
		changeHash : false,
		scrollSpeed : 750,
		filter : ':not(.external)',
		scrollOffset : setScrollOffset()
	});

	/* Portfolio Lightbox */
	if ($(".gallery").length) {
		$(".gallery a[data-gal^='prettyPhoto']").prettyPhoto({
			animation_speed : 'normal',
			theme : 'light_square',
			slideshow : 3000,
			autoplay_slideshow : true,
			social_tools : false,
			deeplinking : false
		});
	}

	//Portfolio isotope
	var $container = $('.portfolio-container');
	if ($container.length) {

		$container.isotope({
			itemSelector : '.portfolio',
			masonry : {
				gutterWidth : 20
			}
		});

		$(window).smartresize(function() {
			$container.isotope({
				itemSelector : '.portfolio',
				masonry : {
					gutterWidth : 20
				}
			});
		});
	}

	if ($("div#sorting-container").length) {
		var $ajax_container = $("div#sorting-container").next(".ajax-portfolio-container");
		$("div#sorting-container a").click(function() {
			$ajax_container.find("a.ajax-close").trigger('click');
			$("div#sorting-container a").removeClass("active-sort");
			var selector = $(this).attr('data-filter');
			$(this).addClass("active-sort");
			$container.isotope({
				filter : selector,
				masonry : {
					gutterWidth : 20
				},
				animationOptions : {
					duration : 750,
					easing : 'linear',
					queue : false
				}
			});
			return false;
		});
	}
	//Portfolio isotope End

	/* Placeholder Script */
	if (!Modernizr.input.placeholder) {
		$('[placeholder]').focus(function() {

			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function() {

			var input = $(this);
			if (input.val() === '' || input.val() === input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		}).blur();

		$('[placeholder]').parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
				}
			});
		});
	}

	/* Contact & Mailchimp Form */
	$("form.dt-form").each(function() {
		$(this).submit(function(e) {
			e.preventDefault();
			var $form = $(this),
			    $msg = $(this).prev('div.message'),
			    $action = $form.attr('action');

			$.post($action, $form.serialize(), function(data) {
				$form.fadeOut("fast", function() {
					$msg.hide().html(data).show('fast');
				});
			});
		});
	});
});

function funtoScroll(x, e) {

	if (jQuery('body').hasClass('page-template-tpl-onepage-php')) {

		var str = new String(e.target);
		var pos = str.indexOf('#');
		var t = str.substr(pos);

		if (jQuery(x).find("li.current-menu-item").hasClass('external')) {
			window.location.href = str;
		} else {
			jQuery.scrollTo(t, 750, {
				offset : {
					top : 0
				}
			});
		}

		jQuery(x).parent('.mean-bar').next('.mean-push').remove();
		jQuery(x).parent('.mean-bar').remove();

		jQuery('nav#main-menu').meanmenu({
			meanMenuContainer : jQuery('header#header'),
			meanRevealPosition : 'right',
			meanScreenWidth : 767,
			meanRemoveAttrs : false,
			onePage : true
		});

		e.preventDefault();
	}
}

jQuery(function() {
  jQuery("#menu-header-menu li.menu-item a").click(function() {
    var header = jQuery("#header-sticky-wrapper");
    var target = jQuery(jQuery(this).attr('href'));
    var offset = target.offset();
    jQuery('html').getNiceScroll(0).doScrollTop(offset.top - header.height(), 750);
  });
});