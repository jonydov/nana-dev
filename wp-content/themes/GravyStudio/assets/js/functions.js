var scrollAnimate = {
    elements: [],
    init: function() {
        $.each($('.animate'), function(i, v) {

            var element_height = $(v).outerHeight();
            var position = $(v).offset();

            scrollAnimate.elements[i] = [];

            scrollAnimate.elements[i].el = v;
            scrollAnimate.elements[i].height = element_height;
            scrollAnimate.elements[i].xtop = position.top;
            scrollAnimate.elements[i].bottom = position.top + element_height;
            scrollAnimate.elements[i].delay = $(v).attr('data-delay');

        });

        $(window).on('resize orientationchange', function() { scrollAnimate.update_viewport(); });

        $(window).load(function() { setTimeout(function() { scrollAnimate.update_viewport(); }, 500) });

        window.addEventListener('scroll', function(e) {
            distanceY = window.pageYOffset || document.documentElement.scrollTop;

            $.each(scrollAnimate.elements, function(i, v) {

                height = scrollAnimate.elements[i].height;
                xtop = scrollAnimate.elements[i].xtop;
                bottom = scrollAnimate.elements[i].bottom;
                delay = scrollAnimate.elements[i].delay;

                if (parseInt(distanceY + scrollAnimate.viewport_height) > parseInt(parseInt(xtop) + parseInt(delay))) {
                    $(scrollAnimate.elements[i].el).addClass('on');
                }else {
                    $(scrollAnimate.elements[i].el).removeClass('on');
                }
            });


        });
    },
    update_viewport: function() {
        scrollAnimate.body_height = $(document).height();
        scrollAnimate.viewport_height = $(window).height();
    }
};

var humanXtensions = {
    init: function() {
        scrollAnimate.init();
    }
};

$(document).ready( function () {

    $('header').affix({});

    /* Sliders */

    $('.texts-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.logos-slider'
    });

    $('.logos-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 0,
        asNavFor: '.texts-slider',
        arrows: false,
        centerMode: false,
        focusOnSelect: true
    });

    $('.slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        autoplaySpeed: 3000,
        arrows: false,
        nextArrow: '<i class="zmdi zmdi-chevron-right slick-next"></i>',
        prevArrow: '<i class="zmdi zmdi-chevron-left slick-prev"></i>'
    });

    /* Nav Menu */

    $('.c-hamburger').click(function(evn){
        evn.preventDefault();
        $(this).toggleClass('is-active');
        $('.main-nav-buttons').toggleClass('is-active');
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
            skrollrInit({forceHeight: false});;
        }
        $(window).on('resize', function () {
            if ($(this).width() <= 980 || isMobile) {
                skrllr = false;
                skrollr.init().destroy();
            }
            else {
                skrollrInit({forceHeight: false});;
            }
        });
    }
});

function whiteBG() {

    $('.white-section').each( function () {

        var from_top = $(this).offset().top - $(window).scrollTop()
        console.log(from_top);
        if( from_top < 90 ){
            $('header').addClass('darken');
        }else{
            $('header').removeClass('darken');
        }
    });
}

$(window).load(function() {

    if( $('.section-intro').length ){
        $('.section-intro').removeClass('on');
    }

    setTimeout(function() {
        scrollAnimate.update_viewport();
        humanXtensions.init();
    }, 500);

    $('.animate').each( function () {

        if( $(this).is(":visible") ){

            $(this).addClass('on');
        }
    });

    whiteBG();
});

$(window).scroll(function() {

    whiteBG();
});