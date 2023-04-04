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
                  <textarea rows="5" class="form-control" name="news-content" id="news-content">
                    {{ $news->content }}
                  </textarea>
                </div>
                <div class="mb-3" id="news-images">
                  <p>Esošās bildes</p>
                  <div class="row">
                    @if(count($news->newsImages) === 0)
                      <p>Nav pievienotas bildes!</p>
                    @else
                      @foreach($news->newsImages as $image)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/news/images/'.$image->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          <img class="img-fluid mb-2"
                               src="{{ asset('storage/news/'.Str::slug($news->title).'/'.$image->image_location) }}"
                               alt="">
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="mb-3" id="news-attachments">
                  <p>Esošie pielikumi</p>
                  <div class="row">
                    @if(count($news->newsAttachments) === 0)
                      <p>Nav pievienoti pielikumi!</p>
                    @else
                      @foreach($news->newsAttachments as $attachment)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/news/attachments/'.$attachment->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          <p class="mb-2">{{ basename($attachment->attachment_location) }}</p>
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="mb-3">
                  <label for="news-images-attachments" class="form-label">Bildes un pielikumi</label>
                  <input class="form-control" type="file" id="news-images-attachments" name="news-images-attachments[]">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a>
                  <p class="small">Pielikumam ir jābūt .PDF un pēc iespējas mazākā izmērā.</p>
                  </p>
                </div>
                <a href="/admin/news" class="btn btn-secondary">Atpakaļ</a>
                <button type="submit" class="btn btn-success">Atjaunot</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    CKEDITOR.replace('news-content', {
      removeButtons: removeButtons = 'Source,Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize'
    });
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.create(document.querySelector('input[id="news-images-attachments"]'));
    FilePond.setOptions({
      server: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      allowFileSizeValidation: true,
      maxFileSize: "33MB",
      allowImagePreview: true,
      allowMultiple: true,
      allowReorder: true,
      acceptedFileTypes: ['image/*', 'application/pdf'],
    });
  </script>
@endsection
