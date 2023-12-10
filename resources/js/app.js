import "./bootstrap";
import Alpine from "alpinejs";
import Splide from '@splidejs/splide';


window.Alpine = Alpine;
Alpine.start();

var splide = new Splide('.splide', {
    type  : 'fade',
    rewind: true,
    autoplay: true,
});

splide.mount();
