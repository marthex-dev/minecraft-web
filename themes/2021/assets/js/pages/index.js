var swiperMain = new Swiper('.swiper-main', {
    direction: 'vertical',
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
});