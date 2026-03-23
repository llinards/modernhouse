<div>
  @include('includes.status-messages')
  <table class="table table-hover" style="table-layout: fixed">
    <thead>
    <tr>
      <th style="width: 40px"></th>
      <th style="width: 40px"></th>
      <th scope="col" style="width: 100px">Statuss</th>
      <th scope="col">Nosaukums</th>
      <th scope="col" style="width: 100px">Tulkojumi</th>
      <th scope="col" style="width: 100px">Varianti</th>
      <th style="width: 110px"></th>
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
        <td
          class="align-middle">{{ $product->translations->firstWhere('language', app()->getLocale())?->name ?? 'Nav pievienots tulkojums!' }}</td>
        <td class="align-middle">
          @php $translatedLanguages = $product->translations->pluck('language')->toArray() @endphp
          @foreach(config('app.languages') as $code => $label)
            <span class="badge {{ in_array($code, $translatedLanguages) ? 'bg-success' : 'bg-light text-muted' }}">
              {{ strtoupper($code) }}
            </span>
          @endforeach
        </td>
        <td class="align-middle">
          @if(count($product->productVariants) > 0)
            <button class="btn btn-sm btn-outline-secondary collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#variants-{{ $product->id }}">
              <i class="bi bi-chevron-up"></i>
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
          <form action="/admin/{{ app()->getLocale() }}/{{ $product->slug }}/delete" method="POST"
                class="d-inline"
                onsubmit="return confirm('Vai tiešām vēlies dzēst? Visi varianti, bildes saistītas ar šo produktu arī tiks dzēstas.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn" title="Dzēst">
              <i class="bi bi-trash"></i>
            </button>
          </form>
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
