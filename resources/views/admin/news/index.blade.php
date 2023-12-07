@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="mt-5">
        <h2 class="text-center">Aktualitātes</h2>
      </div>
      <div>
        <div class="container">
          <div class="row justify-content-between">
            <div class="mb-2">
              <a href="/admin/news/create" class="btn btn-success">Pievienot jaunu</a>
            </div>
            @include('includes.status-messages')
            @foreach($news as $newsItem)
              <div class="col-lg-4 p-2">
                <div class="card position-relative">
                  <div class="card-body">
                    <p class="card-title text-center">{{ $newsItem->title }}</p>
                    <hr>
                    <div class="d-flex justify-content-center mt-4">
                      <a href="/admin/news/{{ $newsItem->id }}/edit" class="btn btn-dark m-1">Rediģēt</a>
                      <button type="button" data-bs-toggle="modal"
                              data-bs-target="#delete-news-modal-{{$newsItem->id}}" class="btn btn-danger m-1">
                        Dzēst
                      </button>
                    </div>
                  </div>
                </div>
                @include('admin.news.delete-modal')
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
