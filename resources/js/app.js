require('bootstrap');

import Splide from '@splidejs/splide';

import 'filepond/dist/filepond.min.css';

const galleries = document.querySelectorAll('.tab-pane .row .col-lg-7.mt-4');

galleries.forEach((gallery) => {
  const main = new Splide( '#' + gallery.firstElementChild.id, {
    type      : 'fade',
    pagination: false,
    lazyLoad: 'nearby',
  });

  const thumbnails = new Splide( '#' + gallery.lastElementChild.id, {
    fixedWidth  : 100,
    fixedHeight : 60,
    gap         : 10,
    arrows: false,
    pagination  : false,
    isNavigation: true,
    lazyLoad: 'sequential',
    breakpoints : {
      600: {
        fixedWidth : 60,
        fixedHeight: 44,
      },
    },
  });
  main.sync( thumbnails );
  main.mount();
  thumbnails.mount();
});
