@php
  $messages = collect([
    'danger'  => $errors->any() ? $errors->all() : null,
    'success' => session('success'),
    'warning' => session('warning'),
    'error'   => session('error'),
  ])->map(fn ($value, $key) => $value ? ['type' => $key === 'error' ? 'danger' : $key, 'messages' => (array) $value] : null)->filter();
@endphp

@foreach($messages as $alert)
  <div class="alert alert-{{ $alert['type'] }} mx-0 my-2 js-status-alert" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    @if(count($alert['messages']) === 1)
      <p class="mb-0">{{ $alert['messages'][0] }}</p>
    @else
      <ul class="mb-0">
        @foreach($alert['messages'] as $message)
          <li>{{ $message }}</li>
        @endforeach
      </ul>
    @endif
  </div>
@endforeach

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
