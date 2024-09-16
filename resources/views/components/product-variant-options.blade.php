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
                  <th class="text-center" scope="col">@lang('basic')</th>
                  <th class="text-center" scope="col">@lang('full')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($option->productVariantOptionDetails as $detail)
                  <tr>
                    <td>{{ $detail->detail }}</td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ $detail->has_in_basic ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>
                    </td>
                    <td class="text-center">
                      <img width="25" height="25"
                           src="{{ $detail->has_in_full ? asset('storage/icons/check.svg') : asset('storage/icons/negative.svg') }}"/>
                    </td>
                  </tr>
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
