@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-7 py-4">
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

                            <div class="col-md-6 input-group-sm offset-md-1">
                                <input id="name" type="text" title="Your nickname here" class=" form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nickname" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-6 input-group-sm offset-md-1">
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

                            <div class="col-md-6 input-group-sm offset-md-1">
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

                            <div class="col-md-6 input-group-sm offset-md-1">
                                <input id="password-confirm" type="password" title="Confirm your password" class="form-control" name="password_confirmation"  placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>

    </script>
@endpush

@endsection

