////////////////////////////////////////////////////////////////////////
// Nav // Nav // Nav // Nav // Nav // Nav // Nav // Nav // Nav // Nav //
////////////////////////////////////////////////////////////////////////

const navContainer = document.querySelector(".nav-c");
const nav = navContainer.querySelector(".nav");
const navMobile = nav.querySelector(".nav_mobile");
const navScrollTrigger = navContainer.querySelector(".nav_scrolltrigger");
const navMobileButton = nav.querySelector('a[mobile-menu="true"]');

let navPadding = "1.5rem";
let hasScrolled = false;
let navMobileExpanded = false;

const setNavPadding = () => {
  if (window.innerWidth >= 1440) {
    navPadding = "2rem";
  } else if (window.innerWidth >= 480) {
    navPadding = "1.5rem";
  } else {
    navPadding = "1.25rem";
  }
  if (hasScrolled) {
    navScrolled();
  }
};

setNavPadding();
window.addEventListener("resize", setNavPadding);

function checkScrollPosition() {
    if (window.scrollY < 64) {
      navReset();
    } else {
      navScrolled();
    } 
}
window.addEventListener('scroll', checkScrollPosition);

function navScrolled() {
    if (hasScrolled === false) {
        const navScrolledTimeline = gsap.timeline();
        navScrolledTimeline.to(nav, {
          marginTop: "0.5rem",
          paddingLeft: navPadding,
          paddingRight: navPadding,
          backdropFilter: "blur(20px)",
          backgroundColor: 'rgba(0, 16, 20, 0.75)',
          duration: 0.5,
          ease: "power3.out",
          onComplete: ()=> {
              hasScrolled = true;
          }
        });
    }
}

function navReset() {
  if (!navMobileExpanded) {
    const navResetTimeline = gsap.timeline();
    navResetTimeline.to(nav, {
      marginTop: "0rem",
      paddingLeft: 0,
      paddingRight: 0,
      backdropFilter: "blur(0px)",
      backgroundColor: 'rgba(0, 23, 29, 0)',
      duration: 0.8,
      ease: "power2.out",
      onComplete: ()=> {
        hasScrolled = false;
      }
    });
  }
}

function navMenuClick() {
  if (navMobileExpanded) {
    navShrinkMobile();
  } else {
    navExpandMobile();
  }
}

function navExpandMobile() {
  navMobileExpanded = true;
  navScrolled();
  const navExpandTimeline = gsap.timeline();
  navExpandTimeline.to(navMobile, {
    height: "auto",
    duration: 0.7,
    ease: "power4.inOut"
  });
}

function navShrinkMobile() {
  navMobileExpanded = false;
  if (!hasScrolled) {
    navReset();
  }
  const navShrinkTimeline = gsap.timeline();
  navShrinkTimeline.to(navMobile, {
    height: "0",
    duration: 1,
    ease: "power4.inOut"
  });
}

navMobileButton.addEventListener("click", navMenuClick);


////////////////////////////////////////////////////////////////////////
// MODALS // MODALS // MODALS // MODALS // MODALS // MODALS // MODALS //
////////////////////////////////////////////////////////////////////////

function setModal(modalFrame, modalTint, modal) {
  modalFrame.style.display = "none";
  modal.style.display = "none";
  modal.style.transform = "translateY(130%)";
  modalTint.style.opacity = 0;
}

function revealModal(modalFrame, modalTint, modal) {
  modalFrame.style.display = "block";
  modal.style.display = "block";

  // Animation timeline for showing the modal
  const revealModalTimeline = gsap.timeline();
  revealModalTimeline
    .to(modalTint, { opacity: 0.75, duration: 1 })
    .to(modal, { y: 0, duration: 1, ease: "expo.out" }, "-=1");

  let closeButton = modal.querySelector(".button--close");
  closeButton.addEventListener("click", function () {
    hideModal(modalFrame, modalTint, modal);
  });
}

function hideModal(modalFrame, modalTint, modal) {
  const hideModalTimeline = gsap.timeline();
  hideModalTimeline
    .to(modalTint, { opacity: 0, duration: 0.8 })
    .to(
      modal,
      {
        y: "130%",
        duration: 0.8,
        ease: "power1.inOut"
      },
      "-=0.8"
    )
    .call(() => {
      setModal(modalFrame, modalTint, modal);
    });
}

// Item CTA Click
document.addEventListener("DOMContentLoaded", function () {
  // Disco Item CTA
  const itemHero = document.querySelector(".section--item-hero");
  const modalFrame = document.querySelector(".modal-frame");
  const modalTint = modalFrame.querySelector(".modal-frame_tint");

  if (itemHero) {
    const itemCTA = itemHero.querySelector(".button--marquee");
    itemCTA.addEventListener("click", function () {
      const modal = modalFrame.querySelector(".modal.is--item-stream");
      setModal(modalFrame, modalTint, modal);
      revealModal(modalFrame, modalTint, modal);
    });
  }

  // Contact CTA
  const streamButtons = document.querySelectorAll('a[stream="true"]');
  streamButtons.forEach((streamButton) => {
    streamButton.addEventListener("click", function () {
      const modal = modalFrame.querySelector(".modal.is--stream");
      setModal(modalFrame, modalTint, modal);
      revealModal(modalFrame, modalTint, modal);
    });
  });

  // Contact CTA
  const contactButtons = document.querySelectorAll('a[contact="true"]');
  contactButtons.forEach((contactButton) => {
    contactButton.addEventListener("click", function () {
      const modal = modalFrame.querySelector(".modal.is--contact");
      setModal(modalFrame, modalTint, modal);
      revealModal(modalFrame, modalTint, modal);
    });
  });

  // Notify CTA
  const notifyButtons = document.querySelectorAll('a[notify="true"]');
  notifyButtons.forEach((notifyButton) => {
    notifyButton.addEventListener("click", function () {
      const modal = modalFrame.querySelector(".modal.is--notify");
      setModal(modalFrame, modalTint, modal);
      revealModal(modalFrame, modalTint, modal);
    });
  });
});

//////////////////////////////////////////////////////////////////////////
// GSAP // GSAP // GSAP // GSAP // GSAP // GSAP // GSAP // GSAP // GSAP //
//////////////////////////////////////////////////////////////////////////

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
