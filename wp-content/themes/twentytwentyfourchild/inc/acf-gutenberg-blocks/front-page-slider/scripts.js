$(document).ready(function (){
    $('.frontpage-slider-container__slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1540,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    settings: "unslick"
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    settings: "unslick"
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    settings: "unslick"
                }
            }
        ]
    });
});