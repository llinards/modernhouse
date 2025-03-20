<div id="product-variant-gallery" class="col-lg-7">
  <section id="{{$productVariant->slug}}-main-carousel" class="splide">
    <div class="splide__track">
      <ul class="splide__list">
        @foreach($productVariant->productVariantImages as $image)
          <li class="splide__slide">
            <a data-fancybox="{{$productVariant->slug}}"
               href="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}">
              <img class="img-fluid"
                   data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
                   alt="{{ $productVariant->{'name_'.app()->getLocale()} }}">
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  </section>
  <section id="{{$productVariant->slug}}-thumbnail-carousel" class="splide mt-2">
    <div class="splide__track">
      <ul class="splide__list">
        @foreach($productVariant->productVariantImages as $image)
          @if($image->product_variant_id === $productVariant->id)
            <li class="splide__slide">
              <img class="img-fluid"
                   data-splide-lazy="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
                   alt="{{ $productVariant->{'name_'.app()->getLocale()} }}"/>
            </li>
          @endif
        @endforeach
      </ul>
    </div>
  </section>
</div>
@script
<script>
  const gallery = document.getElementById('product-variant-gallery');
  const main = new Splide('#' + gallery.firstElementChild.id, {
    type: 'fade',
    pagination: false,
    lazyLoad: 'sequential',
    rewind: true,
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

  Fancybox.bind("[data-fancybox]", {});
</script>
@endscript
