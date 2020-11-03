@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
@endpush

@section('content')

<!-- Start of Left Navbar -->
<div class="left-navbar" id="left-navbar">
  <!-- for navbar links -->
  <div class="left-navbar-links">
      <a href="{{ URL::to('admin') }}" ><i class="fas fa-columns icons icon_color"></i><span class="navbar-span">Home</span></a>
      <a href="{{ URL::to('products') }}"><i class="fas fa-box-open icons"></i><span class="navbar-span icon_color">Items</span></a>
      <a href="{{ URL::to('categories') }}"><i class="fas fa-clipboard icons"></i><span class="navbar-span icon_color">Category</span></a>
      <a href="{{ URL::to('brands') }}"  class="navbar-link-active"><i class="fas fa-tags icons"></i><span class="navbar-span icon_color">Brand</span></a>
      <a href="{{ URL::to('suppliers') }}" ><i class="fas fa-phone icons"></i><span class="navbar-span icon_color">Supplier</span></a>
      <a href="{{ URL::to('invoices') }}" ><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
      <a href="{{ URL::to('analytics') }}"><i class="fas fa-chart-bar icons"></i><span class="navbar-span icon_color">Analytics</span></a>
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
        <div class="col-10 col-lg-11 ">
            <div class="container custom-container pl-5">

                {{-- contents --}}
                <div class="row ">
                    <div class="col">
                      <h3>Brands</h3>
                    </div>
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
                        <button type="submit" data-community="{{ json_encode($brands) }}" data-toggle="modal" data-target="add-modal" id="add-item" class="add-btn btn btn-primary float-right"><i class="fas fa-plus mr-1"></i>ADD BRAND</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        {{-- tables --}}
                          <div class="table-container" id="table-container">
                            <table class="table">
                              <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th colspan="2">Action</th>
                                </tr>
                              </thead>  
                                @forelse ($brands as $brand)
                                <tr class="data-row table-sm table-product">
                                    <td>{{$brand->brand_id}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td>{{$brand->status}}</td>
                                    <td>{{$brand->created_at}}</td>
                                    <td>
                                      {{-- edit icon --}}
                                      <a
                                      class="float-left"
                                      data-target="edit-modal"
                                      data-toggle="modal"
                                      data-tooltip="tooltip"
                                      data-placement="top"
                                      title="Edit"
                                      data-community="{{ json_encode($brand) }}"
                                      data-item-id="{{ $brand->brand_id }}"
                                      data-item-name="{{ $brand->brand_name }}"
                                      data-item-status="{{ $brand->status }}"
                                      id="edit-item"
                                      ><i class="far fa-edit icons"></i></a>
            
                                      {{-- delete icon --}}
                                      <form method="POST" action="/brands/{{$brand->brand_id}}" class="float-left">
                                        @csrf
                                        @method("DELETE")
                                        <div class="form-group form-icon">
                                          {{-- <input type="submit" class="btn btn-danger delete-user" value="Delete"> --}}
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
                        <!-- table -->
                    </div>
                  </div>

                  

                  <div class="row justify-content-center">
                    <div class="col-md-8 d-flex justify-content-center" >
                      {{-- pagination --}}
                      <div class="pagination">
                        <!-- $employee->links -->
                        {{ $brands->render("pagination::bootstrap-4") }}
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
        <form id="add-form" class="form-horizontal" action="{{ route('brands.store') }}" method="POST">
            @csrf
            <div class="card text-black bg-light mb-0">
              <div class="card-header">
                <h2 class="m-0">ADD</h2>
              </div>
              <div class="card-body">

                <!-- ID -->
                <div class="form-group input-group-sm">
                  <label class="col-form-label" for="inputID">ID</label>
                  <input type="text" name="inputID" class="form-control " id="inputID" required autofocus>
                </div>
                <!-- /ID -->
                <!-- Category Name --> 
                <div class="form-group input-group-sm">
                  <label class="col-form-label" for="inputBrandName">Brand Name</label>
                <input type="text" name="inputBrandName" class="form-control " id="inputBrandName" required >
                </div>
                <!-- /Category Name -->
                <!-- Status --> 
                <div class="form-group input-group-sm">
                    <label for="inputStatus">Status</label>
                    <select name="inputStatus" id="inputStatus" class="form-control" required>
                        <option selected disabled value="">Choose...</option>
                            <option>Available</option>
                            <option>Not Available</option>
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
          @forelse ($brands as $brand)
          <form id="edit-form_{{$brand->brand_id}}" class="form-horizontal" method="POST" action="/brands/{{$brand->brand_id}}">
          @empty
          @endforelse
            @csrf
            {{ method_field('PUT') }}
            <div class="card text-dark bg-light mb-0">
              <div class="card-header">
                <h2 class="m-0">Edit</h2>
              </div>
              <div class="card-body">
                    <!-- ID -->
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editID">ID</label>
                    <input type="text" name="editID" class="form-control " id="editID" required autofocus>
                </div>
                <!-- /ID -->
                <!-- Brand Name --> 
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editBrandName">Brand Name</label>
                    <input type="text" name="editBrandName" class="form-control " id="editBrandName" required >
                </div>
                <!-- /Brand Name -->
                <!-- Status --> 
                <div class="form-group input-group-sm">
                    <label for="editStatus">Status</label>
                    <select name="editStatus" id="editStatus" class="form-control" required>
                        <option selected disabled value="">Choose...</option>
                            <option>Available</option>
                            <option>Not Available</option>
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
    <script src="{{asset('js/brands.js')}}"></script>
    <script>
      // alert to fade
      $("#element").fadeTo(2000, 500).slideUp(500, function(){
          $("#element").slideUp(500);
      });

    </script>
@endpush
@endsection
