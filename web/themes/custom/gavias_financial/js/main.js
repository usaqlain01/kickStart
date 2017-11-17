(function ($) {
   "use strict";
   (function ($) {
  var $event = $.event,
    $special, resizeTimeout;
    $special = $event.special.debouncedresize = {
      setup: function () {
              $(this).on("resize", $special.handler);
      },
      teardown: function () {
              $(this).off("resize", $special.handler);
      },
      handler: function (event, execAsap) {
              // Save the context
              var context = this,
                      args = arguments,
                      dispatch = function () {
                              // set correct event type
                              event.type = "debouncedresize";
                              $event.dispatch.apply(context, args);
                      };

              if (resizeTimeout) {
                      clearTimeout(resizeTimeout);
              }

              execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
      },
    threshold: 150
  };
})(jQuery);

   //------- OWL carousle init  ---------------
    jQuery(document).ready(function(){
      function init_carousel_owl(){
        $('.init-carousel-owl').each(function(){
          var items = $(this).data('items') ? $(this).data('items') : 5;
          var items_lg = $(this).data('items_lg') ? $(this).data('items_lg') : 4;
          var items_md = $(this).data('items_md') ? $(this).data('items_md') : 3;
          var items_sm = $(this).data('items_sm') ? $(this).data('items_sm') : 2;
          var items_xs = $(this).data('items_xs') ? $(this).data('items_xs') : 1;
          var loop = $(this).data('loop') ? $(this).data('loop') : true;
          var speed = $(this).data('speed') ? $(this).data('speed') : 200;
          var auto_play = $(this).data('auto_play') ? $(this).data('auto_play') : false;
          var auto_play_speed = $(this).data('auto_play_speed') ? $(this).data('auto_play_speed') : false;
          var auto_play_timeout = $(this).data('auto_play_timeout') ? $(this).data('auto_play_timeout') : 1000;
          var auto_play_hover = $(this).data('auto_play_hover') ? $(this).data('auto_play_hover') : true;
          var navigation = $(this).data('navigation') ? $(this).data('navigation') : false;
          var rewind_nav = $(this).data('rewind_nav') ? $(this).data('rewind_nav') : true;
          var pagination = $(this).data('pagination') ? $(this).data('pagination') : false;
          var mouse_drag = $(this).data('mouse_drag') ? $(this).data('mouse_drag') : true;
          var touch_drag = $(this).data('touch_drag') ? $(this).data('touch_drag') : true;

          $(this).owlCarousel({
              nav: navigation,
              autoplay: auto_play,
              autoplayTimeout: auto_play_timeout,
              autoplaySpeed: auto_play_speed,
              autoplayHoverPause: auto_play_hover,
              navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
              autoHeight: false,
              loop: loop, 
              dots: pagination,
              rewind: rewind_nav,
              smartSpeed: speed,
              mouseDrag: mouse_drag,
              touchDrag: touch_drag,
              responsive : {
                  0 : {
                    items: 1,
                    nav: false
                  },
                  640 : {
                    items : items_xs,
                    nav: false
                  },
                  768 : {
                    items : items_sm,
                    nav: false
                  },
                  992: {
                    items : items_md
                  },
                  1200: {
                    items: items_lg
                  },
                  1400: {
                    items: items
                  }
              }
          });
            
       }); 
    }  

    init_carousel_owl();

    //===== Gallery ============
    $("a[data-rel^='prettyPhoto[g_gal]']").prettyPhoto({
        animation_speed:'normal',
        social_tools: false,
    });

    //===== Popup video ============
    $('.popup-video').magnificPopup({
    type: 'iframe',
    fixedContentPos: false
    });
    //===== WOW ============
     new WOW().init();
  });



//====== OWL Carousel width thumbnail ==============
$(document).ready(function () {
    var owl = $(".init-carousel-owl.carousel-thumbnail.image");
    owl.owlCarousel({
        items: 1,
        nav: true, 
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
    });
    var i = 0;
    owl.find('.owl-item').not('.cloned').each(function() {
      var $src_thumbnail = $(this).find('.item-thumb').first().data('thumbs');
      owl.find('.owl-dots .owl-dot').eq(i).html('<img src="'+$src_thumbnail+'" />');
      i++;
    }); 

    var owl = $(".carousel-thumbnail.text");
    owl.each(function(){
      var $this = $(this);
      $(this).owlCarousel({
        items: 1,
        nav: true, 
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        loop: true,
        navText: [ '<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>' ],
      });
      var i = 0;
      $(this).find('.owl-item').not('.cloned').each(function() {
        var $text = $(this).find('.item').first().data('thumbs');
        $this.find('.owl-dots .owl-dot').eq(i).html('<span>'+ $text +'</span>');
        i++;
      }); 
    })  

    if ($(window).width() > 780) {
      if ( $.fn.jpreLoader ) {
        var $preloader = $( '.js-preloader' );
        $preloader.jpreLoader({
          autoClose: true,
        }, function() {
          $preloader.addClass( 'preloader-done' );
          $( 'body' ).trigger( 'preloader-done' );
          $( window ).trigger( 'resize' );
        });
      }
    }else{
      $('body').removeClass('js-preloader');
    };

    $('.simpleslider').unslider()

});

jQuery(document).ready(function () {
 
  var $container = $('.post-masonry-style');
  $container.imagesLoaded( function(){
      $container.masonry({
          itemSelector : '.item-masory',
          gutterWidth: 0,
          columnWidth: 1,
      }); 
  });


  $('.gva-search-region .icon').on('click',function(e){
    if($(this).parent().hasClass('show')){
        $(this).parent().removeClass('show');
    }else{
        $(this).parent().addClass('show');
    }
    e.stopPropagation();
  })

  
  // ==================================================================================
  // Offcavas
  // ==================================================================================
  $('#menu-bar').on('click',function(e){
    if($('.gva-offcanvas-mobile').hasClass('show-view')){
        $(this).removeClass('show-view');
        $('.gva-offcanvas-mobile').removeClass('show-view');
    }else{
        $(this).addClass('show-view');
       $('.gva-offcanvas-mobile').addClass('show-view'); 
    }
    e.stopPropagation();
  })
  $('.close-offcanvas').on('click', function(e){
    $('.gva-offcanvas-mobile').removeClass('show-view');
    $('#menu-bar').removeClass('show-view');
  });

    /*========== Click Show Sub Menu ==========*/
   
    $('.gva-navigation a').on('click','.nav-plus',function(){
        if($(this).hasClass('nav-minus') == false){
            $(this).parent('a').parent('li').find('> ul').slideDown();
            $(this).addClass('nav-minus');
        }else{
            $(this).parent('a').parent('li').find('> ul').slideUp();
            $(this).removeClass('nav-minus');
        }
        return false;
    });

  /* ============ Isotope ==============*/
    if ( $.fn.isotope ) {
      $( '.isotope-items' ).each(function() {
        var _pid = $(this).data('pid');
        var $el = $( this ),
            $filter = $( '.portfolio-filter a.' + _pid ),
            $loop =  $( this );

        $loop.isotope();

        $loop.imagesLoaded(function() {
          $loop.isotope( 'layout' );
        });

        if ( $filter.length > 0 ) {

          $filter.on( 'click', function( e ) {
            e.preventDefault();
            var $a = $(this);
            $filter.removeClass( 'active' );
            $a.addClass( 'active' );
            $loop.isotope({ filter: $a.data( 'filter' ) });
          });
        };
      });
    };

   //==== Customize =====
    $('.help .control-panel').click(function(){
      if($(this).parents('.help').hasClass('show')){
        $(this).parents('.help').removeClass('show');
      }else $(this).parents('.help').addClass('show');
    });

    $('.drupal-message .close').click(function(){
      $(this).parent().remove();
    })

    $('.gavias-skins-panel .control-panel').click(function(){
      if($(this).parents('.gavias-skins-panel').hasClass('active')){
        $(this).parents('.gavias-skins-panel').removeClass('active');
      }else $(this).parents('.gavias-skins-panel').addClass('active');
    });

    $('.gavias-skins-panel .layout').click(function(){
        $('body').removeClass('wide-layout').removeClass('boxed');
        $('body').addClass($(this).data('layout'));
        $('.gavias-skins-panel .layout').removeClass('active');
        $(this).addClass('active');
        var $container = $('.post-masonry-style');
        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : '.item-masory',
                gutterWidth: 0,
                columnWidth: 1,
            }); 
        });
    });

/*-------------Milestone Counter----------*/
      jQuery('.milestone-block').each(function() {
        jQuery(this).appear(function() {
          var $endNum = parseInt(jQuery(this).find('.milestone-number').text());
          jQuery(this).find('.milestone-number').countTo({
            from: 0,
            to: $endNum,
            speed: 4000,
            refreshInterval: 60,
            formatter: function (value, options) {
              value = value.toFixed(options.decimals);
              value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
              return value;
            }
          });
        },{accX: 0, accY: 0});
      });
/*----------- Animation Progress Bars --------------------*/

  $("[data-progress-animation]").each(function() {
    var $this = $(this);
    $this.appear(function() {
      var delay = ($this.attr("data-appear-animation-delay") ? $this.attr("data-appear-animation-delay") : 1);
      if(delay > 1) $this.css("animation-delay", delay + "ms");
      setTimeout(function() { $this.animate({width: $this.attr("data-progress-animation")}, 800);}, delay);
    }, {accX: 0, accY: -50});
  });
  
  /*----------------------------------------------------*/
  /*  Pie Charts
  /*----------------------------------------------------*/
  var pieChartClass = 'pieChart',
        pieChartLoadedClass = 'pie-chart-loaded';
    
  function initPieCharts() {
    var chart = $('.' + pieChartClass);
    chart.each(function() {
      $(this).appear(function() {
        var $this = $(this),
          chartBarColor = ($this.data('bar-color')) ? $this.data('bar-color') : "#F54F36",
          chartBarWidth = ($this.data('bar-width')) ? ($this.data('bar-width')) : 150
        if( !$this.hasClass(pieChartLoadedClass) ) {
          $this.easyPieChart({
            animate: 2000,
            size: chartBarWidth,
            lineWidth: 8,
            scaleColor: false,
            trackColor: "#eee",
            barColor: chartBarColor,
          }).addClass(pieChartLoadedClass);
        }
      });
    });
  }
  initPieCharts();

  // ============================================================================
  // mb_YTPlayer video background
  // ============================================================================
  if (!jQuery.browser.mobile){
    $(".youtube-bg").mb_YTPlayer();
  }

  // ============================================================================
  // Fixed top Menu Bar
  // ============================================================================
  if($('.gv-sticky-menu').length > 0){
      var sticky = new Waypoint.Sticky({
        element: $('.gv-sticky-menu')[0]
    });
  }  
  var _main_sticky = $('.sticky-wrapper');

  if ( _main_sticky.length > 0 ){
    _main_sticky.each(function(){
      var main_sticky = $(this);
      var gva_sticky = function() {
        if ( $(document).scrollTop() > main_sticky.outerHeight()) {
          main_sticky.removeClass('sticky-is-hidden');
          main_sticky.addClass('sticky-is-show');
        } else {
          main_sticky.removeClass('sticky-is-show');
          if ($(document).scrollTop() < main_sticky.outerHeight()) {
            main_sticky.removeClass('sticky-is-hidden');
            main_sticky.removeClass('sticky-is-show');
          }
        }
      }
      gva_sticky();
      var cs = 0;
      $(window).scroll(function(event) {
          var ns = $(this).scrollTop();
          if ( ns < cs ) {
              gva_sticky();
          } else {
            if ( ns > main_sticky.outerHeight() ) {
              main_sticky.addClass('sticky-is-hidden');
              main_sticky.removeClass('sticky-is-show');
            }
          }
          cs = ns;
      });
    })  
  }
  // ============================================================================
  // Text Typer
  // ============================================================================
  $("[data-typer-targets]", ".rotate-text").typer();

});

var animationDimensions = function() {
  var gavias_height = $(window).height();
  $('.bb-container.full-screen').each(function(){
    $(this).css('height', gavias_height);
  });
}

$(document).ready(function(){
  if($('.full-screen').length > 0){
    animationDimensions();
  }
})

$(window).on('load', function(){
  if($('.full-screen').length > 0){
    animationDimensions();
  }
});

$(window).on("debouncedresize", function(event) {
  if($('.full-screen').length > 0){
   setTimeout(function() {
      animationDimensions();
    }, 50);
  }
});

// Footer fixed
var footerFixed = function() {
  var footer_height = $('#footer').height();
  $('body.footer-fixed .gva-body-page').css('margin-bottom', footer_height);
}

$(document).ready(function(){
  footerFixed();
});

$(window).on("debouncedresize", function(event) {
  footerFixed();
});

$(document).ready(function(){
  var offset = -($(window).height() / 2) + 80; 
  $(window).scroll(function () {
    $('.service-timeline .entry-timeline').each(function(){
        var top_menu_offset = $(this).offset();
       if ($(window).scrollTop() > top_menu_offset.top + offset) {
          $(this).addClass('active');
        } else {
          $(this).removeClass('active');
      }
    });  
  });

  // Select all links with hashes
    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')  
      .click(function(event) {
        // On-page links  
        if (
          location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
          && 
          location.hostname == this.hostname
        ) { 
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000, function() {
              // Callback after animation
              // Must change focus!
              var $target = $(target);
              $target.focus();
              if ($target.is(":focus")) { // Checking if the target was focused
                return false;
              } else {
                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                $target.focus(); // Set focus again
              };
            });
          }
        }
      });
  
});  

})(jQuery);
