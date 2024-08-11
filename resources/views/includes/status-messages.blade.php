@if($errors->any())
  <div class="alert alert-danger mx-0 my-2" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@elseif(Session::has('success'))
  <div x-data="{ show: true }"
       x-show="show"
       x-init="setTimeout(() => (show = false), 3000)" class="alert alert-success mx-0 my-2" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <p>{{Session::get('success')}}</p>
  </div>
@elseif(Session::has('error'))
  <div x-data="{ show: true }"
       x-show="show"
       x-init="setTimeout(() => (show = false), 3000)" class="alert alert-danger mx-0 my-2" role="alert">
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    <p>{{Session::get('error')}}</p>
  </div>
@endif

