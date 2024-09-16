<div class="tab-content mt-2">
  <div class="tab-pane fade show active">
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
              <div class="accordion-body px-md-4 p-2">
                {{--                {!! $option->options !!}--}}
                <table class="table">
                  <thead>
                  <tr>
                    <th scope="col"></th>
                    <th class="text-center" scope="col">@lang('basic')</th>
                    <th class="text-center" scope="col">@lang('full')</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>Vertikāls fasādes dēlis (UYV 21x120)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Horizontālais latojums (25x100 mm)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Vertikālais Latojums (28x45 mm)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Peļu siets pa mājas perimetru</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Difūzijas membrāna (Siga Majvest 200)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Vēja reģipsis Norgips GU (9,5mm)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Statņi koka karkasam C24 (45x195 mm)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Izolācija Isover KL 35 (200 mm)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Tvaika barjeras plēve (Siga Majpell 5)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Latojums (45x45 mm)</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Izolācija Isover KL 35 (50 mm) &ndash; piegādāts materiāls</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>OSB 3 (10 mm) &ndash; piegādāts materiāls</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Saplāksnis (15 mm) vannas istabās &ndash; piegādāts materiāls</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Reģipsis GKB (12,5 mm) &ndash; piegādāts materiāls</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  <tr>
                    <td>Reģipsis mitrām telpām GKBI (12,5 mm) vannas istabās un tehniskajā telpā &ndash; piegādāts
                      materiāls
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/negative.svg')}}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ asset('storage/icons/check.svg')}}"/>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
  {{--  <div class="tab-pane fade" id="full-{{$productVariant->slug}}">--}}
  {{--    <div class="accordion accordion-flush">--}}
  {{--      @foreach($productVariant->productVariantOptions as $option)--}}
  {{--        @if($option->product_variant_id === $productVariant->id && $option->option_category === 'Full')--}}
  {{--          <div class="accordion-item">--}}
  {{--            <h2 class="accordion-header">--}}
  {{--              <button class="accordion-button collapsed variant-button" type="button"--}}
  {{--                      data-bs-toggle="collapse"--}}
  {{--                      data-bs-target="#{{Str::slug($option->option_title)}}"--}}
  {{--                      aria-expanded="false" aria-controls="{{Str::slug($option->option_title)}}">--}}
  {{--                {{ $option->option_title }}--}}
  {{--              </button>--}}
  {{--            </h2>--}}
  {{--            <div id="{{Str::slug($option->option_title)}}"--}}
  {{--                 class="accordion-collapse collapse product-variant-option-content">--}}
  {{--              <div class="accordion-body px-md-4 p-2">--}}
  {{--                {!! $option->options !!}--}}
  {{--              </div>--}}
  {{--            </div>--}}
  {{--          </div>--}}
  {{--        @endif--}}
  {{--      @endforeach--}}
  {{--    </div>--}}
  {{--  </div>--}}
</div>
