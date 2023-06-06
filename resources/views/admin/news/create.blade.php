@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section>
      <div class="my-5">
        <h2 class="text-center">Pievienot jaunu aktualitāti</h2>
      </div>
      <div class="my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin/news" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="news-title" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="news-title" value="{{ old('news-title') }}"
                         name="news-title">
                </div>
                <div class="mb-3">
                  <label for="news-content" class="form-label">Apraksts</label>
                  <textarea rows="5" class="form-control" name="news-content" id="news-content">
                    {{ old('news-content') }}
                  </textarea>
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
                <button type="submit" class="btn btn-success">Pievienot</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    CKEDITOR.replace('news-content', {
      removeButtons: removeButtons = 'Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize',
      allowedContent: true
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
      required: true,
      allowMultiple: true,
      allowReorder: true,
      allowFileSizeValidation: true,
      allowImagePreview: true,
      maxFileSize: "33MB",
      acceptedFileTypes: ['image/*', 'application/pdf'],
    });
  </script>
@endsection
