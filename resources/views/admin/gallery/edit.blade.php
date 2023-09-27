@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="my-5">
        <h2 class="text-center">Rediģēt - {{ $galleryContent->translations[0]->title ?? 'Nav tulkojuma!' }}</h2>
      </div>
      <div class="my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin/gallery" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input name="id" class="visually-hidden" value="{{ $galleryContent->id }}">
                <div class="row mb-3">
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gallery-type" name="gallery-type"
                             value="{{ $galleryContent->is_video }}" {{ $galleryContent->is_video ? 'checked' : '' }}>
                      <label class="form-check-label" for="gallery-type">
                        Video galerija
                      </label>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gallery-pinned" name="gallery-pinned"
                             value="{{ $galleryContent->is_pinned }}" {{ $galleryContent->is_pinned ? 'checked' : '' }}>
                      <label class="form-check-label" for="gallery-pinned">
                        Rādīt galeriju kā pirmo
                      </label>
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="gallery-title" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="gallery-title"
                         value="{{ $galleryContent->translations[0]->title ?? 'Nav tulkojuma!' }}"
                         name="gallery-title">
                </div>
                <div class="mb-3">
                  <label for="gallery-content" class="form-label">Apraksts</label>
                  <textarea rows="5" class="form-control" name="gallery-content" id="gallery-content">
                    {{ $galleryContent->translations[0]->content ?? 'Nav tulkojuma!' }}
                  </textarea>
                </div>
                <div class="mb-3" id="gallery-images">
                  <p>Esošās bildes / video</p>
                  <div class="row">
                    @if(count($galleryContent->galleryImages) === 0)
                      <p>Nav pievienotas bildes!</p>
                    @else
                      @foreach($galleryContent->galleryImages as $image)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/gallery/'.$image->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          @if($galleryContent->is_video)
                            <video class="img-fluid mb-2" controls
                                   src="{{ asset('storage/gallery/'.$galleryContent->slug.'/'.$image->filename) }}"
                            />
                          @else
                            <img class="img-fluid mb-2"
                                 src="{{ asset('storage/gallery/'.$galleryContent->slug.'/'.$image->filename) }}"
                                 alt="">
                          @endif
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="mb-3">
                  <label for="gallery-images" class="form-label">Bildes</label>
                  <input class="form-control" type="file" id="gallery-images" name="gallery-images[]">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a>
                  </p>
                </div>
                <a href="/admin/gallery" class="btn btn-dark">Atpakaļ</a>
                <button type="submit" class="btn btn-success">Atjaunot</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    CKEDITOR.replace('gallery-content', {
      removeButtons: removeButtons = 'Source,Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize'
    });
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.create(document.querySelector('input[id="gallery-images"]'));
    FilePond.setOptions({
      server: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      allowFileSizeValidation: true,
      maxFileSize: '50MB',
      maxTotalFileSize: '50MB',
      allowMultiple: true,
      allowReorder: true,
      allowImagePreview: true,
      acceptedFileTypes: ['image/*', 'video/mp4'],
    });
  </script>
@endsection
