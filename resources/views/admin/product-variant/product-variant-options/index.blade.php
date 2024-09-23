<x-layouts.admin>
  <x-slot name="header">
    Tehniskā informācija
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        @include('includes.status-messages')
        <form action="{{ route('product-variant-options.import', ['productVariant' => $productVariant->id]) }}"
              method="POST">
          @csrf
          <input name="product-variant-id" id="id" value="{{$productVariant->id}}"
                 class="visually-hidden">
          <x-file-upload :required="true"
                         :name="'product-variant-options-excel'"/>
          <button type="submit" class="btn btn-success">Augšupielādēt</button>
        </form>
      </div>
    </div>
    <div class="row justify-content-center mt-5">
      @if(count($productVariantOptions) === 0)
        <div class="col-lg-7 col-12">
          <div class="alert alert-secondary" role="alert">
            Izskatās, ka pagaidām tehniskā informācija nav pievienota.
          </div>
        </div>
      @else
        <div class="col-12">
          <table class="table table-striped">
            <thead>
            <tr>
              <th scope="col">Nosaukums</th>
              <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($productVariantOptions as $productVariantOption)
              <tr>
                <td>
                  <button class="btn btn-dark" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapse{{ $productVariantOption->id }}" aria-expanded="false"
                          aria-controls="collapse{{ $productVariantOption->id }}">
                    {{ $productVariantOption->option_title }}
                  </button>
                  <div class="collapse mt-2" id="collapse{{ $productVariantOption->id }}">
                    <ul class="list-unstyled">
                      @foreach($productVariantOption->productVariantOptionDetails as $detail)
                        <li class="d-flex align-items-center mb-2">
                          <form
                            action="{{ route('product-variant-options.destroy-product-variant-option-detail', ['productVariantOptionDetail' => $detail->id]) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');" class="btn btn-dark"
                                    type="submit">
                              <i class="bi bi-trash text-white"></i>
                            </button>
                          </form>
                          <div class="px-1">
                            {{ $detail->detail }}
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </td>
                <td>
                  <form
                    action="{{route('product-variant-options.destroy-product-variant-option', ['productVariantOption' => $productVariantOption->id])}}"
                    method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');" class="btn btn-dark"
                            type="submit">
                      <i class="bi bi-trash text-white"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            <form
              action="{{route('product-variant-options.destroy', ['productVariant' => $productVariant->id])}}"
              method="POST">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu visu tehnisko informāciju?');"
                      class="btn btn-danger"
                      type="submit">
                Dzēst visu tehnisko informāciju
              </button>
            </form>
          </div>
        </div>
      @endif
    </div>
  </x-slot>
</x-layouts.admin>
