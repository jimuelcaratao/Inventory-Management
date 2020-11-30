@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endpush

@push('links')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
    @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link font-weight-bold" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endif
@endpush

@section('content')
<div class="container">
    
    <div class="row pt-4 ">
        <div class="col img_logo">
            <img class="border rounded-circle" src="{{ asset('images/fb-dp-HJM.png') }}" alt="" width="150px;">
        </div>
    </div>

    <div class="row ">

        <div class="col-md-6 py-4">
            <div class="card border-0">
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                <div class="card-body pt-5">
                    <div class="login-text py-2 offset-md-1">
                        <h4>Sign-up</h4>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row pt-2">
                            {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> --}}

                            <div class="col-md-7 input-group-sm offset-md-1">
                                <input id="name" type="text" title="Your nickname here" class=" form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Username" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-7 input-group-sm offset-md-1">
                                <input id="email" type="email" title="Your Email-Address here" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="E-Mail Address" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-7 input-group-sm offset-md-1">
                                <input id="password" type="password" title="Your Password here" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> --}}

                            <div class="col-md-7 input-group-sm offset-md-1">
                                <input id="password-confirm" type="password" title="Confirm your password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn-custom w-50">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

 
        </div>

        <div class="col-md-6 img_login pt-5">
            <img class="" src="{{ asset('images/undraw_arrived.svg') }}" alt="" width="400px;">
        </div>
    </div>
</div>
@push('scripts')
    <script>

    </script>
@endpush

@endsection

