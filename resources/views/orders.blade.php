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
        <a href="{{ URL::to('orders') }}" class="navbar-link-active"><i class="far fa-list-alt icons"></i><span class="navbar-span icon_color">Orders</span></a>
        <a href="{{ URL::to('categories') }}"><i class="fas fa-clipboard icons"></i><span class="navbar-span icon_color">Category</span></a>
        <a href="{{ URL::to('brands') }}" ><i class="fas fa-tags icons"></i><span class="navbar-span icon_color">Brand</span></a>
        <a href="{{ URL::to('suppliers') }}" ><i class="fas fa-phone icons"></i><span class="navbar-span icon_color">Supplier</span></a>
        <a href="{{ URL::to('invoices') }}" ><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
        <a href="{{ URL::to('analytics') }}" ><i class="fas fa-chart-bar icons"></i><span class="navbar-span icon_color">Analytics</span></a>
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

              {{-- Orders --}}
              <div class="row my-4" >
                  <h3>Orders</h3>
              </div>
              <div class="row py-4">
                  <div class="col-8">
                      {{-- search order--}}
                      <form class="form-inline ">
                          <input class="form-control" type="search" name="searchOrder" placeholder="Search" aria-label="Search">
                          
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
              <div class="row py-4">
                <div class="col">
                     {{-- tables --}}
                     <div class="table-container" id="table-container">
                        <table class="table">
                          <thead>
                            <tr>
                                <th>Transaction No.</th>
                                <th>User ID</th>
                                <th>Status</th>
                                <th>Shipped date</th>
                                <th>Arriving date</th>
                                <th colspan="2">Action</th>
                            </tr>
                          </thead>  
                            @forelse ($orders as $order)
                                    <tr class="data-row table-sm table-product">
                                        <td>{{$order->transaction_no}}</td>
                                        <td>{{$order->user_id}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->shipped_date}}</td>
                                        <td>{{$order->arriving_date}}</td>

                                        <td>
                                        {{-- edit icon --}}
                                        <a
                                        class="float-left"
                                        data-target="edit-modal"
                                        data-toggle="modal"
                                        data-tooltip="tooltip"
                                        data-placement="top"
                                        title="View"
                                        data-community="{{ json_encode($order) }}"
                                        data-item-transactorder="{{ $order->transaction_no }}"
                                        data-item-id="{{ $order->user_id }}"
                                        data-item-status="{{ $order->status }}"
                                        data-item-shipped_date="{{ $order->shipped_date }}"
                                        data-item-arriving_date="{{ $order->arriving_date }}"
                                        id="edit-item"
                                        ><i class="fas fa-list icons"></i></a>
                
                                        {{-- delete icon --}}
                                        {{-- <form method="POST" action="/orders/{{$order->transaction_no}}" class="float-left">
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

            {{-- migrate to invoice --}}
            <div class="row justify-content-end">
                <div class="pagination">
                    <form method="POST" action="{{ route('orders.store') }}" class="float-left">
                      @csrf
                      {{-- @method("DELETE") --}}
                      <div class="form-group form-icon">
                        <button class="btn btn-danger delete-all" type="submit"  data-tooltip="tooltip" data-placement="top" title="Delete">Send to Invoice</button>
                      </div>
                  </form>
                </div>
          </div>

            <div class="row justify-content-center">
                <div class="col-md-8 d-flex justify-content-center" >
                  {{-- pagination --}}
                  <div class="pagination">
                    <!-- $employee->links -->
                    {{ $orders->render("pagination::bootstrap-4") }}
                  </div>
                </div>
            </div>

            {{-- seperator --}}
            <div class="separator my-5">
            </div>
            
              {{-- Order Records --}}
              <div class="row my-4" >
                  <h3>Orders Record</h3>
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
                
                <div class="row py-4">
                    <div class="col">
                         {{-- tables --}}
                         <div class="table-container" id="table-container">
                            <table class="table">
                              <thead>
                                <tr>
                                    <th>Order item ID</th>
                                    <th>Transaction No.</th>
                                    <th>Barcode</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th colspan="2">Action</th>
                                </tr>
                              </thead>  
                                @forelse ($order_items as $order_item)
                                        <tr class="data-row table-sm table-product">
                                            <td>{{$order_item->order_item_id}}</td>
                                            <td>{{$order_item->transaction_no}}</td>
                                            <td>{{$order_item->barcode}}</td>
                                            <td>{{$order_item->quantity}}</td>
                                            <td>{{$order_item->price}}</td>
                                            <td>{{$order_item->discount}}</td>

                                            <td>
                                            {{-- edit icon --}}
                                            {{-- <a
                                            class="float-left"
                                            data-target="edit-modal"
                                            data-toggle="modal"
                                            data-tooltip="tooltip"
                                            data-placement="top"
                                            title="View"
                                            data-community="{{ json_encode($order_item) }}"
                                            data-item-id="{{ $order_item->order_item_id }}"
                                            data-item-transact="{{ $order_item->transaction_no }}"
                                            data-item-barcode="{{ $order_item->barcode }}"
                                            data-item-quantity="{{ $order_item->quantity }}"
                                            data-item-price="{{ $order_item->price }}"
                                            data-item-discount="{{ $order_item->discount }}"
                                            id="edit-item"
                                            ><i class="fas fa-list icons"></i></a> --}}
                    
                                            {{-- delete icon --}}
                                            <form method="POST" action="/orders/{{$order_item->order_item_id}}" class="float-left">
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
                        {{ $order_items->render("pagination::bootstrap-4") }}
                      </div>
                    </div>
                </div>

            </div>
            {{-- end of content container --}}
        </div>
    </div>
    {{-- end of main container --}}
</div>


{{-- Ordesrs --}}
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
        @forelse ($orders as $order)
        <form id="edit-form_{{$order->transaction_no}}" class="form-horizontal" method="POST" action="/orders/{{$order->transaction_no}}">
        @empty
        @endforelse
          @csrf
          {{ method_field('PUT') }}
          <div class="card text-dark bg-light mb-0">
            <div class="card-body">

              <!-- Transaction No -->
              <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editTransactionNoOrders">Transaction No</label>
                  <input type="text" name="editTransactionNoOrders" class="form-control " id="editTransactionNoOrders" readonly >
              </div>
              <!-- /Transaction No -->
              <!-- User ID --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editUserID">User ID</label>
                <input type="text" name="editUserID" class="form-control " id="editUserID" readonly >
              </div>
              <!-- /User ID -->
              <!-- Status --> 
              <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editStatusOrders">Status</label>
                  <select name="editStatusOrders" id="editStatusOrders" class="form-control" required>
                    <option selected disabled value="">Choose...</option>
                        <option>Delivered</option>
                        <option>Shipping</option>
                        <option>Canceled</option>
                        <option>Returned</option>
                  </select>
              </div>
              <!-- /Status -->
              <!-- Shipped date --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editShipped">Shipped date</label>
                <input type="date" name="editShipped" class="form-control " id="editShipped" required >
              </div>
              <!-- /Shipped date --> 
              <!-- Arriving date --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editArriving">Arriving date</label>
                <input type="date" name="editArriving" class="form-control " id="editArriving" required >
              </div>
              <!-- /Arriving date --> 

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




{{-- Order Record --}}
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
          @forelse ($order_items as $order_item)
          <form id="edit-form_{{$order_item->order_item_id}}" class="form-horizontal" method="POST" action="/orders/{{$order_item->order_item_id}}">
          @empty
          @endforelse
            @csrf
            {{ method_field('PUT') }}
            <div class="card text-dark bg-light mb-0">
              <div class="card-body">
                <!-- Order ID --> 
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editOrderID">Order ID</label>
                    <input type="text" name="editOrderID" class="form-control " id="editOrderID" readonly >
                </div>
                <!-- /Order ID -->
                <!-- Transaction No -->
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editTransactionNo">Transaction No</label>
                    <input type="text" name="editTransactionNo" class="form-control " id="editTransactionNo" readonly >
                </div>
                <!-- /Transaction No -->
                <!-- Barcode --> 
                <div class="form-group input-group-sm">
                    <label class="col-form-label" for="editBarcode">Barcode</label>
                    <input type="text" name="editBarcode" class="form-control " id="editBarcode" readonly >
                </div>
                <!-- /Barcode -->
                <!-- Quantity --> 
                <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editQuantity">Quantity</label>
                  <input type="text" name="editQuantity" class="form-control " id="editQuantity" readonly >
                </div>
                <!-- /Quantity --> 
                <!-- Price --> 
                <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editPrice">Price</label>
                  <input type="text" name="editPrice" class="form-control " id="editPrice" readonly >
                </div>
                <!-- /Price --> 
                <!-- Discount --> 
                <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editDiscount">Discount</label>
                  <input type="text" name="editDiscount" class="form-control " id="editDiscount" readonly >
                </div>
                <!-- /Discount --> 
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
  <script src="{{asset('js/orders.js')}}"></script>
  <script>
    // alert to fade
    $("#element").fadeTo(2000, 500).slideUp(500, function(){
        $("#element").slideUp(500);
    });

  </script>
@endpush