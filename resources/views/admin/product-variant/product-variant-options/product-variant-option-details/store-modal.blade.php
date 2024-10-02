<div class="modal fade" id="store-product-variant-option-detail-modal" tabindex="-1"
     aria-labelledby="store-product-variant-detail-modal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form
          action="{{ route('product-variant-options.store-product-variant-option-detail') }}"
          method="POST">
          @csrf
          <input name="id" class="visually-hidden" value="{{ $productVariantOption->id }}">
          <div class="mb-3">
            <input type="text" class="form-control" name="product_variant_option_detail"
                   value="" required>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-basic"
                     name="has_in_basic"
                     value="">
              <label class="form-check-label" for="has-in-basic">
                Bāzes komplektācija
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-middle"
                     name="has_in_middle"
                     value="">
              <label class="form-check-label" for="has-in-middle">
                Pelēkā apdare
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-full"
                     name="has_in_full" value="">
              <label class="form-check-label" for="has-in-full">
                Pilnā komplektācija
              </label>
            </div>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Saglabāt</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
