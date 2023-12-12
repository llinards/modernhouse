@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Rediģēt
          - {{ $productVariant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</h2>
      </div>
      <div class="all-products-content my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              @include('includes.status-messages')
              <form action="/admin/product-variant" id="update-product-variant" method="POST"
                    enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input name="id" id="id" value="{{ $productVariant->id }}" class="visually-hidden">
                {{--                <div class="mb-3">--}}
                {{--                  <h4>Pieder pie kategorijas ---}}
                {{--                    <strong>{{ $productVariant->product->translation[0]->name}}</strong></h4>--}}
                {{--                </div>--}}
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $productVariant->is_active }}"
                           id="product-variant-available"
                           name="product-variant-available" {{ $productVariant->is_active ? 'checked' : '' }} >
                    <label class="form-check-label" for="product-variant-available">
                      Pieejams mājaslapā
                    </label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="product-variant-name" class="form-label">Nosaukums</label>
                  <input type="text" class="form-control" id="product-variant-name"
                         value="{{ $productVariant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}"
                         name="product-variant-name">
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-6">
                      <label for="product-variant-basic-price" class="form-label">Cena rūpnīcas komplektācijai</label>
                      <input type="text" name="product-variant-basic-price" id="product-variant-basic-price"
                             value="{{ $productVariant->price_basic }}" class="form-control">
                    </div>
                    <div class="col-6">
                      <label for="product-variant-full-price" class="form-label">Cena pilnai komplektācijai</label>
                      <input type="text" name="product-variant-full-price" id="product-variant-full-price"
                             value="{{ $productVariant->price_full }}" class="form-control">
                    </div>
                    <p class="small">Ja cena tiek norādīta kā 0.00, tad klientiem rādīsies - <strong>Cena pēc
                        individuālā pieprasījuma.</strong></p>
                  </div>
                </div>
                <div class="mb-3">
                  <a href="/admin/product-variant/{{ $productVariant->id }}/product-variant-options"
                     class="btn btn-dark">Tehniskā informācija</a>
                  <a href="/admin/product-variant/{{ $productVariant->id }}/product-variant-details"
                     class="btn btn-dark">Platība, istabas</a>
                </div>
                <div class="mb-3">
                  <div class="row">
                    <div class="col-6">
                      <label for="product-variant-living-area" class="form-label">Dzīvojamā platība</label>
                      <input type="text" name="product-variant-living-area"
                             value="{{ $productVariant->living_area }}" class="form-control">
                    </div>
                    <div class="col-6">
                      <label for="product-variant-building-area" class="form-label">Apbūves platība</label>
                      <input type="text" name="product-variant-building-area"
                             value="{{ $productVariant->building_area }}" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="product-variant-description" class="form-label">Apraksts</label>
                  <textarea rows="5" class="form-control" name="product-variant-description"
                            id="product-variant-description">
                    {{ $productVariant->translations[0]->description ?? 'Nav pievienots tulkojums!' }}
                  </textarea>
                </div>
                <div class="mb-3" id="product-variant-images">
                  <p>Esošās bildes</p>
                  <div class="row">
                    @if(count($productVariant->productVariantImages) === 0)
                      <p>Nav pievienotas bildes!</p>
                    @else
                      @foreach($productVariant->productVariantImages as $image)
                        <div class="col-lg-4 col-md-3 col-sm-6 col-6">
                          <a class="btn btn-danger btn-sm mb-1"
                             href="{{ URL::to('/admin/product-variant/image/'.$image->id.'/delete') }}">
                            <i class="bi bi-x"></i>
                          </a>
                          <img class="img-fluid mb-2"
                               src="{{ asset('storage/product-images/'.$product->slug.'/'.$productVariant->slug.'/'.$image->filename) }}"
                               alt="">
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
                <div class="mb-3">
                  <label for="product-variant-images" class="form-label">Pievienot jaunas bildes</label>
                  <input class="form-control" type="file" id="product-variant-images" name="product-variant-images[]">
                  <p class="small">Bildei ir jābūt .JPG, .JPEG vai .PNG formātā un pēc iespējas mazākā izmērā.</p>
                  <p class="small">Tās var samazināt šajā lapā - <a href="https://compressor.io/" target="_blank">compressor.io</a>
                  </p>
                </div>
                <div class="d-flex justify-content-between">
                  <button type="button" data-bs-toggle="modal" data-bs-target="#delete-product-variant-modal"
                          class="btn btn-danger">Dzēst
                  </button>
                  <div class="d-flex">
                    <a href="/admin" class="btn btn-dark">Atpakaļ</a>
                    <button type="submit" form="update-product-variant" class="btn btn-success mx-1">Atjaunot</button>
                  </div>
                </div>
              </form>
              @include('admin.product-variant.delete-modal')
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
      allowMultiple: true,
      allowReorder: true,
      maxFileSize: '500KB',
      allowImagePreview: true,
      acceptedFileTypes: ['image/*'],
    });
  </script>
@endsection
