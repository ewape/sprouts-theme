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
    linkScroll: function() {
      $('.linkscroll a').click(function() {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
               if (target.length) {
                 $('html, body').animate({
                     scrollTop: target.offset().top
                }, 1000);
                return false;
            }
      });
    },
    scrollTop: function() {
      $('.scroll-top').click(function() {
        $('body,html').animate({
          scrollTop : 0
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
          preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
          tError: 'Nie udało się pobrać zdjęcia #%curr%.<a href="%url%">The image</a>',
          titleSrc: function(item) {
            return item.el.attr('alt');
          }
        },
      });
    }

  };

  // Load Events
  $(document).ready(UTIL.loadEvents);
  $('.dropdown-toggle').dropdown();
   $(window).load(function(){
    $(".twentytwenty-container").twentytwenty();
  });

   $(window).bind("load", function() {
       (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.6&appId=955624011163030";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    });


})(jQuery); // Fully reference jQuery after this point.
