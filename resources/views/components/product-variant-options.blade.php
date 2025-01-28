<div class="tab-content mt-2">
  <div class="tab-pane fade show active">
    <div class="accordion accordion-flush">
      @foreach($productVariant->productVariantOptions as $option)
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
              <table class="table">
                <thead>
                <tr>
                  <th scope="col"></th>
                  @if($productVariant->price_basic)
                    <th class="text-center align-middle" scope="col">@lang('basic')</th>
                  @endif
                  @if($productVariant->price_middle)
                    <th class="text-center align-middle" scope="col">@lang('middle')</th>
                  @endif
                  @if($productVariant->price_full)
                    <th class="text-center align-middle" scope="col">@lang('full')</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($option->productVariantOptionDetails as $detail)
                  @if(str_contains($detail->detail, '*'))
                    <tr>
                      <td colspan="4">
                        <p class="small">{{$detail->detail}}</p></td>
                    </tr>
                  @else
                    <tr>
                      <td>{{ $detail->detail }}</td>
                      @if($productVariant->price_basic)
                        <td class="text-center align-middle">
                          <img width="25" height="25"
                               src="{{ $detail->has_in_basic ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>
                        </td>
                      @endif
                      @if($productVariant->price_middle)
                        <td class="text-center align-middle">
                          <img width="25" height="25"
                               src="{{ $detail->has_in_middle ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>
                        </td>
                      @endif
                      @if($productVariant->price_full)
                        <td class="text-center align-middle">
                          <img width="25" height="25"
                               src="{{ $detail->has_in_full ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>
                        </td>
                      @endif
                    </tr>
                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
