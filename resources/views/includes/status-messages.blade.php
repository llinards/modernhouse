@if($errors->any())
  <div class="alert alert-danger mx-0 my-2" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    Kļūda!<br/>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@elseif(Session::has('success'))
  <div class="alert alert-success mx-0 my-2" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <p>{{Session::get('success')}}</p>
  </div>
@endif
