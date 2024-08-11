<x-layouts.admin>
  <x-slot name="header">
    Aktualitātes
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-between">
      <div class="mb-2">
        <a href="/admin/news/create" class="btn btn-success">Pievienot jaunu</a>
      </div>
      @include('includes.status-messages')
      @foreach($allNews as $news)
        <div class="col-lg-4 p-2">
          <div class="card position-relative">
            <div class="card-header d-flex justify-content-end align-content-center">
              <a href="/admin/news/{{ $news->id }}/edit" title="Rediģēt" class="btn py-0">
                <i class="bi bi-pencil-square"></i>
              </a>
              <button type="button" title="Dzēst" data-bs-toggle="modal"
                      data-bs-target="#delete-news-modal-{{$news->id}}"
                      class="btn p-0">
                <i class="bi bi-trash-fill"></i>
              </button>
            </div>
            <div class="card-body">
              <p class="card-title text-center">{{ $news->title }}</p>
            </div>
          </div>
          @include('admin.news.delete-modal')
        </div>
      @endforeach
    </div>
  </x-slot>
</x-layouts.admin>
