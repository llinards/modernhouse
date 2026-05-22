<div class="modal fade" id="promo-modal" tabindex="-1" aria-labelledby="promo-modal-title" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-close-btn d-flex justify-content-end p-3">
        <button type="button" data-bs-dismiss="modal" aria-label="Close">
          <i class="bi bi-x-lg text-black"></i>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8">
              <img class="img-fluid" src="{{ $promoModal->image_url }}" alt="{{ $promoModal->title }}">
            </div>
            <div class="col-12 col-lg-4 d-flex flex-column justify-content-center">
              <div class="mb-3 mb-lg-4 mt-2 mt-lg-0">
                <h2 id="promo-modal-title" class="text-uppercase mb-3">{{ $promoModal->title }}</h2>
                @if($promoModal->description)
                  <div class="promo-modal-description">{!! $promoModal->description !!}</div>
                @endif
              </div>
              <div class="d-flex justify-content-center justify-content-lg-start">
                <a href="{{ $promoModal->cta_url }}" target="_blank" rel="noopener"
                   class="btn btn-primary text-uppercase d-flex justify-content-center align-items-center">{{ $promoModal->cta_label }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  (function () {
    const promoModal = document.getElementById('promo-modal');
    if (!promoModal || sessionStorage.getItem('promoModalSeen')) {
      return;
    }
    setTimeout(() => {
      try {
        new bootstrap.Modal(promoModal).show();
        sessionStorage.setItem('promoModalSeen', '1');
      } catch (error) {
        console.error('Failed to show promo modal:', error);
      }
    }, 2000);
  })();
</script>
