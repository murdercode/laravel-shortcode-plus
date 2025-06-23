import Splide from "@splidejs/splide";
import GLightbox from 'glightbox';
import ImageCompare from "image-compare-viewer";

document.addEventListener('DOMContentLoaded', function () {

// Splide
    const checkSplide = document.getElementsByClassName('splide');

    if (checkSplide !== null) {

        for (let i = 0; i < checkSplide.length; i++) {
            new Splide(checkSplide[i], {
                type: 'loop',
                padding: '5rem',
                pagination: false,
            }).mount();
        }

    }

// GLightbox
    const checkLightbox = document.querySelector(".glightbox");

    if (checkLightbox !== null) {
        const lightbox = GLightbox();
    }
// Image Compare
    const viewers = document.querySelectorAll(".image-compare");
    if (viewers !== null) {
        viewers.forEach((element) => {
            let view = new ImageCompare(element).mount();
        });
    }

}, false);


//Youtube
const ytbPlayers = document.querySelectorAll('.ytb-player');

ytbPlayers.forEach((ytbPlayer) => {
    const ytbPlayerElement = ytbPlayer.querySelector('.ytb-player-element');
    if (!ytbPlayerElement) return; // Prevent error if element is missing

    ytbPlayerElement.addEventListener('click', function (e) {
        e.preventDefault();

        const iframe = ytbPlayer.querySelector('.ytb-player-iframe');
        if (iframe) {
            iframe.removeAttribute('srcdoc');
        }

        setTimeout(() => {
            ytbPlayerElement.style.display = 'none';
        }, 200);
    });
});
