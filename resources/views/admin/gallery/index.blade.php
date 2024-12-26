<x-layouts.admin>
  <x-slot name="header">
    <h2 class="text-center">Galerijas</h2>
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-between">
      <div class="my-2">
        <a href="/admin/gallery/create" class="btn btn-success">Pievienot jaunu</a>
      </div>
      <livewire:admin.gallery-list/>
    </div>
  </x-slot>
</x-layouts.admin>
