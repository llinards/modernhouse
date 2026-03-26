@if($errors->any())
  <div class="alert alert-danger mx-0 my-2 js-status-alert" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@elseif(Session::has('success'))
  <div class="alert alert-success mx-0 my-2 js-status-alert" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <p>{{Session::get('success')}}</p>
  </div>
@elseif(Session::has('warning'))
  <div class="alert alert-warning mx-0 my-2 js-status-alert" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <p>{{Session::get('warning')}}</p>
  </div>
@elseif(Session::has('error'))
  <div class="alert alert-danger mx-0 my-2 js-status-alert" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <p>{{Session::get('error')}}</p>
  </div>
@endif

@once
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.js-status-alert');
    if (alert) {
      alert.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  });
</script>
@endonce

