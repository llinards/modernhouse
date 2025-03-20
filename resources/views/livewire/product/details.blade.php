<div class="col-lg-5 d-flex flex-column justify-content-between">
    <div>
        <h2 class="text-center">@lang('choose option')</h2>
        <x-product-variant-option-buttons :productVariant="$productVariant"/>
        <div class="mb-2">
            {{--              TODO: Nepieciešams būs rādīt katram produktu variantam atšķirīgus aprakstus--}}
            @if($productVariant->price_basic)
                <div class="basic-variant-price basic-{{$productVariant->slug}} show active">
                    <h3
                            class="text-center mt-3">
                        @if($productVariant->price_basic != 0.00)
                            @lang('price from') EUR {{ number_format($productVariant->price_basic, 2, ',', ' ') }}
                        @else
                            @lang('individual price')
                        @endif
                    </h3>
                    {{--                TODO: Temporary fix--}}
                    @if(($product->slug === 'dvinu-majas' || $product->slug === 'privatmajas'))
                        <div class="mt-3 d-flex flex-column">
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('foundation_construction')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('utility_installation')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('house_structure_installation')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('external_finish_completed')</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            @if($productVariant->price_middle)
                <div class="middle-variant-price middle-{{$productVariant->slug}}">
                    <h3 class="text-center mt-3">
                        @if($productVariant->price_middle != 0.00)
                            @lang('price from') EUR {{ number_format($productVariant->price_middle, 2, ',', ' ') }}
                        @else
                            @lang('individual price')
                        @endif
                    </h3>
                    {{--                TODO: Temporary fix--}}
                    @if(($product->slug === 'dvinu-majas' || $product->slug === 'privatmajas'))
                        <div class="mt-3 d-flex flex-column">
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('foundation_construction')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('internal_utility_installation')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('house_structure_installation')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('external_finish_with_panels')</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            @if($productVariant->price_full)
                <div class="full-variant-price full-{{$productVariant->slug}}">
                    <h3 class="text-center mt-3">
                        @if($productVariant->price_full != 0.00)
                            @lang('price from') EUR {{ number_format($productVariant->price_full, 2, ',', ' ') }}
                        @else
                            @lang('individual price')
                        @endif
                    </h3>
                    {{--                TODO: Temporary fix--}}
                    @if(($product->slug === 'dvinu-majas' || $product->slug === 'privatmajas'))
                        <div class="mt-3 d-flex flex-column">
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('foundation_construction')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('internal_utility_installation')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('house_structure_installation')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('complete_internal_and_external_finish')</p>
                            </div>
                            <div class="d-flex product-variant-options-included">
                                <img width="25" height="25" src="{{ asset('storage/icons/check.svg') }}"/>
                                <p class="small">@lang('kitchen_and_bathroom_setup')</p>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <hr class="my-1">
        <div class="product-variant-description mx-auto">
            <p>{!! $productVariant->translations[0]->description !!}</p>
            <div class="d-flex justify-content-between">
                <p>@lang('living space') : {{ $productVariant->living_area }} m<sup>2</sup>
                </p>
                <p>@lang('construction area') : {{ $productVariant->building_area }}
                    m<sup>2</sup></p>
            </div>
            @if($productVariant->productVariantDetails->isNotEmpty())
                <hr class="my-1">
                <ul class="product-variant-details p-0 m-0">
                    @foreach($productVariant->productVariantDetails as $detail)
                        <li class="d-flex justify-content-between">
                            <div>
                                <img src="{{ asset('storage/icons/' . ($detail->hasThis ? 'check.svg' : 'negative.svg')) }}"/>
                                {{ $detail->name }}
                            </div>
                            <div>
                                <img src="{{ asset('storage/icons/product-variant-detail-icons/'.$detail->icon.'.svg') }}"/>
                                @if($detail->count > 0)
                                    {{ $detail->count }}
                                @else
                                    <span class="invisible">-</span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                <hr class="my-1 mb-4">
            @endif
        </div>
    </div>
    <div class="d-flex flex flex-wrap gap-2 justify-content-center">
        @if($productVariant->productVariantPlan->isNotEmpty())
            @foreach($productVariant->productVariantPlan as $plan)
                <a
                        class="btn btn-primary btn-primary-sm d-flex justify-content-center align-items-center {{$loop->first ? '' : 'visually-hidden'}}"
                        href="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/plan/'.$plan->filename) }}"
                        data-fancybox="{{$productVariant->slug}}-plan">
                    @lang('View the house plan')
                </a>
            @endforeach
        @endif
        <button id="{{$productVariant->slug}}"
                class="btn btn-primary btn-primary-sm d-flex justify-content-center align-items-center request-product-info-modal"
        >@lang('customer order')</button>
    </div>
</div>
@script
<script>
    document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(button => {
        button.addEventListener('show.bs.tab', () => {
            const targetClass = button.dataset.bsTarget.replace('#', '');
            const currentVariantPrice = document.querySelector(`.${targetClass}`);
            if (currentVariantPrice) {
                document.querySelectorAll('.basic-variant-price, .middle-variant-price, .full-variant-price')
                    .forEach(element => element.classList.remove('show', 'active'));
                currentVariantPrice.classList.add('show', 'active');
            }
        });
    });

    const modal = new bootstrap.Modal('#request-product-info');
    document.querySelectorAll('.request-product-info-modal').forEach(button => {
        button.addEventListener('click', () => modal.show());
    });
</script>
@endscript
