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
                <form  action="{{ route('user_descriptions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body  p-5">

                        <input type="hidden" class="form-control" name="userID" value="{{ Auth::user()->id }}" readonly>

                        {{-- Email --}}
                        <div class="form-group row small">
                            <label for="inputFirstname" class="col-sm-3 col-form-label text-right">Email</label>
                            <div class="col-sm-7 input-group-sm">
                            <input type="text" class="form-control" id="inputFirstname" name="inputFirstname" value="{{ $users->firstname }}" readonly>
                            </div>
                            <i class="col-sm-2 far fa-edit fa-lg" id="editFirstname" type="button"></i>
                        </div>
                        {{-- /First name --}}

                        {{-- last name --}}
                        <div class="form-group row small">
                            <label for="inputLastname" class="col-sm-3 col-form-label text-right">password</label>
                            <div class="col-sm-7 input-group-sm">
                                <input type="text" class="form-control" id="inputLastname" name="inputLastname"  value="{{ $users->lastname }}"  readonly>
                            </div>
                            <i class="col-sm-2 far fa-edit fa-lg" id="editLastname" type="button"></i>
                        </div>
                        {{-- /last name --}}


                        {{-- middle name --}}
                        <div class="form-group row small">
                            <label for="inputMiddlename" class="col-sm-3 col-form-label text-right">confirm password</label>
                            <div class="col-sm-7 input-group-sm">
                                <input type="text" class="form-control" id="inputMiddlename"  name="inputMiddlename"  value="{{ $users->middlename }}"  readonly>
                            </div>
                            <i class="col-sm-2 far fa-edit fa-lg" id="editMiddlename" type="button"></i>
                        </div>
                        {{-- /middle name --}}

                    </div>
                    <div class="card-footer text-right">
                        <input id="editForm" class="btn btn-primary" type="submit" value="Save" />
                        <button class="btn btn-secondary" onClick="window.location.reload();">Cancel</button>
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
       

    </script>
@endpush