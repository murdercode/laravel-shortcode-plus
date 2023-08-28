import Splide from "@splidejs/splide";
import GLightbox from 'glightbox';
import ImageCompare from "image-compare-viewer";

// Splide
const checkSpide = document.querySelector(".splide");
if (checkSpide !== null) {

    let splide = new Splide('.splide', {
        type: 'loop',
        padding: '5rem',
    });

    splide.mount();

}

// GLightbox
const checkLightbox = document.querySelector(".glightbox");

if (checkLightbox !== null) {
    const lightbox = GLightbox();
}
// Image Compare
const viewers = document.querySelectorAll(".image-compare");
if(viewers !== null){
    viewers.forEach((element) => {
        let view = new ImageCompare(element).mount();
    });
}
