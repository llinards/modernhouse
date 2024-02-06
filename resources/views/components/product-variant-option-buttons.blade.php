<div>
  <ul class="nav nav-tabs d-flex justify-content-evenly border-0 buttons-content-switch flex-nowrap">
    <li class="nav-item">
      <button class="nav-link active" data-bs-toggle="tab"
              data-bs-target="#basic-{{$productVariant->slug}}" type="button">@lang('basic')
      </button>
    </li>
    <li class="nav-item">
      <button class="nav-link" data-bs-toggle="tab"
              data-bs-target="#full-{{$productVariant->slug}}" type="button">@lang('full')
      </button>
    </li>
  </ul>
</div>
