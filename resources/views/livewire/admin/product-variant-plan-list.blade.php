<div class="mb-3">
  <p>Esošais plānojums</p>
  <div class="row">
    @if(count($productVariantPlan) === 0)
      <p>Nav pievienots plānojums!</p>
    @else
      @foreach($productVariantPlan as $plan)
        <div class="col-lg-4 col-md-3 col-sm-6 col-6"
             wire:key="product-variant-image-{{ $plan->id }}">
          <button type="button" wire:click="deletePlan({{$plan}})" class="btn btn-danger btn-sm mb-1"
                  wire:confirm="Vai tiešām vēlies dzēst plānojumu?">
            <i class="bi bi-x"></i>
          </button>
          <img class="img-fluid mb-2"
               src="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/plan/'.$plan->filename) }}"
               alt="">
        </div>
      @endforeach
    @endif
  </div>
</div>
