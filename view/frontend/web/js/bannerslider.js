require([
    'jquery',
], function ($) {
    $(document).ready(function(){
        const swiper = new Swiper('.swiper',
        {
            spaceBetween: 30,
            centeredSlides: true,
            
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
        });
    })
    
});