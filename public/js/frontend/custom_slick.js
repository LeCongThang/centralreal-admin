$(document).on('ready', function() {
    
});

$(".regular1").slick({
    dots: false,
    infinite: true,
    // prevArrow: false,
    // nextArrow: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
    {
        breakpoint: 1199,
        settings: {
            slidesToShow: 3,
            slidesToScroll:1
        }
    },
    {
        breakpoint: 992,
        settings: {
            slidesToShow: 2,
            slidesToScroll:1
        }
    },
    {
        breakpoint: 768,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1
        }
    },
    {
        breakpoint: 600,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }

    ]
});

$(".regular2").slick({
    dots: false,
    infinite: true,
    prevArrow: '<button class="fa fa-chevron-left"></button>',
    nextArrow: '<button class="fa fa-chevron-right"></button>',
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    autoplay: true,
    speed: 2000,
    autoplaySpeed: 2000,
    responsive: [
    {
        breakpoint: 1199,
        settings: {
            slidesToShow: 1,
            slidesToScroll:1
        }
    },
    {
        breakpoint: 992,
        settings: {
            slidesToShow: 1,
            slidesToScroll:1
        }
    },
    {
        breakpoint: 768,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    },
    {
        breakpoint: 600,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }

    ]
});

$(".regular3").slick({
    dots: true,
    infinite: true,
    prevArrow: false,
    nextArrow: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    autoplay: true,
    speed: 1000,
    autoplaySpeed: 2000,
    
});