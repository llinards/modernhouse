<x-layouts.admin>
  <x-slot name="header">
    Aktualitātes
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-between">
      <div class="mb-2">
        <a href="/admin/news/create" class="btn btn-success">Pievienot jaunu</a>
      </div>
      @include('includes.status-messages')
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">Nosaukums</th>
          <th scope="col">Izveidots</th>
          <th scope="col">Rediģēts</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($allNews as $news)
          <tr>
            <td class="align-middle">{{ $news->title }}</td>
            <td class="align-middle">{{ \Carbon\Carbon::parse($news->created_at)->format('d-m-Y') }}</td>
            <td class="align-middle">{{ \Carbon\Carbon::parse($news->updated_at)->format('d-m-Y') }}</td>
            <td class="align-middle">
              <a href="/admin/news/{{ $news->id }}/edit" title="Rediģēt" class="btn">
                <i class="bi bi-pencil-square"></i>
              </a>
            </td>
            <td class="align-middle">
              <form action="/admin/news/{{ $news->id }}/delete" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" title="Dzēst" onclick="return confirm('Vai tiešām vēlies dzēst aktualitāti?')"
                        class="btn p-0">
                  <i class="bi bi-trash-fill"></i>
                </button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </x-slot>
</x-layouts.admin>
