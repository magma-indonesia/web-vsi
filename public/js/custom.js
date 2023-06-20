jQuery(document).ready(function ($) {
    "use strict";

    /*
    ==============================================================
     COUNTDOWN  Script Start
    ==============================================================
    */

    if (jQuery('.countdown').length) {
        jQuery('.countdown').downCount({date: '8/8/2018 12:00:00', offset: +1});
    }

    /*
  ==============================================================
     Counter Script Start
  ==============================================================
  */
    if (jQuery('.counter').length) {
        jQuery('.counter').counterUp({
            delay: 20,
            time: 1000
        });
    }


    /*
      =======================================================================
           Pretty Photo Script Script
      =======================================================================
    */
    if (jQuery("a[data-rel^='prettyPhoto']").length) {
        jQuery("a[data-rel^='prettyPhoto']").prettyPhoto();
    }


    /*
    ==============================================================
        DL Responsive Menu
    ==============================================================
    */
    if (typeof ($.fn.dlmenu) == 'function') {
        jQuery('#kode-responsive-navigation').each(function () {
            jQuery(this).find('.dl-submenu').each(function () {
                if (jQuery(this).siblings('a').attr('href') && jQuery(this).siblings('a').attr('href') != '#') {
                    var parent_nav = jQuery('<li class="menu-item kode-parent-menu"></li>');
                    parent_nav.append(jQuery(this).siblings('a').clone());

                    jQuery(this).prepend(parent_nav);
                }
            });
            jQuery(this).dlmenu();
        });
    }


    jQuery('.tabs .tab-links a').on('click', function (e) {
        var currentAttrValue = jQuery(this).attr('href');

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

        e.preventDefault();

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).siblings().slideUp(800);
        jQuery('.tabs ' + currentAttrValue).delay(800).slideDown(800);

        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
    });


    /*
    ==============================================================
        SLICK SLIDER
    ==============================================================
    */

    if (jQuery('.city-news-slider').length) {
        jQuery('.city-news-slider').slick({
            slidesToShow: 1,
            autoplay: true,
            autoplaySpeed: 0,
            speed: 10000,
            cssEase: 'linear',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }


    if (jQuery('.main-banner-slider').length) {
        jQuery('.main-banner-slider').slick({
            slidesToShow: 1,
            autoplay: true,
            speed: 1000,
            fade: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    if (jQuery('.city-department-slider').length) {
        jQuery('.city-department-slider').slick({
            slidesToShow: 1,
            autoplay: true,
            speed: 1000,
            vertical: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    if (jQuery('.city-project-slider').length) {
        jQuery('.city-project-slider').slick({
            slidesToShow: 3,
            centerMode: true,
            autoplay: true,
            speed: 800,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    if (jQuery('.city-emergency-slide').length) {
        jQuery('.city-emergency-slide').slick({
            slidesToShow: 3,
            autoplay: true,
            speed: 800,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    if (jQuery('.program-slider').length) {
        jQuery('.program-slider').slick({
            slidesToShow: 1,
            autoplay: true,
            speed: 800,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    if (jQuery('.city-health2-slider').length) {
        jQuery('.city-health2-slider').slick({
            slidesToShow: 4,
            autoplay: true,
            speed: 800,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }

    if (jQuery('.city-health2-slider2').length) {
        jQuery('.city-health2-slider2').slick({
            slidesToShow: 3,
            autoplay: true,
            speed: 800,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }


    if (jQuery('.blog-post-slider').length) {
        jQuery('.blog-post-slider').slick({
            slidesToShow: 2,
            autoplay: true,
            speed: 800,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }


                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    }


    jQuery('.accordion-section-title').click(function (e) {
        // Grab current anchor value
        var currentAttrValue = jQuery(this).attr('href');

        if (jQuery(e.target).is('.active')) {
            close_accordion_section();
        } else {
            close_accordion_section();

            // Add active class to section title
            jQuery(this).addClass('active');
            // Open up the hidden content panel
            jQuery('.accordion ' + currentAttrValue).slideDown(300).addClass('open');
        }

        e.preventDefault();
    });


    if (jQuery('select').length) {
        jQuery('select').niceSelect();
    }


    /*================================================
                slider start
        =================================================*/
    if (jQuery('.bx-pager').length) {
        jQuery('.bx-pager').bxSlider({

            auto: true,
            pagerCustom: '#bx-pager'

        });
    }

    /* ---------------------------------------------------------------------- */
    /*	Click to Top
/* ---------------------------------------------------------------------- */
    if (jQuery('#child-topbtn').length) {
        jQuery('#child-topbtn').on("click", function () {
            jQuery('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    }


    if (jQuery('.city_top_navigation').length) {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 40) {
                animate: true,
                    jQuery('.city_top_navigation').addClass("sticky");

            } else {
                jQuery('.city_top_navigation').removeClass("sticky");
            }
        });
    }

    jQuery(window).on('load', function ($) {
        if (jQuery('#filterable-item-holder-1').length) {
            var filter_container = jQuery('#filterable-item-holder-1');

            filter_container.children().css('position', 'relative');
            filter_container.masonry({
                singleMode: true,
                itemSelector: '.filterable-item:not(.hide)',
                animate: true,
                animationOptions: {duration: 800, queue: false}
            });
            jQuery(window).resize(function () {
                var temp_width = filter_container.children().filter(':first')();
                filter_container.masonry({
                    columnWidth: temp_width,
                    singleMode: true,
                    itemSelector: '.filterable-item:not(.hide)',
                    animate: true,
                    animationOptions: {duration: 800, queue: false}
                });
            });
            jQuery('ul#filterable-item-filter-1 a').click(function (e) {

                jQuery(this).addClass("active");
                jQuery(this).parents("li").siblings().children("a").removeClass("active");
                e.preventDefault();

                var select_filter = jQuery(this).attr('data-value');

                if (select_filter == "All" || jQuery(this).parent().index() == 0) {
                    filter_container.children().each(function () {
                        if (jQuery(this).hasClass('hide')) {
                            jQuery(this).removeClass('hide');
                            jQuery(this).fadeIn();
                        }
                    });
                } else {
                    filter_container.children().not('.' + select_filter).each(function () {
                        if (!jQuery(this).hasClass('hide')) {
                            jQuery(this).addClass('hide');
                            jQuery(this).fadeOut();
                        }
                    });
                    filter_container.children('.' + select_filter).each(function () {
                        if (jQuery(this).hasClass('hide')) {
                            jQuery(this).removeClass('hide');
                            jQuery(this).fadeIn();
                        }
                    });
                }

                filter_container.masonry();
                cornerStampSelector: '.corner-stamp'

            });
        }
    });


    /*
    =======================================================================
            Map Script
    =======================================================================
  */
    if (jQuery('#map-canvas').length) {
        google.maps.event.addDomListener(window, 'load', initialize);
    }


});

function close_accordion_section() {
    jQuery('.accordion .accordion-section-title').removeClass('active');
    jQuery('.accordion .accordion-section-content').slideUp(300).removeClass('open');
}

/*
  =======================================================================
       Map Custom Style Script Script
  =======================================================================
*/
function initialize() {
    var MY_MAPTYPE_ID = 'custom_style';
    var map;
    var brooklyn = new google.maps.LatLng(40.6743890, -73.9455);
    var featureOpts = [
        {
            "featureType": "administrative",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": "-100"
                }
            ]
        },
        {
            "featureType": "administrative.province",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": 65
                },
                {
                    "visibility": "on"
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "lightness": "50"
                },
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": "-100"
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "all",
            "stylers": [
                {
                    "lightness": "30"
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "all",
            "stylers": [
                {
                    "lightness": "40"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "visibility": "simplified"
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "hue": "#ffff00"
                },
                {
                    "lightness": -25
                },
                {
                    "saturation": -97
                }
            ]
        },
        {
            "featureType": "water",
            "elementType": "labels",
            "stylers": [
                {
                    "lightness": -25
                },
                {
                    "saturation": -100
                }
            ]
        }
    ];

    var mapOptions = {
        zoom: 14,
        scrollwheel: false,
        center: brooklyn,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
        },
        mapTypeId: MY_MAPTYPE_ID
    };


    map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);

    var styledMapOptions = {
        name: 'Custom Style'
    };

    var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

    map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
    var marker = new google.maps.Marker({
        position: brooklyn,
        icon: 'images/map.png'
    });

    marker.setMap(map);
}
