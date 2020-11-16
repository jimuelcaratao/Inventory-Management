@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/user_descriptions.css') }}">
@endpush

@section('content')

{{-- Alerts --}}
@if (\Session::has('danger'))
    <div id="element" class="alert alert-danger" >
        <p>{{ \Session::get('danger') }}</p>
    </div>
@endif

@if (\Session::has('success'))
    <div id="element" class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div>
@endif
{{-- end of alerts --}}
<div class="container main-container">
    <div class="row my-4" >
        <div class="col align-self-start">
            <h3>Profile</h3>

        </div>
        <div class="col align-self-end">
            {{-- back button --}}
            @if(auth()->user()->is_admin == 1)         
                <div class="float-right">
                    <a href="{{ route('admin.home') }}"><button class="btn btn-secondary"><i class="fas fa-home"></i></button></a>  
                </div>
            @else
                <div class="float-right">
                    <a href="{{ route('home') }}"><button class="btn btn-secondary"><i class="fas fa-home"></i></button></a>     
                </div>
            @endif
        </div>


    </div>
    <div class="row">
        <div class="col-3 col-lg-2 py-4">
            <div class="links pb-3 ">
                <a href="{{ URL::to('user_descriptions') }}" >Informations</a>
            </div>
            <div class="links">
                <a href="{{ URL::to('user_security') }}" class="active-profile">Security</a>
            </div>
        </div>
        <div class="col-9 col-lg-10">

            <div class="card w-100">
                {{-- form email --}}
                <form  action="{{ route('user_security.create') }}" method="GET">
                    @csrf
                    <div class="card-body  p-5">
                        <input type="hidden" class="form-control" name="userID" value="{{ Auth::user()->id }}" readonly>

                        <h6>Email Address</h6>
                        <div class="w-100 border-bottom mb-4"></div>
                        {{-- Email --}}
                        <div class="form-group row small">
                            <label for="inputEmail" class="col-sm-3 col-form-label text-right">Email</label>
                            <div class="col-sm-7 input-group-sm">
                                <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $users->email }}" readonly required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <i class="col-sm-2 far fa-edit fa-lg" id="editEmail" type="button"></i>
                        </div>
                        {{-- /Email--}}
                        <div class=" text-right">
                            <input id="editForm" class="btn btn-primary" type="submit" value="Save" />
                            <button class="btn btn-secondary" onClick="window.location.reload();">Cancel</button>
                        </div>

                    </div>
                </form>
                {{-- form password --}}
                <form  action="{{ route('user_security.store') }}" method="POST">
                    @csrf
                    <div class="card-body  p-5">
                        <input type="hidden" class="form-control" name="userID" value="{{ Auth::user()->id }}" readonly>

                        <h6>Password</h6>
                        <div class="w-100 border-bottom mb-4"></div>
                        {{-- Email --}}
                        {{-- <div class="form-group row small">
                            <label for="inputEmail" class="col-sm-3 col-form-label text-right">Email</label>
                            <div class="col-sm-7 input-group-sm">
                                <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $users->email }}" readonly required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <i class="col-sm-2 far fa-edit fa-lg" id="editEmail" type="button"></i>
                        </div> --}}
                        {{-- /Email --}}

                        {{-- password --}}
                        <div class="form-group row small">
                            <label for="password" class="col-sm-3 col-form-label text-right">password</label>
                            <div class="col-sm-7 input-group-sm">
                                {{-- <input type="text" class="form-control" id="inputPassword" name="inputPassword"   readonly> --}}
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" readonly>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <i class="col-sm-2 far fa-edit fa-lg" id="editPassword" type="button"></i>
                        </div>
                        {{-- /password --}}


                        {{-- confirm password --}}
                        <div class="form-group row small">
                            <label for="password-confirm" class="col-sm-3 col-form-label text-right">confirm password</label>
                            <div class="col-sm-7 input-group-sm">
                                {{-- <input type="text" class="form-control" id="inputConPassword"  name="inputConPassword"  readonly> --}}
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" readonly>

                            </div>
                            {{-- <i class="col-sm-2 far fa-edit fa-lg" id="editConPassword" type="button"></i> --}}
                        </div>
                        {{-- /confirm password --}}

                        <div class=" text-right">
                            <input id="editForm" class="btn btn-primary" type="submit" value="Save" />
                            <button class="btn btn-secondary" onClick="window.location.reload();">Cancel</button>
                        </div>

                    </div>
                </form>


            </div>

        </div>
    </div>
    {{-- end of main container --}}
</div>


        
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('js/layouts/user_security.js')}}"></script>
<script>
    document.getElementById('editEmail').onclick = function(e) {
    document.getElementById('email').removeAttribute('readonly');
    document.getElementById("email").focus();
};
document.getElementById('editPassword').onclick = function(e) {
    document.getElementById('password').removeAttribute('readonly');
    document.getElementById('password-confirm').removeAttribute('readonly');
    document.getElementById("password").focus();
};
// document.getElementById('editConPassword').onclick = function(e) {
//     document.getElementById('password-confirm').removeAttribute('readonly');
//     document.getElementById("password-confirm").focus();
// };

// alert to fade
$("#element").fadeTo(2000, 500).slideUp(500, function(){
    $("#element").slideUp(500);
});
</script>
@endpush