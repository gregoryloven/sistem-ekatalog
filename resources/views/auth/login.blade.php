@extends('layouts_enduser.index')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<section class="text-center py-0">
        <div class="bg-holder overlay overlay-1" style="background-image:url(../enduser/assets/img/login.jpg);"></div>
        <!--/.bg-holder-->
        <div class="container">
          <form method="POST" action="{{ route('login') }}">
            @csrf
          <div class="row min-vh-100 align-items-center justify-content-center pt-11 pb-8">
            <div class="col-md-7 col-lg-6 col-xl-5 mx-auto" data-zanim-timeline="{}" data-zanim-trigger="scroll">
              <div class="overflow-hidden">
                <div class="card mx-lg-3 bg-100" data-zanim-xs='{"delay":0.1,"duration":1}'>
                  <div class="card-body p-md-5">
                    <h4 class="mb-3">Login with Freya</h4>
                    <form class="text-start mt-4">
                      <div class="row align-items-center">
                        <div class="col-12">
                          <div class="input-group">
                            <div class="input-group-text bg-100"><span class="far fa-user"></span></div><input class="form-control" type="text" name="email" placeholder="Email or username" aria-label="Text input with dropdown button" />
                          </div>
                        </div>
                        <div class="col-12 mt-2 mt-sm-4">
                          <div class="input-group">
                            <div class="input-group-text bg-100"><span class="fas fa-lock"></span></div><input class="form-control" type="Password" name="password" placeholder="Password" aria-label="Text input with dropdown button" />
                          </div>
                        </div>
                      </div>
                      <div class="row align-items-center mt-4">
                        <div class="col-6">
                          <div class="form-check mb-0"><input class="form-check-input" id="rememberMe" type="checkbox" value="" /><label class="form-check-label text-500 mb-0" for="rememberMe">Remember Me</label></div>
                        </div>
                        <div class="col-6 mt-2 mt-sm-0 ps-0"><button class="btn btn-primary w-100" type="submit">Login</button></div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div><!-- end of .container-->
      </section>
@endsection
