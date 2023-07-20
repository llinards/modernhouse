<div class="modal fade" id="request-product-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-close-btn d-flex justify-content-end p-3">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="text-center">{{$product->{'name_'.app()->getLocale()} }}</h4>
        <form id="request-product-info" method="POST"
              action="/{{app()->getLocale()}}/{{$product->slug}}">
          @csrf
          <x-honeypot/>
          <input type="text" class="visually-hidden" name="product-name"
                 value="{{ $product->{'name_'.app()->getLocale()} }}"/>
          @if(count($product->productVariants) !== 1)
            <div class="mb-3">
              <label for="product-variant" class="form-label fw-bold">Variants*</label>
              <select class="form-select" name="product-variant" id="product-variant"
                      aria-label="Default select example">
                @foreach($product->productVariants as $variant)
                  <option
                    value="{{ $variant->{'name_'.app()->getLocale()} }}">{{ $variant->{'name_'.app()->getLocale()} }}</option>
                @endforeach
              </select>
            </div>
          @endif
          <div class="mb-3">
            <label for="product-variant-option" class="form-label fw-bold">Komplektācija*</label>
            <select class="form-select" name="product-variant-option" id="product-variant-option"
                    aria-label="Default select example">
              <option value="Basic" selected>Rūpnīcas</option>
              <option value="Full">Pilna</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="name-surname" class="form-label fw-bold">Vārds, uzvārds*</label>
            <input type="text" name="name-surname" class="form-control" id="name-surname"
                   value="{{ old('name-surname') }}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">E-pasts*</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
          </div>
          <div class="mb-3">
            <label for="phone-number" class="form-label fw-bold">Kontakttālrunis*</label>
            <input type="tel" name="phone-number" class="form-control" id="phone-number"
                   value="{{ old('phone-number') }}">
          </div>
          <div class="mb-3">
            <label for="company" class="form-label fw-bold">Uzņēmums</label>
            <input type="text" name="company" class="form-control" id="company" value="{{ old('company') }}">
          </div>
          <label for="customers-question" class="form-label fw-bold">Papildus jautājumi</label>
          <textarea class="form-control mb-3" name="customers-question" id="customers-question" rows="3">
            {{ old('customers-question') }}
          </textarea>
          <div class="mb-3 d-flex align-items-center">
            <input class="form-check-input m-0" type="checkbox" value="1" id="customer-agrees-for-data-processing"
                   name="customer-agrees-for-data-processing"
            >
            <label for="customer-agrees-for-data-processing" class="form-label mb-0 d-block mx-2">Piekrītu, ka mani
              iesniegtie
              dati tiek apstrādāti un uzglabāti.</label>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button type="submit" id="submit-product-info-callback"
                    class="btn btn-primary disabled fw-light d-flex justify-content-center align-items-center">Nosūtīt
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
