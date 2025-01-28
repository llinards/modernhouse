<div class="mt-2">
  <ul class="nav nav-tabs d-flex justify-content-evenly border-0 buttons-content-switch flex-nowrap">
    @if($productVariant->price_basic)
      <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab"
                data-bs-target="#basic-{{$productVariant->slug}}" type="button">@lang('basic')
        </button>
      </li>
    @endif
    @if($productVariant->price_middle)
      <li class="nav-item">
        <button class="nav-link {{$productVariant->price_basic ? '' : 'active'}}" data-bs-toggle="tab"
                data-bs-target="#middle-{{$productVariant->slug}}" type="button">@lang('middle')
        </button>
      </li>
    @endif
    @if($productVariant->price_full)
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab"
                data-bs-target="#full-{{$productVariant->slug}}" type="button">@lang('full')
        </button>
      </li>
    @endif
  </ul>
</div>
