@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card">

                <div class="card-body">
                    <h4 class="text-logo sign-in text-center mt-3 mb-5">{{ _i('Sign in') }}</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                              </span>
                            </div>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="{{ _i('E-Mail Address') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="fa fa-key" aria-hidden="true"></i>
                              </span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ _i('Password') }}">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" id="remember" class="form-check-input" name="remember"  {{ old('remember') ? 'checked' : '' }}><label for="remember" class="remember-me form-check-label" >{{ _i('Remember Me') }}</label>
                        </div>
                        <div class="row">
                            <div class="col-6">
                              <button class="sign-in btn btn-primary px-4" type="submit" name="submitlogin">{{ _i('Login') }}</button>

                            </div>
                            @if (Route::has('password.request'))
                            <div class="col-6 nopadding">
                              <a href="{{ route('password.request') }}" class="forgotten-password btn btn-link px-0">{{ _i('Forgot Your Password?') }}</a>
                            </div>
                            @endif

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
