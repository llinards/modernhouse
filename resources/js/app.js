import Splide from '@splidejs/splide';

import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';

import fslightbox from 'fslightbox';

import * as bootstrap from 'bootstrap'
import L from 'leaflet';

window.Splide = Splide;

window.FilePond = FilePond;
window.FilePondPluginFileValidateType = FilePondPluginFileValidateType;
window.FilePondPluginImagePreview = FilePondPluginImagePreview;
window.FilePondPluginFileValidateSize = FilePondPluginFileValidateSize;

window.fslightbox = fslightbox;

window.bootstrap = bootstrap;
window.L = L;

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
