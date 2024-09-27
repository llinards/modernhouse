<table class="table table-striped">
  <thead>
  <tr>
    <th scope="col"></th>
    <th scope="col">Nosaukums</th>
    <th scope="col"></th>
  </tr>
  </thead>
  <tbody wire:sortable="updateProductVariantOptionOrder" wire:sortable-group="updateProductVariantOptionDetailOrder">
  @foreach($productVariantOptions as $productVariantOption)
    <tr wire:key="product-variant-option-{{ $productVariantOption->id }}"
        wire:sortable.item="{{ $productVariantOption->id }}">
      <td class="align-middle" wire:sortable.handle>
        <i class="bi bi-arrows-move"></i>
      </td>
      <td>
        <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $productVariantOption->id }}" aria-expanded="false"
                aria-controls="collapse{{ $productVariantOption->id }}">
          {{ $productVariantOption->option_title }}
        </button>
        <div class="collapse mt-2" id="collapse{{ $productVariantOption->id }}">
          <ul wire:sortable-group.item-group="{{ $productVariantOption->id }}" class="list-unstyled">
            @foreach($productVariantOption->productVariantOptionDetails as $detail)
              <li wire:key="product-variant-option-{{ $detail->id }}" wire:sortable-group.item="{{ $detail->id}}"
                  class="d-flex align-items-center mb-2">
                @include('admin.product-variant.product-variant-options.edit-modal', ['detail' => $detail])
                <div wire:sortable-group.handle>
                  <i class="bi bi-arrows-move"></i>
                </div>
                <button type="button" class="btn btn-dark mx-1" data-bs-toggle="modal"
                        data-bs-target="#edit-product-variant-detail-modal-{{ $detail->id }}">
                  <i class="bi bi-pencil text-white"></i>
                </button>
                <form
                  action="{{ route('product-variant-options.destroy-product-variant-option-detail', ['productVariantOptionDetail' => $detail->id]) }}"
                  method="POST" class="d-inline px-1">
                  @csrf
                  @method('DELETE')
                  <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');"
                          class="btn btn-danger"
                          type="submit">
                    <i class="bi bi-trash text-white"></i>
                  </button>
                </form>
                <div class="">
                  {{ $detail->detail }}
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </td>
      <td>
        <form
          action="{{route('product-variant-options.destroy-product-variant-option', ['productVariantOption' => $productVariantOption->id])}}"
          method="POST">
          @csrf
          @method('DELETE')
          <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');" class="btn btn-dark"
                  type="submit">
            <i class="bi bi-trash text-white"></i>
          </button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
