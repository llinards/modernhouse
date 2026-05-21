<div class="modal fade" id="copy-product-variant-options-modal" tabindex="-1"
     aria-labelledby="copy-product-variant-options-modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Kopēt opcijas no cita varianta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        @if(count($productVariant->productVariantOptions) > 0)
          <div class="alert alert-warning">
            Šim variantam jau ir opcijas. Kopētās opcijas tiks pievienotas esošajām.
          </div>
        @endif
        <form
          action="{{ route('product-variant-options.copy', ['locale' => app()->getLocale(), 'productVariant' => $productVariant->id]) }}"
          method="POST">
          @csrf
          <div class="mb-3">
            <label for="source-variant-select" class="form-label">Izvēlieties variantu</label>
            <select class="form-select" id="source-variant-select" name="source_variant_id" required>
              <option value="">-- Izvēlieties --</option>
              @foreach($availableVariants as $variant)
                <option value="{{ $variant->id }}">
                  {{ $variant->translations->first()?->name ?? $variant->slug }}
                  — {{ $variant->product->translations->first()?->name ?? $variant->product->slug }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Kopēt</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
