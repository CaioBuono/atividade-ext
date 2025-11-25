const swiper = new Swiper('.mySwiper', {
  loop: true,
  grabCursor: true,
  centeredSlides: false,
  spaceBetween: 18,
  autoplay: { delay: 3000, disableOnInteraction: false },
  pagination: { el: '.swiper-pagination', clickable: true },
  navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
  breakpoints: {
    0: { slidesPerView: 1.05 },
    640: { slidesPerView: 2.1 },
    920: { slidesPerView: 3 },
    1200: { slidesPerView: 4 }
  }
});

// Pause autoplay while mouse is over swiper container
const swiperEl = document.querySelector('.mySwiper');
swiperEl.addEventListener('mouseenter', () => swiper.autoplay.stop());
swiperEl.addEventListener('mouseleave', () => swiper.autoplay.start());