<x-layouts.admin>
  <x-slot name="header">
    Visas mājas/moduļi
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      <div class="text-center">
        <a href="/admin/open-days-submissions" class="btn btn-dark">Pieteikumi atvērto durvju dienai Svīres ielā</a>
      </div>
      <livewire:admin.product-list :products="$products"/>
    </div>
  </x-slot>
</x-layouts.admin>
