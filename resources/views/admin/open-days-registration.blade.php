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
          <th scope="col"/>
        </tr>
        </thead>
        <tbody>
        @php
          $previousSubmission = null;
        @endphp
        @foreach($submissions as $submission)
          @php
            $isDuplicate = $previousSubmission && $previousSubmission->date === $submission->date && $previousSubmission->time === $submission->time;
            $previousSubmission = $submission;
          @endphp
          <tr>
            <th scope="row">{{$submission->id}}</th>
            <td>{{ $submission->firstName }}</td>
            <td>{{ $submission->lastName }}</td>
            <td @if($isDuplicate) class="bg-danger" @endif>{{ $submission->date }}</td>
            <td @if($isDuplicate) class="bg-danger" @endif>{{ $submission->time }}</td>
            <td>{{ $submission->phoneNumber }}</td>
            <td>{{ $submission->questions }}</td>
            <form action="/admin/open-days-submissions/{{$submission->id}}/delete" method="POST">
              @csrf
              @method('DELETE')
              <td>
                <button onclick="return confirm('Vai tiešām vēlies dzēst ierakstu?');" class="btn btn-dark"
                        type="submit"><i
                    class="bi bi-trash text-white"></i></button>
            </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </x-slot>
</x-layouts.admin>
