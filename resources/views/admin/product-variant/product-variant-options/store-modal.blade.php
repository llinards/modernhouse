<div class="modal fade" id="store-product-variant-option-modal" tabindex="-1"
     aria-labelledby="store-product-variant-detail-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form
          action="{{ route('product-variant-options.store-product-variant-option') }}"
          method="POST">
          @csrf
          <input name="id" class="visually-hidden" value="{{ $productVariant->id }}">
          <div class="mb-3">
            <input type="text" class="form-control"
                   name="product_variant_option"
                   value="" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Saglabāt</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
