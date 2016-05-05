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
                $(panel).find('.accordion-header').click(function() {
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
            UTIL.magnificPopup();
            UTIL.scrollTop();

            // Fire common finalize JS
            UTIL.fire('common', 'finalize');
        },
        wow: function() {
            new WOW().init();
        },
        scrollTop: function() {
            $('.scroll-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        },
        magnificPopup: function() {
            $('.gallery-icon a, .thumb').magnificPopup({
                type: 'image',
                tLoading: 'Pobieranie zdjęcia #%curr%...',
                mainClass: 'mfp-img-mobile',

                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    tPrev: 'Poprzednie zdjęcie (przycisk w lewo na klawiaturze)',
                    tNext: 'Następne zdjęcie (przycisk w prawo na klawiaturze)',
                    tCounter: '%curr% z %total%',
                    preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: 'Nie udało się pobrać zdjęcia #%curr%.<a href="%url%">The image</a>',
                    titleSrc: function(item) {
                        return item.el[0].childNodes[0].alt;
                    }
                },
            });
        },

        scroll: 0,

        previousScroll: 0,
        scrollUp: 0,

        scrollPos: function(){
            this.scroll = $(window).scrollTop();
        },

        scrollDirection: function() {
            if (this.scroll > this.previousScroll){
                this.scrollUp = 0;
            }
            else {
                this.scrollUp = 1;
            }
            this.previousScroll = this.scroll;
        },

        arrows: function() {
            if (this.scroll >= 200) {
                $('.arrows').fadeIn();
                var activeArrow = $('.arrows a').eq(this.scrollUp);
                activeArrow.addClass('active').siblings().removeClass('active');
            }
            else {
                $('.arrows').fadeOut();
            }
        },

        smoothScroll: function() {
            $('.smoothscroll').click(function() {
                var target = $(this.hash);
                var offset = $('body').css('padding-top');
                if (offset) {
                    offset = offset.replace('px','');
                }

                target = target.length ? target : 1;
                console.log(target.offset());
                if (target) {
                    $('html,body').animate({
                        scrollTop: ( target.offset().top - offset )
                    }, 1000);
                    return false;
                }
            });
        },

        windowScroll: function() {
            this.scrollPos();
            this.scrollDirection();
            this.arrows();
        },
        docReady: function() {
            this.smoothScroll();
        }
    };

    // Load Events
    $(document).ready(UTIL.loadEvents);
    $('.dropdown-toggle').dropdown();

    $(window).load(function() {
        $(".twentytwenty-container").twentytwenty();
    });

    $(window).scroll(function() {
        UTIL.windowScroll();
    });

    UTIL.wow();

    $(window).bind("load", function() {
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


    });

    function WHCreateCookie(name, value, days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function WHReadCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }

    function WHCheckCookies() {
        if (WHReadCookie('cookies_accepted') !== 'T') {
            var message_container = document.createElement('div');
            message_container.id = 'cookies-message-container';
            var html_code = '<div id="cookies-message" class="container-fluid"><p class="cookies-message-text">Strona korzysta z plików cookies zgodnie z <a class="cookies-link" href="' + location.protocol + '//' + location.host + '/polityka-cookies/">Polityką cookies</a>. Korzystanie z witryny bez zmiany ustawień dotyczących cookies oznacza, że będą one zamieszczane w Państwa urządzeniu końcowym. Możecie Państwo dokonać w każdym czasie zmiany ustawień dotyczących cookies. </p><a href="#" id="accept-cookies-checkbox" class="btn btn-default" name="accept-cookies"><span>Rozumiem</span></a></div>';

            message_container.innerHTML = html_code;
            document.body.appendChild(message_container);
            $('body').css('margin-bottom', $('#cookies-message-container').height());
        }
    }

    function WHCloseCookiesWindow() {
        WHCreateCookie('cookies_accepted', 'T', 365);
        $('#cookies-message-container').fadeOut();
        document.getElementById('cookies-message-container').removeChild(document.getElementById('cookies-message'));
    }

    $('body').on('click', '#accept-cookies-checkbox', function() {
        WHCreateCookie('cookies_accepted', 'T', 365);
        $('#cookies-message-container').fadeOut();
    });

    $('body').on('click', '.cookies-message-text', function() {
        WHCreateCookie('cookies_accepted', 'T', 365);
        $('#cookies-message-container').fadeOut();
    });

    $(document).ready(function() {
        WHCheckCookies();
    });




})(jQuery); // Fully reference jQuery after this point.