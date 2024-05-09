<x-layouts.admin>
  <x-slot name="header">
    Pieteikumi atvērto durvju dienām Svīres ielā
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-between">
      @if(count($submissions) === 0)
        <div class="alert alert-secondary" role="alert">
          Izskatās, ka pagaidām nav pieteikumu!
        </div>
      @endif
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Vārds</th>
          <th scope="col">Uzvārds</th>
          <th scope="col">Datums</th>
          <th scope="col">Laiks</th>
          <th scope="col">Telefona numurs</th>
          <th scope="col">Jautājumi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($submissions as $submission)
          <tr>
            <th scope="row">{{$submission->id}}</th>
            <td>{{ $submission->firstName }}</td>
            <td>{{ $submission->lastName }}</td>
            <td>{{ $submission->date }}</td>
            <td>{{ $submission->time }}</td>
            <td>{{ $submission->phoneNumber }}</td>
            <td>{{ $submission->questions }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </x-slot>
</x-layouts.admin>
