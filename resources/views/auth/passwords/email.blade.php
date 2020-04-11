@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="clearfix">
                        <div class="col-sm-12 text-center mb-3">
                        <a class="navbar-brand" href="{{ url('/') }}">査読管理システム</a>
                      </div>
                      <h4 class="pt-3">{{ _i('Did you forget your password?') }}</h4>
                      <p class="text-muted">{{ _i('Provide your email that you used to register. We will send you information on how to reset your password.') }}</p>
                    </div>

                    <form method="POST" class="mb-5" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-prepend input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                                </span>
                              </div>
                              <input class="form-control @error('email') is-invalid @enderror" id="email" size="16" name="email" type="email" placeholder="{{ _i('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                              <span class="input-group-append">
                                <button class="btn btn-primary" type="submit" name="forgetpass">{{ _i('Send') }}</button>
                              </span>
                              @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
