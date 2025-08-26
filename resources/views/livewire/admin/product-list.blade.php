<div class="row mt-2">
  @include('includes.status-messages')
  <div class="row" wire:sortable="updateOrder">
    @foreach($products as $product)
      <div class="col-lg-4 col-md-6 col-12 mb-4" wire:key="product-{{ $product->id }}"
           wire:sortable.item="{{ $product->id }}">
        <div class="card h-100">
          <!-- Card Header with Drag Handle and Status -->
          <div class="p-2 d-flex justify-content-between align-items-center">
            <div wire:sortable.handle class="cursor-move">
              <i class="bi bi-arrows-move text-muted"></i>
            </div>
            <div>
            <span class="badge bg-dark bg-opacity-75">
                {!! $product->cover_video_filename ? '<i class="bi bi-camera-video-fill"></i>' : '<i class="bi bi-image-fill"></i>' !!}
              </span>
              <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
              {{ $product->is_active ? 'Aktīvs' : 'Nav aktīvs' }}
            </span>
            </div>
          </div>

          <!-- Card Image -->
          <div class="position-relative">
            <img src="{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename) }}"
                 class="card-img-top"
                 style="height: 200px; object-fit: cover;"
                 alt="{{ $product->translations[0]->name ?? 'Product image' }}">
          </div>

          <!-- Card Body -->
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</h5>

            <!-- Edit Button -->
            <div class="mb-3">
              <a href="/admin/{{ $product->slug }}/edit" title="Rediģēt" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-pencil-square"></i> Rediģēt
              </a>
            </div>

            <!-- Product Variants -->
            <div class="mt-auto">
              @if(count($product->productVariants) != 0)
                <div x-data="{ expanded: false }">
                  <button @click="expanded = !expanded"
                          class="btn btn-sm btn-outline-secondary w-100"
                          :class="{ 'mb-2': expanded }">
                    <span x-text="expanded ? 'Paslēpt variantus' : 'Rādīt variantus'"></span>
                    <span class="badge bg-secondary ms-1">{{ count($product->productVariants) }}</span>
                  </button>

                  <div x-show="expanded" x-transition class="mt-2">
                    <div class="list-group list-group-flush">
                      @foreach($product->productVariants as $variant)
                        <div class="list-group-item px-0 py-2 d-flex justify-content-between align-items-start">
                          <div class="flex-grow-1">
                            <span class="badge {{ $variant->is_active ? 'bg-success' : 'bg-danger' }} me-2">
                              {{ $variant->is_active ? 'Aktīvs' : 'Nav aktīvs' }}
                            </span>
                            <small>{{ $variant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</small>
                          </div>
                          <a href="/admin/product-variant/{{ $variant->id }}/edit"
                             title="Rediģēt"
                             class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil-square"></i>
                          </a>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @else
                <div class="text-center text-muted">
                  <small>Nav pievienoti varianti.</small>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
