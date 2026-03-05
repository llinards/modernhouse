<x-layouts.admin>
  <x-slot name="header">
    Visas mājas/moduļi
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-center">
      @if(app()->getLocale() == 'lv')
        <div class="d-flex gap-2">
          <div class="my-2">
            <a href="/admin/{{ app()->getLocale() }}/create" class="btn btn-success">Jauna kategorija</a>
          </div>
          <div class="my-2">
            <a href="/admin/{{ app()->getLocale() }}/product-variant/create" class="btn btn-success">Jauns
              modulis/māja</a>
          </div>
        </div>
      @endif
      <livewire:admin.product-list/>
    </div>
  </x-slot>
</x-layouts.admin>
