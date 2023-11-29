// Set Page Load Animation Parameters
const loadDuration = "1";
CustomEase.create("loadWipe", "M0,0,C0.558,0,0.266,1,1,1");

// Page Wipe on Load
gsap.set("load", { bottom: "auto", top: 0 });
gsap.to(".load", {
  height: "0",
  duration: loadDuration,
  ease: "loadWipe"
});
gsap.set("load", { display: "none", bottom: 0, top: "auto" });

// Page Transition
$(document).ready(function () {
  $("a").on("click", function (e) {
    if (
      $(this).prop("hostname") === window.location.host &&
      $(this).attr("href").indexOf("#") === -1 &&
      $(this).attr("target") !== "_blank"
    ) {
      e.preventDefault();
      let destination = $(this).attr("href");
      gsap.set(".load", { display: "flex" });
      gsap.fromTo(
        ".load",
        {
          height: "0vh"
        },
        {
          height: "100vh",
          duration: loadDuration,
          ease: "loadWipe",
          onComplete: () => {
            window.location = destination;
          }
        }
      );
    }
  });
});

// Hero Background Parallax
gsap.to(".hero_bg-video", {
  y: "25%",
  ease: "cubic-bezier(0, 0, 1, 1)",
  scrollTrigger: {
    trigger: ".section-hero",
    scrub: true,
    start: "top top",
    end: "bottom top"
  }
});

// Arrow Buttons
let arrowsLeft = document.querySelectorAll(".button--arrow.swiper-prev");

arrowsLeft.forEach((arrowLeft) => {
  arrowLeft.addEventListener("mouseenter", () => {
    // Check if the arrowLeft element doesn't have the class ".is--disabled" on mouse enter
    if (!arrowLeft.classList.contains("is--disabled")) {
      // On hover in: move all child elements with class ".button--arrow-wrap" to the left
      gsap.to(arrowLeft.querySelectorAll(".button--arrow-wrap"), {
        x: "-100%",
        duration: 0.3,
        onComplete: () =>
          gsap.set(arrowLeft.querySelectorAll(".button--arrow-wrap"), {
            x: "0%"
          })
      });
    }
  });

  arrowLeft.addEventListener("mouseleave", () => {
    // On hover out: move all child elements with class ".button--arrow-wrap" back to their original position
    gsap.to(arrowLeft.querySelectorAll(".button--arrow-wrap"), {
      x: "0%",
      duration: 0.3,
      onComplete: () =>
        gsap.set(arrowLeft.querySelectorAll(".button--arrow-wrap"), {
          x: "0%"
        })
    });
  });
});

// Arrow Button Right
let arrowsRight = document.querySelectorAll(".button--arrow.swiper-next");

arrowsRight.forEach((arrowRight) => {
  arrowRight.addEventListener("mouseenter", () => {
    // Check if the arrowLeft element doesn't have the class ".is--disabled" on mouse enter
    if (!arrowRight.classList.contains("is--disabled")) {
      // On hover in: move all child elements with class ".button--arrow-wrap" to the left
      gsap.to(arrowRight.querySelectorAll(".button--arrow-wrap"), {
        x: "100%",
        duration: 0.3,
        onComplete: () =>
          gsap.set(arrowRight.querySelectorAll(".button--arrow-wrap"), {
            x: "0%"
          })
      });
    }
  });

  arrowRight.addEventListener("mouseleave", () => {
    // On hover out: move all child elements with class ".button--arrow-wrap" back to their original position
    gsap.to(arrowRight.querySelectorAll(".button--arrow-wrap"), {
      x: "0%",
      duration: 0.3,
      onComplete: () =>
        gsap.set(arrowRight.querySelectorAll(".button--arrow-wrap"), {
          x: "0%"
        })
    });
  });
});

// Primary Button Hover
let buttonsPrimary = document.querySelectorAll(".button--primary");
let btnPrimaryEase = "power3.out";

buttonsPrimary.forEach((buttonPrimary) => {
  buttonPrimary.addEventListener("mouseenter", () => {
    gsap.to(buttonPrimary.querySelectorAll(".star_circle"), {
      x: "3.15rem",
      duration: 0.4,
      ease: btnPrimaryEase
    });
    gsap.to(buttonPrimary.querySelector(".o-button--primary"), {
      x: "2.5rem",
      duration: 0.4,
      ease: btnPrimaryEase
    });
  });
});

buttonsPrimary.forEach((buttonPrimary) => {
  buttonPrimary.addEventListener("mouseleave", () => {
    gsap.to(buttonPrimary.querySelectorAll(".star_circle"), {
      x: "0",
      duration: 0.4,
      ease: btnPrimaryEase
    });
    gsap.to(buttonPrimary.querySelector(".o-button--primary"), {
      x: "0",
      duration: 0.4,
      ease: btnPrimaryEase
    });
  });
});

// Secondary Button Hover
let buttonsSecondary = document.querySelectorAll(".button--secondary");

buttonsSecondary.forEach((buttonSecondary) => {
  buttonSecondary.addEventListener("mouseenter", () => {
    gsap.to(buttonSecondary.querySelectorAll(".star_circle"), {
      x: "1.7rem",
      duration: 0.3,
      ease: "power4"
    });
    gsap.to(buttonSecondary.querySelector(".o-button"), {
      x: "1.4rem",
      duration: 0.3,
      ease: "power4"
    });
  });
});

buttonsSecondary.forEach((buttonSecondary) => {
  buttonSecondary.addEventListener("mouseleave", () => {
    gsap.to(buttonSecondary.querySelectorAll(".star_circle"), {
      x: "0",
      duration: 0.4,
      ease: "power2"
    });
    gsap.to(buttonSecondary.querySelector(".o-button"), {
      x: "0",
      duration: 0.4,
      ease: "power2"
    });
  });
});

// Accordions
document.addEventListener("DOMContentLoaded", function () {
  const contentWraps = document.querySelectorAll(".accordion__content-wrap");
  contentWraps.forEach((contentWrap) => {
    contentWrap.style.height = "0px";
  });

  const accordions = document.querySelectorAll(".accordion__title");

  accordions.forEach((accordion) => {
    accordion.addEventListener("click", function () {
      const contentWrap = this.nextElementSibling;
      const isOpen =
        contentWrap.style.height === "auto" || contentWrap.style.height === "";

      const accordionOpenWrap = this.querySelector(".accordion__open-wrap");
      const accordionCloseWrap = this.querySelector(".accordion__close-wrap");
      const accordionDuration = "0.3";
      const accordionEasing = "power2.Out";

      if (isOpen) {
        gsap.to(contentWrap, {
          height: 0,
          duration: accordionDuration,
          ease: accordionEasing
        });

        gsap.to(accordionOpenWrap, {
          y: "0%",
          duration: accordionDuration,
          ease: accordionEasing
        });

        gsap.to(accordionCloseWrap, {
          y: "0%",
          duration: accordionDuration,
          ease: accordionEasing
        });
      } else {
        gsap.to(contentWrap, {
          height: "auto",
          duration: accordionDuration,
          ease: accordionEasing
        });

        gsap.to(accordionOpenWrap, {
          y: "-100%",
          duration: accordionDuration,
          ease: accordionEasing
        });

        gsap.to(accordionCloseWrap, {
          y: "-100%",
          duration: accordionDuration,
          ease: accordionEasing
        });
      }
    });
  });
});

// Live Grid Scrolltrigger
const liveGrid = document.querySelector(".section-live-grid");
if (liveGrid) {
  const gridImages = liveGrid.querySelectorAll(".live-grid_image");
  const gridColumnsSide = liveGrid.querySelectorAll(
    ".live-grid_column.is--side"
  );
  const gridColumnCentre = liveGrid.querySelector(
    ".live-grid_column.is--centre"
  );

  const gridTimeline = gsap.timeline({
    scrollTrigger: {
      trigger: liveGrid,
      start: "top bottom",
      end: "bottom top",
      scrub: true
    }
  });

  gridTimeline
    .to(
      gridImages,
      {
        scale: "1",
        ease: "none"
      },
      "start"
    )
    .fromTo(
      gridColumnsSide,
      {
        y: "-5%"
      },
      {
        y: "5%",
        ease: "none"
      },
      "start"
    )
    .fromTo(
      gridColumnCentre,
      {
        y: "0%"
      },
      {
        y: "-10%",
        ease: "none"
      },
      "start"
    );
}

// Marquee Button
const buttonMarquees = document.querySelectorAll(".button--marquee_block-wrap");

function animateMarqueeButtons() {
  buttonMarquees.forEach((buttonMarquee) => {
    buttonMarquee.style.transition = "none";
    buttonMarquee.style.transform = "translateX(0)";
  });

  setTimeout(() => {
    buttonMarquees.forEach((buttonMarquee) => {
      buttonMarquee.style.transition = "transform 20s cubic-bezier(0, 0, 1, 1)";
      buttonMarquee.style.transform = "translateX(-100%)";
    });

    setTimeout(() => {
      animateMarqueeButtons();
    }, 20000); // Reset after 20 seconds
  }, 0.01); // Delay before starting the animation
}

animateMarqueeButtons();

// Footer Marquee
const footerMarqueeBlockWraps = document.querySelectorAll(
  ".footer_marquee-block-wrap"
);

function animateFooterMarquee() {
  footerMarqueeBlockWraps.forEach((footerMarqueeBlockWrap) => {
    footerMarqueeBlockWrap.style.transition = "none";
    footerMarqueeBlockWrap.style.transform = "translateX(0)";
  });

  setTimeout(() => {
    footerMarqueeBlockWraps.forEach((footerMarqueeBlockWrap) => {
      footerMarqueeBlockWrap.style.transition =
        "transform 30s cubic-bezier(0, 0, 1, 1)";
      footerMarqueeBlockWrap.style.transform = "translateX(-100%)";
    });

    setTimeout(() => {
      animateFooterMarquee();
    }, 30000); // Reset after 20 seconds
  }, 0.01); // Delay before starting the animation
}

animateFooterMarquee();
