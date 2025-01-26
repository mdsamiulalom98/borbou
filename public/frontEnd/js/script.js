jQuery(document).ready(function () {
    "use strict";

    $('.success-slider').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        margin: 0,
        items: 3,
        smartSpeed: 1000,
        autoplayTimeout: 4000,
        mouseDrag: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
             0: {
                items: 1,
                nav: true
            },
            500: {
                items: 1,
                nav: true
            },
            768: {
                items: 2,
                nav: true
            },
            991: {
                items: 3,
                nav: true,
                loop: true,
            },
            1192: {
                items: 4,
                nav: true,
                loop: true,
            }
        }
    });
    
    $('.femaleslideContainer').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        margin: 30,
        items: 3,
        smartSpeed: 1000,
        autoplayTimeout: 4000,
        mouseDrag: true,
        
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
             0: {
                items: 1,
                nav: false
            },
            500: {
                items: 1,
                nav: false
            },
            768: {
                items: 2,
                nav: false
            },
            991: {
                items: 3,
                nav: true,
                loop: true,
            },
            1192: {
                items: 4,
                nav: true,
                loop: true,
            }
        }
    });
    $('.maleslideContainer').owlCarousel({
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        margin: 30,
        items: 3,
        smartSpeed: 1000,
        autoplayTimeout: 4000,
        mouseDrag: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsiveClass: true,
        responsive: {
             0: {
                items: 1,
                nav: false
            },
            500: {
                items: 1,
                nav: false
            },
            768: {
                items: 2,
                nav: false
            },
            991: {
                items: 3,
                nav: true,
                loop: true,
            },
            1192: {
                items: 4,
                nav: true,
                loop: true,
            }
        }
    });
    
    
    // const filterDropdown = $('#filterDropdown');
    // const filterBottom = $('.filter-bottom');
    // filterDropdown.on("click", function() {
    //     console.log('ok');
    //     filterDropdown.toggleClass("active");
    //     filterBottom.slideToggle("slow");
    // }
    
    $("#filterDropdown").click(function(){
        $(".filter-show").slideToggle();
        
    });
 
 
});