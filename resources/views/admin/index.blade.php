<x-layouts.admin>
  <x-slot name="header">
    Visas mājas/moduļi
  </x-slot>
  <x-slot name="content">
    @if(app()->getLocale() == 'lv')
      <div class="d-flex gap-2">
        <div class="my-2">
          <a href="{{ route('admin.products.create', ['locale' => app()->getLocale()]) }}" class="btn btn-success">Jauna
            kategorija</a>
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
    <hr class="my-4">
    <h5>Pirmā skata video</h5>
    <div class="row justify-content-center">
      <div class="col-lg-7 col-12">
        <form action="{{ route('admin.introduction-video.update', ['locale' => app()->getLocale()]) }}" method="POST"
              enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="mb-3">
            <x-file-upload :name="'introduction-video'" :required="'true'"
                           :files="$videoExists ? json_encode(['introduction-video/introduction-video.mp4']) : null"/>
            <p class="small">Video ir jābūt .MP4 formātā un pēc iespējas mazākā izmērā.</p>
            <p class="small">Pirmais kadrs tiks automātiski izmantots kā priekšskatījuma bilde.</p>
          </div>
          <button type="submit" class="btn btn-success">Saglabāt</button>
        </form>
      </div>
    </div>
  </x-slot>
</x-layouts.admin>
