@extends('layouts.app')

@push('css')
@endpush

@section('content')

<!-- Start of Left Navbar -->
<div class="left-navbar" id="left-navbar">
    <!-- for navbar links -->
    <div class="left-navbar-links">
        <a href="{{ URL::to('admin') }}" ><i class="fas fa-columns icons icon_color"></i><span class="navbar-span">Home</span></a>
        <a href="{{ URL::to('products') }}"><i class="fas fa-box-open icons"></i><span class="navbar-span icon_color">Items</span></a>
        <a href="{{ URL::to('orders') }}"><i class="far fa-list-alt icons"></i><span class="navbar-span icon_color">Orders</span></a>
        <a href="{{ URL::to('categories') }}"><i class="fas fa-clipboard icons"></i><span class="navbar-span icon_color">Category</span></a>
        <a href="{{ URL::to('brands') }}"><i class="fas fa-tags icons"></i><span class="navbar-span icon_color">Brand</span></a>
        <a href="{{ URL::to('suppliers') }}" ><i class="fas fa-phone icons"></i><span class="navbar-span icon_color">Supplier</span></a>
        <a href="{{ URL::to('invoices') }}" ><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
        <a href="{{ URL::to('analytics') }}"><i class="fas fa-chart-bar icons"></i><span class="navbar-span icon_color">Analytics</span></a>
        <a href="{{ URL::to('users') }}" class="navbar-link-active"><i class="fas fa-users icons"></i><span class="navbar-span icon_color">Users</span></a>

    </div>
    <!-- for navbar hambuger -->
    <div class="hamburger" id="hamburger-nav">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
    </div>
  </div>
<!-- End of Left Navbar -->

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
    <div class="row">
        <div class="col-2 col-lg-1">

        </div>
        <div class="col-10 col-lg-11">

            <div class="container custom-container pl-5">
                <div class="row my-4" >
                    <h3>Users</h3>
                </div>

                <div class="row py-4">
                    <div class="col-8">
                        {{-- search --}}
                        <form class="form-inline ">
                            <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
                            
                            <button type="submit" class="btn btn-secondary  mx-2">
                                <i class="fas fa-search"></i> 
                            </button>
                        </form>
                    </div>
                    <div class="col-4">
                        {{-- adding product button --}}
                        {{-- <button type="submit" data-community="{{ json_encode($categories) }}" data-toggle="modal" data-target="add-modal" id="add-item" class="add-btn btn btn-primary float-right"><i class="fas fa-plus mr-1"></i>ADD CATEGORY</button> --}}
                    </div>
                </div>
                {{-- table --}}
                <div class="row py-4">
                    <div class="col">
                         {{-- tables --}}
                         <div class="table-container" id="table-container">
                            <table class="table">
                              <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Account type</th>
                                    {{-- <th>Password</th> --}}
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th colspan="2">Action</th>
                                </tr>
                              </thead>  
                                @forelse ($user_collection as $user_item)
                                <tr class="data-row table-sm table-product">
                                    <td>{{$user_item->id}}</td>
                                    <td>{{$user_item->name}}</td>
                                    <td>{{$user_item->email}}</td>
                                    @if ($user_item->is_admin == 1)
                                        <td>Admin</td>
                                    @else
                                        <td>User</td>
                                    @endif
                                    {{-- <td>{{$user_item->password}}</td> --}}
                                    <td>{{$user_item->created_at}}</td>
                                    <td>{{$user_item->updated_at}}</td>
                                    <td>
                                      {{-- edit icon --}}
                                      <a
                                      class="float-left"
                                      data-target="edit-modal"
                                      data-toggle="modal"
                                      data-tooltip="tooltip"
                                      data-placement="top"
                                      title="View"
                                      data-community="{{ json_encode($user_item) }}"
                                      data-item-id="{{ $user_item->id }}"
                                      data-item-name="{{ $user_item->name }}"
                                      data-item-email="{{ $user_item->email }}"
                                      data-item-is_admin="{{ $user_item->is_admin }}"
                                      data-item-password="{{ $user_item->password }}"
                                      data-item-created_at="{{ $user_item->created_at }}"
                                      data-item-updated_at="{{ $user_item->updated_at }}"
                                      data-item-firstname="{{ $user_item->firstname }}"
                                      data-item-middlename="{{ $user_item->middlename }}"
                                      data-item-lastname="{{ $user_item->lastname }}"
                                      data-item-contact="{{ $user_item->contact }}"
                                      data-item-address="{{ $user_item->address }}"

                                      id="edit-item"
                                      ><i class="fas fa-list icons"></i></a>
            
                                      {{-- delete icon --}}
                                      {{-- <form method="POST" action="/users/{{$user_item->id}}" class="float-left">
                                        @csrf
                                        @method("DELETE")
                                        <div class="form-group form-icon">
                                          <i class="fas fa-trash-alt delete-user icons" type="submit"  data-tooltip="tooltip" data-placement="top" title="Delete"></i>
                                        </div>
                                      </form> --}}
                                    </td>
                                </tr>
                                    @empty
                                    <tr>
                                      <td colspan="9" style="text-align: center">
                                        <h3>No data!</h3>
                                      </td>
                                    </tr>
                                  @endforelse
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 d-flex justify-content-center" >
                      {{-- pagination --}}
                      <div class="pagination">
                        <!-- $employee->links -->
                        {{ $user_collection->render("pagination::bootstrap-4") }}
                      </div>
                    </div>
                </div>

            </div>
            {{-- end of content container --}}
        </div>
    </div>
    {{-- end of main container --}}
</div>


<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modal-label">View Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="attachment-body-content">
        @forelse ($user_collection as $user_item)
        <form id="edit-form_{{$user_item->id}}" class="form-horizontal" method="POST" action="/users/{{$user_item->id}}">
        @empty
        @endforelse
          @csrf
          {{ method_field('PUT') }}
          <div class="card text-dark bg-light mb-0">
            <div class="card-body">

              <!-- User ID --> 
              <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editUserID">User ID</label>
                  <input type="text" name="editUserID" class="form-control " id="editUserID" readonly >
              </div>
              <!-- /User ID -->
              <!-- Username --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editUsername">Username</label>
                <input type="text" name="editUsername" class="form-control " id="editUsername" readonly >
              </div>
              <!-- /Username --> 
              <!-- Email --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editEmail">Email</label>
                <input type="text" name="editEmail" class="form-control " id="editEmail" readonly >
              </div>
              <!-- /Email --> 
              <!-- Account Type --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editAccountType">Account Type</label>
                <input type="text" name="editAccountType" class="form-control " id="editAccountType" readonly >
              </div>
              <!-- /Account Type --> 
              <!-- Password --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editPassword">Password</label>
                <input type="text" name="editPassword" class="form-control " id="editPassword" readonly >
              </div>
              <!-- /Password --> 

              <!-- First name --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editFirstname">First name</label>
                <input type="text" name="editFirstname" class="form-control " id="editFirstname" readonly >
              </div>
              <!-- /First name --> 
              <!-- Middle name --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editMiddlename">Middle name</label>
                <input type="text" name="editMiddlename" class="form-control " id="editMiddlename" readonly >
              </div>
              <!-- /Middle name --> 
              <!-- Last name --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editLastname">Last name</label>
                <input type="text" name="editLastname" class="form-control " id="editLastname" readonly >
              </div>
              <!-- /Last name --> 
              <!-- Contact --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editContact">Contact</label>
                <input type="text" name="editContact" class="form-control " id="editContact" readonly >
              </div>
              <!-- /Contact --> 
              <!-- Address --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editAddress">Address</label>
                <input type="text" name="editAddress" class="form-control " id="editAddress" readonly >
              </div>
              <!-- /Address --> 
              <!-- Created at --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editCreated">Created at</label>
                <input type="text" name="editCreated" class="form-control " id="editCreated" readonly >
              </div>
              <!-- /Created at --> 
              <!-- Updated at --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editUpdated">Updated at</label>
                <input type="text" name="editUpdated" class="form-control " id="editUpdated" readonly >
              </div>
              <!-- /Updated at --> 
          </div>
            <div class="modal-footer form-group">
              {{-- <button type="submit" name="submit" id="editsearch" class="btn btn-primary ">Save Changes</button> --}}
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
<!-- /Edit Modal -->


@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}"></script>
  <script src="{{asset('js/users.js')}}"></script>
  <script>
    // alert to fade
    $("#element").fadeTo(2000, 500).slideUp(500, function(){
        $("#element").slideUp(500);
    });

  </script>
@endpush