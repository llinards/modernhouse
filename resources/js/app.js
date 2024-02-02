import Splide from '@splidejs/splide';

import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

import * as bootstrap from 'bootstrap'
import L from 'leaflet';

window.Splide = Splide;

window.FilePond = FilePond;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;

window.bootstrap = bootstrap;
window.L = L;

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
