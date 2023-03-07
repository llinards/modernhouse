<div class="col-6 product-variant-option-editors" data-editor-initialized="false">
  <input name="product-variant-id[]" value="{{ $productVariant->id }}"
         class="visually-hidden">
  <div class="mb-3">
    <input type="text" class="form-control product-variant-option-editor-titles"
           value="{{ old('product-variant-option-title.0') }}"
           name="product-variant-option-title[]">
  </div>
  <div class="mb-3">
    <select class="form-select" name="product-variant-option-category[]">
      <option selected>Izvēlies komplektāciju</option>
      <option value="Basic">
        Rūpnīcas komplektācija
      </option>
      <option value="Full">
        Pilnā komplektācija
      </option>
    </select>
  </div>
  <div class="mb-2">
                                        <textarea rows="5"
                                                  class="form-control product-variant-option-editor-descriptions"
                                                  name="product-variant-option-description[]"
                                        >
                                        {{ old('product-variant-option-description.0') }}
                                        </textarea>
  </div>
</div>
