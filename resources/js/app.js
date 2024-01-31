import Splide from '@splidejs/splide';
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
import * as bootstrap from 'bootstrap'
import L from 'leaflet';

window.L = L;

window.bootstrap = bootstrap;

window.Splide = Splide;

require('fslightbox');

const galleryImages = document.querySelectorAll('#gallery-images');
galleryImages.forEach((image) => {
  const main = new Splide('#' + image.firstElementChild.id, {
    type: 'fade',
    pagination: false,
    lazyLoad: 'nearby',
    heightRatio: 0.5,
  });
  main.mount();
});


const galleries = document.querySelectorAll('.tab-pane .row .col-lg-7.mt-4');
galleries.forEach((gallery) => {
  const main = new Splide('#' + gallery.firstElementChild.id, {
    type: 'fade',
    pagination: false,
    lazyLoad: 'sequential',
  });

  const thumbnails = new Splide('#' + gallery.lastElementChild.id, {
    fixedWidth: 100,
    fixedHeight: 60,
    gap: 10,
    arrows: false,
    pagination: false,
    isNavigation: true,
    lazyLoad: 'sequential',
    breakpoints: {
      600: {
        fixedWidth: 60,
        fixedHeight: 44,
      },
    },
  });
  main.sync(thumbnails);
  main.mount();
  thumbnails.mount();
});
