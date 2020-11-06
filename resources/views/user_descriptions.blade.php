@extends('layouts.app')

@push('css')
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

{{-- back button --}}
@if(auth()->user()->is_admin == 1)         
    <a href="{{ route('admin.home') }}"><button class="btn btn-secondary">Back</button></a>  
@else
      <a href="{{ route('home') }}"><button class="btn btn-secondary">Back</button></a>      
@endif


<div class="container main-container">
    <div class="row">
        <div class="col-2 col-lg-1">

        </div>
        <div class="col-10 col-lg-11">

            <div class="container custom-container pl-5">
                <div class="row my-4" >
                    <h3>Profile</h3>
                </div>

                <div class="row py-4">
                    <div class="card w-100">
                        <form  action="{{ route('user_descriptions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body  p-5">

                                <input type="hidden" class="form-control" name="userID" value="{{ Auth::user()->id }}" readonly>
                                
                                <img src="{{  asset('storage/avatars/'. Auth::user()->id .'/' . $users->photo ) }}" alt="avatars" width="80"/>
                                {{-- <img src="{{  asset('storage/avatars/'. Auth::user()->id .'/LeNfVGuZMp3iAo0RhpFT3EUTpUKq7w5JoMcEdSVe.png') }}" alt="avatars" width="80"/> --}}

                                <input type="file" class="form-control" name="avatar" accept=".jpg,.gif,.png" multiple>

                                {{-- First name --}}
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputFirstname" name="inputFirstname" value="{{ $users->firstname }}" readonly>
                                    </div>
                                    <i class="col-sm-2 far fa-edit fa-lg" id="editFirstname" type="button"></i>
                                </div>
                                {{-- /First name --}}

                                {{-- last name --}}
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputLastname" name="inputLastname"  value="{{ $users->lastname }}"  readonly>
                                    </div>
                                    <i class="col-sm-2 far fa-edit fa-lg" id="editLastname" type="button"></i>
                                </div>
                                {{-- /last name --}}


                                {{-- middle name --}}
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Middle Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputMiddlename"  name="inputMiddlename"  value="{{ $users->middlename }}"  readonly>
                                    </div>
                                    <i class="col-sm-2 far fa-edit fa-lg" id="editMiddlename" type="button"></i>
                                </div>
                                {{-- /middle name --}}

                                {{-- Contact  --}}
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Contact Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputContact"  name="inputContact"  value="{{ $users->contact }}"  readonly>
                                    </div>
                                    <i class="col-sm-2 far fa-edit fa-lg" id="editContact" type="button"></i>
                                </div>
                                {{-- /Contact  --}}

                                {{-- Address--}}
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputAddress" name="inputAddress"  value="{{ $users->address }}" readonly>
                                    </div>
                                    <i class="col-sm-2 far fa-edit fa-lg" id="editAddress" type="button"></i>
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
                
                <div class="row py-4">
                
                </div>

            </div>
            {{-- end of content container --}}
        </div>
    </div>
    {{-- end of main container --}}
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}"></script>
    <script>
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

    </script>
@endpush