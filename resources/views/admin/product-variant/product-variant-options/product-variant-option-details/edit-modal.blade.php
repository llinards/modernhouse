<div class="modal fade" id="edit-product-variant-option-detail-modal-{{ $detail->id }}" tabindex="-1"
     aria-labelledby="edit-product-variant-detail-modal-{{ $detail->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form
          action="{{ route('product-variant-options.update-product-variant-option-detail', ['productVariantOptionDetail' => $detail->id]) }}"
          method="POST">
          @csrf
          @method('PATCH')
          <input name="id" class="visually-hidden" value="{{ $detail->id }}">
          <div class="mb-3">
            <input type="text" class="form-control" id="detail-{{ $detail->id }}" name="product_variant_option_detail"
                   value="{{ $detail->detail }}" required>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-basic-{{ $detail->id }}"
                     name="has_in_basic"
                     value="{{ $detail->has_in_basic }}" {{ $detail->has_in_basic ? 'checked' : '' }}>
              <label class="form-check-label" for="has-in-basic-{{ $detail->id }}">
                Bāzes komplektācija
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-middle-{{ $detail->id }}"
                     name="has_in_middle"
                     value="{{ $detail->has_in_middle }}" {{ $detail->has_in_middle ? 'checked' : '' }}>
              <label class="form-check-label" for="has-in-middle-{{ $detail->id }}">
                Pelēkā apdare
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="has-in-full-{{ $detail->id }}"
                     name="has_in_full" value="{{ $detail->has_in_full }}" {{ $detail->has_in_full ? 'checked' : '' }}>
              <label class="form-check-label" for="has-in-full-{{ $detail->id }}">
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
