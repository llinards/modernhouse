<div class="tab-content mt-2">
    <div class="tab-pane fade show active">
        <div class="accordion accordion-flush">
            @foreach ($productVariant->productVariantOptions as $option)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#option-{{ $option->id }}" aria-expanded="false"
                            aria-controls="option-{{ $option->id }}">
                            {{ $option->option_title }}
                        </button>
                    </h2>
                    <div id="option-{{ $option->id }}"
                        class="accordion-collapse collapse product-variant-option-content">
                        <div class="accordion-body p-md-4 p-2">
                            <ul class="product-variant-option-features p-0 m-0">
                                @foreach ($option->productVariantOptionDetails as $detail)
                                    @if (str_contains($detail->detail, '*'))
                                        <li class="product-variant-option-note" data-variant-note>
                                            <p class="small mb-0">{{ $detail->detail }}</p>
                                        </li>
                                    @else
                                        <li class="product-variant-option-feature d-flex align-items-center"
                                            data-has-basic="{{ $detail->has_in_basic ? 1 : 0 }}"
                                            data-has-middle="{{ $detail->has_in_middle ? 1 : 0 }}"
                                            data-has-full="{{ $detail->has_in_full ? 1 : 0 }}">
                                            <img width="25" height="25"
                                                src="{{ asset('storage/icons/check.svg') }}" />
                                            {{ $detail->detail }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
