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
                                    <th>Nickname</th>
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
                                      id="edit-item"
                                      ><i class="fas fa-list icons"></i></a>
            
                                      {{-- delete icon --}}
                                      <form method="POST" action="/users/{{$user_item->id}}" class="float-left">
                                        @csrf
                                        @method("DELETE")
                                        <div class="form-group form-icon">
                                          <i class="fas fa-trash-alt delete-user icons" type="submit"  data-tooltip="tooltip" data-placement="top" title="Delete"></i>
                                        </div>
                                      </form>
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



@endsection

@push('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}"></script>
  {{-- <script src="{{asset('js/invoices.js')}}"></script> --}}
  <script>
    // alert to fade
    $("#element").fadeTo(2000, 500).slideUp(500, function(){
        $("#element").slideUp(500);
    });

  </script>
@endpush