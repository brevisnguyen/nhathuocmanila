import "./bootstrap";
import Alpine from "alpinejs";
import Splide from "@splidejs/splide";

window.Alpine = Alpine;
Alpine.start();

new Splide("#hero-banner", {
    type: "fade",
    rewind: true,
    autoplay: true,
}).mount();

new Splide("#tpcn", {
    autoplay: true,
    perPage: 1,
    rewind: true,
}).mount();
