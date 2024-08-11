<table class="table table-striped">
  <thead>
  <tr>
    <th scope="col"></th>
    <th scope="col"></th>
    <th scope="col">Nosaukums</th>
    <th scope="col">Izveidots</th>
    <th scope="col">Rediģēts</th>
    <th scope="col"></th>
    <th scope="col"></th>
  </tr>
  </thead>
  <tbody wire:sortable="updateOrder">
  @foreach($galleries as $gallery)
    <tr wire:sortable.item="{{ $gallery->id }}" wire:key="gallery-{{ $gallery->id }}" wire:sortable.handle>
      <td class="align-middle">{!! $gallery->is_pinned ? '<i class="bi bi-pin-angle-fill"></i>' : '' !!}</td>
      <td
        class="align-middle">{!! $gallery->is_video ? '<i class="bi bi-camera-video-fill"></i>' : '<i class="bi bi-image-fill"></i>' !!}</td>
      <td class="align-middle">{{ $gallery->translations[0]->title ?? 'Nav tulkojuma!' }}</td>
      <td class="align-middle">{{ \Carbon\Carbon::parse($gallery->created_at)->format('d-m-Y') }}</td>
      <td class="align-middle">{{ \Carbon\Carbon::parse($gallery->updated_at)->format('d-m-Y') }}</td>
      <td class="align-middle">
        <a href="/admin/gallery/{{ $gallery->id }}/edit" title="Rediģēt" class="btn">
          <i class="bi bi-pencil-square"></i>
        </a>
      </td>
      <td class="align-middle">
        <form action="/admin/gallery/{{ $gallery->id }}/delete" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" title="Dzēst" onclick="return confirm('Vai tiešām vēlies dzēst galeriju?')"
                  class="btn p-0">
            <i class="bi bi-trash-fill"></i>
          </button>
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

