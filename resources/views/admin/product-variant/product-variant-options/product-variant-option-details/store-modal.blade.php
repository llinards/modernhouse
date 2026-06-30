<div class="modal fade" id="store-product-variant-option-detail-modal-{{ $productVariantOption->id }}" tabindex="-1"
     aria-labelledby="store-product-variant-detail-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form x-data="{ isLabel: false }"
          action="{{ route('product-variant-options.store-product-variant-option-detail', ['locale' => app()->getLocale()]) }}"
          method="POST">
          @csrf
          <input name="id" class="visually-hidden" value="{{ $productVariantOption->id }}">
          <div class="mb-3">
            <input type="text" class="form-control" name="product_variant_option_detail"
                   value="" required>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="is-label-{{ $productVariantOption->id }}"
                   name="is_label" value="1" x-model="isLabel">
            <label class="form-check-label" for="is-label-{{ $productVariantOption->id }}">
              Apakšvirsraksts (bez komplektācijām)
            </label>
          </div>
          <div class="d-flex justify-content-between mb-3" x-show="!isLabel">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-basic-{{ $productVariantOption->id }}"
                     name="has_in_basic"
                     value="1">
              <label class="form-check-label" for="has-in-basic-{{ $productVariantOption->id }}">
                Bāzes komplektācija
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-middle-{{ $productVariantOption->id }}"
                     name="has_in_middle"
                     value="1">
              <label class="form-check-label" for="has-in-middle-{{ $productVariantOption->id }}">
                Pelēkā apdare
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-full-{{ $productVariantOption->id }}"
                     name="has_in_full" value="1">
              <label class="form-check-label" for="has-in-full-{{ $productVariantOption->id }}">
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
