@include('components.layouts.head')

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="row justify-content-center w-100">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">
                            Reset Password
                        </h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">


                            <div class="row mb-3">

                                <div class="col-md-12">
                                    <label for="password"
                                    class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-md-12">
                                    <label for="password-confirm"
                                    class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                        <div class="row mb-0 mt-4">
                            <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ubah Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('components.layouts.script')
