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


const registerForOpenDaysModal = document.getElementById('register-for-open-days-modal');
setTimeout(() => {
  new bootstrap.Modal(registerForOpenDaysModal).show();
}, 1000);
