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
                <a href="{{ URL::to('user_descriptions') }}" class="active-profile">Informations</a>
            </div>
            <div class="links">
                <a href="{{ URL::to('user_security') }}">Security</a>
            </div>
        </div>
        <div class="col-9 col-lg-10">

            <div class="card w-100">

                    <div class="card-body  p-5">

                        <input type="hidden" class="form-control" name="userID" value="{{ Auth::user()->id }}" readonly>
                        
                        {{-- avatar display --}}
                        @if($users->photo)
                        <div class="clearfix">
                            <img class="border mx-auto d-block" src="{{  asset('avatars/'.  Auth::user()->id . '_' . $users->photo ) }}" alt="{{ $users->photo }}" width="200"/>

                            {{-- delete icon --}}
                            <form method="POST" action="/user_descriptions/{{ Auth::user()->id }}" class="float-left">
                                @csrf
                                @method("DELETE")
                                <button type="submit" title="Delete" class="close btn-close delete-user" aria-label="Delete">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </form>

                        </div>
                        @else
                            <img class="border mx-auto d-block" src="{{  asset('images/user-homepage.png') }}" alt="user-homepage.png" width="200"/>
                        @endif

                <form  action="{{ route('user_descriptions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                        <input class="py-3 mx-auto d-block" type="file"  name="avatar" accept=".jpg,.gif,.png">

                        {{-- Nickname --}}
                        <div class="form-group row small">
                            <label for="inputNickname" class="col-sm-2 col-form-label small">Nickname</label>
                            <div class="col-sm-8 input-group-sm">
                                <input type="text" class="form-control" id="inputNickname" name="inputNickname" value="{{ $users->name }}" readonly>
                            </div>
                            <div class="edit-item">
                                <i class="col-sm-2 far fa-edit fa-lg" id="editNickname" type="button"></i>
                            </div>
                        </div>
                        {{-- /Nickname --}}

                        {{-- First name --}}
                        <div class="form-group row small">
                            <label for="inputFirstname" class="col-sm-2 col-form-label small">Firstname</label>
                            <div class="col-sm-8 input-group-sm">
                                <input type="text" class="form-control" id="inputFirstname" name="inputFirstname" value="{{ $users->firstname }}" readonly>
                            </div>
                            <div class="edit-item">
                                <i class="col-sm-2 far fa-edit fa-lg" id="editFirstname" type="button"></i>
                            </div>
                        </div>
                        {{-- /First name --}}

                        {{-- last name --}}
                        <div class="form-group row small">
                            <label for="inputLastname" class="col-sm-2 col-form-label">Lastname</label>
                            <div class="col-sm-8 input-group-sm">
                                <input type="text" class="form-control" id="inputLastname" name="inputLastname"  value="{{ $users->lastname }}"  readonly>
                            </div>
                            <div class="edit-item">
                                <i class="col-sm-2 far fa-edit fa-lg" id="editLastname" type="button"></i>
                            </div>
                        </div>
                        {{-- /last name --}}


                        {{-- middle name --}}
                        <div class="form-group row small">
                            <label for="inputMiddlename" class="col-sm-2 col-form-label ">Middlename</label>
                            <div class="col-sm-8 input-group-sm">
                                <input type="text" class="form-control" id="inputMiddlename"  name="inputMiddlename"  value="{{ $users->middlename }}"  readonly>
                            </div>
                            <div class="edit-item">
                                <i class="col-sm-2 far fa-edit fa-lg" id="editMiddlename" type="button"></i>
                            </div>
                        </div>
                        {{-- /middle name --}}

                        {{-- Contact  --}}
                        <div class="form-group row small">
                            <label for="inputContact" class="col-sm-2 col-form-label">Contact</label>
                            <div class="col-sm-8 input-group-sm">
                                <input type="text" class="form-control" id="inputContact"  name="inputContact"  value="{{ $users->contact }}"  readonly>
                            </div>
                            <div class="edit-item">
                                <i class="col-sm-2 far fa-edit fa-lg" id="editContact" type="button"></i>
                            </div>
                        </div>
                        {{-- /Contact  --}}

                        {{-- Address--}}
                        <div class="form-group row small">
                            <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-8 input-group-sm">
                                <input type="text" class="form-control" id="inputAddress" name="inputAddress"  value="{{ $users->address }}" readonly>
                            </div>
                            <div class="edit-item">
                                <i class="col-sm-2 far fa-edit fa-lg" id="editAddress" type="button"></i>
                            </div>
                        </div>
                        {{-- /Address --}}

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
    <script>
        document.getElementById('editNickname').onclick = function(e) {
            document.getElementById('inputNickname').removeAttribute('readonly');
            document.getElementById("inputNickname").focus();
        };
        document.getElementById('editFirstname').onclick = function(e) {
            document.getElementById('inputFirstname').removeAttribute('readonly');
            document.getElementById("inputFirstname").focus();
        };
        document.getElementById('editLastname').onclick = function(e) {
            document.getElementById('inputLastname').removeAttribute('readonly');
            document.getElementById("inputLastname").focus();
        };
        document.getElementById('editMiddlename').onclick = function(e) {
            document.getElementById('inputMiddlename').removeAttribute('readonly');
            document.getElementById("inputMiddlename").focus();
        };
        document.getElementById('editContact').onclick = function(e) {
            document.getElementById('inputContact').removeAttribute('readonly');
            document.getElementById("inputContact").focus();
        };
        document.getElementById('editAddress').onclick = function(e) {
            document.getElementById('inputAddress').removeAttribute('readonly');
            document.getElementById("inputAddress").focus();
        };

      // alert to fade
      $("#element").fadeTo(2000, 500).slideUp(500, function(){
          $("#element").slideUp(500);
      });

      //delete
        $('.delete-user').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
@endpush