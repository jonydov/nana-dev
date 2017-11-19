var scrollAnimate = {
    elements: [],
    init: function () {
        $.each($('.animate'), function (i, v) {

            var element_height = $(v).outerHeight();
            var position = $(v).offset();

            scrollAnimate.elements[i] = [];

            scrollAnimate.elements[i].el = v;
            scrollAnimate.elements[i].height = element_height;
            scrollAnimate.elements[i].xtop = position.top;
            scrollAnimate.elements[i].bottom = position.top + element_height;
            scrollAnimate.elements[i].delay = $(v).attr('data-delay');

        });

        $(window).on('resize orientationchange', function () {
            scrollAnimate.update_viewport();
        });

        $(window).load(function () {
            setTimeout(function () {
                scrollAnimate.update_viewport();
            }, 500)
        });

        window.addEventListener('scroll', function (e) {
            distanceY = window.pageYOffset || document.documentElement.scrollTop;

            $.each(scrollAnimate.elements, function (i, v) {

                height = scrollAnimate.elements[i].height;
                xtop = scrollAnimate.elements[i].xtop;
                bottom = scrollAnimate.elements[i].bottom;
                delay = scrollAnimate.elements[i].delay;

                if (parseInt(distanceY + scrollAnimate.viewport_height) > parseInt(parseInt(xtop) + parseInt(delay))) {
                    $(scrollAnimate.elements[i].el).addClass('on');
                } else {
                    $(scrollAnimate.elements[i].el).removeClass('on');
                }
            });


        });
    },
    update_viewport: function () {
        scrollAnimate.body_height = $(document).height();
        scrollAnimate.viewport_height = $(window).height();
    }
};

var nana = {
    init: function () {
        scrollAnimate.init();
    }
};

function scrollToAnchor(aid) {
    var aTag = $("a[name='" + aid + "']");

    $('html,body').animate({scrollTop: aTag.offset().top - 100}, 200);
}

$(document).ready(function () {

    $('.lang-toggle').on('click', function (e) {
        var text = $(this).text();
        $(this).text(text == "ABC" ? "אבג" : "ABC");
        $('.alphabet-scale .letter').toggleClass('active');
    });

    $('.btn-search').on('click', function (e) {

        var $this = $('.search-bar');
        $('.navbar').fadeOut(250);
        $this.fadeIn(250);
        $this.find('input[type=text]').focus();

        e.preventDefault();
    });

    $('.search-bar .btn-close').on('click', function (e) {

        var $this = $('.search-bar');
        $('.navbar').fadeIn(250);
        $this.fadeOut(250);

        e.preventDefault();
    });

    $('#links a').on('click', function (e) {
        scrollToAnchor($(this).attr('href'));
    });

    /* Isotope JS */

    $.Isotope.prototype._positionAbs = function( x, y ) {
        return { right: x, top: y };
    };

    var $grid = $('.items-filter').isotope({
        itemSelector: '.item',
        transformsEnabled: false
    });

    // store filter for each group
    var filters = {};

    $('.nav-cat, #links').on('click', '.cat', function () {
        var $this = $(this);
        // get group key
        var $buttonGroup = $this.parents('.cat-types');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        filters[filterGroup] = $this.attr('data-filter');
        // combine filters
        var filterValue = concatValues(filters);
        // set filter for Isotope
        $grid.isotope({filter: filterValue});
    });

    // change is-checked class on buttons
    $('.nav-cat, #links').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', '.cat', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });

    // flatten object by concatting values
    function concatValues(obj) {
        var value = '';
        for (var prop in obj) {
            value += obj[prop];
        }
        return value;
    }


    /* Affix */

    $('header').affix({});


    /* Magnific Popups */

    $('.mfp-close').on( "click", function() {
        $.magnificPopup.close();
    });

    $('.popup-img').magnificPopup({
        type: 'image',
        closeMarkup:'<button class="mfp-close fa fa-times-circle"></button>',
        gallery: {
            enabled: true,
            tCounter: '<span class="mfp-counter">%curr% מתוך %total%</span>',
            arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>'
        },
        image: {
            titleSrc: function(item) {
                return '<h3>' + item.el.find('.image').attr('data-title') + '</h3>' + item.el.find('.image').attr('data-caption');
            }
        },
        callbacks: {
            beforeOpen: function() {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure animated ' + this.st.el.attr('data-effect'));
            }
        }
    });

    $('.popup-yt').magnificPopup({
        type: 'iframe',
        titleSrc: function(item) {
            return '<h3>' + item.el.attr('data-title') + '</h3>' + item.el.attr('data-caption');
        },
        closeMarkup:'<button class="mfp-close fa fa-times-circle"></button>',
        iframe: {
            markup: '<div class="mfp-iframe-scaler">' +
            '<div class="mfp-close"><i class="zmdi zmdi-close"></i></div>' +
            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
            '<div class="mfp-bottom-bar">'+
            '<div class="mfp-title vid"></div>'+
            '</div>'+
            '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button
            patterns: {
                youtube: {
                    index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

                    id: 'v=', // String that splits URL in a two parts, second part should be %id%
                    // Or null - full URL will be returned
                    // Or a function that should return %id%, for example:
                    // id: function(url) { return 'parsed id'; }

                    src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
                },
                vimeo: {
                    index: 'vimeo.com/',
                    id: '/',
                    src: '//player.vimeo.com/video/%id%?autoplay=1'
                },
                gmaps: {
                    index: '//maps.google.',
                    src: '%id%&output=embed'
                }

                // you may add here more sources

            },

            srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
        },
        callbacks: {
            markupParse: function(template, values, item) {
                values.title = item.el.attr('data-title');
            }
        },
    });


    /* Sliders */

    $('.shows-slider-holder').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: false,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: false,
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.section-albums-slider .albums-slider-holder, .section-artist-gallery .artist-gallery-slider-holder').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: false,
        dots: false,
        rtl: true,
        arrows: true,
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.section-albums-banner-slider .items').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        dots: true,
        arrows: false,
    });

    $('.albums-slider-holder .items').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        dots: true,
        arrows: false,
    });

    $('.slider-holder').slick({
        asNavFor: '.slider-texts-holder',
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        dots: true,
        arrows: false,
    });

    $('.slider-texts-holder').slick({
        asNavFor: '.slider-holder',
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        dots: false,
        arrows: false,
    });

    $('.artists-slider').slick({
        infinite: true,
        rtl: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplay: false,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: false,
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    /* Shows - AJAX Filter */

    $('.filter-shows li').on('click', function (e) {
        e.preventDefault();

        var filter_type = $(this).data('filter');

        if (filter_type == 'artist') {

            if ($('.locations').hasClass('on')) {
                $('.locations').removeClass('on');
            }

            $('.artists').toggleClass('on');

        } else if (filter_type == 'location') {

            if ($('.artists').hasClass('on')) {
                $('.artists').removeClass('on');
            }

            $('.locations').toggleClass('on');

        } else if (filter_type == 'date') {
            $('.locations, .artists').removeClass('on');
            get_shows(filter_type);
        }
    });

    $('header li.artists-slider-toggle').hover(function () {
        //$('.main-artists-slider').stop(true, true).toggleClass('animate on');
    });

    $('.artists-slider .artist').on('click', function (e) {
        e.preventDefault();

        $('.artists-slider .artist').removeClass('active');
        $(this).addClass('active');

        get_shows('artist', $(this).attr('data-artist'), '');
    });

    $('.locations-slider .location').on('click', function (e) {
        e.preventDefault();

        $('.locations-slider .location').removeClass('active');
        $(this).addClass('active');

        get_shows('location', '', $(this).attr('data-location'));
    });

    function get_shows(filter_type, artist, location) {

        var baseURL = $('header .logo').attr('href');

        $.ajax({
            cache: false,
            url: baseURL + '/wp-admin/admin-ajax.php',
            type: "POST",
            data: {action: 'shows-filter', filter_type: filter_type, artist: artist, location: location},

            beforeSend: function () {
                $('#preloader').addClass('on');
                $('.shows-filter').removeClass('on');
            },

            success: function (data, textStatus, jqXHR) {

                var $ajax_response = $(data);
                console.log($ajax_response);

                if ($ajax_response.selector != 'No Results') {
                    $('.shows-filter').html($ajax_response);
                } else {
                    $('.shows-filter').html('<div class="no-results">אין הופעות קרובות לאמן זה.</div>');
                }
            },

            error: function (jqXHR, textStatus, errorThrown) {
                console.log('The following error occured: ' + textStatus, errorThrown);
            },

            complete: function (jqXHR, textStatus) {

                $('#preloader').removeClass('on');
                $('.shows-filter').addClass('on');
            }

        });
    }


    /* productions or news - AJAX Load archive */

    $('.archive-list a').on('click', function (e) {
        e.preventDefault();
        var baseURL = $('header .logo').attr('href');

        var year = $(this).data('year');
        var month = $(this).data('month');

        if ($('body').hasClass('page-template-tmpl-news')) {
            var post_type = 'news';
        }

        if ($('body').hasClass('page-template-tmpl-productions')) {
            var post_type = 'productions';
        }

        if (month != undefined) {
            var height = $('.archive .items').height();
            //$('.section-productions-archive .items').css('height', height);
            $('.archive .items .item').fadeOut(300);

            $.ajax({

                cache: false,
                url: baseURL + '/wp-admin/admin-ajax.php',
                type: "POST",

                data: {action: 'load-archive', month: month, year: year, post_type: post_type},


                beforeSend: function () {
                    $('#ajax-response').html('Loading');
                },

                success: function (data, textStatus, jqXHR) {

                    var $ajax_response = $(data);
                    console.log($ajax_response);
                    var url = $('.section-news-archive').data('currentUrl');

                    console.log($ajax_response);
                    $('.archive .items').html($ajax_response);

                    history.pushState('productionsItems', "", url + '?year=' + year + '&month=' + month);

                },

                error: function (jqXHR, textStatus, errorThrown) {
                    console.log('The following error occured: ' + textStatus, errorThrown);
                },

                complete: function (jqXHR, textStatus) {
                    $('.animate').each(function () {

                        if ($(this).is(":visible")) {

                            $(this).addClass('on');
                        }
                    });
                }

            });
        }
    });

    /* Nav Menu */

    $('.c-hamburger').click(function (evn) {
        evn.preventDefault();
        $(this).toggleClass('is-active');
        $('.main-nav').toggleClass('is-active');
    });

    /**
     * MOBILE DETECTION
     *
     */
    var isMobile = false; //initiate as false
    var isIOS = false;

    // device detection
    if ($(window).width() <= 768 ||
        /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {

        isMobile = true;
        $('body').addClass('mobile');

        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            isIOS = true;
            $('body').addClass('ios');
        }
    }

    /**
     Skrollr
     */

    if ($('.skrollable').length) {
        var skrllr;
        var skrollrInit = function () {
            setTimeout(function () {
                skrllr = skrollr.init({
                    smoothScrolling: true,
                    mobileDeceleration: 0.004
                });
            }, 100);
        };

        if ($(window).width() > 980 && !isMobile) {
            skrollrInit({forceHeight: false});
            ;
        }
        $(window).on('resize', function () {
            if ($(this).width() <= 980 || isMobile) {
                skrllr = false;
                skrollr.init().destroy();
            }
            else {
                skrollrInit({forceHeight: false});
                ;
            }
        });
    }
});

function whiteBG() {

    $('.white-section').each(function () {

        var from_top = $(this).offset().top - $(window).scrollTop()
        console.log(from_top);
        if (from_top < 90) {
            $('header').addClass('darken');
        } else {
            $('header').removeClass('darken');
        }
    });
}

$(window).load(function () {

    if ($('.section-intro').length) {
        $('.section-intro').removeClass('on');
    }

    setTimeout(function () {
        scrollAnimate.update_viewport();
        nana.init();
    }, 500);

    $('.animate').each(function () {

        if ($(this).is(":visible")) {

            $(this).addClass('on');
        }
    });

    whiteBG();
});

$(window).scroll(function () {

    whiteBG();
});