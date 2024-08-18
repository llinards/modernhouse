<div class="mb-3" id="all-product-variant-images">
  <p>Esošās bildes</p>
  <div class="row" wire:sortable="updateOrder">
    @if(count($productVariant->productVariantImages) === 0)
      <p>Nav pievienotas bildes!</p>
    @else
      @foreach($productVariant->productVariantImages as $image)
        <div class="col-lg-4 col-md-3 col-sm-6 col-6" wire:sortable.item="{{ $image->id }}"
             wire:key="product-variant-image-{{ $image->id }}" wire:sortable.handle>
          <a class="btn btn-danger btn-sm mb-1"
             href="{{ URL::to('/admin/product-variant/image/'.$image->id.'/delete') }}">
            <i class="bi bi-x"></i>
          </a>
          <img class="img-fluid mb-2"
               src="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
               alt="">
        </div>
      @endforeach
    @endif
  </div>
</div>
