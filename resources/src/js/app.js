import Splide from "@splidejs/splide";
import GLightbox from 'glightbox';
import ImageCompare from "image-compare-viewer";

// Splide
let splide = new Splide( '.splide', {
    type   : 'loop',
    padding: '5rem',
} );

splide.mount();

// GLightbox
const lightbox = GLightbox();

// Image Compare
const viewers = document.querySelectorAll(".image-compare");

viewers.forEach((element) => {
    let view = new ImageCompare(element).mount();
});
