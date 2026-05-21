<div>
  <x-status-messages />
  <table class="table table-hover align-middle" style="table-layout: fixed">
    <thead>
    <tr>
      <th style="width: 40px"></th>
      <th scope="col">Nosaukums</th>
      <th scope="col" style="width: 100px">Ieraksti</th>
      <th style="width: 110px"></th>
    </tr>
    </thead>
    <tbody wire:sortable="updateProductVariantOptionOrder"
           wire:sortable-group="updateProductVariantOptionDetailOrder">
    @foreach($productVariantOptions as $productVariantOption)
      <tr wire:key="option-row-{{ $productVariantOption->id }}"
          wire:sortable.item="{{ $productVariantOption->id }}">
        <td wire:sortable.handle>
          <i class="bi bi-arrows-move"></i>
        </td>
        <td>
          {{ $productVariantOption->option_title }}
        </td>
        <td>
          <button class="btn btn-sm btn-outline-secondary collapsed" type="button"
                  data-bs-toggle="collapse" data-bs-target="#option-details-{{ $productVariantOption->id }}"
                  aria-expanded="false" aria-controls="option-details-{{ $productVariantOption->id }}">
            <i class="bi bi-chevron-up"></i>
            <i class="bi bi-chevron-down"></i>
            <span class="badge bg-secondary">{{ count($productVariantOption->productVariantOptionDetails) }}</span>
          </button>
        </td>
        <td>
          @include('admin.product-variant.product-variant-options.edit-modal', ['productVariantOption' => $productVariantOption])
          <button type="button" class="btn" title="Rediģēt" data-bs-toggle="modal"
                  data-bs-target="#edit-product-variant-option-modal-{{ $productVariantOption->id }}">
            <i class="bi bi-pencil-square"></i>
          </button>
          <form
            action="{{ route('product-variant-options.destroy-product-variant-option', ['locale' => app()->getLocale(), 'productVariantOption' => $productVariantOption->id]) }}"
            method="POST" class="d-inline"
            onsubmit="return confirm('Vai tiešām vēlies dzēst ierakstu?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" title="Dzēst">
              <i class="bi bi-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      <tr wire:key="option-details-row-{{ $productVariantOption->id }}"
          id="option-details-{{ $productVariantOption->id }}" class="collapse">
        <td colspan="4" class="p-0">
          <div class="p-2">
            @include('admin.product-variant.product-variant-options.product-variant-option-details.store-modal', ['productVariantOption' => $productVariantOption])
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                    data-bs-target="#store-product-variant-option-detail-modal-{{ $productVariantOption->id }}">
              <i class="bi bi-plus text-white"></i> Pievienot ierakstu
            </button>
          </div>
          <table class="table table-hover table-light align-middle m-0" style="table-layout: fixed">
            <tbody wire:sortable-group.item-group="{{ $productVariantOption->id }}">
            @foreach($productVariantOption->productVariantOptionDetails as $detail)
              <tr wire:key="option-detail-{{ $detail->id }}"
                  wire:sortable-group.item="{{ $detail->id }}">
                <td style="width: 40px" wire:sortable-group.handle>
                  <i class="bi bi-arrows-move"></i>
                </td>
                <td>
                  @include('admin.product-variant.product-variant-options.product-variant-option-details.edit-modal', ['detail' => $detail])
                  <i class="bi bi-arrow-return-right text-muted me-1"></i>{{ $detail->detail }}
                </td>
                <td style="width: 240px">
                  @unless(str_contains($detail->detail, '*'))
                    <span class="d-flex gap-1">
                      <span class="badge {{ $detail->has_in_basic ? 'bg-success' : 'bg-light text-muted' }}" title="Bāzes komplektācija">Bāzes</span>
                      <span class="badge {{ $detail->has_in_middle ? 'bg-success' : 'bg-light text-muted' }}" title="Pelēkā apdare">Pelēkā</span>
                      <span class="badge {{ $detail->has_in_full ? 'bg-success' : 'bg-light text-muted' }}" title="Pilnā komplektācija">Pilnā</span>
                    </span>
                  @endunless
                </td>
                <td style="width: 110px">
                  <button type="button" class="btn btn-sm" title="Rediģēt" data-bs-toggle="modal"
                          data-bs-target="#edit-product-variant-option-detail-modal-{{ $detail->id }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                  <form
                    action="{{ route('product-variant-options.destroy-product-variant-option-detail', ['locale' => app()->getLocale(), 'productVariantOptionDetail' => $detail->id]) }}"
                    method="POST" class="d-inline"
                    onsubmit="return confirm('Vai tiešām vēlies dzēst ierakstu?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm" title="Dzēst">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
