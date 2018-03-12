
jQuery(document).ready(function(){
    jQuery('#nav >li:last-child').addClass('last');
})

jQuery(document).ready(function(){
    jQuery('#nav li').each(function(){
        jQuery(this).click(function(){
            var s_href = jQuery(this).find('a').attr('href');
            var n = s_href.indexOf("#");
            if (n == -1){
                
                location.href=s_href;
            }
        })
    })
})
jQuery(window)
        .load(function () {
            "use strict";

            var IS_IPAD = navigator.userAgent.match(/iPad/i) != null;
            var IS_IPHONE = (navigator.userAgent.match(/iPhone/i) != null) || (navigator.userAgent.match(/iPod/i) != null);


            if (IS_IPAD == true || IS_IPHONE == true) {
                jQuery('#animationcss').remove();
            }


        })

/* =================================
 Sticky Nav                    
 ==================================== */

//Shrink Navigation
var cbpAnimatedHeader = (function () {
    function init() {
        "use strict";
        window.addEventListener('scroll', function (event) {
        }, false);
        window.addEventListener('scroll', function (e) {
            if (jQuery(window)
                    .scrollTop() > 10) {
                jQuery('nav')
                        .addClass('shrink-nav');
            } else {
                jQuery('nav')
                        .removeClass('shrink-nav');
            }
        });
    }
    function scrollY() {
        return window.pageYOffset || docElem.scrollTop;
    }
    init();
})();

function init() {
}

window.onload = init();
jQuery(document).ready(function () {
    /* =================================
    Fit Video
    ==================================== */
    
    // Target your .container, .wrapper, .post, etc.
    jQuery(".video-main").fitVids();

    try {
        var url = window.location.href;
        var arr = url.split('?');
        if (arr[1])
        {
            jQuery("#nav-" + arr[1]).trigger('click');
        }
    }
    catch (err) {
    }
    
    "use strict";
    // Blog Start
    jQuery('.blog-content-out')
            .css("display", "none");
    jQuery('.blog-content')
            .click(function () {
                jQuery('.blog-content-out')
                        .slideUp();
                jQuery('.blog-content')
                        .removeClass("active");
                if (jQuery(this)
                        .find('.blog-content-out')
                        .css("display") == "none") {
                    jQuery(this)
                            .find('.blog-content-out')
                            .slideDown();
                    jQuery(this)
                            .addClass('active');
                } else {
                    jQuery(this)
                            .removeClass("active");
                    jQuery(this)
                            .find('.blog-content-out')
                            .slideUp();
                }
            });

    // Shrink nav on scroll
    jQuery(window)
            .scroll(function () {
                if (jQuery(window)
                        .scrollTop() > 10) {
                    jQuery('nav')
                            .addClass('shrink-nav');
                } else {
                    jQuery('nav')
                            .removeClass('shrink-nav');
                }
            });

    // Mobile Toggle Control
    jQuery('.mobile-toggle')
            .click(function () {
                jQuery('nav')
                        .toggleClass('open-nav');
            });
    jQuery('.dropdown-arrow')
            .click(function () {
                if (jQuery('.mobile-toggle')
                        .is(":visible")) {
                    if (jQuery(this)
                            .children('.dropdown')
                            .hasClass('open-nav')) {
                        jQuery(this)
                                .children('.dropdown')
                                .removeClass('open-nav');
                    } else {
                        jQuery('.dropdown')
                                .removeClass('open-nav');
                        jQuery(this)
                                .children('.dropdown')
                                .addClass('open-nav');
                    }
                }
            });

    // Position Fullwidth Subnavs fullwidth correctly
    jQuery('.dropdown-fullwidth')
            .each(function () {
                jQuery(this)
                        .css('width', jQuery('.row')
                                .width());
                var subNavOffset = -(jQuery('nav .row')
                        .innerWidth() - jQuery('.menu')
                        .innerWidth() - 15);
                jQuery(this)
                        .css('left', subNavOffset);
            });

    /* =================================
     Full Screen Header
     ==================================== */
    function SetResizeContent() {
        var minheight = jQuery(window).height();
        jQuery(".full-screen").css('min-height', minheight);
    }
    SetResizeContent();
    //Navigation Visible On Scroll
    mainNav();
    //Popup Scrollbar

    var IS_IPAD = navigator.userAgent.match(/iPad/i) != null;
    var IS_IPHONE = (navigator.userAgent.match(/iPhone/i) != null) || (navigator.userAgent.match(/iPod/i) != null);


    if (IS_IPAD == true || IS_IPHONE == true) {

    }
    else
    {
        jQuery('li.content-scroll figure').removeAttr('class');

        try {
            jQuery(".content-scroll").mCustomScrollbar({
                autoHideScrollbar: true,
                theme: "minimal-dark"
            });
        }
        catch (err) {
        }


    }


    //Slider carousel



    jQuery('.carousel').each(function () {
        jQuery(this).carousel({
            //Stop auto sliding 
            //interval: false
            //Auto sliding, define time interval like 5000.
            interval: 5600
        });
        jQuery(this).carousel('pause');
    });


    jQuery(window)
            .scroll(function () {
                if (jQuery(this)
                        .scrollTop() > 100) {
                    jQuery('.scrollToTop')
                            .fadeIn();
                } else {
                    jQuery('.scrollToTop')
                            .fadeOut();
                }
            });

    //Click event to scroll to top
    jQuery('.scrollToTop')
            .click(function () {
                jQuery('html, body')
                        .animate({
                            scrollTop: 0
                        }, 1000);
                return false;
            });

   
         /* =================================
         easyPieChart
         ==================================== */
        jQuery('.chart').each(function(){
            
        
            var p_barColor = jQuery(this).attr('data-barcolor');console.log(p_barColor);
            var p_trackColor = jQuery(this).attr('data-trackcolor');
            jQuery(this).easyPieChart({
                easing: 'easeOutCirc',
                barColor: p_barColor,
                trackColor: p_trackColor,
                scaleColor: false,
                scaleLength: 5,
                percent: 67,
                lineCap: 'round',
                lineWidth: 15, //12
                size: 150, //110
                animate: {
                    duration: 2000,
                    enabled: true
                },
                onStep: function (from, to, percent) {
                    jQuery(this.el).find('.percent').text(Math.round(percent));
                }
            });
        });
    // Windows Resize Events
    jQuery(window)
            .resize(function () {
                // Position Fullwidth Subnavs fullwidth correctly
                jQuery('.dropdown-fullwidth')
                        .each(function () {
                            jQuery(this)
                                    .css('width', jQuery('.row')
                                            .width());
                            var subNavOffset = -(jQuery('nav .row')
                                    .innerWidth() - jQuery('.menu')
                                    .innerWidth() - 15);
                            jQuery(this)
                                    .css('left', subNavOffset);
                        });

                //Set Height of Full Screen Header	
                SetResizeContent();

                //Portfolio Items Resize
                jQuery('.portfolio').isotope('reLayout')

            });

    // Navigation Start
    jQuery('.main-navigation')
            .onePageNav({
                scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
                scrollOffset: 79 //Height of Navigation Bar
            });


    jQuery('navbar-nav ul li a')
            .click(function (e) {

                jQuery(".main section")
                        .removeClass(" ");
                jQuery(jQuery(this)
                        .attr('href'))
                        .addClass(' ');
                jQuery(this)
                        .parent()
                        .parent()
                        .parent()
                        .removeClass('in');
            });
});


jQuery(window)
        .scroll(function () {
            mainNav();
        });
if (matchMedia('(min-width: 992px), (max-width: 767px)')
        .matches) {
    function mainNav() {
        var top = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
        if (top > 40)
            jQuery('.sticky-navigation')
                    .stop()
                    .animate({
                        "top": '0'
                    });
        else {
            jQuery('.sticky-navigation')
                    .stop()
                    .animate({
                        "top": '-80'
                    });
            jQuery('#navbar')
                    .removeClass('in');
        }
    }
}
if (matchMedia('(min-width: 768px) and (max-width: 991px)')
        .matches) {
    function mainNav() {
        var top = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
        if (top > 40)
            jQuery('.sticky-navigation')
                    .stop()
                    .animate({
                        "top": '0'
                    });
        else
            jQuery('.sticky-navigation')
                    .stop()
                    .animate({
                        "top": '-120'
                    });
    }
}
/* =================================
 Smooth Scroll
 ==================================== */
var scrollAnimationTime = 1200,
        scrollAnimation = 'easeInOutExpo';
jQuery('a.scrollto').bind('click.smoothscroll', function (event) {
    event.preventDefault();
    var target = this.hash;
    jQuery('html, body').stop()
            .animate({
                'scrollTop': jQuery(target)
                        .offset()
                        .top
            }, scrollAnimationTime, scrollAnimation, function () {
                window.location.hash = target;
            });
});
// Inner links
jQuery('.inner-link').smoothScroll({
    speed: 900,
    offset: -68
});
/* =================================
 Stellar
 ==================================== */
jQuery(window)
        .stellar({
            horizontalScrolling: false
        });
/* =================================
 IE10 On Windows 8 Fix
 =================================== */
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
            document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                    )
            )
    document.querySelector('head')
            .appendChild(msViewportStyle)
}
/* =================================
 Blog (load more)
 ==================================== */
var $group = jQuery('.group');
jQuery("#load-more").click(function () {
    if (jQuery(this).hasClass('disable'))
        return false;
    var $hidden = $group.filter(':hidden:first').addClass('show');
    if (!$hidden.next('.group').length) {
        jQuery(this).addClass('disable');
    }
});
//Bootstrap collapsed menu
jQuery(document).on('click', '.navbar-collapse.in', function (e) {
    if (jQuery(e.target).is('a')) {
        jQuery(this).collapse('hide');
    }
});




