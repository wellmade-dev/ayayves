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