@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endpush
@section('content')

<div class="container">

    {{-- <div class="row justify-content-center pt-4">
        <img src="{{  asset('images/fb-dp-HJM.png' ) }}" alt="avatars" width="150"/>
    </div> --}}

    <div class="row justify-content-end py-4">
        <div class="col-md-6 ">
            <div class="card border-0">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body pt-5">
                    <div class="login-text py-2 offset-md-1">
                        <h4>Sign-in</h4>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row pt-2">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-8 input-group-sm offset-md-1">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail address" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-8 input-group-sm offset-md-1">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if (\Session::has('message'))
                                    <span id="element" class="text-danger" role="alert" >
                                       <small><strong>{{ \Session::get('message') }}</strong></small> 
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> 
                                    <label class="form-check-label" for="remember">
                                        <small>{{ __('Remember Me') }}</small> 
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary login-btn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                       <small>{{ __('Forgot Your Password?') }}</small> 
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
