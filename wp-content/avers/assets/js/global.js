(function($){

$(document).ready(function(){


    /* Слайдер на главной странице*/

    $('.slider').slick({
        'slidersToShow': 1,
        'slidesToScroll': 1,
        'arrows':true,
        'prevArrow': '.prev-block',
        'nextArrow':'.next-block',
        'dots':false,
        'autoplay': true,
        ' autoplaySpeed': 6000
    });

    /*Конец слайдера*/


  /**********************************************
    Главное меню добавляем классы
  */
  $('.collapse .main-menu .sub-menu').addClass('text-left');
  $('.collapse .main-menu .sub-menu').addClass('list-unstyled');
  $('.collapse .main-menu .sub-menu').css('display', 'none');

  /*
    Добавляем ховер на главное меню
  */
  $('header nav li').hover(function() {
       $(this).children('a').css('color', '#ed1c2e');
      if ($(this).children('ul').hasClass('sub-menu')) {
        $(this).children('ul.sub-menu').fadeIn('400');
        $(this).children('ul').children('li').hover(function() {
          $(this).children('a').css('color','#ed1c2e');
        }, function() {
          $(this).children('a').css('color', '#FFF');
        });
      }
    }, function() {
       if (!$(this).hasClass('current-menu-item')) {
           $(this).children('a').css('color', '#000');
        }
       $(this).children('ul.sub-menu').fadeOut('fast');
    });
  /*
    Конец Главное меню
  *********************************************************/

  /********************************************************
    Подменю добавляем классы
  */
  $('.under-main-menu .sub-menu').addClass('text-left');
  $('.under-main-menu .sub-menu').addClass('list-unstyled');
  $('.under-main-menu .sub-menu').css('display', 'none');

  /*
    Добавляем ховер подменю
  */
  $('header .header-bottom ul.under-main-menu li').hover(function() {
     $(this).children('a').css('color', '#000');
     $(this).children('ul.sub-menu').css('width', $(this).width()+60);
      if ($(this).children('ul').hasClass('sub-menu')) {
        $(this).children('ul.sub-menu').fadeIn('400');
        $(this).children('ul').children('li').hover(function() {
          $(this).children('a').css('color','#ed1c2e');
        }, function() {
          $(this).children('a').css('color', '#FFF');
        });
      }
    }, function() {
      if (!$(this).hasClass('current-menu-item')) {
        $(this).children('a').css('color', '#FFF');
      }
       $(this).children('ul.sub-menu').fadeOut('fast');
    });

  $('.block_offers .btn').each(function() {
    var $element = $(this);
    var h = ($element.width()+29)/2+'px';
    console.log(h);
    var h1 = $element.css('left', 'calc(50% - '+h+')');
    console.log(h1);
  });

/*Актив для рубрики блога*/
  $('.blog_category li a').each(function() {
    
        if ($(this).attr('href') == window.location.href)
        {
            $(this).addClass('active-btn');
        }
  });




  $('.voprosik').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',
    
            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
              beforeOpen: function() {
                if($(window).width() < 700) {
                  this.st.focus = false;
                } else {
                  this.st.focus = '#name';
                }
              }
            }
          });

    $('.images-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return item.el.attr('title');
            }
        }
    });

    $('ol li:first-child').on('click', function() {

      $(this).siblings('li').toggle(400);
      $(this).toggleClass('minus');
      $(this).parent('ol').css('background', '#FFF');
    });
    
    $(window).scroll(function() {
      var $h = $('.block-news').height();
      console.log($h);
      console.log($(this).scrollTop());
      if ($(this).scrollTop() > $h) {
        $('a.link-blog .text-blog').addClass('fadeOut');
      }
    });
});
})(jQuery);