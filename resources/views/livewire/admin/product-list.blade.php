<div class="row mt-2">
  @include('includes.status-messages')
  <table class="table table-hover">
    <thead class="thead-dark">
    <tr>
      <th colspan="7"></th>
    </tr>
    </thead>
    <tbody wire:sortable="updateOrder">
    @foreach($products as $product)
      <tr wire:key="product-{{ $product->id }}" wire:sortable.item="{{ $product->id }}">
        <td class="align-middle" wire:sortable.handle>
          <i class="bi bi-arrows-move"></i>
        </td>
        <td class="align-middle">
                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->is_active ? 'Aktīvs' : 'Nav aktīvs' }}
                        </span>
        </td>
        <td
          class="align-middle">{!! $product->cover_video_filename ? '<i class="bi bi-camera-video-fill"></i>' : '<i class="bi bi-image-fill"></i>' !!}</td>
        <td class="align-middle">
          <img src="{{ asset('storage/product-images/'.$product->slug.'/'.$product->cover_photo_filename) }}"
               class="img-thumbnail" style="max-width: 100px;">
        </td>
        <td class="align-middle">
          <h5>{{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</h5>
        </td>
        <td class="align-middle">
          <a href="/admin/{{ $product->slug }}/edit" title="Rediģēt" class="btn">
            <i class="bi bi-pencil-square"></i>
          </a>
        </td>
        <td class="align-middle">
          @if(count($product->productVariants) != 0)
            <div x-data="{ expanded: false }">
              <button @click="expanded = !expanded" class="btn btn-sm btn-outline-secondary"
                      :class="{ 'mb-2': expanded }">
                <span x-text="expanded ? 'Paslēpt variantus' : 'Rādīt variantus'"></span>
                ({{ count($product->productVariants) }})
              </button>
              <div x-show="expanded">
                <ul class="list-unstyled">
                  @foreach($product->productVariants as $variant)
                    <li class="mb-2">
                                                <span
                                                  class="badge {{ $variant->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $variant->is_active ? 'Aktīvs' : 'Nav aktīvs' }}
                                                </span>
                      {{ $variant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}
                      <a href="/admin/product-variant/{{ $variant->id }}/edit" title="Rediģēt" class="btn px-1 py-0">
                        <i class="bi bi-pencil-square"></i>
                      </a>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @else
            <p>Nav pievienoti varianti.</p>
          @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
