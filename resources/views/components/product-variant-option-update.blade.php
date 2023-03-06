<div class="col-6 product-variant-option-editors" data-editor-initialized="false">
  <input name="id[]" id="id[]" value="{{ $productVariantOption->id }}" class="visually-hidden">
  <input name="product-variant-id[]" value="{{ $productVariant->id }}" class="visually-hidden">
  <div class="mb-3">
    <input type="text" class="form-control product-variant-option-editor-titles"
           value="{{ $productVariantOption->option_title }}"
           name="product-variant-option-title[]">
  </div>
  <div class="mb-3">
    <select class="form-select" name="product-variant-option-category[]">
      <option
        {{ $productVariantOption->option_category == 'Basic' ? 'selected' : '' }} value="Basic">
        Rūpnīcas komplektācija
      </option>
      <option
        {{ $productVariantOption->option_category == 'Full' ? 'selected' : '' }} value="Full">
        Pilnā komplektācija
      </option>
    </select>
  </div>
  <div class="mb-2">
                        <textarea rows="5" class="form-control product-variant-option-editor-descriptions"
                                  name="product-variant-option-description[]"
                        >
                        {{ $productVariantOption->options }}
                        </textarea>
  </div>
  <div class="w-100 mb-5">
    <a
      href="{{ URL::to('/admin/product-variant/'. $productVariant->id .'/product-variant-options/'. $productVariantOption->id) }}"
      class="btn btn-danger w-100" onclick="return confirm('Vai tiešām vēlies dzēst?')">Dzēst</a>
  </div>
</div>
