import "./bootstrap";
import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse";
import Splide from "@splidejs/splide";

window.Alpine = Alpine;
Alpine.plugin(collapse);
Alpine.start();

const heroBanner = document.getElementById("hero-banner");
if (heroBanner != undefined) {
    new Splide("#hero-banner", {
        type: "fade",
        rewind: true,
        autoplay: true,
        classes: {
            prev  : 'splide__arrow--prev splide__r_arrow splide__r_arrow--prev',
            next  : 'splide__arrow--next splide__r_arrow splide__r_arrow--next',
        },
    }).mount();
}

const relatedItems = document.getElementById("relate-items");
if (relatedItems != undefined) {
    new Splide("#relate-items", {
        perPage: 5,
        gap: '1rem',
        breakpoints: {
            1280: { perPage: 5 },
            1024: { perPage: 4 },
            768: { perPage: 3 },
            640: { perPage: 2 },
        },
        pagination: false,
        classes: {
            prev  : 'splide__arrow--prev splide__r_arrow splide__r_arrow--prev',
            next  : 'splide__arrow--next splide__r_arrow splide__r_arrow--next',
        },
    }).mount();
}

const flashSale = document.getElementById("flash-sale");
if (flashSale != undefined) {
    new Splide("#flash-sale", {
        perPage: 5,
        gap: '1rem',
        breakpoints: {
            1280: { perPage: 5 },
            1024: { perPage: 4 },
            768: { perPage: 3 },
            640: { perPage: 2 },
        },
        pagination: false,
        classes: {
            prev  : 'splide__arrow--prev splide__r_arrow splide__r_arrow--prev',
            next  : 'splide__arrow--next splide__r_arrow splide__r_arrow--next',
        },
    }).mount();
}

const flashSaleCounter = document.getElementById('flash-sale-countdown');
if (flashSaleCounter != undefined) {
    var x = setInterval(function() {
        let currDate = new Date();
        let stopTime = currDate.setHours(23, 59, 59, 999);
        let now = new Date().getTime();

        var distance = stopTime - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        flashSaleCounter.innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

        if (distance < 0) {
            clearInterval(x);
            flashSaleCounter.innerHTML = "EXPIRED";
        }
    }, 1000);
}
