(function ($) {

    $(document).ready(function () {

        function cityLoad(val){
            $.ajax({
                type: 'post',
                url: myAjax.ajaxurl,
                data: {
                    action: 'loadCities',
                    currentCity: val

                },
                success: function (data) {
                    var city = $('#cityfilter');
                    if (data.count == 0) {
                        city.html(data['res']);
                        city.attr('disabled', true);
                    }
                    else {
                        city.removeAttr('disabled');
                        city.html(data['res']);
                    }
                }
            });
        }

        /*AJAX Недвижимость*/
        $('#countryfilter').on('change', function () {
            var val = $(this).val();
            cityLoad(val);
        });

        var click = 0;
        (function () {
            $.ajax({
                url: myAjax.ajaxurl,
                data: {
                    action: 'getCurrentPage'

                },
                success: function (data) {
                    click = data.currentPage;
                }
            });
        })()
        var ajaxImg = $('.ajax-img');
        var property = $('#property');
        var $filter = $('#filter');
        $filter.on('submit', function (e) {
            e.preventDefault();
            click = 0;
            var filter = $(this);
            $.ajax({
                url: myAjax.ajaxurl,
                data: filter.serialize(),
                type: filter.attr('method'),
                beforeSend: function (xhr) {
                    property.addClass('ajax-bg');
                    ajaxImg.addClass('show');
                    filter.find('button').text('Ищем');
                },
                success: function (data) {
                    click = data.currentPage;
                    if (window.location.href != data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        if (data["res"] === "") {
                            $('.alert-interavers').fadeIn(400).delay(800).fadeOut(400);
                            filter.find('button').text('Найти');
                            property.removeClass('ajax-bg');
                            ajaxImg.removeClass('show');
                        } else {
                            property.html(data['res']);
                            $('.price_item span').each(function () {
                                var price = +$(this).text();
                                $.fn.changePrice($(this), price);
                            });
                            filter.find('button').text('Найти');
                            property.removeClass('ajax-bg');
                            ajaxImg.removeClass('show');
                        }
                    }
                }
            });
        });

        $('body').on('click', '#pagination-property a', function (e) {
            e.preventDefault();
            click += 1;
            $.ajax({
                type: 'post',
                url: myAjax.ajaxurl,
                data: {
                    action: 'myfilter',
                    currentPage: click

                },
                beforeSend: function (xhr) {
                    property.addClass('ajax-bg');
                    ajaxImg.addClass('show');
                },
                success: function (data) {
                    $('#pagination-property').remove();
                    property.append(data['res']);
                    $('.price_item span').each(function () {
                        var price = +$(this).text();
                        $.fn.changePrice($(this), price);
                    });
                    property.removeClass('ajax-bg');
                    ajaxImg.removeClass('show');
                }
            });
        });

        $('#clean-filter').on('click', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: myAjax.ajaxurl,
                data: {
                    action: 'cleanFilter'
                },
                success: function (data) {
                    window.location.href = data.link;
                }
            });
        });
        $('.property-country_link').on('click', function (e) {
            e.preventDefault();
            var $countryID = $(this).data('country-id');
            $.ajax({
                type: 'post',
                url: myAjax.ajaxurl,
                data: {
                    action: 'myfilter',
                    countryfilter: $countryID
                },
                beforeSend: function (xhr) {
                    property.addClass('ajax-bg');
                    ajaxImg.addClass('show');
                    $filter.find('button').text('Ищем');
                    $('#countryfilter option').each(function () {
                        if ($(this).val() == $countryID) {
                            $(this).attr('selected', true);
                            cityLoad($countryID);
                        }
                    });
                },
                success: function (data) {
                    if (data["res"] === "") {
                        $('.alert-interavers').fadeIn(400).delay(800).fadeOut(400);
                        $filter.find('button').text('Найти');
                        property.removeClass('ajax-bg');
                        ajaxImg.removeClass('show');
                    } else {
                        property.html(data['res']);
                        $('.price_item span').each(function () {
                            var price = +$(this).text();
                            $.fn.changePrice($(this), price);
                        });
                        $filter.find('button').text('Найти');
                        property.removeClass('ajax-bg');
                        ajaxImg.removeClass('show');
                    }

                }
            });
        });
        /*End AJAX Недвижимость*/

    });
})(jQuery);