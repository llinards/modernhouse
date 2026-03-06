@props(['productVariant', 'product'])

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
