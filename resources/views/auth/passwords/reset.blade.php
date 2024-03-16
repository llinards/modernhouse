<x-layouts.auth>
  <div class="text-center mb-4">
    <img src="{{ asset('storage/logo/logo-black.png') }}" class="modern-house-logo"
         alt="Modern House logo">
  </div>
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="row mb-3">
          <label for="email" class="col-md-4 col-form-label text-md-end">E-pasts</label>
          <div class="col-md-6">
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="password" class="col-md-4 col-form-label text-md-end">Jaunā parole</label>
          <div class="col-md-6">
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="password-confirm"
                 class="col-md-4 col-form-label text-md-end">Jaunā parole vēlreiz</label>
          <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation"
                   required autocomplete="new-password">
          </div>
        </div>
        <div class="row justify-content-center">
          <button type="submit" class="btn btn-primary">
            Atjaunot
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layouts.auth>
