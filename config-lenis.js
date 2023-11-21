"use strict"; // fix lenis in safari

const lenis = new Lenis({
duration: 0.9,
easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // https://www.desmos.com/calculator/brs54l4xou
direction: "vertical", // vertical, horizontal
gestureDirection: "vertical", // vertical, horizontal, both
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