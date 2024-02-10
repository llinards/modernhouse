<div class="mt-4 gallery">
  {{--  {{ dd($galleries) }}--}}
  @foreach($galleries as $gallery)
    <div class="row mt-5" wire:key="{{$gallery->id}}">
      <div class="col-lg-3 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
        <h2 class="fw-bold title mb-2">{{ $gallery->translations[0]->title }}</h2>
        <p>{!! $gallery->translations[0]->content !!}</p>
      </div>
      <div
        class="col-lg-9 d-flex order-first order-lg-last justify-content-center align-items-center flex-column">
        @if($gallery->is_video)
          <video class="img-fluid" controls
                 src="{{ asset('storage/gallery/'. $gallery->slug . '/' .$gallery->images[0]->filename) }}#t=0.001"
                 title="{{ $gallery->translations[0]->title }}">Your browser does not support the
            video tag.
          </video>
        @else
          <div wire:ignore id="gallery-images">
            <section id="gallery-{{$gallery->slug}}-main-carousel" class="splide">
              <div class="splide__track">
                <ul class="splide__list">
                  @foreach($gallery->images as $image)
                    <li class="splide__slide">
                      <a data-fslightbox="{{$gallery->slug}}"
                         href="{{ asset('storage/gallery/'. $gallery->slug . '/' .$image->filename) }}">
                        <img class="img-fluid"
                             data-splide-lazy="{{ asset('storage/gallery/'. $gallery->slug . '/' .$image->filename) }}"
                             alt="{{ $gallery->title }}">
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </section>
          </div>
        @endif
      </div>
    </div>
  @endforeach
  <div x-intersect:half="$wire.loadMore()" class="mt-4 d-flex justify-content-center">
    <div wire:loading class="spinner-border" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
</div>
<script type="module">
  let lastGalleryIndex = 0;

  function initializeSplide() {
    const galleryImages = document.querySelectorAll('#gallery-images');
    const newGalleryImages = Array.from(galleryImages).slice(lastGalleryIndex);

    newGalleryImages.forEach((image) => {
      const main = new Splide('#' + image.firstElementChild.id, {
        type: 'fade',
        pagination: false,
        lazyLoad: 'nearby',
        heightRatio: 0.5,
      });
      main.mount();
    });

    lastGalleryIndex = galleryImages.length;
  }

  window.addEventListener('galleryChange', () => {
    console.log('Gallery change event');
    initializeSplide();
    refreshFsLightbox();
  });

  // Call the function when the script is initially run
  initializeSplide();
</script>
