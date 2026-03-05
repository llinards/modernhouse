<div>
  @include('includes.status-messages')
  <table class="table table-hover">
    <thead>
    <tr>
      <th></th>
      <th></th>
      <th scope="col">Statuss</th>
      <th scope="col">Nosaukums</th>
      <th scope="col">Varianti</th>
      <th></th>
    </tr>
    </thead>
    <tbody wire:sortable="updateOrder">
    @foreach($products as $product)
      <tr wire:sortable.item="{{ $product->id }}" wire:key="product-{{ $product->id }}">
        <td class="align-middle" wire:sortable.handle>
          <i class="bi bi-arrows-move"></i>
        </td>
        <td
          class="align-middle">{!! $product->cover_video_filename ? '<i class="bi bi-camera-video-fill"></i>' : '<i class="bi bi-image-fill"></i>' !!}</td>
        <td class="align-middle">
          <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
            {{ $product->is_active ? 'Aktīvs' : 'Nav aktīvs' }}
          </span>
        </td>
        <td class="align-middle">{{ $product->translations[0]->name ?? 'Nav pievienots tulkojums!' }}</td>
        <td class="align-middle">
          @if(count($product->productVariants) > 0)
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#variants-{{ $product->id }}">
              <i class="bi bi-chevron-down"></i>
              <span class="badge bg-secondary">{{ count($product->productVariants) }}</span>
            </button>
          @else
            <small class="text-muted">Nav variantu</small>
          @endif
        </td>
        <td class="align-middle">
          <a href="/admin/{{ app()->getLocale() }}/{{ $product->slug }}/edit" title="Rediģēt" class="btn">
            <i class="bi bi-pencil-square"></i>
          </a>
        </td>
      </tr>
      @foreach($product->productVariants as $variant)
        <tr class="collapse table-light" id="variants-{{ $product->id }}">
          <td></td>
          <td></td>
          <td class="align-middle">
            <span class="badge {{ $variant->is_active ? 'bg-success' : 'bg-danger' }}">
              {{ $variant->is_active ? 'Aktīvs' : 'Nav aktīvs' }}
            </span>
          </td>
          <td class="align-middle">
            <i class="bi bi-arrow-return-right text-muted me-1"></i>
            {{ $variant->translations[0]->name ?? 'Nav pievienots tulkojums!' }}
          </td>
          <td></td>
          <td class="align-middle">
            <a href="/admin/{{ app()->getLocale() }}/product-variant/{{ $variant->id }}/edit"
               title="Rediģēt" class="btn">
              <i class="bi bi-pencil-square"></i>
            </a>
          </td>
        </tr>
      @endforeach
    @endforeach
    </tbody>
  </table>
</div>
