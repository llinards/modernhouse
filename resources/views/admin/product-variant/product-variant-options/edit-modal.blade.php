<div class="modal fade" id="edit-product-variant-option-modal-{{ $productVariantOption->id }}" tabindex="-1"
     aria-labelledby="edit-product-variant-detail-modal-{{ $productVariantOption->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form
          action="{{ route('product-variant-options.update-product-variant-option', ['productVariantOption' => $productVariantOption->id]) }}"
          method="POST">
          @csrf
          @method('PATCH')
          <input name="id" class="visually-hidden" value="{{ $productVariantOption->id }}">
          <div class="mb-3">
            <input type="text" class="form-control" id="detail-{{ $productVariantOption->id }}"
                   name="product_variant_option"
                   value="{{ $productVariantOption->option_title }}" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Saglabāt</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
