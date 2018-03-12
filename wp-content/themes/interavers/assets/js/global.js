(function ($) {

    $(document).ready(function () {

        /*Якорь*/
        $(".scrollto__btn-scrollto").on("click", function (event) {
            event.preventDefault();
            $('body,html').animate({scrollTop: 0}, 750);
        });

        $(window).scroll(function () {
            var $headerHeight = $('#masthead').height();
            var $contentHeight = $('#content').height();
            var $windowHeight = $(window).height();
            $summ = $headerHeight + $contentHeight - $windowHeight + 149;
            if ($(this).scrollTop() > 687 && $(this).scrollTop() < $summ) {
                $('.site-scrollto').addClass('fixed');
            }
            else {
                $('.site-scrollto').removeClass('fixed');
            }
        });

        /*Конец Якорь*/

        /* Слайдер на главной странице Partners*/

        $('.slider').slick({
            'slidesToShow': 6,
            'slidesToScroll': 1,
            'arrows': true,
            'prevArrow': '.prev-block',
            'nextArrow': '.next-block',
            'dots': false,
            'autoplay': true,
            'autoplaySpeed': 2000

        });

        /*Конец слайдера*/

        /* Слайдер на главной страницах Отзывы*/

        $('.arrows').removeAttr('style');

        $('.images-gallery').slick({
            'slidesToShow': 4,
            'slidesToScroll': 1,
            'arrows': true,
            'prevArrow': '.prev-block',
            'nextArrow': '.next-block',
            'dots': false,
            'autoplay': true,
            'autoplaySpeed': 4000

        });

        /*Конец слайдера*/

        /* Слайдер на синголвых страницых Учебных Заведений*/

        $('.photogallery__head-slider').slick({
            'slidesToShow': 1,
            'slidesToScroll': 1,
            'arrows': true,
            'prevArrow': '.prev-block',
            'nextArrow': '.next-block',
            'dots': false,
            'autoplay': true,
            'autoplaySpeed': 4000,
            'asNavFor': '.small-slider-position__small-slider',

        });
        if ($('.small-slider-position__small-slider_img').length <= 5) {
            $('.small-slider-position__small-slider').slick({
                'slidesToShow': 5,
                'asNavFor': '.photogallery__head-slider',
                'dots': false,
                'focusOnSelect': true,
                'arrows': false
            });
        } else {
            $('.small-slider-position__small-slider').slick({
                'slidesToShow': 5,
                'asNavFor': '.photogallery__head-slider',
                'dots': false,
                'focusOnSelect': true,
                'arrows': false,
                'centerMode': true
            });
        }

        /*Конец слайдера*/

        /* Высота Блока */

        $(function () {
            $('.equal').matchHeight();
        });

        $(function () {
            $('.blog_equal').matchHeight();
        });

        $(function () {
            $('.tax-education_equal').matchHeight();
        });

        $(function () {
            $('.map').matchHeight();
        });

        $(function () {
            $('.programms_equal').matchHeight();
        });

        $(function () {
            $('.property_equal').matchHeight();
        });

        $(function () {
            $('.property_title_equal').matchHeight();
        });

        $(function () {
            $('.property_country_equal').matchHeight();
        });

        /* Конец Высоты Блока */

        /**********************************************
         Главное меню добавляем классы
         */
        $('.collapse .main-menu .sub-menu').addClass('text-left');
        $('.collapse .main-menu .sub-menu').addClass('list-unstyled');
        $('.collapse .main-menu .sub-menu').addClass('hide_ul');

        /*
         Добавляем ховер на главное меню
         */
        $('header nav ul.main-menu li').hover(function () {
            $(this).find('.sub-menu').fadeIn(300);
        }, function () {
            $(this).find('.sub-menu').fadeOut(300);
        });
        /*
         Конец Главное меню
         *********************************************************/

        /********************************************************

        /*
         Добавляем ховер подменю
         */
        $('header .header-bottom ul.under-main-menu li').hover(function () {
            $(this).find('.sub-menu').fadeIn(300);
        }, function () {
            $(this).find('.sub-menu').fadeOut(300);
        });

        /*  $('.block_offers .btn').each(function() {
         var $element = $(this);
         var h = ($element.width()+29)/2+'px';
         console.log(h);
         var h1 = $element.css('left', 'calc(50% - '+h+')');
         console.log(h1);
         });*/

        /*Актив для рубрики блога*/
        $('.blog_category li a').each(function () {
            if (window.location.href.indexOf($(this).attr('href')) == 0) {
                $(this).addClass('active-btn');
            }
        });

        /* Актив конец */

        /*Актив для рубрики Отзывы*/
        $('.reviews_category li a').each(function () {
            if (window.location.href.indexOf($(this).attr('href')) == 0) {
                $(this).addClass('active-btn');
            }
        });

        /* Актив конец */

        /*Актив для меню стран*/
        $('#navigation .navigation__list > li > a').each(function () {
            if (window.location.href.indexOf($(this).attr('href')) == 0) {
                var nav = $(this).siblings('.sub-navigation-menu');
                $(this).parent('li').addClass('item-selected');
                nav.removeClass('hidden');
                setTimeout(function () {
                    nav.removeClass('hiddenvisibility');
                }, 30);
            }
        });

        $('#navigation .navigation__list > li > ul.sub-navigation-menu > li > a').each(function () {
            if (window.location.href.indexOf($(this).attr('href')) == 0) {
                $(this).addClass('current-list-item');
            }
        });

        /* Актив конец */

        /*Попапы*/
        /*Попапы для Header */


        $('.voprosik').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });

        $('.free-consultation').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });

        /*Попапы для Header Конец */

        /*Попапы для О нас*/
        $('.images-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            mainClass: 'mfp-img-mobile',
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            }
        });

        /*Попапы для О нас Конец*/

        /*Попап для образования*/

        $('.left-request').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function () {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });

        /*Конец попапы для образования*/

        /*Аккордион */
        $('ol li:first-child').on('click', function () {

            $(this).siblings('li').toggle(400);
            $(this).toggleClass('minus');
            $(this).parent('ol').css('background', '#FFF');
        });

        /* Аккордион конец */

        /*Аккордион для Стран*/

        $('.education_country__accordion .accordion_title').on('click', function () {
            if ($(this).parent('.education_country__accordion').parent('.row').siblings('.row').children('.education_country__accordion').children('.accordion_title').hasClass('minus')) {
                $(this).each(function () {
                    $('.education_country__accordion .accordion_title').removeClass('minus');
                    $('.education_country__accordion .accordion_content').css('display', 'none');
                });
            }
            $(this).siblings('.accordion_content').toggle(400);
            $(this).toggleClass('minus');
        });

        /* Аккордион конец */

        /*Аккордион для Navigation*/

        $('.navigation__list .navigation__list_item').on('click', function () {
            var $listItem = $(this);
            if ($listItem.hasClass('item-selected')) {
                $listItem.removeClass('item-selected');
                $listItem.children('.sub-navigation-menu').addClass('hiddenvisibility');
                $listItem.children('.sub-navigation-menu').one('transitionend', function(e) {
                    $listItem.children('.sub-navigation-menu').addClass('hidden');
                });
            } else {
                $listItem.addClass('item-selected');
                $listItem.children('.sub-navigation-menu').removeClass('hidden');
                setTimeout(function () {
                    $listItem.children('.sub-navigation-menu').removeClass('hiddenvisibility');

                }, 20);
            }
        });

        $('.navigation__list .navigation__list_item > a').on('click', function (event) {
            event.stopPropagation();
        });

        $('.navigation__list .navigation__list_item ul.sub-navigation-menu > li > a').on('click', function (event) {
            event.stopPropagation();
        });

        /* Аккордион конец */

        /* Price changes */
        $.fn.changePrice = function (e, price) {
            if ($.isNumeric(price)) {
                var newPrice = accounting.formatNumber(price, 0, " ");
                e.text(newPrice);
            }
        }

        $('.price_item span').each(function () {
            var price = +$(this).text();
            $.fn.changePrice($(this), price);
        });

        /*End Price Changes */

        // $(window).scroll(function () {
        //     var $h = $('.block-news').height();
        //     console.log($h);
        //     console.log($(this).scrollTop());
        //     if ($(this).scrollTop() > $h) {
        //         $('a.link-blog .text-blog').addClass('fadeOut');
        //     }
        // });
    });
})(jQuery);