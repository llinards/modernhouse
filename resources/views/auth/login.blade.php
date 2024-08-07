<x-layouts.auth>
  <div class="text-center mb-4">
    <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo"
         alt="Modern House logo">
  </div>
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('login') }}">
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
        <div class="row mb-3">
          <label for="password" class="col-md-4 col-form-label text-md-end">Parole</label>
          <div class="col-md-6">
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="current-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-6 offset-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember"
                     id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                Atcerēties mani
              </label>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-primary mb-2">
            Pieslēgties
          </button>
          @if (Route::has('password.request'))
            <a class="btn btn-link p-0" href="{{ route('password.request') }}">
              Aizmirsi paroli?
            </a>
          @endif
        </div>
      </form>
    </div>
  </div>
</x-layouts.auth>
