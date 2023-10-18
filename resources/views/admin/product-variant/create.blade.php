@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Pievienot jaunu moduli/māju</h2>
      </div>
      <div class="all-products-content my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin/product-variant" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="product-id" class="form-label">Izvēlies kategoriju</label>
                  <select class="form-select" name="product-id" id="product-id">
                    <option selected>Izvēlies...</option>
                    @foreach($allProducts as $product)
                      <option
                        value="{{ $product->id }}">{{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="product-variant-name" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="product-variant-name"
                         value="{{ old('product-variant-name') }}" name="product-variant-name">
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-6">
                      <label for="product-variant-basic-price" class="form-label">Cena rūpnīcas komplektācijai</label>
                      <input type="text" name="product-variant-basic-price" id="product-variant-basic-price"
                             value="{{ old('product-variant-basic-price') }}" class="form-control">
                    </div>
                    <div class="col-6">
                      <label for="product-variant-full-price" class="form-label">Cena pilnai komplektācijai</label>
                      <input type="text" name="product-variant-full-price" id="product-variant-full-price"
                             value="{{ old('product-variant-full-price') }}" class="form-control">
                    </div>
                    <p class="small">Ja cena tiek norādīta kā 0.00, tad klientiem rādīsies - <strong>Cena pēc
                        individuālā pieprasījuma.</strong></p>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="product-variant-description" class="form-label">Apraksts</label>
                  <textarea rows="5" class="form-control" name="product-variant-description"
                            id="product-variant-description">
                    {{ old('product-variant-description') }}
                  </textarea>
                </div>
                <div class="mb-3">
                  <label for="product-variant-images" class="form-label">Bildes</label>
                  <input class="form-control" type="file" id="product-variant-images" name="product-variant-images[]">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a>
                  </p>
                </div>
                <a href="/admin" class="btn btn-dark">Atpakaļ</a>
                <button type="submit" class="btn btn-success">Pievienot</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    CKEDITOR.replace('product-variant-description', {
      removeButtons: removeButtons = 'Source,Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize'
    });

    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginImagePreview);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.create(document.querySelector('input[id="product-variant-images"]'));
    FilePond.setOptions({
      server: {
        url: '/admin/upload',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      },
      required: true,
      allowMultiple: true,
      maxFileSize: '500KB',
      allowReorder: true,
      allowImagePreview: true,
      acceptedFileTypes: ['image/*'],
    });
  </script>
@endsection
