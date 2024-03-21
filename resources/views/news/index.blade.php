<x-layouts.app :title="Lang::get('news')">
  <x-slot name="header">
    @lang('news')
  </x-slot>
  <x-slot name="content">
    @foreach($allNews as $news)
      <div class="row mt-4 news-item">
        <div class="col-lg-4 d-flex justify-content-center align-items-start flex-column mt-lg-0 mt-2">
          <h2 class="mb-2">{{ $news->title }}</h2>
          <div class="d-flex w-100 justify-content-lg-between justify-content-center mt-2 flex-wrap">
            <a href="/{{app()->getLocale()}}/news/{{$news->slug}}"
               class="btn btn-primary d-flex justify-content-center align-items-center ">@lang('read more')</a>
          </div>
        </div>
        <div class="col-lg-8 d-flex order-first order-lg-last justify-content-center flex-column "
             id="news-images">
          <section id="news-index-{{$news->slug}}-main-carousel" class="splide">
            <div class="splide__track">
              <ul class="splide__list">
                @foreach($news->images as $image)
                  <li class="splide__slide">
                    <img class="img-fluid"
                         data-splide-lazy="{{ asset('storage/news/'.$news->slug.'/'.$image->image_location) }}"
                         alt="{{ $news->title }}">
                  </li>
                @endforeach
              </ul>
            </div>
          </section>
        </div>
      </div>
    @endforeach
  </x-slot>
</x-layouts.app>
<script type="module">
  const newsImages = document.querySelectorAll('#news-images');
  newsImages.forEach((image) => {
    const main = new Splide('#' + image.firstElementChild.id, {
      type: 'fade',
      pagination: false,
      lazyLoad: 'nearby',
      heightRatio: 0.5,
    });
    main.mount();
  });
</script>
