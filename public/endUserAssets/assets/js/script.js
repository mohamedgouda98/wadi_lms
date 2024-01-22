// navbar navbar-toggler onclick
let open = false

document.querySelector(".show_category").addEventListener('click',()=> {
    if(!open){
        document.getElementById("category_mobile").setAttribute("style","display:block;")
        open=true
    }
    else {
        document.getElementById("category_mobile").setAttribute("style","display:none;")
        open=false
    }
})

let toggeler = false
document.querySelector(".navbar-toggler").addEventListener('click',()=>{
    if(!toggeler) {
        document.getElementById("navbarSupportedContent").setAttribute("style","display:none;")
        document.querySelector(".navBar__mobile__menu").setAttribute("style","display:block;")
        toggeler=true
    }
    else {
        document.querySelector(".navBar__mobile__menu").setAttribute("style","display:none;")
        toggeler=false
    }
})

document.querySelector(".close_mobile_nav").addEventListener('click',()=>{
    document.querySelector(".navBar__mobile__menu").setAttribute("style","display:none;")
    toggeler=false
})




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


