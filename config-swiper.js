const rem = 16;

$(".merch-swiper").each(function (index) {
  const swiperMerch = new Swiper($(this).find(".swiper")[0], {
    breakpoints: {
      922: {
        slidesPerView: "auto",
        spaceBetween: rem * 1.5
      },
      767: {
        slidesPerView: "auto",
        spaceBetween: rem * 1.5
      },
      479: {
        slidesPerView: "auto",
        spaceBetween: rem * 1.5
      }
    },
    slidesPerView: "auto",
    spaceBetween: rem,
    keyboard: true,
    speed: 680,
    followFinger: true,
    mousewheel: {
      forceToAxis: true,
      sensitivity: 1.5
    },
    navigation: {
      nextEl: ".swiper-next",
      prevEl: ".swiper-prev",
      disabledClass: "is--disabled"
    }
  });
});

$(".disco-swiper").each(function (index) {
  const swiperDisco = new Swiper($(this).find(".swiper")[0], {
    breakpoints: {
      922: {
        slidesPerView: "auto",
        spaceBetween: rem * 1.5
      },
      767: {
        slidesPerView: "auto",
        spaceBetween: rem * 1.5
      },
      479: {
        slidesPerView: "auto"
      }
    },
    keyboard: true,
    speed: 680,
    followFinger: true,
    slidesPerView: 1.2,
    spaceBetween: rem * 0.75,
    mousewheel: {
      forceToAxis: true,
      sensitivity: 1.5
    },
    navigation: {
      nextEl: ".swiper-next",
      prevEl: ".swiper-prev",
      disabledClass: "is--disabled"
    }
  });
});