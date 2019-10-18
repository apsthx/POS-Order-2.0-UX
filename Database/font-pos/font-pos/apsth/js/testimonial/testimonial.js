/*******************************/
// this is for the testimonial 1
/*******************************/
$('.testi1').owlCarousel({
        loop: true
        , margin: 30
        , nav: false
        , dots: true
        , autoplay:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                , nav: false
            }
            , 1170: {
                items: 2
            }
        }
    })
/*******************************/
// this is for the testimonial 2 
/*******************************/
$('.testi2').owlCarousel({
    loop: true
    , margin: 20
    , nav: false
    , dots: true
    , autoplay:true
    , responsiveClass: true
    , responsive: {
        0: {
            items: 1
            , nav: false
        }
        , 1170: {
            items: 1
        }
    }
})
$(function () {
    // 1) ASSIGN EACH 'DOT' A NUMBER
    dotcount = 1;
    $('.testi2 .owl-dot').each(function () {
        $(this).addClass('dotnumber' + dotcount);
        $(this).attr('data-info', dotcount);
        dotcount = dotcount + 1;
    });
    // 2) ASSIGN EACH 'SLIDE' A NUMBER
    slidecount = 1;
    $('.testi2 .owl-item').not('.cloned').each(function () {
        $(this).addClass('slidenumber' + slidecount);
        slidecount = slidecount + 1;
    });
    $('.testi2 .owl-dot').each(function () {
        grab = jQuery(this).data('info');
        slidegrab = $('.slidenumber' + grab + ' img').attr('src');
        console.log(slidegrab);
        $(this).css("background-image", "url(" + slidegrab + ")");
    });
    // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT
    // TO MAKE IT ALL NEAT 
    
});

/*******************************/
// this is for the testimonial 3
/*******************************/
$('.testi3').owlCarousel({
        loop: true
        , margin: 30
        , nav: false
        , dots: true
        , autoplay:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                , nav: false
            }
            , 1170: {
                items: 3
            }
        }
    })
/*******************************/
// this is for the testimonial 4
/*******************************/
$('.testi4').owlCarousel({
        loop: true
        , margin: 30
        , nav: false
        , dots: true
        , autoplay:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                
            }
            , 1650: {
                items: 1
            }
        }
    })
/*******************************/
// this is for the testimonial 5
/*******************************/
$('.testi5').owlCarousel({
        loop: true
        , margin: 30
        , nav: false
        , navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>']
        , dots: true
        , autoplay:true
        , center:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                
            }
            , 1170: {
                items: 3
            }
        }
    })

/*******************************/
// this is for the testimonial 5
/*******************************/
$('.testi7').owlCarousel({
        loop: true
        , margin: 30
        , nav: true
        , navText: ['<i class="ti-arrow-circle-left"></i>','<i class="ti-arrow-circle-right"></i>']
        , dots: false
        , autoplay:true
        , center:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                
            }
            , 1650: {
                items: 1
            }
        }
    })
/*******************************/
// this is for the testimonial 8 
/*******************************/
$('.testi8').owlCarousel({
    loop: true
    , margin: 20
    , nav: false
    , dots: true
    , autoplay:true
    , responsiveClass: true
    , responsive: {
        0: {
            items: 1
            , nav: false
        }
        , 1650: {
            items: 1
        }
    }
})
$(function () {
    // 1) ASSIGN EACH 'DOT' A NUMBER
    dotcount = 1;
    $('.testi8 .owl-dot').each(function () {
        $(this).addClass('dotnumber' + dotcount);
        $(this).attr('data-info', dotcount);
        dotcount = dotcount + 1;
    });
    // 2) ASSIGN EACH 'SLIDE' A NUMBER
    slidecount = 1;
    $('.testi8 .owl-item').not('.cloned').each(function () {
        $(this).addClass('slidenumber' + slidecount);
        slidecount = slidecount + 1;
    });
    $('.testi8 .owl-dot').each(function () {
        grab = jQuery(this).data('info');
        slidegrab = $('.slidenumber' + grab + ' img').attr('src');
        console.log(slidegrab);
        $(this).css("background-image", "url(" + slidegrab + ")");
    });
    // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT
    // TO MAKE IT ALL NEAT 
    
});


/*******************************/
// this is for the testimonial 9
/*******************************/
$('.testi9').owlCarousel({
        loop: true
        , margin: 30
        , nav: false
        , dots: true
        , autoplay:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                
            }
            , 1650: {
                items: 1
            }
        }
    })
/*******************************/
// this is for the testimonial 10
/*******************************/
$('.testi10').owlCarousel({
        loop: true
        , margin: 30
        , nav: false
        , dots: false
        , autoplay:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                
            }
            , 1650: {
                items: 1
            }
        }
    })