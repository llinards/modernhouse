@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="my-5">
        <h2 class="text-center">Rediģēt - {{ $news->title }}</h2>
      </div>
      <div class="my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin/news/" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input name="id" class="visually-hidden" value="{{ $news->id }}">
                <div class="mb-3">
                  <label for="news-title" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="news-title" value="{{ $news->title }}"
                         name="news-title">
                </div>
                <div class="mb-3">
                  <label for="news-content" class="form-label">Apraksts</label>
                  <x-description-text-area
                    :name="'news-content'"> {{ $news->content }}</x-description-text-area>
                </div>
                <div class="mb-3" id="news-images">
                  <p>Esošās bildes</p>
                  <div class="row">
                    @if(count($news->images) === 0)
                      <p>Nav pievienotas bildes!</p>
                    @else
                      @foreach($news->images as $image)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/news/image/'.$image->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          <img class="img-fluid mb-2"
                               src="{{ asset('storage/news/'.$news->slug.'/'.$image->image_location) }}"
                               alt="">
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="mb-3" id="news-attachments">
                  <p>Esošie pielikumi</p>
                  <div class="row">
                    @if(count($news->attachments) === 0)
                      <p>Nav pievienoti pielikumi!</p>
                    @else
                      @foreach($news->attachments as $attachment)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/news/attachment/'.$attachment->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          <p class="mb-2">{{ basename($attachment->attachment_location) }}</p>
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col">
                    <label for="news-images" class="form-label">Bildes</label>
                    <input class="form-control" type="file" id="news-images" name="news-images[]">
                    </p>
                  </div>
                  <div class="col">
                    <label for="news-attachments" class="form-label">Pielikumi</label>
                    <input class="form-control" type="file" id="news-attachments" name="news-attachments[]">
                    </p>
                  </div>
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a>
                  <p class="small">Pielikumam ir jābūt .PDF un pēc iespējas mazākā izmērā.</p>
                </div>
                <a href="/admin/news" class="btn btn-dark">Atpakaļ</a>
                <button type="submit" class="btn btn-success">Atjaunot</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.create(document.querySelector('input[id="news-images"]'), {
      server: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      allowMultiple: true,
      allowReorder: true,
      allowFileSizeValidation: true,
      allowImagePreview: true,
      maxFileSize: "512KB",
      acceptedFileTypes: ['image/*'],
    });

    FilePond.create(document.querySelector('input[id="news-attachments"]'), {
      server: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      allowMultiple: true,
      allowReorder: true,
      allowFileSizeValidation: true,
      maxFileSize: "50MB",
      acceptedFileTypes: ['application/pdf'],
    });
  </script>
@endsection
