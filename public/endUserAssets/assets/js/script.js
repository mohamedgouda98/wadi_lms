const swiperEl = document.querySelector('swiper-container');
const buttonEl = document.querySelector('.carousel-control-next');
const buttonE2 = document.querySelector('.carousel-control-prev');

buttonEl.addEventListener('click', () => {
  swiperEl.swiper.slideNext();
});

buttonE2.addEventListener('click', () => {
  swiperEl.swiper.slidePrev();
});


// swiper element
const swiperE2 = document.querySelector('swiper-container');

// swiper parameters
const swiperParams = {
  slidesPerView: 1,
  breakpoints: {
    100: {
      slidesPerView: 1,
    },
    991: {
      slidesPerView: 2,
    },
    1400: {
      slidesPerView: 3,
    },
  },
  on: {
    init() {
      // ...
    },
  },
};

// now we need to assign all parameters to Swiper element
Object.assign(swiperE2, swiperParams);

// and now initialize it
swiperEl.initialize();
