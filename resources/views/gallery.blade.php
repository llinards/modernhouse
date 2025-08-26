<x-layouts.app :title="Lang::get('gallery')">
  <x-slot name="header">
    @lang('gallery')
  </x-slot>
  <x-slot name="slot">
    @foreach($galleries as $gallery)
      <div class="row mt-4 gallery-item">
        <div class="col-lg-5 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
          <h2 class="mb-2">{{ $gallery->translations[0]->title }}</h2>
          <p>{!! $gallery->translations[0]->content !!}</p>
        </div>
        @if($gallery->is_video)
          <div
            class="col-lg-7 d-flex order-first order-lg-last justify-content-center align-items-center flex-column">
            <video class="img-fluid" controls
                   src="{{ asset('storage/gallery/'. $gallery->slug . '/' .$gallery->images[0]->filename) }}#t=0.001"
                   title="{{ $gallery->translations[0]->title }}">Your browser does not support the
              video tag.
            </video>
          </div>
        @else
          <div
            class="col-lg-7 d-flex order-first order-lg-last justify-content-center align-items-center flex-column"
            id="gallery-images">
            <section id="gallery-{{$gallery->slug}}-main-carousel" class="splide">
              <div class="splide__track">
                <ul class="splide__list">
                  @foreach($gallery->images as $image)
                    <li class="splide__slide">
                      <a data-fancybox="{{$gallery->slug}}"
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
    @endforeach
    {{ $galleries->links()}}
  </x-slot>
</x-layouts.app>
<script type="module">
  const galleryImages = document.querySelectorAll('#gallery-images');
  galleryImages.forEach((image) => {
    const main = new Splide('#' + image.firstElementChild.id, {
      type: 'fade',
      pagination: false,
      lazyLoad: 'nearby',
      heightRatio: 0.5,
      rewind: true
    }).on('lazyload:error', function (img, slide) {
      console.error('Failed to load image:', img.src);
    });
    main.mount();
  });
  Fancybox.bind("[data-fancybox]", {});
</script>
