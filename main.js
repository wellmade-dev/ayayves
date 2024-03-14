///////////////////////////////////////////////////////////////////////
// Page Initialisation // Page Initialisation // Page Initialisation //
///////////////////////////////////////////////////////////////////////

function initGSAPLenis() {
  gsap.registerPlugin(ScrollTrigger);
  ScrollTrigger.config({ ignoreMobileResize: true });

  "use strict";

  lenis = new Lenis({
    duration: 0.9,
    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
    direction: "vertical",
    gestureDirection: "vertical",
    smooth: false,
    mouseMultiplier: 0.6,
    smoothTouch: false,
    touchMultiplier: 1.2,
    infinite: false
  });

  function connectToScrollTrigger() {
    lenis.on("scroll", ScrollTrigger.update);
    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });
  }

  connectToScrollTrigger();

  return ScrollTrigger;
}



function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

let windowWidth = window.innerWidth;

function onResize(passedFunction) {
  if (window.innerWidth !== windowWidth) {
      windowWidth = window.innerWidth;

    passedFunction();
  }
}

function initWindowResize() {
  window.addEventListener('resize', throttle(() => onResize(initMarquees), 250));
};

document.addEventListener('DOMContentLoaded', function () {
  initPage();
});

function initPage(container) {
  initGSAPLenis();
  initWindowResize();
  initMenuInteraction();
  initModals();
  initMarquees();
  initNavFooterLinks();
  initReleaseLinks();
  initLinkTransitionListeners()

  if /* Home */ (window.location.pathname === "/" || window.location.pathname.startsWith("/page-home.html")) {
    lazyloadHeroVideo();
    heroParallax();
    initMerchSlider();
    initGlassDisplayButtons(); 
    initSolidDisplayButtons();

    // Live Grid Animation
    scrollGridAnimation();

    // Hero Image in Shows Section Parallax
    imageParallax(document.querySelector(".section-shows img"), "top bottom", "bottom top", "0%", "30%",);

    // Show Event Interaction
    showItemHover();

    // Double Card Section Parallax
    doublecardVerticalSpeed();
    imageParallax(document.querySelector(".section-doublecard img"), "top bottom", "bottom top", "0%", "10%", );

    // Discography Section
    discographyHomeTimeline();
    releaseCardHover();

  } else if /* Product */ (window.location.pathname.startsWith("/product/")) {
    productNavigationMenu();
    initVariantOptions();
    initAccordions();
    initMerchSlider();
    initGlassDisplayButtons(); 
    setMobileNavOnDesktop();

  } else if /* Shop Archive */ (window.location.pathname.startsWith("/shop/")) {
    initMerchArchiveSlider(); //

  } else if /* Release */ (window.location.pathname.startsWith("/release/")) {
    lazyloadHeroVideo();
    heroParallax();
    initGlassDisplayButtons(); 
    releaseCardHover();
  
    if (window.location.pathname === "/release/") {
      initReleaseArchiveSlider()
    } else {
      initReleaseSlider();
    }
    
  } else if /* Cart */ (window.location.pathname.startsWith("/cart/")) {
    initUpdateCartButton(); //
  }

  animatePageLoad()
};


//////////////////////////////////////////////////////////////
// Transitions // Transitions // Transitions // Transitions //
//////////////////////////////////////////////////////////////

let loaderCopy;
wipeIn = "power3.out";
wipeOut = CustomEase.create("custom", "M0,0 C0.3,0 0.387,0.256 0.455,0.512 0.517,0.75 0.599,1 1,1 ");

async function animatePageLoad() {
  const loader = document.querySelector('.loader');
  svgEase = CustomEase.create("custom", "M0,0 C0.399,0 0.446,0.304 0.5,0.5 0.523,0.587 0.499,0.949 1,1 ");

  loaderCopy = loader.cloneNode(true);

  if /* Home */ (window.location.pathname === "/") {
    await new Promise(resolve => setTimeout(resolve, 500));
    await animateLoaderLogo(loader);
/*     await new Promise(resolve => setTimeout(resolve, 500)); */
    await dismissPageLoader(loader);

  } else if /* Cart */ (window.location.pathname.startsWith("/cart/")) {
    dismissPageLoaderCart(loader);

  } else if /* Checkout */ (window.location.pathname.startsWith("/checkout/")) {
    dismissPageLoaderCheckout(loader);

  } else /* Any Other Page */{
    await dismissPageLoader(loader);
  }
  loader.remove();
}

// Animate Loader Logo
function animateLoaderLogo(loader) {
  const svg = loader.querySelector("svg");
  return new Promise(resolve => {
    gsap.to(svg, {
      y: "0%",
      duration: 1,
      ease: svgEase,
      onComplete: resolve
    });
  });
}

// Dismiss Page Loader
function dismissPageLoader(loader) {
  const loaderInner = loader.querySelector(".loader-inner");
  const tint = loader.querySelector(".bg-tint");
  const svgWrapper = loader.querySelector('.logo-w');
  const svg = loader.querySelector("svg");

  gsap.set(svg, { y: 0 })
  
  return new Promise(resolve => {
    gsap.fromTo(tint, {
      opacity: 0.6,
    }, {
      opacity: 0,
      duration: 1,
      ease: wipeOut,
    });
    gsap.to(svgWrapper, {
      y: "30%",
      opacity: 0,
      duration: 0.4,
      ease: "power2.in",
    });
    gsap.to(loaderInner, {
      clipPath: "inset(0 0 100% 0)",
      duration: 1,
      ease: wipeOut,
      delay: 0.3,
      onComplete: resolve
    });
  });
}

// Append Loader to DOM and Reset Logo & Logo Wrapper
function appendLoaderAndReset() {
  document.body.appendChild(loaderCopy);
  const loader = document.querySelector(".loader");
    const svgWrapper = loader.querySelector('.logo-w');
    const svg = loader.querySelector('svg');

    svgWrapper.style.cssText = '';
    svg.style.cssText = '';

    gsap.set(svg, { y: 0 })
}

// Add Loader Back to DOM and Animate In
function animateLoaderIn(destination) {
  appendLoaderAndReset();
  const loader = document.querySelector(".loader");
  const loaderInner = loader.querySelector(".loader-inner");
  const tint = loader.querySelector(".bg-tint");
  const svg = loader.querySelector("svg");

  gsap.fromTo(svg, { y: "-140%"}, {
    y: "0%",
    duration: 1,
    ease: svgEase,
  });
  gsap.fromTo(tint, { opacity: 0 }, {
    opacity: 0.3,
    duration: 1,
  });
  gsap.fromTo(loaderInner, { clipPath: "inset(100% 0% 0% 0%)" }, {
    clipPath: "inset(0% 0% 0% 0%)",
    duration: 1.2,
    ease: wipeIn,
    onComplete: () => {
      window.location = destination;
    }
  });
};

// Fade the Loader and Stagger Each Checkout Card
function dismissPageLoaderCheckout(loader) {
  return new Promise(resolve => {
    gsap.to(loader, {
      opacity: 0,
      duration: 1,
    });
    gsap.from(".wc-block-components-sidebar-layout > *", {
      duration: 0.5,
      opacity: 0,
      y: 32,
      stagger: 0.15,
      ease: "power1.out",
      onComplete: () => {
        resolve
      }
    });
  });
}

// Fade the Loader and Stagger Each Cart Card
function dismissPageLoaderCart(loader) {
  cartContent = "div[data-block-name='woocommerce/classic-shortcode'] > *";

  return new Promise(resolve => {
    gsap.to(loader, {
      opacity: 0,
      duration: 1,
    });
    gsap.from("h1", {
      opacity: 0,
      y: 32,
      duration: 0.5,
    });
    gsap.from(cartContent, {
      duration: 0.5,
      opacity: 0,
      y: 32,
      stagger: 0.15,
      delay: 0,
      ease: "power1.out",
      onComplete: () => {
        resolve
      }
    });
  });
}

function initLinkTransitionListeners() {
  const excludedPaths = ["/cart/", "/checkout/"];

  if (!excludedPaths.some(path => window.location.pathname.startsWith(path))) {
    document.querySelectorAll("a").forEach(function (link) {
      link.addEventListener("click", function (e) {
        let hostname = e.currentTarget.hostname;
        const href = e.currentTarget.getAttribute("href");
        const target = e.currentTarget.getAttribute("target");

        if (hostname === "127.0.0.1") {
          hostname = "127.0.0.1:8000";
        };        

        if (hostname === window.location.host && href.indexOf("#") === -1 && href.indexOf("#") === -1) {
          if (loaderCopy) {
          e.preventDefault();
          let destination = href;
          animateLoaderIn(destination);
          }
        }
      });
    });

    // On click of the back button
    window.onpageshow = function (event) {
      if (event.persisted) {
        window.location.reload();
      }
    };
  }
};

//////////////////////////////////////////////////////////
// Animations // Animations // Animations // Animations //
//////////////////////////////////////////////////////////

// Custom Branded Easing
easingMedium = CustomEase.create("custom", "M0,0 C0.288,0 0.199,0.599 0.4,0.8 0.609,1.011 0.898,1 1,1 ");

function lazyloadHeroVideo() {
  const videoBackground = document.querySelector(".section-hero .bg-content.video-w");
  const video = videoBackground?.querySelector('video');

  if (video && video.getAttribute('data-src')) {
    video.src = video.getAttribute('data-src');
    video.onloadeddata = () => {
      gsap.to(video, {
        opacity: 1,
        duration: 0.5,
      });
    };
  }
}

// Hero Background Parallax
function heroParallax() {
  const heroSection = document.querySelector(".section-hero");
	if (heroSection) {
		const background = heroSection.querySelector(".bg-content");
		const tint = heroSection.querySelector(".bg-tint");
		
		if (background) {
			let heroTimeline = gsap.timeline({
				scrollTrigger: {
					trigger: ".section-hero",
					start: "top top",
					end: "bottom top",
					scrub: true
				}
			});

			heroTimeline.to(background, {
				y: "-25vh",
				ease: "none"
			}, 0)
			.to(tint, {
				opacity: 1,
				ease: "none",
				immediateRender: false
			}, 0);
		}
	}
}

// Image Parallax Function
function imageParallax(image, start, end, startPosition, endPosition) {
	if (image) {
	  gsap.timeline({
		scrollTrigger: {
			trigger: image,
			start: start,
			end: end,
			scrub: true
		}
	  })
		.fromTo(image, { y: startPosition }, { y: endPosition, ease: "none" }, "start")
	} else {
		console.log("can't find image")
	}
}

// Live Grid Scrolling
function scrollGridAnimation() {
	const scrollGrid = document.querySelector(".section-scrollgrid");

	if (scrollGrid) {
	  const ribbonImages = scrollGrid.querySelectorAll("img");
	  const ribbons = scrollGrid.querySelectorAll(".ribbon");
	
	  gsap.timeline({
		scrollTrigger: {
		  trigger: scrollGrid,
		  start: "top bottom",
		  end: "bottom top",
		  scrub: true
		}
	  })
		.to(ribbonImages, { scale: "1", ease: "none" }, "start")
		.fromTo(ribbons[0], { y: "-5%" }, { y: "5%", ease: "none" }, "start")
		.fromTo(ribbons[1], { y: "10%" }, { y: "0%", ease: "none" }, "start")
		.fromTo(ribbons[2], { y: "-5%" }, { y: "5%", ease: "none" }, "start");
	}
}

// Double Card Vertical Speed
function doublecardVerticalSpeed() {
	const doublecardSection = document.querySelector(".section-doublecard");

	if (doublecardSection) {
  		const cards = doublecardSection.querySelectorAll(".card");

		gsap.timeline({
			scrollTrigger: {
			trigger: doublecardSection,
			start: "top bottom",
			end: "bottom top",
			scrub: true
			}
		})

	.fromTo(cards[0], { y: "10%" }, { y: "0%", ease: "none" }, "start")
	.fromTo(cards[1], { y: "0%" }, { y: "-60%", ease: "power1.in" }, "start")
	}
}

// Discography Section GSAP Timeline
function discographyHomeTimeline() {
	const discographySection = document.querySelector(".section-discography");
	const releaseTiles = document.querySelectorAll(".release-tile");

	if (discographySection) {
	const sticky = discographySection.querySelector(".sticky-w")
	const imageWrap = discographySection.querySelector(".image-w");
	const image = discographySection.querySelector(".background-img");
	const tint = discographySection.querySelector(".bg-tint");
	const releaseWrapper = discographySection.querySelector(".discography-w")
	const img = image.querySelector("img");
	const releaseTiles = discographySection.querySelectorAll(".release-tile");

	const sectionTimeline = gsap.timeline({
		scrollTrigger: {
		trigger: sticky,
		start: "top 20%",
		end: "bottom bottom",
		scrub: true
		}
	});

	sectionTimeline
		.to(image, { width: "100vw", height: "100vh", ease: "power1.inOut" }, "start")
		.to(image, { borderRadius: 0, ease: "power4.in" }, "start")
		.fromTo(tint, { opacity: 0 }, { opacity: 0.5, ease: "power1.in" }, "start")
	
	const releaseTimeline = gsap.timeline({
		scrollTrigger: {
		trigger: releaseWrapper,
		start: "top bottom",
		end: "bottom top",
		scrub: true
		}
	})

	releaseTimeline
		.fromTo(img, {y: "0%"}, {y: "-35%"}, "start")

	// Background Image Parallax during Release Tile Fly By
	imageParallax(img, "top bottom", "center center", "-10%", "0%");

	releaseTiles.forEach((releaseTile) => {
		imageParallax(releaseTile.querySelector("img"), "top bottom", "bottom top", "0%", "15%");
	})
	}
}

function setMarquee(marquee, speed) {
    if (!marquee) return null;
  
    // Remove existing GSAP animations if any
    if (marquee.marqueeTimeline) {
      marquee.marqueeTimeline.kill();
    }

    let marqueeSplits = marquee.querySelectorAll('.marquee-split');
    marqueeSplits.forEach((split, index) => {
      if (index > 0) {
        split.remove();
      }
    });

    const marqueeSplit = marquee.querySelector('.marquee-split');
    const marqueeBlock = marqueeSplit?.querySelector('.marquee-block');
    if (!marqueeSplit || !marqueeBlock) return;
  
    marqueeSplit.innerHTML = '';
    marqueeSplit.appendChild(marqueeBlock.cloneNode(true));
  
    const marqueeWidth = marquee.offsetWidth;
    let totalWidth = marqueeBlock.offsetWidth;
  
    while (totalWidth < marqueeWidth) {
      const cloneBlock = marqueeBlock.cloneNode(true);
      marqueeSplit.appendChild(cloneBlock);
      totalWidth += cloneBlock.offsetWidth;
    }
  
    const duplicatedMarqueeSplit = marqueeSplit.cloneNode(true);
    marquee.appendChild(duplicatedMarqueeSplit);
  
    marqueeSplits = marquee.querySelectorAll('.marquee-split');
    gsap.set(marqueeSplits, { x: 0 });

    let marqueeTimeline = gsap.timeline({
      repeat: -1, 
      defaults: { ease: "linear" }
    });

    marqueeSplits.forEach((split) => {
      marqueeTimeline.to(split, { x: "-100%", duration: speed }, 0);
    });

    // Store the timeline in the marquee element for later reference
    marquee.marqueeTimeline = marqueeTimeline;

    return marqueeTimeline;
}


  
// Define the Initisalise Marquees function
function initMarquees() {

	const marquees = [
		{
			element: () => document.querySelector(".header-marquee"),
			timeline: null,
			speed: 60
		},
		{
			element: () => document.querySelector(".footer-marquee"),
			timeline: null,
			speed: 30
		},
		{
			element: () => document.querySelector(".button--marquee"),
			timeline: null,
			speed: 22
		}, 
		{
			element: () => document.querySelector(".archive-marquee"),
			timeline: null,
			speed: 120
		}
	];

	marquees.forEach(marquee => {
		if (marquee.timeline) {
		marquee.timeline.kill();
		}

		// Reinitialise Marquee and store New Timeline
		marquee.timeline = setMarquee(marquee.element(), marquee.speed);
	});
}

//////////////////////////////////////////////////////////////////
// Interactions // Interactions // Interactions // Interactions //
//////////////////////////////////////////////////////////////////

// Toggle Page Scroll
function togglePageScroll(enable) {
  if (enable) {
    document.body.style.overflow = '';
    lenis.start();
  } else {
    document.body.style.overflow = 'hidden';
    lenis.stop();
  }
}

// On Escape Press
function handleEscapePress(event, eventFunction) {
    // Check if the key pressed is Escape
    if (event.key === 'Escape') {
        eventFunction();
    }
};


// Dim Link List Siblings on Hover
function animateLinkGroups(target, isHoveringIn, config) {
  if (!target) {
    return
  };

  const children = Array.from(target.parentNode.children);

  const siblings = children.filter(
    (sibling) => sibling !== target
  );

  const defaultConfig = {
    dim: false,
    dimOpacity: 0.5,
    dimDuration: 0.3,
    dimEase: "none",
    ticker: false,
    tickerDuration: false,
    addClass: false,
    className: null,
  };

  // Merge default config with passed-in config
  const {
    dim,
    dimOpacity,
    dimDuration,
    dimEase,
    ticker,
    tickerDuration,
  } = { ...defaultConfig, ...config };

  if (isHoveringIn) {
    if (dim) {
      gsap.to(target, { opacity: 1, duration: dimDuration, ease: dimEase, overwrite: true });
      siblings.forEach(sibling => {
        gsap.to(sibling, { opacity: dimOpacity, duration: dimDuration, ease: dimEase, overwrite: true });
      })
    }
    if (ticker) {
      tickerLinkHover(target, false, tickerDuration);
    }
  } else {
    children.forEach(child => {
      gsap.to(child, { opacity: 1, duration: dimDuration, ease: dimEase, overwrite: true }); // Reset Opacity
    });
  }
}

// Animate Ticker Label on Button
function tickerLinkHover(input, newLabel, customDuration, manualLabelReset) {
  const labelText = input.querySelector(".label");
  const labelWrapper = labelText.parentNode;
  const animationDuration = customDuration || 0.25 ;
  const animationEase = "power1.out";

  function resetLinkLabel() {
    const duplicatedLabel = labelWrapper.querySelector(".duplicated-label");
    gsap.to(labelText, { y: 0, duration: animationDuration, ease: animationEase });
    gsap.to(duplicatedLabel, {
      y: "100%", duration: animationDuration, ease: animationEase,
      onComplete: () => {
        duplicatedLabel?.remove();
        if (!manualLabelReset) {
          input.removeEventListener('mouseout', resetLinkLabel);
        }
      }
    });
  }

  let duplicatedLabel = input.querySelector(".duplicated-label");
  if (duplicatedLabel) {
    resetLinkLabel(duplicatedLabel);
    return
  }

  // Logic for hover in
  duplicatedLabel = labelText.cloneNode(true);
  Object.assign(duplicatedLabel.style, {
    position: 'absolute',
    top: '0',
    left: '0',
    width: '100%',
  });
  duplicatedLabel.classList.add("duplicated-label");

  if (newLabel) {
    duplicatedLabel.textContent = newLabel;
  }

  labelWrapper.appendChild(duplicatedLabel);

  // Start animation for hover in
  gsap.to(labelText, { y: "-100%", duration: animationDuration, ease: animationEase });
  gsap.from(duplicatedLabel, { y: "100%", duration: animationDuration, ease: animationEase });

  // Attach the mouse-out event listener to handle automatic mouse-out animation
  if (!manualLabelReset) {
    input.addEventListener('mouseout', resetLinkLabel);
  }
}

function initLinkGroups(parent, targetClass, config, outConfig) {
  parent.addEventListener('mouseover', function (event) {
    let targetElement = event.target.closest(targetClass);
    if (targetElement && this.contains(targetElement)) {
      animateLinkGroups(targetElement, true, config)
    }
  })

  parent.addEventListener('mouseout', function (event) {
    let targetElement = event.target.closest(targetClass);
    if (targetElement && this.contains(targetElement)) {
      animateLinkGroups(targetElement, false, outConfig || config)
    }
  })
}

function initNavFooterLinks() {
  // Init Links in Navigation Bar
  initLinkGroups(navigation, '.navigation-link', {
    dim: true,
    dimOpacity: 0.5,
    dimDuration: 0.2,
    dimEase: "none",
    ticker: true,
    translateX: false,
  });

  const footerLinkWrapper = document.querySelector(".footer-link-w");

  if (footerLinkWrapper) {
    initLinkGroups(footerLinkWrapper, '.footer-link', {
      dim: true,
      dimOpacity: 0.5,
      dimDuration: 0.2,
      dimEase: "none",
      ticker: true,
      tickerDuration: 0.3,
      translateX: false,
    })
  }
}

// Menu Button Animation
const navigation = document.getElementById('navigation');
const navigationMenu = navigation.querySelector(".navigation-menu");
const navMenuButton = navigation.querySelector(".menu-button");
const menuIconWrapper = navMenuButton.querySelector(".menu-icon");
const menuIconLineOne = navMenuButton.querySelector(".line:nth-child(1)");
const menuIconLineTwo = navMenuButton.querySelector(".line:nth-child(2)");
const navDesktopLinks = navigation.querySelector(".desktop-links");
const navMobileLinks = navigation.querySelector(".mobile-links");
let navTheme = null;

function animateMenuButton(isOpening) {
  const gap = isOpening ? 0 : "0.325rem";
  const lineWidth = isOpening ? "75%" : "100%";

  gsap.to(menuIconWrapper, { gap, duration: 0.75, ease: easingMedium });
  gsap.to([menuIconLineOne, menuIconLineTwo], {
    duration: 0.75,
    ease: easingMedium,
    width: lineWidth,
    rotation: index => (isOpening ? (index === 0 ? 135 : 45) : 0),
    y: index => (isOpening ? (index === 0 ? 0.5 : -0.5) : 0.5),
  });
}

function toggleNavigationMenu() {
  const isOpening = navMenuButton.getAttribute('aria-expanded') === 'false';
  const navImageColumn = navigationMenu.querySelector('.image-col');
  const navImageBack = navImageColumn.querySelector(".img-w:nth-child(1)");
  const navImageFront = navImageColumn.querySelector(".img-w:nth-child(2)");
  const primaryLinksWrapper = navigationMenu.querySelector(".primary-links-w");
  const primaryLinkLabels = primaryLinksWrapper.querySelectorAll(".label");
  const secondaryLinksWrapper = navigationMenu.querySelector(".secondary-links-w");
  
  if (isOpening && navigation.hasAttribute('theme')) {
    navTheme = navigation.getAttribute('theme');
  }

  if (isOpening) {
    navigation.setAttribute('theme', 'secondary');
  } else {
    setTimeout(function() {
    if (navTheme !== null) {
      navigation.setAttribute('theme', navTheme);
      console.log(navTheme);
    } else {
      navigation.removeAttribute('theme');
    }
  }, 750);    
  }


  const tl = gsap.timeline({
    onStart: () => {
      togglePageScroll(isOpening ? false : true);
      gsap.set(navigationMenu, { display: "flex" });
      animateMenuButton(isOpening);
      tickerLinkHover(navMenuButton, isOpening ? "Close" : "Menu", 0.4, true);
      if (isOpening) {
        gsap.set(navImageFront, { y: "2.5rem" });
        gsap.set(navImageBack, { y: "4rem" });
        gsap.set(primaryLinkLabels, { y: "-2rem", autoAlpha: 0 });
        gsap.set(secondaryLinksWrapper, { autoAlpha: 0, y: "-0.5rem" });
      }
    },
    onComplete: () => {
      if (isOpening) { document.addEventListener('keydown', onEscapePressNav); } else {
        document.removeEventListener('keydown', onEscapePressNav);
        gsap.set(navigationMenu, { display: "none" });
      }
      navMenuButton.setAttribute('aria-expanded', isOpening ? "true" : "false");
    }
  });

  // Stagger In/Out Navbar Items
  tl.to(navDesktopLinks.children, {
    duration: 0.175,
    autoAlpha: (isOpening ? 0 : 1),
    y: (isOpening ? "-0.5rem" : 0),
    stagger: (isOpening ? 0.15 : -0.15),
    ease: "power1.out",
  }, 0);

  tl.to(navMobileLinks.children, {
    duration: 0.175,
    autoAlpha: (isOpening ? 0 : 1),
    y: (isOpening ? "-0.5rem" : 0),
    stagger: (isOpening ? 0.15 : -0.15),
    ease: "power1.out",
  }, 0);

  // Open Navigation Menu
  tl.to(navigationMenu, {
    clipPath: (isOpening ? "inset(0% 0% 0% 0%)" : "inset(0% 0% 100% 0%)"),
    duration: 1,
    ease: wipeOut,
  }, (isOpening ? 0 : 0.2));

  // Reveal Image Cards
  tl.to(navImageFront, {
    duration: 1,
    y: (isOpening ? 0 : "2.5rem"),
    ease: (isOpening ? "power2.out" : "power2.in" ),
  }, (isOpening ? 0.25 : 0));

  tl.to(navImageBack, {
    duration: 1,
    y: (isOpening ? 0 : "4rem" ),
    ease: (isOpening ? "power2.out" : "power2.in" ),
  }, (isOpening ? 0.25 : 0));

  
  // Stagger Reveal Primary Links
  tl.to(primaryLinkLabels, {
    duration: (isOpening ? 0.75 : 0.75),
    y: (isOpening ? 0 : "-1rem"),
    stagger: (isOpening ? 0.15 : -0.1),
    autoAlpha: (isOpening ? 1 : 0),
    ease: (isOpening ? easingMedium : easingMedium),
  }, (isOpening ? 0 : 0.15))

  initLinkGroups(primaryLinksWrapper, '.primary-link', {
    dim: true,
    dimOpacity: 0.5,
    dimDuration: 0.25,
  })

  // Reveal Secondary Links
  tl.to(secondaryLinksWrapper, {
    duration: (isOpening ? 0.3 : 0.5),
    y: (isOpening ? 0 : "-0.5rem"),
    autoAlpha: (isOpening ? 1 : 0),
  }, (isOpening ? 0.5 : 0))

  initLinkGroups(secondaryLinksWrapper, '.primary-link', {
    dim: true,
    dimOpacity: 0.5,
    dimDuration: 0.25,
  })

}

function onEscapePressNav(event) {
    if (event.key === 'Escape') {
        hideNavigationMenu();
    }
};
  
function initMenuInteraction() {
  navMenuButton.addEventListener("click", (event) => {
      toggleNavigationMenu();
  });
};

function productNavigationMenu() {
  function handleIntersection(entries, observer) {
      entries.forEach(entry => {
          if (entry.isIntersecting) {
              navigation.setAttribute('theme', "product");
          } else {
              navigation.removeAttribute('theme');
          }
      });
  }
  
  // Specify a threshold of 0.5
  let options = {
    rootMargin: "-32px 0px 0px 0px",
      threshold: 0
  };

  let observer = new IntersectionObserver(handleIntersection, options);

  let targetElement = document.querySelector('.product-gallery');

  if (targetElement) {
      observer.observe(targetElement);
  } else {
      console.log('Element not found');
  }

  observer.observe(targetElement);
}

function setMobileNavOnDesktop() {

    const navigationLinks = navigation.querySelector('.navigation-links');
    if (navigationLinks) {
        navigationLinks.style.maxWidth = "unset";
        navigationLinks.style.width = "unset";
        navigationLinks.style.gap = "1.25rem";
    }
    
    // Hide desktop links
    const navDesktopLinks = navigation.querySelectorAll('.desktop-links');
    navDesktopLinks.forEach(link => {
        link.style.display = 'none';
    });

    // Show mobile links
    const mobileLinks = navigation.querySelectorAll('.mobile-links');
    mobileLinks.forEach(link => {
        link.style.display = 'flex';
    });
}

// Glass Display Button Hover
function initGlassDisplayButtons() {
    let buttonsGlass = document.querySelectorAll(".button--display:not(.tertiary)");

    const animateButton = (buttonGlass, moveStar, moveText, duration, ease) => {
        gsap.to(buttonGlass.querySelectorAll(".star-w"), {
            x: moveStar,
            duration: duration,
            ease: ease
        });
        gsap.to(buttonGlass.querySelector('[label]'), {
            x: moveText,
            duration: duration,
            ease: ease
        });
    };

    buttonsGlass.forEach((buttonGlass) => {
        buttonGlass.addEventListener("mouseenter", (event) => {
            let starWidth = buttonGlass.querySelector('.star-w').offsetWidth;
            let borderWidth = parseInt(window.getComputedStyle(buttonGlass).outlineWidth, 10);
            let paddingRight = parseInt(window.getComputedStyle(buttonGlass).paddingRight, 10);

            let moveStar = starWidth + borderWidth + paddingRight;
            let moveText = starWidth - (paddingRight * 2);

            animateButton(buttonGlass, moveStar, moveText, 0.3, "power4");
        });

        buttonGlass.addEventListener("mouseleave", () => {
            animateButton(buttonGlass, 0, 0, 0.4, "power2");
        });
    });
}

// Solid Display Button Hover
function initSolidDisplayButtons() {
    let buttonsSolid = document.querySelectorAll(".button--display.tertiary:not(.disabled)");

    const animateButton = (buttonSolid, xValue, opacityValue, duration, ease) => {
        gsap.to(buttonSolid.querySelectorAll(".star-w"), {
            x: xValue,
            opacity: opacityValue,
            duration: duration,
            ease: ease
        });

        gsap.to(buttonSolid.querySelectorAll(".star-w[hidden]"), {
            x: xValue,
            opacity: 1 - opacityValue, // Inverts the opacity for hidden stars
            duration: duration,
            ease: ease
        });

        gsap.to(buttonSolid.querySelector('[label]'), {
            x: xValue,
            duration: duration,
            ease: ease
        });
    };

    buttonsSolid.forEach((buttonSolid) => {
        let starWidth = buttonSolid.querySelector('.star-w').offsetWidth;
        let gap = parseInt(window.getComputedStyle(buttonSolid).gap, 10);
        let move = starWidth + gap;
        let duration = 0.3;

        buttonSolid.addEventListener("mouseenter", () => {
            animateButton(buttonSolid, move, 0, duration, "power4");
        });

        buttonSolid.addEventListener("mouseleave", () => {
            animateButton(buttonSolid, 0, 1, duration, "power2");
        });
    });
}


// Accordions
function initAccordions() {
    const accordionDuration = "0.8";

    function toggleAccordion(content, horizontalLine, verticalLine, button) {
        const isExpanded = button.getAttribute('aria-expanded') === 'true';

        button.setAttribute('aria-expanded', !isExpanded);
        gsap.to(content, { height: isExpanded ? "0px" : "auto", duration: accordionDuration, ease: easingMedium });
        gsap.to(horizontalLine, { rotation: isExpanded ? 0 : 180, duration: accordionDuration, ease: easingMedium });
        gsap.to(verticalLine, { rotation: isExpanded ? 0 : 90, duration: accordionDuration, ease: easingMedium });
    }

    const accordions = document.querySelectorAll(".accordion");
    accordions.forEach((accordion) => {
        const content = accordion.querySelector(".content");
        const horizontalLine = accordion.querySelector(".line:nth-child(1)");
        const verticalLine = accordion.querySelector(".line:nth-child(2)");
        const button = accordion.querySelector(".accordion-button");

        button.addEventListener('click', () => toggleAccordion(content, horizontalLine, verticalLine, button));
    });
};

// Show Event Interaction
function showItemHover() {
  let items = document.querySelectorAll(".show-item");
  let fadeItems = ".heading-400, .heading-500, a";
  
  items.forEach((item) => {
    item.addEventListener("mouseenter", () => {
      // Apply the effect to all target elements in all items
      items.forEach(i => {
        gsap.to(i.querySelectorAll(fadeItems), { opacity: 0.4, duration: 0.3 });
      });
      // Override the effect for the current item
      gsap.to(item.querySelectorAll(fadeItems), { opacity: 1, duration: 0.3 });
      gsap.to(item, { opacity: 1, duration: 0.3 });
      gsap.to(item.querySelector(".divider_fill"), { 
        width: "100%", 
        duration: 0.6, 
        ease: "power3.out",
      });
    });
    item.addEventListener("mouseleave", () => {
      gsap.killTweensOf(item.querySelector(".divider_fill"));
      gsap.to(item.querySelector(".divider_fill"), { 
        width: "0%", 
        duration: 0.5, 
        ease: "power4.out",
      });
      if (!Array.from(items).some(el => el.matches(':hover'))) {
        items.forEach(i => {
          gsap.to(i.querySelectorAll(fadeItems), { opacity: 1, duration: 0.3 });
        });
      }
    });
  });
}

// Release Tile Hover
function releaseCardHover() {
    const releaseCards = document.querySelectorAll(".release-card");

    releaseCards.forEach((releaseCard) => {
        const image = releaseCard.querySelector("img");
        const buttonWrapper = releaseCard.querySelector(".listen-button-w");
        const buttonWrapperHeight = buttonWrapper.offsetHeight;
        const button = buttonWrapper.querySelector(".button--listen");
        const descriptionWrappers = releaseCard.querySelectorAll(".desc-w");
        const bgTint = releaseCard.querySelector(".bg-tint");
        const bgGradient = releaseCard.querySelector(".bg-gradient");
        const buttonSVG = button.querySelector("svg");

        const rem = 16;

        gsap.set(descriptionWrappers, { y: buttonWrapperHeight })
        gsap.set(button, { opacity: 1 });

        releaseCard.addEventListener('mouseenter', () => {
            gsap.to(image, { scale: 1, ease: "power2.out", duration: 0.6 });
            gsap.to(descriptionWrappers, { y: 0, ease: easingMedium, duration: 0.5 });
            gsap.to(bgTint, { opacity: 0.4, ease: easingMedium, duration: 0.5 });
            gsap.to(bgGradient, { opacity: 1, ease: easingMedium, duration: 0.5 })
        });

        button.addEventListener('mouseenter', () => {
            gsap.to(button, { opacity: 0.75, ease: easingMedium, duration: 0.3 });
            gsap.to(buttonSVG, { x: 2, y: -2, ease: easingMedium, duration: 0.3 })
        })

        releaseCard.addEventListener('mouseleave', () => {
            gsap.to(image, { scale: 1.025, ease: easingMedium, duration: 0.6 });
            gsap.to(descriptionWrappers, { y: buttonWrapperHeight, ease: easingMedium, duration: 0.6 });
            gsap.to(bgTint, { opacity: 0.3, ease: easingMedium, duration: 0.6 });
            gsap.to(bgGradient, { opacity: 0, ease: easingMedium, duration: 0.6 });
        });

        button.addEventListener('mouseleave', () => {
            gsap.to(button, { opacity: 0.9, ease: easingMedium, duration: 0.3 });
            gsap.to(buttonSVG, { x: 0, y: 0, ease: easingMedium, duration: 0.3 })
        })
    });
};

// Product Woocommerce
function dispatchChangeEvent(element) {
    var changeEvent = new Event('change', { bubbles: true });
    element.dispatchEvent(changeEvent);
}
  
function updatePrice() {
    const priceContainer = document.querySelector('.woocommerce-variation-price');
    if (priceContainer) {
        const priceText = priceContainer.textContent.trim();
        let regularPrice, salePrice;

        const prices = priceText.split(' ').filter(p => p.trim() !== '');

        if (prices.length === 1) {
            regularPrice = prices[0];
        } else if (prices.length >= 2) {
            salePrice = prices[0];
            regularPrice = prices[1];
        }

        const priceWrapper = document.querySelector('.price');
        const regularPriceDisplay = priceWrapper.querySelector('div:first-child');
        const salePriceDisplay = priceWrapper.querySelector('.strikeout');

        if (regularPriceDisplay) {
          regularPriceDisplay.textContent = regularPrice;
          regularPriceDisplay.classList.add('amount');
        }

        if (salePriceDisplay) {
            if (salePrice) {
                salePriceDisplay.textContent = salePrice;
                salePriceDisplay.style.display = 'block';
            } else {
                salePriceDisplay.style.display = 'none';
            }
        }
    } else {
        console.log("Can't find price")
    }
}
  
function createRadios(variantOption) {
  const selectElement = variantOption.querySelector('select');
  const variantType = selectElement.getAttribute('data-attribute_name');
  const addToCartButton = document.querySelector('.single_add_to_cart_button');
  const addToCartMarquee = document.querySelector('.button--marquee');

  // Init outOfStockVariantNames as an array
  let outOfStockVariantNames = window.outOfStockVariantNames instanceof Array ? window.outOfStockVariantNames : [];


  selectElement.style.display = 'none';
  const label = variantOption.querySelector('label');
  if (label) {
      label.style.display = 'none';
  }

  const radioContainer = document.createElement('div');
  radioContainer.classList.add('variant-w', variantType);
  selectElement.parentNode.insertBefore(radioContainer, selectElement.nextSibling);

  let foundAvailable = false;
  let firstAvailableRadio = null;

  Array.from(selectElement.options).forEach((option, index) => {
      if (option.value) {
          const radioButton = document.createElement('input');
          radioButton.type = 'radio';
          radioButton.id = variantType + '_' + option.value.toLowerCase();
          radioButton.name = selectElement.name;
          radioButton.value = option.value;

          const label = document.createElement('label');
          label.htmlFor = radioButton.id;
          label.textContent = option.text;

          if (outOfStockVariantNames) {
              if (outOfStockVariantNames.includes(label.textContent)) {
                  radioButton.disabled = true;
              } else {
                  if (!foundAvailable) {
                      foundAvailable = true;
                      firstAvailableRadio = radioButton;
                      if (index === 0) { // If the first variant is available, no need to change
                          radioButton.checked = true;
                      }
                  }
              }
          } else {
              // outOfStockVariantNames is not an array or not defined
              // Handle this case, perhaps by treating all variants as available
              if (!foundAvailable) {
                  foundAvailable = true;
                  firstAvailableRadio = radioButton;
                  if (index === 0) { // If the first variant is available, no need to change
                      radioButton.checked = true;
                  }
              }
          }

          radioContainer.appendChild(radioButton);
          radioContainer.appendChild(label);

          if (radioContainer.children.length > 6) {
              radioContainer.classList.add('grid');
          }
      }
  });

  if (!foundAvailable) {
      // If no available variant is found, disable the Add to Cart button
    if (addToCartButton) {
      // Disable the default WooCommerce ATC Button
      addToCartButton.disabled = true;
    }
  } else {
      // Select the first available variant if the default is out of stock
      firstAvailableRadio.checked = true;
      selectElement.value = firstAvailableRadio.value;
      dispatchChangeEvent(selectElement); // Make sure to reflect this change
  }

  radioContainer.addEventListener('change', function(event) {
      if (event.target.name === selectElement.name) {
          selectElement.value = event.target.value;
          dispatchChangeEvent(selectElement);
          updatePrice();
      }
  });
};

  
  // Synchronize select dropdown with radio button selection
function syncDropdown(selectElement) {
    selectElement.addEventListener('change', function() {
        const radios = document.getElementsByName(this.name);
        radios.forEach(radio => {
            radio.checked = radio.value === this.value;
        });
    });
};
  
function initVariantOptions() {
    // Check for product variants
    const variantOptions = document.querySelectorAll('.variant-option');
    if (variantOptions.length > 0) {
        variantOptions.forEach(variantOption => {
            const selectElement = variantOption.querySelector('select');
            if (selectElement) {
                createRadios(variantOption);
                syncDropdown(selectElement);
            }
        });
    };
  
    // Update price after variant initialises
    const targetNode = document.querySelector('.woocommerce-variation');
    if (targetNode) {
      new MutationObserver(function(mutations) {
          mutations.forEach(mutation => {
              if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                  updatePrice();
              }
          });
      }).observe(targetNode, { childList: true, subtree: true });
    };
}

// Initialise Merch Slider
function initMerchSlider() {
  const slider = document.querySelector('.merch-slider');

  if (slider) {
    const arrowPrev = (slider.querySelector('.button--arrow.swiper-prev'));
    const arrowNext = (slider.querySelector('.button--arrow.swiper-next'));

    const swiper = new Swiper(slider.querySelector(".swiper"), {
            slidesPerView: "auto",
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
    arrowButtonHover(arrowPrev, 'left');
    arrowButtonHover(arrowNext, 'right'); 
  }
}

// Initialise Merch Slider
function initMerchArchiveSlider() {
  const slider = document.querySelector('.archive.merch-slider');

  if (slider) {
    const arrowWrapper = (slider.querySelector('.arrow-counter-w'));
    const arrowPrev = (arrowWrapper.querySelector('.button--arrow.swiper-prev'));
    const arrowNext = (arrowWrapper.querySelector('.button--arrow.swiper-next'));

    const swiper = new Swiper(slider.querySelector(".swiper"), {        
      slidesPerView: "auto",
      keyboard: true,
      speed: 680,
      followFinger: true,
      loop: true,
      loopPreventsSliding: false,
      pagination: {
          el: '.counter',
          type: 'custom',
          renderCustom: function (swiper, current, total) {
              return '(' + current + ' of ' + total + ')';
          }
      },
      freeMode: {
          enabled: true,
          sticky: true,
          momentumRatio: 0.25,
          momentumVelocityRatio: 0.6
      },
      mousewheel: {
          forceToAxis: true,
          sensitivity: 1.5
      },
      navigation: {
          nextEl: ".swiper-next",
          prevEl: ".swiper-prev",
          disabledClass: "is--disabled"
      },
      observer: true,
      observeParents: true,
      on: {
        init: function() {
          toggleSwiperOnBreakpoint(this, slider, arrowWrapper);
        },
        resize: function() {
          toggleSwiperOnBreakpoint(this, slider, arrowWrapper);
        },
      },
    });

    arrowButtonHover(arrowPrev, 'left');
    arrowButtonHover(arrowNext, 'right');

  }
}

// Initialise Release Slider
function initReleaseSlider() {
  const slider = document.querySelector('.release-slider');

  if (slider) {
    const arrowPrev = (slider.querySelector('.button--arrow.swiper-prev'));
    const arrowNext = (slider.querySelector('.button--arrow.swiper-next'));

    const swiper = new Swiper(slider.querySelector(".swiper"), {
      slidesPerView: "auto",
      keyboard: true,
      speed: 680,
      followFinger: true,
      loop: true,
      loopPreventsSliding: false,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumRatio: 0.25,
        momentumVelocityRatio: 0.6
      },
      pagination: {
        el: '.counter',
        type: 'custom',
        renderCustom: function (swiper, current, total) {
          return '(' + current + ' of ' + total + ')';
        }
      },
      mousewheel: {
        forceToAxis: true,
        sensitivity: 1.5
      },
      navigation: {
        nextEl: ".swiper-next",
        prevEl: ".swiper-prev",
        disabledClass: "is--disabled"
      }
    })

    arrowButtonHover(arrowPrev, 'left');
    arrowButtonHover(arrowNext, 'right');

  }
}

function initReleaseArchiveSlider() {
  const slider = document.querySelector('.archive.release-slider');

  if (slider) {
    const arrowWrapper = (slider.querySelector('.arrow-counter-w'));
    const arrowPrev = (arrowWrapper.querySelector('.button--arrow.swiper-prev'));
    const arrowNext = (arrowWrapper.querySelector('.button--arrow.swiper-next'));

    const swiper = new Swiper(slider.querySelector(".swiper"), {        
      slidesPerView: "auto",
      keyboard: true,
      speed: 680,
      followFinger: true,
      loop: true,
      loopPreventsSliding: false,
      freeMode: {
          enabled: true,
          sticky: true,
          momentumRatio: 0.25,
          momentumVelocityRatio: 0.6
      },
      pagination: {
          el: '.counter',
          type: 'custom',
          renderCustom: function (swiper, current, total) {
              return '(' + current + ' of ' + total + ')';
          }
      },
      mousewheel: {
          forceToAxis: true,
          sensitivity: 1.5
      },
      navigation: {
          nextEl: ".swiper-next",
          prevEl: ".swiper-prev",
          disabledClass: "is--disabled"
      },
      observer: true,
      observeParents: true,
      on: {
        init: function() {
          toggleSwiperOnBreakpoint(this, slider, arrowWrapper);
        },
        resize: function() {
          toggleSwiperOnBreakpoint(this, slider, arrowWrapper);
        },
      },
    });

    arrowButtonHover(arrowPrev, 'left');
    arrowButtonHover(arrowNext, 'right');

  }
}

// Disables Swiper on Mobile Breakpoint
function toggleSwiperOnBreakpoint(swiper, slider, arrowWrapper) {
  const breakpoint = 520;
  if (window.innerWidth > breakpoint) {
    // Larger than breakpoints
    if (arrowWrapper.style.display = "none") {
      swiper.enable();
      arrowWrapper.style.display = "flex";
      slider.classList.remove('disabled');
    }
    
  } else {
    // Smaller than breakpoint
    swiper.disable();
    slider.classList.add('disabled');
    arrowWrapper.style.display = "none";
  }
}

// Slider Arrow Buttons
function arrowButtonHover(arrow, direction) {
    if (!arrow) return; 

    arrow.addEventListener("mouseenter", () => {
        if (!arrow.classList.contains("is--disabled")) {
            const arrows = arrow.querySelectorAll(".arrow");
            gsap.to(arrows, {
                x: direction === 'left' ? "-200%" : "200%",
                duration: 0.3,
                ease: "power1.out",
                onComplete: () => gsap.set(arrows, { x: "0%" })
            });
        }
    });
}


/////////////////////////////////////////
// Cart Page // Cart Page // Cart Page //
/////////////////////////////////////////

function initUpdateCartButton() {
    if (window.location.pathname === '/cart/') {
        var applyCouponButton = document.querySelector('[name="apply_coupon"]');
        if (applyCouponButton) {
            applyCouponButton.disabled = true;
  
            // Get all input elements within the form
            var inputs = document.querySelectorAll('.woocommerce-cart-form input');
  
            inputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    applyCouponButton.disabled = false;
                });
            });
        }
    }
};


////////////////////////////////////////////////////
// Modals // Modals // Modals // Modals // Modals //
////////////////////////////////////////////////////

function createModalSkeleton() {
    const bodyStyle = getComputedStyle(document.body);
    const pageMargin = bodyStyle.getPropertyValue('--page-margin').trim();
    return `
        <div class="modal-w" theme="light">
            <div class="modal-tint" style="opacity: 0;"></div>
            <div class="modal" style="transform: translateY(calc(100% + ${pageMargin}));" >
                <div class="header">
                    <div class="heading-w">
                        <div class="heading">Contact</div>
                        <div class="p2">Fill out your details and Ill be in touch.</div>
                    </div>
                    <button class="button--close">
                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 0.999997L6.83333 6.83333L8 8L15 0.999997" stroke="#021117" stroke-width="2"/>
                        </svg>
                    </button>
                </div>
                <div class="content"></div>
            </div>
        </div>`;
  }
  
  function fetchCartContents() {
    return new Promise((resolve, reject) => {
        jQuery.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                'action': 'fetch_cart_contents'
            },
            success: function (response) {
                resolve(response); // Resolve the promise with the response
            },
            error: function (error) {
                reject(error); // Reject the promise if there's an error
            }
        });
    });
  }

function modifyCartActionButtons() {
  const modal = document.querySelector(".modal");
  const links = modal.querySelectorAll('a');

  links.forEach(function(link) {
    if (link.textContent.trim() === 'View cart') {
      // Replace the text content with "Edit"
      link.textContent = 'Edit';
    }
  });
}
  
  function initContactForm() {
    const modal = document.querySelector('.modal');
    const form = modal.querySelector('form');
    // Function to add responsive sizing to textarea
    const textarea = form.querySelector('textarea');
    const fieldWrapper = form.querySelector('.hf-fields-wrap');
    const submitButton = form.querySelector('input[type="submit"]');
  
    textarea.addEventListener('input', autoExpand);
  
    function autoExpand() {
        // Reset the height to shrink if text is deleted
        this.style.height = '0.9rem';
  
        // Set the height to the scroll height to expand as needed
        this.style.height = this.scrollHeight + 'px';
    }
  
    animateFieldDividers(modal);
  
    formValidation(form, submitButton);
  
    const feedbackMessage = document.createElement('div');
    feedbackMessage.className = 'form-feedback-message';
    feedbackMessage.style.display = 'none';
    
    fieldWrapper.insertBefore(feedbackMessage, submitButton);
  
    let contactFormErrorCount = 0;  // Error count for this specific form
  
    form.addEventListener('submit', function(event) {
      event.preventDefault();
  
      var formData = new FormData(form);
      formData.append('action', 'hf_form_submit');
  
  
      var baseURL = window.location.origin;
      var ajaxURL = baseURL + '/wp-admin/admin-ajax.php';
      
      var testError = forceFormError(formData.get('EMAIL'));
      if (testError) {
        ajaxURL = testError;
      }
  
  
      jQuery.ajax({
        url: ajaxURL,
        type: 'POST',
        data: formData,
        processData: false,  // Necessary for FormData
        contentType: false,  // Necessary for FormData
        success: function(response) {
            successMessage = "Message sent successfully! I’ll be in touch with you as soon as possible.";
            displayModalMessage(successMessage, "success");
            console.log('Form submitted successfully:', response);
            clearForm(modal);
            setTimeout(hideModal, 7500);
        },
          error: function(error) {
              contactFormErrorCount = handleFormError(error, contactFormErrorCount);
          }
      });
    });
  }
  
  function formValidation(form) {
    const submit = form.querySelector('input[type="submit"]');
    submit.disabled = true;
  
    const validateForm = () => {
        let isValid = true;
  
        form.querySelectorAll('input[required], select[required], textarea[required]').forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
            }
        });
  
        // Enable or disable the submit button based on the form validity
        submit.disabled = !isValid;
    };
  
    // Trigger validation whenever there's an input in the form fields
    form.addEventListener('input', validateForm);
  
    // Perform initial validation
    validateForm();
  };
  
  function clearForm(wrapper) {
    // Select the form inside the wrapper
    var form = wrapper.querySelector('form'); // Assuming there's only one form inside the wrapper
  
    // Iterate over all form elements
    for (var i = 0; i < form.elements.length; i++) {
        if (form.elements[i].type === "text" || form.elements[i].type === "email" || form.elements[i].type === "number" || form.elements[i].tagName === "TEXTAREA") {
            form.elements[i].value = '';
        }
        else if (form.elements[i].type === "checkbox" || form.elements[i].type === "radio") {
            form.elements[i].checked = false;
        }
    }
  }
  
  function displayModalMessage(message, type) {
    const messageDiv = document.querySelector('.form-feedback-message');
  
    if (type === "error") {
      color = 'rgba(255, 0, 0, 0.15)';
    } else if (type === "success") {
      color = 'rgba(0, 128, 0, 0.2)';
    } else {
      color = 'rgba(2, 17, 23, 0.05)';
    }
  
    messageDiv.style.backgroundColor = color;
    messageDiv.innerHTML = message;
  
    messageDiv.style.display = 'block';
  }
  
  function handleFormError(error, errorCount) {
    let errorMessage;
  
    if (errorCount >= 1) {
        errorMessage = "Something is still wrong, maybe try emailing me. My email address is <a href='mailto:ayayves@gmail.com'>ayayves@gmail.com</a>.";
    } else {
        // Increment error count in the parent document
        errorMessage = "Something’s gone wrong in submitting the form. Please try again.";
    }
  
    console.error('Form submission error:', error);
    displayModalMessage(errorMessage, "error");
  
    return errorCount + 1; // Return the incremented errorCount
  }
  
  function forceFormError(field) {
    if (field === "error@error.com") {
      return 'https://example.com/invalid-url';
    }
    return null;
  }
  
  function createMailchimpForm() {
    return `
        <form id="mailchimp-form" name="mailchimp-form" data-name="Mailchimp Form" action="https://ayayves.us8.list-manage.com/subscribe/post?u=2d15eede27755fb407e5a6edd&id=0486f04f81&f_id=003004e0f0" method="post" class="contact-form" aria-label="Mailing List Form">
            <div class="fields-w">
                <div class="form-field-w">
                    <input maxlength="256" name="FNAME" data-name="FNAME" placeholder="First Name" type="text" id="MCFNAME" required="">
                    <div class="divider">
                        <div class="divider_fill"></div>
                        <div class="divider_bg"></div>
                    </div>
                </div>
                <div class="form-field-w">
                    <input maxlength="256" name="LNAME" data-name="LNAME" placeholder="Last Name" type="text" id="MCLNAME" required="">
                    <div class="divider">
                        <div class="divider_fill"></div>
                        <div class="divider_bg"></div>
                    </div>
                </div>
                <div class="form-field-w">
                    <input maxlength="256" name="EMAIL" data-name="EMAIL" placeholder="Email" type="email" id="MCEMAIL" required="">
                    <div class="divider">
                        <div class="divider_fill"></div>
                        <div class="divider_bg"></div>
                    </div>
                </div>
                <div class="form-field-w">
                    <input maxlength="256" name="CITY" data-name="CITY" placeholder="City" type="text" id="MCCITY" required="">
                    <div class="divider">
                        <div class="divider_fill"></div>
                        <div class="divider_bg"></div>
                    </div>
                </div>
                <div class="form-feedback-message" style="display: none;"></div>
                <input id="MCSUBMIT" type="submit" data-wait="Please wait..." value="Sign Up">
                <noscript>Please enable JavaScript for this form to work.</noscript>
            </div>
        </form>
    `;
  }
  
  function initMailchimpForm() {
    const modal = document.querySelector('.modal');
    const form = modal.querySelector('form');
    submitButton = form.querySelector('input[type="submit"]');
  
    animateFieldDividers(modal);
    formValidation(form, submitButton);
  
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      var formData = jQuery(form).serialize();
      var formDataObject = jQuery.param(formData);
  
      let URL = 'https://ayayves.us8.list-manage.com/subscribe/post-json?u=2d15eede27755fb407e5a6edd&id=0486f04f81&c=?'
  
      var testError = forceFormError(formDataObject['MCEMAIL']);
      if (testError) {
        URL = testError;
      }
  
      jQuery.ajax({
        type: 'POST',
        url: URL,
        data: formData,
        cache: false,
        dataType: 'json',
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        success: (res) => {
          let successMessage = "You've been subscribed. I'll let you know about upcoming gigs and releases.";
          displayModalMessage(successMessage, "success");
          console.log('Form submitted successfully:', res);
          clearForm(modal);
          setTimeout(hideModal, 7500);
        },
        error: (error) => {
          contactFormErrorCount = handleFormError(error, contactFormErrorCount);
        }
      });
    });
  }
  
  function buildStreamLinks() {
    return `
    <div class="stream-links">
      <a class="stream-link-w" target="_blank" platform='applemusic'><div class="stream-link">
              <div class="platform-title">Apple Music
    </div>
              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.005 1.75443H0.375954V0H11V10.6241H9.24557V2.995L1.24057 11L0 9.75943L8.005 1.75443Z" fill="currentColor"/>
              </svg>
          </div><div class="divider" data-pg-name="Divider" data-pgc="divider">
              <div class="divider_fill"></div>
              <div class="divider_bg"></div>
          </div></a>
      <a class="stream-link-w" target="_blank" platform='spotify'><div class="stream-link">
              <div class="platform-title">Spotify</div>
              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.005 1.75443H0.375954V0H11V10.6241H9.24557V2.995L1.24057 11L0 9.75943L8.005 1.75443Z" fill="currentColor"/>
              </svg>
          </div><div class="divider" data-pg-name="Divider" data-pgc="divider">
              <div class="divider_fill"></div>
              <div class="divider_bg"></div>
          </div></a>
      <a class="stream-link-w" target="_blank" platform='unearthed'><div class="stream-link">
              <div class="platform-title">Unearthed</div>
              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.005 1.75443H0.375954V0H11V10.6241H9.24557V2.995L1.24057 11L0 9.75943L8.005 1.75443Z" fill="currentColor"/>
              </svg>
          </div><div class="divider" data-pg-name="Divider" data-pgc="divider">
              <div class="divider_fill"></div>
              <div class="divider_bg"></div>
          </div></a>
      <a class="stream-link-w" target="_blank" platform='youtube'><div class="stream-link">
              <div class="platform-title">YouTube</div>
              <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M8.005 1.75443H0.375954V0H11V10.6241H9.24557V2.995L1.24057 11L0 9.75943L8.005 1.75443Z" fill="currentColor"></path>
              </svg>
          </div><div class="divider" data-pg-name="Divider" data-pgc="divider">
              <div class="divider_fill"></div>
              <div class="divider_bg"></div>
          </div></a>
    </div>`;
  }
  
  function createArtistLinks(modal) {
    const applemusic = modal.querySelector("[platform='applemusic']");
    const spotify = modal.querySelector("[platform='spotify']");
    const unearthed = modal.querySelector("[platform='unearthed']");
    const youtube = modal.querySelector("[platform='youtube']");
  
    applemusic.href = "https://music.apple.com/au/artist/aya-yves/1502547272";
    spotify.href = "https://open.spotify.com/artist/2Mgm4AwTZRFzZV0Dc3MI3n?si=bEQN7ainTkqpXOlfGLoHBA";
    unearthed.href = "https://www.abc.net.au/triplejunearthed/artist/aya-yves/";
    youtube.href = "https://www.youtube.com/ayayves";
  }
  
  function initReleaseLinks() {
    const links = document.querySelectorAll("a[data='streamlink']");
  
    links.forEach(link => {
        if (link.id && link.id.startsWith("post-")) {
            const postID = link.id.split('-')[1];
  
            fetchReleaseData(postID)
                .then(data => {
                    if (data && !data.apple_music_link && !data.spotify_link) {
                        if (data.presave_link) {
                            link.href = data.presave_link;
                        }
                    } else {
                      link.addEventListener('click', (event) => {
                          event.preventDefault();
                          buildStreamReleaseModal(data);
                      });
                  }
                })
                .catch(error => {
                    console.error('Error fetching release data for post', postID, ':', error);
                });
        }
    });
  }
  
  function createReleaseLinks(data) {
    const modal = document.querySelector('.modal');
    const applemusic = modal.querySelector("[platform='applemusic']");
    const spotify = modal.querySelector("[platform='spotify']");
    const unearthed = modal.querySelector("[platform='unearthed']");
    const youtube = modal.querySelector("[platform='youtube']");
  
    if (data && data.apple_music_link) {
      applemusic.href = data.apple_music_link;
    } else {
      applemusic.remove();
    }
  
    if (data && data.spotify_link) {
      spotify.href = data.spotify_link;
    } else {
      spotify.remove();
    }
  
    if (data && data.unearthed_link) {
      unearthed.href = data.unearthed_link;
    } else {
      unearthed.remove();
    }
  
    if (data && data.youtube_link) {
      youtube.href = data.youtube_link;
    } else {
      youtube.remove();
    }
  }
  
  function streamLinkHover() {
    const modal = document.querySelector('.modal');
    let links = modal.querySelectorAll('.stream-link-w');
    
    links.forEach((link) => {
      
      link.addEventListener("mouseenter", () => {
        // Dim all links
        links.forEach(i => {
          gsap.to(i.querySelectorAll('.stream-link'), { opacity: 0.25, duration: 0.3 });
        });
        // Highlight current link
        gsap.to(link.querySelectorAll('.stream-link'), { opacity: 1, duration: 0.3 });
        gsap.to(link, { opacity: 1, duration: 0.3 });
        gsap.to(link.querySelector(".divider_fill"), { 
          width: "100%", 
          duration: 0.6, 
          ease: "power3.out",
        });
        gsap.to(link.querySelector('svg'), { x: "0.1875rem", y: "-0.1875rem", duration: 0.3, ease: "power3.out" })
        gsap.to(link.querySelector('.platform-title'), { x: "0.1875rem", y: "-0.1875rem", duration: 0.3, ease: "power3.out" })
      });
  
      link.addEventListener("mouseleave", () => {
        gsap.killTweensOf(link.querySelector(".divider_fill"));
        gsap.to(link.querySelector(".divider_fill"), { 
          width: "0%", 
          duration: 0.5, 
          ease: "power4.out",
        });
        gsap.to(link.querySelector('svg'), { x: "0", y: "0", duration: 0.3, ease: "power3.out" })
        gsap.to(link.querySelector('.platform-title'), { x: "0", y: "0", duration: 0.3, ease: "power3.out" })
        // Reset opacity if no link is hovered
        if (!Array.from(links).some(el => el.matches(':hover'))) {
          links.forEach(i => {
            gsap.to(i.querySelectorAll('.stream-link'), { opacity: 1, duration: 0.3 });
          });
        }
      });
    });
  }
  
  function animateFieldDividers(modal) {
    let fields = modal.querySelectorAll(".form-field-w")
    fields.forEach((field) => {
    field.addEventListener("mouseenter", () => {
      gsap.to(field.querySelector(".divider_fill"), { 
        width: "100%", 
        duration: 0.75, 
        ease: "power3.out",
      });
    });
    field.addEventListener("mouseleave", () => {
      gsap.killTweensOf(field.querySelector(".divider_fill"));
      gsap.to(field.querySelector(".divider_fill"), { 
        width: "0%", 
        duration: 0.5, 
        ease: "power3.out",
      });
    });
  });
  }
  
  function animateStreamLinks(linkWrapper) {
    let links = linkWrapper.querySelectorAll(".stream-link-w")
    links.forEach((link) => {
    link.addEventListener("mouseenter", () => {
      gsap.to(link.querySelector(".divider_fill"), { 
        width: "100%", 
        duration: 0.75, 
        ease: "power3.out",
      });
    });
    link.addEventListener("mouseleave", () => {
      gsap.killTweensOf(link.querySelector(".divider_fill"));
      gsap.to(link.querySelector(".divider_fill"), { 
        width: "0%", 
        duration: 0.5, 
        ease: "power3.out",
      });
    });
  });
  }
  
  async function buildModal(heading, description, content) {
    const mainContent = document.querySelector('main');

    const existingModal = document.querySelector('.modal-w')
   
    if (!(existingModal)) {
      togglePageScroll(false);
    
      mainContent.insertAdjacentHTML('beforebegin', createModalSkeleton());
    
      const modalTint = document.querySelector('.modal-tint');
      const modal = document.querySelector('.modal');  
      
      modal.querySelector('.heading').innerHTML = heading;
    
      if (description) {
        modal.querySelector('.p2').innerHTML = description;
      } else {
        modal.querySelector('.p2')?.remove();
      }
    
      modal.querySelector('.content').innerHTML = content;
    
      modalTint.addEventListener('click', hideModal);
      modal.querySelector('.button--close').addEventListener('click', hideModal);
      document.addEventListener('keydown', onEscapePress);
    }
  }
  
  async function buildCartModal() {
    heading = "Cart";
    description = false;
    content = await fetchCartContents();
    buildModal(heading, description, content);
    modifyCartActionButtons();
    initMarquees();
    revealModal();
  }
  
  async function updateCartModal() {
    modal = document.querySelector(".modal");
    content = modal.querySelector(".content");
    updatedCart = await fetchCartContents();
    content.innerHTML = updatedCart;
  }
  
  // Update Cart Modal on Change
  jQuery(document).ready(function($) {
    // Listen for the 'removed_from_cart' event
    $(document.body).on('removed_from_cart', function() {
        // Call the updateCartModal function
        updateCartModal();
    });
  });
  
  async function buildContactModal() {
    heading = "Contact";
    description = "Fill in your details and I’ll be in touch.";
    content = await fetchContactForm();
    buildModal(heading, description, content);
    initContactForm();
    revealModal();
  }
  
  function buildMailchimpModal() {
    heading = "Stay in the Loop";
    description = "Get updates on new music and upcoming gigs.";
    content = createMailchimpForm();
    buildModal(heading, description, content);
    initMailchimpForm();
    revealModal();
  }
  
  function buildStreamArtistModal() {
    heading = "Stream";
    description = "Choose your streaming platform of choice.";
    content = buildStreamLinks();
    buildModal(heading, description, content);
    createArtistLinks(document.querySelector('.modal'));
    streamLinkHover();
    revealModal();
  }
  
  function buildStreamReleaseModal(data) {
    heading = "Stream"
    description = "Choose your streaming platform of choice.";
    content = buildStreamLinks();
    buildModal(heading, description, content);
    createReleaseLinks(data);
    streamLinkHover();
    revealModal();
  }
  
  function revealModal() {
    const modalTint = document.querySelector('.modal-tint');
    const modal = document.querySelector('.modal');
  
    const revealModalTimeline = gsap.timeline();
    revealModalTimeline
      .to(modalTint, { opacity: 0.75, duration: 1 })
      .to(modal, { y: 0, duration: 1, ease: "expo.out" }, "-=1");
  }
  
  function hideModal() {
    const modalWrapper = document.querySelector('.modal-w');
    const modal = document.querySelector('.modal');
    const modalTint = document.querySelector('.modal-tint');
  
    if (modalWrapper) {
      togglePageScroll(true);
      const hideModalTimeline = gsap.timeline({
        onComplete: () => {
            modalWrapper.remove();
            document.removeEventListener('keydown', onEscapePress);
        }
      });
  
      hideModalTimeline
        .to(modalTint, { opacity: 0, duration: 0.7, ease: "power1.in" })
        .to(modal,{y: "130%", duration: 0.7, ease: "power2.in"},"-=0.7")
  
    } else {
        console.error('Modal element not found');
    }
  }
  
  function onEscapePress(event) {
    // Check if the key pressed is Escape
    if (event.key === 'Escape') {
        hideModal();
    }
  }

function initModals() {
    cartButtons = document.querySelectorAll('[modal="cart"]');
    cartButtons.forEach((cartButton) => {
      cartButton.addEventListener("click", buildCartModal);
    });

    contactButtons = document.querySelectorAll('[modal="contact"]');
    contactButtons.forEach((contactButton) => {
      contactButton.addEventListener("click", buildContactModal);
    });
    
    mailchimpButtons = document.querySelectorAll('[modal="mailchimp"]');
    mailchimpButtons.forEach((mailchimpButton) => {
      mailchimpButton.addEventListener("click", buildMailchimpModal);
    });
    
    streamArtistButtons = document.querySelectorAll('[modal="stream-artist"]');
    streamArtistButtons.forEach((streamArtistButton) => {
      streamArtistButton.addEventListener("click", buildStreamArtistModal);
    })
    
    streamReleaseButtons = document.querySelectorAll('[modal="stream-release"]');
    streamReleaseButtons.forEach((streamReleaseButton) => {
      streamReleaseButton.addEventListener("click", buildStreamArtistModal);
    })
}