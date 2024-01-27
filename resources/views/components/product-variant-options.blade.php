<div class="tab-content product-variant-option mt-2">
  <div class="tab-pane fade show active" id="basic-{{$productVariant->slug}}">
    <div class="accordion accordion-flush">
      @foreach($productVariant->productVariantOptions as $option)
        @if($option->product_variant_id === $productVariant->id && $option->option_category === 'Basic')
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed variant-button" type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#{{Str::slug($option->option_title)}}"
                      aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">
                {{ $option->option_title }}
              </button>
            </h2>
            <div id="{{Str::slug($option->option_title)}}"
                 class="accordion-collapse collapse product-variant-option-content">
              <div class="accordion-body">
                {!! $option->options !!}
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
  <div class="tab-pane fade" id="full-{{$productVariant->slug}}">
    <div class="accordion accordion-flush">
      @foreach($productVariant->productVariantOptions as $option)
        @if($option->product_variant_id === $productVariant->id && $option->option_category === 'Full')
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed variant-button" type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#{{Str::slug($option->option_title)}}"
                      aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">
                {{ $option->option_title }}
              </button>
            </h2>
            <div id="{{Str::slug($option->option_title)}}"
                 class="accordion-collapse collapse product-variant-option-content">
              <div class="accordion-body">
                {!! $option->options !!}
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
</div>
