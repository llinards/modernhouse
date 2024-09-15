<x-layouts.app :title="$news->title">
  <x-slot name="header">
    {{ $news->title }}
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div
        class="col-lg-8"
        id="news-images">
        <section id="news-show-{{$news->slug}}-main-carousel" class="splide">
          <div class="splide__track">
            <ul class="splide__list">
              @foreach($news->images as $image)
                <li class="splide__slide">
                  <a data-fslightbox="{{$news->slug}}"
                     href="{{ asset('storage/news/'.$news->slug.'/'.$image->image_location) }}">
                    <img class="img-fluid"
                         data-splide-lazy="{{ asset('storage/news/'.$news->slug.'/'.$image->image_location) }}"
                         alt="{{ $news->title }}">
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </section>
      </div>
    </div>
    </div>
    <div class="row mt-4 justify-content-center">
      <div class="col-lg-8">
        <p>{!! $news->content !!}</p>
        <div class="d-flex justify-content-lg-between justify-content-center mt-4 flex-wrap">
          @foreach($news->attachments as $attachment)
            <x-download-attachment :href="asset('storage/news/'.$news->slug.'/'.$attachment->attachment_location)"
                                   :filename="basename($attachment->attachment_location)"/>
          @endforeach
        </div>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <a href="/{{app()->getLocale()}}/news"
           class="btn btn-primary d-flex justify-content-center align-items-center ">@lang('back')</a>
      </div>
  </x-slot>
</x-layouts.app>
<script type="module">
  const newsImages = document.getElementById('news-images');
  const main = new Splide('#' + newsImages.firstElementChild.id, {
    type: 'fade',
    pagination: false,
    lazyLoad: 'nearby',
    heightRatio: 0.5,
  });
  main.mount();
</script>
