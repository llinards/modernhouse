@extends('app')
@section('content')
{{--  @include('includes.navbar-desktop', ['index' => false])--}}
  @include('includes.navbar-mobile', ['index' => false])
  <div class="container-xxl content">
    <div class="row">
      <div class="title">
        <h1 class="fw-bold text-center text-uppercase">{{ $product->name }}</h1>
      </div>
      <div class="product-levels">
        <ul class="nav mt-4 nav-tabs d-flex product-level-titles flex-nowrap">
          @if(count($product->productOptions) !== 1)
            @foreach($product->productOptions as $option)
              <li class="nav-item">
                <button class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#{{Str::slug($option->name)}}" type="button">{{ $option->name }}</button>
              </li>
            @endforeach
          @endif
        </ul>
        <div class="tab-content product-level">
          @foreach($product->productOptions as $option)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{Str::slug($option->name)}}">
              <div class="row">
                <div class="col-lg-7 mt-4">
                  <section id="{{Str::slug($option->name)}}-main-carousel" class="splide">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productImages as $image)
                          @if($image->option_id === $option->id)
                            <li class="splide__slide">
                              <img class="img-fluid" src="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($option->name).'/'.$image->filename }}" alt="">
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                  <section id="{{Str::slug($option->name)}}-thumbnail-carousel" class="splide mt-2">
                    <div class="splide__track">
                      <ul class="splide__list">
                        @foreach($product->productImages as $image)
                          @if($image->option_id === $option->id)
                            <li class="splide__slide">
                              <img class="img-fluid" data-splide-lazy="{{ asset('storage/product-images/'.Str::slug($product->name)).'/'.Str::slug($option->name).'/'.$image->filename }}"/>
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </div>
                  </section>
                </div>
                <div class="col-lg-5 mt-4 d-flex flex-column">
                  <div class="product-short-description">
                    <p>{{ $option->description }}</p>
                  </div>
                  <div class="product-option-types">
                    <h4 class="fw-bold text-center mt-4 mb-2">Choose your variant:</h4>
                    <div class="product-levels">
                      <ul class="nav nav-tabs d-flex product-level-titles flex-nowrap">
                        <li class="nav-item">
                          <button class="nav-link active variant-title" id="basic-variant-title" data-bs-toggle="tab" data-bs-target="#basic-{{Str::slug($option->name)}}" type="button">Basic</button>
                        </li>
                        <li class="nav-item">
                          <button class="nav-link variant-title" id="full-variant-title" data-bs-toggle="tab" data-bs-target="#full-{{Str::slug($option->name)}}" type="button">Full</button>
                        </li>
                      </ul>
                      <div class="tab-content product-level mt-2">
                        <div class="tab-pane fade show active" id="basic-{{Str::slug($option->name)}}">
                          <div class="accordion accordion-flush" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                  Ārsienas
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                                <div class="accordion-body">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Vannasistaba
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                <div class="accordion-body">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="product-price mt-2 mb-5">
                            <h1 class="text-center">EUR {{ number_format($option->price_basic, 2, ',', ' ') }}</h1>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="full-{{Str::slug($option->name)}}">
                          <div class="accordion accordion-flush" id="accordionExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                  Ārsienas
                                </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                                <div class="accordion-body">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed variant-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  Vannasistaba
                                </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                                <div class="accordion-body">
                                  <ul class="list-group list-group-flush">
                                    <li class="list-group-item">An item</li>
                                    <li class="list-group-item">A second item</li>
                                    <li class="list-group-item">A third item</li>
                                    <li class="list-group-item">A fourth item</li>
                                    <li class="list-group-item">And a fifth one</li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="product-price mt-2 mb-5">
                            <h1 class="text-center">EUR {{ number_format($option->price_full, 2, ',', ' ') }}</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="product-order d-flex flex-column align-items-center">
                    <button
                      class="btn btn-primary btn-main btn-secondary fw-light d-flex justify-content-center align-items-center text-uppercase">@lang('order
                      now')</button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <script>

  </script>
@endsection
