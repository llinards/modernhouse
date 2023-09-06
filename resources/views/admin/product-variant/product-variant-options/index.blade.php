@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Tehniskā informācija - {{ $productVariant->{'name_'.app()->getLocale()} }}</h2>
      </div>
      <div class="all-products-content my-5">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7 col-12">
              <div class="mb-5">
                <button class="btn btn-success" onclick="addNewProductVariantOption();">+</button>
              </div>
              @include('includes.status-messages')
              @if (count($allProductVariantOptions) !== 0)
                <form action="/admin/product-variant/{{ $productVariant->id }}/product-variant-options" method="POST"
                      enctype="multipart/form-data">
                  @csrf
                  @method('PATCH')
                  <div class="row" id="product-variant-option-editor-section">
                    @foreach($allProductVariantOptions as $key => $productVariantOption)
                      <x-product-variant-option-update :key="$key" :productVariantOption="$productVariantOption"
                                                       :productVariant="$productVariant"/>
                    @endforeach
                  </div>
                  <a href="/admin/product-variant/{{ $productVariant->id }}/edit" class="btn btn-dark">Atpakaļ</a>
                  <button type="submit" class="btn btn-success mx-1">Atjaunot</button>
                </form>
              @else
                <form action="/admin/product-variant/{{ $productVariant->id }}/product-variant-options" method="POST"
                      enctype="multipart/form-data">
                  @csrf
                  <div class="row" id="product-variant-option-editor-section">
                    <x-product-variant-option-create :productVariant="$productVariant"/>
                  </div>
                  <a href="/admin/product-variant/{{ $productVariant->id }}/edit" class="btn btn-dark">Atpakaļ</a>
                  <button type="submit"
                          class="btn btn-success mx-1">{{ count($allProductVariantOptions) !== 0 ? 'Atjaunot' : 'Pievienot' }}</button>
                </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="col-6 visually-hidden empty-editor">
    <input name="product-variant-id[]" value="{{ $productVariant->id }}"
           class="visually-hidden">
    <div class="mb-3">
      <input type="text" class="form-control product-variant-option-editor-titles"
             value=""
             name="product-variant-option-title[]">
    </div>
    <div class="mb-3">
      <select class="form-select" name="product-variant-option-category[]">
        <option selected>Izvēlies komplektāciju</option>
        <option value="Basic">
          Rūpnīcas komplektācija
        </option>
        <option value="Full">
          Pilnā komplektācija
        </option>
      </select>
    </div>
    <div class="mb-2">
                        <textarea rows="5" class="form-control product-variant-option-editor-descriptions"
                                  name="product-variant-option-description[]">
                        </textarea>
    </div>
  </div>


  <script>
    let currentEditorId = document.querySelectorAll('.product-variant-option-editors').length - 1;

    function setProductVariantOptionEditorIds() {
      const productVariantOptionEditors = document.querySelectorAll('.product-variant-option-editors');
      const productVariantOptionTitles = document.querySelectorAll('.product-variant-option-editor-titles');
      const productVariantOptionDescriptions = document.querySelectorAll('.product-variant-option-editor-descriptions');
      for (let i = 0; i < productVariantOptionEditors.length; i++) {
        productVariantOptionEditors[i].setAttribute('id', 'product-variant-option-editor-' + i);
        productVariantOptionTitles[i].setAttribute('id', 'product-variant-option-editor-title-' + i);
        productVariantOptionDescriptions[i].setAttribute('id', 'product-variant-option-editor-description-' + i);
      }
    }

    function setCKEDITOR() {
      const productVariantOptionEditors = document.querySelectorAll('.product-variant-option-editors');
      for (let i = 0; i < productVariantOptionEditors.length; i++) {
        const productVariantOptionEditor = document.getElementById('product-variant-option-editor-' + i);
        if (productVariantOptionEditor.getAttribute('data-editor-initialized') === 'false') {
          CKEDITOR.replace('product-variant-option-editor-description-' + i, {
            removeButtons: 'Source,Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize'
          });
          productVariantOptionEditor.setAttribute('data-editor-initialized', 'true');
        }
      }
    }

    setProductVariantOptionEditorIds();
    setCKEDITOR();

    const addNewProductVariantOption = () => {
      currentEditorId++;
      const productVariantOptionContainer = document.querySelector('.empty-editor');
      const cloneElement = productVariantOptionContainer.cloneNode(true);
      document.getElementById('product-variant-option-editor-section').appendChild(cloneElement);
      cloneElement.classList.remove('visually-hidden');
      cloneElement.classList.add('product-variant-option-editors');
      cloneElement.classList.remove('empty-editor');
      cloneElement.setAttribute('data-editor-initialized', 'false');
      cloneElement.setAttribute('id', 'product-variant-option-editor-' + currentEditorId);
      setProductVariantOptionEditorIds();
      setCKEDITOR();
    };
  </script>
@endsection
