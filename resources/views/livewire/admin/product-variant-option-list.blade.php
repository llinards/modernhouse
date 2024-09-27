<div class="accordion accordion-flush" wire:sortable="updateProductVariantOptionOrder"
     wire:sortable-group="updateProductVariantOptionDetailOrder">
  @foreach($productVariantOptions as $productVariantOption)
    <div class="accordion-item" wire:key="product-variant-option-{{ $productVariantOption->id }}"
         wire:sortable.item="{{ $productVariantOption->id }}">
      <div class="d-flex align-items-center">
        <div class="align-middle" wire:sortable.handle>
          <i class="bi bi-arrows-move"></i>
        </div>
        <h2 class="accordion-header flex-grow-1 mx-2">
          <button class="accordion-button collapsed variant-button" type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapse{{ $productVariantOption->id }}"
                  aria-expanded="false" aria-controls="collapse{{ $productVariantOption->id }}">
            {{ $productVariantOption->option_title }}
          </button>
        </h2>
        <button type="button" class="btn btn-dark mx-1" data-bs-toggle="modal"
                data-bs-target="#edit-product-variant-modal-{{ $productVariantOption->id }}">
          <i class="bi bi-pencil text-white"></i>
        </button>
        <form
          action="{{route('product-variant-options.destroy-product-variant-option', ['productVariantOption' => $productVariantOption->id])}}"
          method="POST">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');" class="btn btn-danger"
                  type="submit">
            <i class="bi bi-trash text-white"></i>
          </button>
        </form>
      </div>
      <div id="collapse{{ $productVariantOption->id }}"
           class="accordion-collapse collapse product-variant-option-content">
        <div class="accordion-body p-0 mt-2">
          <ul wire:sortable-group.item-group="{{ $productVariantOption->id }}">
            @foreach($productVariantOption->productVariantOptionDetails as $detail)
              <li wire:key="product-variant-option-{{ $detail->id }}" wire:sortable-group.item="{{ $detail->id}}"
                  class="d-flex align-items-center mb-2">
                @include('admin.product-variant.product-variant-options.edit-modal', ['detail' => $detail])
                <div wire:sortable-group.handle>
                  <i class="bi bi-arrows-move"></i>
                </div>
                <div class="mx-2">
                  <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                          data-bs-target="#edit-product-variant-detail-modal-{{ $detail->id }}">
                    <i class="bi bi-pencil text-white"></i>
                  </button>
                  <form
                    action="{{ route('product-variant-options.destroy-product-variant-option-detail', ['productVariantOptionDetail' => $detail]) }}"
                    method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');"
                            class="btn btn-danger"
                            type="submit">
                      <i class="bi bi-trash text-white"></i>
                    </button>
                  </form>
                </div>
                <div>
                  {{ $detail->detail }}
                </div>

              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endforeach
</div>
