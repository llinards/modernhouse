@props(['target' => ''])
<div
  wire:loading.class.remove="d-none"
  wire:target="{{ $target }}"
  class="loading-spinner position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center d-none">
  <div class="spinner spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
