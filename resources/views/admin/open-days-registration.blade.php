<x-layouts.admin>
  <x-slot name="header">
    Pieteikumi atvērto durvju dienām
  </x-slot>
  <x-slot name="content">
    <div class="row justify-content-between">
      @include('includes.status-messages')
      @if(count($submissions) === 0)
        <div class="alert alert-secondary" role="alert">
          Izskatās, ka pagaidām nav pieteikumu!
        </div>
      @else
        <h4 class="my-2">Kopējais pieteikumu skaits: {{count($submissions)}}</h4>
        <div class="d-flex justify-content-evenly mt-2 mb-2">
          <a href="/admin/open-days-submissions/export" class="btn btn-dark">Lejupielādēt Excel formātā</a>
        </div>
      @endif
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">Vārds</th>
          <th scope="col">Uzvārds</th>
          <th scope="col">Datums</th>
          <th scope="col">Laiks</th>
          <th scope="col">Telefona numurs</th>
          <th scope="col">Mērķis</th>
          <th scope="col"/>
        </tr>
        </thead>
        <tbody>
        @php
          $previousSubmission = null;
        @endphp
        @foreach($submissions as $submission)
          @php
            // $isDuplicate = $previousSubmission && $previousSubmission->date === $submission->date && $previousSubmission->time === $submission->time;
            $isDuplicate = false;
            $previousSubmission = $submission;
          @endphp
          <tr>
            <td>{{ $submission->firstName }}</td>
            <td>{{ $submission->lastName }}</td>
            <td @if($isDuplicate) class="bg-danger" @endif>{{ $submission->date }}</td>
            <td @if($isDuplicate) class="bg-danger" @endif>{{ $submission->time }}</td>
            <td>{{ $submission->phoneNumber }}</td>
            <td>{{ $submission->reason }}</td>
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
      <div class="d-flex justify-content-evenly mt-2 mb-2">
        <form action="/admin/open-days-submissions/all/delete" method="POST">
          @csrf
          @method('DELETE')
          <td>
            <button onclick="return confirm('Vai tiešām vēlies dzēst VISUS ierakstus?');" class="btn btn-danger"
                    type="submit">Dzēst visus ierakstus
            </button>
        </form>
      </div>
    </div>
  </x-slot>
</x-layouts.admin>
