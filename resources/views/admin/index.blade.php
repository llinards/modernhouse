<x-layouts.admin>
  <x-slot name="header">
    Visas mājas/moduļi
  </x-slot>
  <x-slot name="content">
    @if(app()->getLocale() == 'lv')
      <div class="d-flex gap-2">
        <div class="my-2">
          <a href="{{ route('admin.products.create', ['locale' => app()->getLocale()]) }}" class="btn btn-success">Jauna kategorija</a>
        </div>
        <div class="my-2">
          <a href="/admin/{{ app()->getLocale() }}/product-variant/create" class="btn btn-success">Jauns
            modulis/māja</a>
        </div>
      </div>
    @endif
    <div class="row justify-content-center">
      <livewire:admin.product-list/>
    </div>
  </x-slot>
</x-layouts.admin>
