/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {
    'use strict';
    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function() {
                // JavaScript to be fired on all pages
            },
            finalize: function() {
                // JavaScript to be fired on all pages, after page specific JS is fired
            }
        },
        // Home page
        'home': {
            init: function() {
                // JavaScript to be fired on the home page
            },
            finalize: function() {
                // JavaScript to be fired on the home page, after the init JS
            }
        },
        // About us page, note the change from about-us to about_us.
        'about_us': {
            init: function() {
                // JavaScript to be fired on the about us page
            }
        },
        'post_type_archive_faq': {
            init: function() {
                var panels = $('.type-faq');
                panels.each(function(i, panel) {
                    $(panel).find('.accordion-content').hide();
                    $(panel).find('.accordion-header').on('click', function() {
                        $(this).parents('.type-faq').toggleClass('accordion-open');
                        $(this).next('.accordion-content').slideToggle(300);
                    });
                });
            }
        }
    };

    // The routing fires all common scripts, followed by the page specific scripts.
    // Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function(func, funcname, args) {
            var fire;
            var namespace = Sage;
            funcname = (funcname === undefined) ? 'init' : funcname;
            fire = func !== '';
            fire = fire && namespace[func];
            fire = fire && typeof namespace[func][funcname] === 'function';

            if (fire) {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function() {
            // Fire common init JS
            UTIL.fire('common');

            UTIL.docReady();

            // Fire page-specific init JS, and then finalize JS
            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
                UTIL.fire(classnm);
                UTIL.fire(classnm, 'finalize');
            });


            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        },
        wow: function() {
            new WOW().init();
        },

        scrollTop: function() {
            $('.scroll-top').on('click', function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        },

        photoswipe: function() {
            var template = $('.pswp')[0];
            var items = [];
            $('.thumb img, .gallery-icon a img').each(function(i, el) {
                items.push({
                    src: el.parentNode.href,
                    w: 0,
                    h: 0,
                    title: el.alt || ''
                });
            });

            $('.thumb, .gallery-icon').each(function(i) {
                $(this).on('click', function(e) {
                    e.preventDefault();
                    var options = {
                        index: i,
                        bgOpacity: 0.85,
                        showHideOpacity: true,
                        getThumbBoundsFn: false,
                        errorMsg: "Nie można załadować zdjęcia",
                        shareButtons: [{
                            id: 'facebook',
                            label: 'Facebook',
                            url: 'https://www.facebook.com/sharer/sharer.php?u={{url}}'
                        }, {
                            id: 'twitter',
                            label: 'Twitter',
                            url: 'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'
                        }, {
                            id: 'pinterest',
                            label: 'Pinterest',
                            url: 'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}&description={{text}}'
                        }, {
                            id: 'download',
                            label: 'Pobierz',
                            url: '{{raw_image_url}}',
                            download: true
                        }],
                    };

                    var gallery = new PhotoSwipe(template, PhotoSwipeUI_Default, items, options);

                    gallery.listen('gettingData', function(index, item) {
                        if (item.w < 1 || item.h < 1) { // unknown size
                            var img = new Image();
                            img.onload = function() { // will get size after load
                                item.w = this.width; // set image width
                                item.h = this.height; // set image height
                                gallery.invalidateCurrItems(); // reinit Items
                                gallery.updateSize(true); // reinit Items
                            };
                            img.src = item.src; // let's download image
                        }
                    });
                    gallery.init();
                });
            });
        },

        scroll: 0,
        previousScroll: 0,
        scrollUp: 0,
        toBottom: 0,

        footerHeight: function() {
            return $('.footer-bottom').outerHeight();
        },

        tooltipInit: function() {
            if (!('ontouchstart' in window)) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        },

        bodyMarginBottom: function() {
            if (!isNaN(this.footerHeight())) {
                if (parseInt($('.parallax-wrap').css('margin-bottom'), 10) !== this.footerHeight()) {
                    $('.parallax-wrap').css('margin-bottom', this.footerHeight() + 'px');
                    $('.footer-bottom').css({
                        'position': 'fixed',
                        'z-index': -1
                    });
                }
            }
        },

        scrollPos: function() {
            this.scroll = $(window).scrollTop();
        },

        scrollDirection: function() {
            if (this.scroll > this.previousScroll) {
                this.scrollUp = 1;
            }
            else {
                this.scrollUp = 0;
            }
            this.previousScroll = this.scroll;
        },

        btnBack: function() {
            $('.btn-back').on('click', function(e) {
                e.preventDefault();
                if (document.referrer.length > 1) {
                    window.history.back(-1);
                }
            });
        },

        arrows: function() {

            if (this.scroll >= 300) {
                $('.arrows').fadeIn(300);
            }

            else {
                $('.arrows').fadeOut(300);
            }
        },

        arrowsBottomPos: function() {
            var btnBackPos = $('.btn-back').offset().top + $('.btn-back').outerHeight();
            btnBackPos = $(document).height() - btnBackPos;

            if (!isNaN(btnBackPos) && btnBackPos > 0) {
                $('.arrows').css('bottom', btnBackPos + 'px');
            }

        },

        smoothScroll: function() {
            $('.smoothscroll').on('click', function() {
                var target = $(this.hash);
                var offset = $('body').css('padding-top');
                if (offset) {
                    offset = offset.replace('px', '');
                }

                if (target) {
                    $('html,body').animate({
                        scrollTop: (target.offset().top - offset)
                    }, 1000);
                    return false;
                }
            });
        },

        colHeight: function() {
            var sidebarH = $('.sidebar').outerHeight(),
                mainH = $('.main').outerHeight();

            if (!isNaN(sidebarH) && !isNaN(mainH)) {
                if (sidebarH > mainH) {
                    $('body').addClass('sidebar-higher');
                }
                else {
                    $('body').removeClass('sidebar-higher');
                }
            }
        },

        searchToggle: function(animateIn, animateOut) {
            $('.header-search').addClass(animateOut);
            $('.navbar-search-btn').on('click', function() {

                if ($('.header-search').hasClass(animateOut)) {
                    $('.header-search').addClass(animateIn).removeClass(animateOut);
                }
                else {
                    $('.header-search').addClass(animateOut).removeClass(animateIn);
                }

                if ($('.header-search').hasClass('hidden')) {
                    $('.header-search').removeClass('hidden');
                }
            });
        },

        imgCompareLoader: function() {
            $('.img-compare').addClass('visible');
            $('.img-compare').find('.spinner').fadeOut().remove();
        },

        menuDropdown: function() {
            $('.dropdown-toggle').dropdown();
        },

        fbLoad: function() {
            setTimeout(function() {
                (function(d, s, id) {

                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) {
                        return;
                    }
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.6&appId=955624011163030";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));

            }, 2000);
        },

        addEmail: function() {
            var emailName = 'kontakt',
                domain = 'kielki.info';
            $('.email-me').attr('href', 'mailto:' + emailName + '@' + domain);
        },

        booksWidgetSlider: function() {
            var imagesLoaded = false,
                slideShow = $('.flexslider'),
                slideShowOptions = {
                    touch: true,
                    animation: "slide",
                    directionNav: false,
                    prevText: "Poprzeni",
                    nextText: "Następny",
                    pauseOnHover: true,
                    animationLoop: false,
                    start: function(slider) { // Fires when the slider loads the first slide
                        sliderStart(slider);
                    },
                    before: function(slider) { // Fires asynchronously with each slider animation
                        sliderBefore(slider);
                    }
                };

            function lazyLoadDone(images) {
                var notLoaded = images.filter('[data-src]');
                return !notLoaded.length;
            }

            function sliderBefore(slider) {
                if (!imagesLoaded) {
                    var slides = slider.slides,
                        index = slider.animatingTo,
                        $slide = $(slides[index]),
                        $img = $slide.find('img[data-src]'),
                        current = index + slider.cloneOffset,
                        nextIndex = current + 1,
                        prevIndex = current - 1;

                    var images = $slide.parent().find('.lazy'),
                        currentNeighbours = images.eq(current).add(images.eq(prevIndex)).add(images.eq(nextIndex));

                    currentNeighbours.each(function() {
                        var src = $(this).attr('data-src');
                        if (src) {
                            $(this).attr('src', src).removeAttr('data-src');
                        }
                    });

                    imagesLoaded = lazyLoadDone(images);
                }
            }

            function sliderStart(slider) {
                var currentImage = $(slider).find('.lazy').eq(0),
                    src = currentImage.attr('data-src');
                currentImage.attr('src', src).removeAttr('data-src');
            }

            function init() {
                slideShow.flexslider(slideShowOptions);
            }

            init();

        },

        twentytwenty: function() {
            $(".twentytwenty-container").twentytwenty();
        },

        adsLoad: function() {
            window.adsbygoogle = window.adsbygoogle || [];
            var $ads = $('.adsbygoogle');

            $.each($ads, function() {
                window.adsbygoogle.push({});
            });

            function getEmptyAds($ads) {
                $ads.each(function(i, el) {
                    if (!el.children.length) {
                        $(el).next().removeClass('hidden');
                    }
                });
            }

            if ($ads.length) {
                getEmptyAds($ads);
            }
        },

        windowResize: function() {
            this.bodyMarginBottom();
            this.arrowsBottomPos();
            this.colHeight();
        },

        windowLoad: function() {
            UTIL.fbLoad();
            UTIL.imgCompareLoader();
            UTIL.booksWidgetSlider();
            UTIL.photoswipe();
            UTIL.twentytwenty();
            UTIL.bodyMarginBottom();
            UTIL.arrowsBottomPos();
            UTIL.adsLoad();
            UTIL.colHeight();
        },

        windowScroll: function() {
            this.scrollPos();
            this.arrows();
        },

        docReady: function() {
            this.menuDropdown();
            this.wow();
            this.smoothScroll();
            this.searchToggle('flipInX', 'flipOutX');
            this.scrollTop();
            this.addEmail();
            this.btnBack();
            this.tooltipInit();
        }
    };


    // Load Events
    $(document).ready(UTIL.loadEvents);

    $(window).on('scroll', function() {
        UTIL.windowScroll();
    });

    $(window).on('resize', function() {
        UTIL.windowResize();
    });

    $(window).bind("load", UTIL.windowLoad);

})(jQuery); // Fully reference jQuery after this point.