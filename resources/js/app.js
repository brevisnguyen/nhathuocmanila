import "./bootstrap";
import Alpine from "alpinejs";
import Splide from "@splidejs/splide";

window.Alpine = Alpine;
Alpine.start();

const heroBanner = document.getElementById("hero-banner");
if (heroBanner != undefined) {
    new Splide("#hero-banner", {
        type: "fade",
        rewind: true,
        autoplay: true,
    }).mount();
}

const tpcnBanner = document.getElementById("tpcn");
if (tpcnBanner != undefined) {
    new Splide("#tpcn", {
        autoplay: true,
        perPage: 1,
        rewind: true,
    }).mount();
}

const relateBanner = document.getElementById("relate-items");
if (relateBanner != undefined) {
    new Splide("#relate-items", {
        perPage: 5,
        gap: '1rem',
        breakpoints: {
            1170: { perPage: 5, gap: '1rem' },
            768: { perPage: 3, gap: 0 },
            640: { perPage: 2, gap: 0 },
        },
        pagination: false,
        classes: {
            prev  : 'splide__arrow--prev splide__r_arrow splide__r_arrow--prev',
            next  : 'splide__arrow--next splide__r_arrow splide__r_arrow--next',
        },
    }).mount();
}
