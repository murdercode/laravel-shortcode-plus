import Splide from "@splidejs/splide";
import GLightbox from 'glightbox';

// import 'juxtaposejs/build/js/juxtapose.js';

// Splide
let splide = new Splide( '.splide', {
    type   : 'loop',
    padding: '5rem',
} );

splide.mount();

// GLightbox
const lightbox = GLightbox();
