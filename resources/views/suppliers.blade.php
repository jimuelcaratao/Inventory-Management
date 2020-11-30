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
        <a href="{{ URL::to('suppliers') }}" class="navbar-link-active"><i class="fas fa-phone icons"></i><span class="navbar-span icon_color">Supplier</span></a>
        <a href="{{ URL::to('invoices') }}"><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
        <a href="{{ URL::to('analytics') }}"><i class="fas fa-chart-bar icons"></i><span class="navbar-span icon_color">Analytics</span></a>
        <a href="{{ URL::to('users') }}" ><i class="fas fa-users icons"></i><span class="navbar-span icon_color">Users</span></a>

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
                    <h3>Suppliers</h3>
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
                        <button type="submit" data-community="{{ json_encode($suppliers) }}" data-toggle="modal" data-target="add-modal" id="add-item" class="add-btn btn btn-primary float-right"><i class="fas fa-plus mr-1"></i>ADD SUPPLIER</button>
                    </div>
                </div>

                {{-- Suppliers Section --}}
                <div class="row ">

                    @forelse ($suppliers as $supplier)
                        <div class="col-md-auto align-self-start py-2">
                            <div class="card card-user card-shadow" style="width: 13rem;">
                                <div class="card-body">
                                <h5 class="card-title">{{$supplier->status}}</h5>
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                <h2 class="card-text">{{$supplier->company_name}}</h2>
                                    {{-- delete icon --}}
                                    <form method="POST" action="/suppliers/{{$supplier->supplier_id}}" class="float-right">
                                        @csrf
                                        @method("DELETE")
                                        <div class="form-group form-icon">
                                            {{-- <input type="submit" class="btn btn-danger delete-user" value="Delete"> --}}
                                            <i class="fas fa-trash-alt delete-user fa-lg icons" type="submit"  data-tooltip="tooltip" data-placement="top" title="Delete"></i>
                                        </div>
                                    </form>
                                    <a
                                    class="float-right"
                                    data-target="edit-modal"
                                    data-toggle="modal"
                                    data-tooltip="tooltip"
                                    data-placement="top"
                                    title="Edit"
                                    data-community="{{ json_encode($supplier) }}"
                                    data-item-id="{{ $supplier->supplier_id }}"
                                    data-item-name="{{ $supplier->company_name }}"
                                    data-item-address="{{ $supplier->address }}"
                                    data-item-contact="{{ $supplier->contact }}"
                                    data-item-status="{{ $supplier->status }}"
                                    id="edit-item"
                                    ><i class="far fa-edit fa-lg icons"></i></a>


                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-auto align-self-start py-2">
                            <h3>No Data!</h3>
                        </div>
                    @endforelse
                   
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 d-flex justify-content-center" >
                      {{-- pagination --}}
                      <div class="pagination">
                        <!-- $employee->links -->
                        {{ $suppliers->render("pagination::bootstrap-4") }}
                      </div>
                    </div>
                </div>
                {{-- end of custom-container --}}
            </div>
        </div>
    </div>

    {{-- end of main-container --}}
</div>


<!-- Add Modal -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="add-modal-label">Add Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="attachment-body-content">
        <form id="add-form" class="form-horizontal" action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="card text-black bg-light mb-0">
                <div class="card-body">

                <!-- SupplierID -->
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="inputID">SupplierID</label>
                    <input type="text" name="inputID" class="form-control " id="inputID" required autofocus>
                </div>
                <!-- /SupplierID -->

                <!-- Company name -->
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="inputCompanyName">Company Name</label>
                    <input type="text" name="inputCompanyName" class="form-control " id="inputCompanyName" required>
                </div>
                <!-- /Company name -->
                <!-- Address --> 
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="inputAddress">Address</label>
                <input type="text" name="inputAddress" class="form-control " id="inputAddress" required >
                </div>
                <!-- /Address -->
                <!-- Contact --> 
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="inputContact">Contact</label>
                    <input type="text" name="inputContact" class="form-control" id="inputContact" required>
                </div>
                <!-- /Contact -->
                <!-- Status --> 
                <div class="form-group input-group-sm">
                    <label for="inputStatus">Status</label>
                    <select name="inputStatus" id="inputStatus" class="form-control" required>
                        <option selected disabled value="">Choose...</option>
                            <option>Active</option>
                            <option>Not Active</option>
                    </select>
                </div>
                <!-- /Status --> 
                </div>
            </div>
                <div class="form-group modal-footer">
                <button type="submit" name="submit" id="add" class="btn btn-primary ">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
        
        </div>
    </div>
    </div>
<!-- /Add Modal -->


<!-- Edit Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit-modal-label">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="attachment-body-content">
          @forelse ($suppliers as $supplier)
          <form id="edit-form_{{$supplier->supplier_id}}" class="form-horizontal" method="POST" action="/suppliers/{{$supplier->supplier_id}}">
          @empty
          @endforelse
            @csrf
            {{ method_field('PUT') }}
            <div class="card text-dark bg-light mb-0">
              <div class="card-body">
                    <!-- ID -->
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editID">ID</label>
                    <input type="text" name="editID" class="form-control " id="editID" required autofocus>
                </div>
                <!-- /ID -->
                <!-- Company name --> 
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editCompanyName">Company Name</label>
                    <input type="text" name="editCompanyName" class="form-control " id="editCompanyName" required >
                </div>
                <!-- /Company name -->
             <!-- Address --> 
             <div class="form-group input-group-sm">
                <label class="col-form-label" for="editAddress">Address</label>
            <input type="text" name="editAddress" class="form-control " id="editAddress" required >
            </div>
            <!-- /Address -->
            <!-- Contact --> 
            <div class="form-group input-group-sm">
                <label class="col-form-label" for="editContact">Contact</label>
                <input type="text" name="editContact" class="form-control" id="editContact" required>
            </div>
            <!-- /Contact -->
            <!-- Status --> 
            <div class="form-group input-group-sm">
                <label for="editStatus">Status</label>
                <select name="editStatus" id="editStatus" class="form-control" required>
                    <option selected disabled value="">Choose...</option>
                        <option>Active</option>
                        <option>Not Active</option>
                </select>
            </div>
            <!-- /Status --> 
            </div>
              <div class="modal-footer form-group">
                <button type="submit" name="submit" id="editsearch" class="btn btn-primary ">Save Changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
<!-- /Edit Modal -->


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/suppliers.js')}}"></script>
    <script>
      // alert to fade
      $("#element").fadeTo(2000, 500).slideUp(500, function(){
          $("#element").slideUp(500);
      });


     
    </script>
@endpush
@endsection