require('./bootstrap');
require('bootstrap');

import Splide from '@splidejs/splide';

const main = new Splide( '#main-carousel', {
  type      : 'fade',
  pagination: false,
} );

const thumbnails = new Splide( '#thumbnail-carousel', {
  fixedWidth  : 100,
  fixedHeight : 60,
  gap         : 10,
  arrows: false,
  pagination  : false,
  isNavigation: true,
  breakpoints : {
    600: {
      fixedWidth : 60,
      fixedHeight: 44,
    },
  },
} );

main.sync( thumbnails );
main.mount();
thumbnails.mount();
