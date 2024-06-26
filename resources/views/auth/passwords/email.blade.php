<x-layouts.auth>
  <div class="text-center mb-2">
    <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo"
         alt="Modern House logo">
  </div>
  <div class="card">
    <div class="card-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="row mb-3">
          <label for="email" class="col-md-4 col-form-label text-md-end">E-pasts</label>
          <div class="col-md-6">
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
            @enderror
          </div>
        </div>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-primary">
            Atjaunot paroli
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layouts.auth>
