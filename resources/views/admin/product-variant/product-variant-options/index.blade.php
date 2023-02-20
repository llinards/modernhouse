@extends('app')
@section('content')
  <div class="container">
    @include('includes.admin-navbar')
    <section class="all-products">
      <div class="all-products-title my-5">
        <h2 class="text-center">Tehniskā informācija - {{ $productVariant->name }}</h2>
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
                  <div class="row">
                    @foreach($allProductVariantOptions as $key => $productVariantOption)
                      
                      <div class="col-6 product-variant-option-{{$key}}">
                        <input name="id[]" id="id[]" value="{{ $productVariantOption->id }}" class="visually-hidden">
                        <div class="mb-3">
                          <input type="text" class="form-control" id="product-variant-option-title-{{$key}}"
                                 value="{{ $productVariantOption->option_title }}"
                                 name="product-variant-option-title[]">
                        </div>
                        <div class="mb-3">
                          <select class="form-select" name="product-variant-option-category[]">
                            <option
                              {{ $productVariantOption->option_category == 'Basic' ? 'selected' : '' }} value="Basic">
                              Rūpnīcas komplektācija
                            </option>
                            <option
                              {{ $productVariantOption->option_category == 'Full' ? 'selected' : '' }} value="Full">
                              Pilnā komplektācija
                            </option>
                          </select>
                        </div>
                        <div class="mb-2">
                        <textarea rows="5" class="form-control" class="product-variant-option-description"
                                  name="product-variant-option-description[]"
                                  id="product-variant-option-description-{{$key}}">
                        {{ $productVariantOption->options }}
                        </textarea>
                        </div>
                        <div class="w-100 mb-5">
                          <a
                            href="{{ URL::to('/admin/product-variant/'. $productVariant->id .'/product-variant-options/'. $productVariantOption->id) }}"
                            class="btn btn-danger w-100" onclick="return confirm('Vai tiešām vēlies dzēst?')">Dzēst</a>
                        </div>
                      </div>

                    @endforeach
                  </div>
                  <a href="/admin/product-variant/{{ $productVariant->id }}/edit" class="btn btn-secondary">Atpakaļ</a>
                  <button type="submit" class="btn btn-success mx-1">Atjaunot</button>
                </form>
{{--              @else--}}
{{--                <form action="/admin/product-variant/{{ $productVariant->id }}/product-variant-options" method="POST"--}}
{{--                      enctype="multipart/form-data">--}}
{{--                  @csrf--}}
{{--                  <div class="row">--}}
{{--                    <div class="col-6 product-variant-option">--}}
{{--                      <input name="product-variant-id[]" id="product-variant-id-0" value="{{ $productVariant->id }}" class="visually-hidden">--}}
{{--                      <div class="mb-3">--}}
{{--                        <input type="text" class="form-control" id="product-variant-option-title-0"--}}
{{--                               value="{{ old('product-variant-option-title.0') }}"--}}
{{--                               name="product-variant-option-title[]">--}}
{{--                      </div>--}}
{{--                      <div class="mb-3">--}}
{{--                        <select class="form-select" name="product-variant-option-category[]">--}}
{{--                          <option selected>Izvēlies komplektāciju</option>--}}
{{--                          <option value="Basic">--}}
{{--                            Rūpnīcas komplektācija--}}
{{--                          </option>--}}
{{--                          <option value="Full">--}}
{{--                            Pilnā komplektācija--}}
{{--                          </option>--}}
{{--                        </select>--}}
{{--                      </div>--}}
{{--                      <div class="mb-2">--}}
{{--                        <textarea rows="5" class="form-control" class="product-variant-option-description"--}}
{{--                                  name="product-variant-option-description[]"--}}
{{--                                  id="product-variant-option-description-0">--}}
{{--                        {{ old('product-variant-option-description.0') }}--}}
{{--                        </textarea>--}}
{{--                      </div>--}}
{{--                      <div class="w-100 mb-5">--}}
{{--                        <a--}}
{{--                          href=""--}}
{{--                          class="btn btn-danger w-100" onclick="return confirm('Vai tiešām vēlies dzēst?')">Dzēst</a>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                  <a href="/admin/product-variant/{{ $productVariant->id }}/edit" class="btn btn-secondary">Atpakaļ</a>--}}
{{--                  <button type="submit"--}}
{{--                          class="btn btn-success mx-1">{{ count($allProductVariantOptions) !== 0 ? 'Atjaunot' : 'Pievienot' }}</button>--}}
{{--                </form>--}}
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script>
    const allProductVariantOptionDescriptions = document.querySelectorAll('textarea');

    for (let i = 0; i < allProductVariantOptionDescriptions.length; i++) {
      CKEDITOR.replace('product-variant-option-description-' + i, {
        removeButtons: 'Source,Save,Templates,SelectAll,Scayt,NewPage,Preview,Print,Find,Replace,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,Outdent,Indent,Blockquote,CreateDiv,JustifyCenter,JustifyLeft,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize'
      });
    }

    const addNewProductVariantOption = () => {
      console.log('clicked');
      const productVariantOptionContainer = document.querySelector('.product-variant-option');
      const cloneElement = productVariantOptionContainer.cloneNode(true);
      productVariantOptionContainer.parentElement.appendChild(cloneElement);
    };
  </script>
@endsection
