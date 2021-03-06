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
        <a href="{{ URL::to('invoices') }}" class="navbar-link-active"><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
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
                    <h3>Invoices</h3>
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
                                    <th>Invoice No.</th>
                                    <th>User ID</th>
                                    <th>Status</th>
                                    <th>Shipped date</th>
                                    <th>Arriving date</th>
                                    <th colspan="3">Action</th>
                                </tr>
                              </thead>  
                                @forelse ($invoices as $invoice)
                                <tr class="data-row table-sm table-product">
                                    <td>{{$invoice->invoice_id}}</td>
                                    <td>{{$invoice->user_id}}</td>
                                    <td>{{$invoice->status}}</td>
                                    <td>{{$invoice->shipped_date}}</td>
                                    <td>{{$invoice->arriving_date}}</td>
                                    <td>
                                      {{-- edit icon --}}
                                      <a
                                      class="float-left"
                                      data-target="edit-modal"
                                      data-toggle="modal"
                                      data-tooltip="tooltip"
                                      data-placement="top"
                                      title="View"
                                      data-community="{{ json_encode($invoice) }}"
                                      data-item-id="{{ $invoice->invoice_id }}"
                                      data-item-user="{{ $invoice->user_id }}"
                                      data-item-status="{{ $invoice->status }}"
                                      data-item-shipped="{{ $invoice->shipped_date }}"
                                      data-item-arrived="{{ $invoice->arriving_date }}"
                                      id="edit-item"
                                      ><i class="fas fa-list icons"></i></a>

                                      {{-- Print icon --}}
                                      <form method="POST" action="/invoice-print/{{$invoice->invoice_id}}" class="float-left" target="_blank">
                                        {{-- @csrf --}}
                                        @method("GET")
                                        <div class="form-group form-icon">
                                          <i class="fas fa-print  print-invoice icons" type="submit"  data-tooltip="tooltip" title="Print"></i>
                                        </div>
                                      </form>

                                      {{-- delete icon --}}
                                      <form method="POST" action="/invoices/{{$invoice->invoice_id}}" class="float-left">
                                        @csrf
                                        @method("DELETE")
                                        <div class="form-group form-icon">
                                          <i class="fas fa-trash-alt delete-user icons" type="submit"  data-tooltip="tooltip" title="Delete"></i>
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
                        {{ $invoices->render("pagination::bootstrap-4") }}
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
        @forelse ($invoices as $invoice)
        <form id="edit-form_{{$invoice->invoice_id}}" class="form-horizontal" method="POST" action="/invoices/{{$invoice->invoice_id}}">
        @empty
        @endforelse
          @csrf
          {{ method_field('PUT') }}
          <div class="card text-dark bg-light mb-0">
            <div class="card-body">
                  <!-- Transaction No -->
              <div class="form-group input-group-sm">
                  <label class="col-form-label" for="editTransactionNo">Transaction No</label>
                  <input type="text" name="editTransactionNo" class="form-control " id="editTransactionNo" readonly >
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
                <label class="col-form-label" for="editStatus">Status</label>
                <input type="text" name="editStatus" class="form-control " id="editStatus" readonly >
              </div>
              <!-- /Status --> 
              <!-- Shipped Date --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editShippedDate">Shipped Date</label>
                <input type="text" name="editShippedDate" class="form-control " id="editShippedDate" readonly >
              </div>
              <!-- /Shipped Date --> 
              <!-- Arrived Date --> 
              <div class="form-group input-group-sm">
                <label class="col-form-label" for="editArrivedDate">Arrived Date</label>
                <input type="text" name="editArrivedDate" class="form-control " id="editArrivedDate" readonly >
              </div>
              <!-- /Arrived Date --> 
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
  <script src="{{asset('js/invoices.js')}}"></script>
  <script>
    // alert to fade
    $("#element").fadeTo(2000, 500).slideUp(500, function(){
        $("#element").slideUp(500);
    });

// Print

$(document).ready(function() {
  /**
* for showing edit item popup
  */
  $(document).on('click', "#print-item", function() {
  $(this).addClass('print-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

      var options = {
      'backdrop': 'static'
      };
      $('#print-modal').modal(options)

  })

  // on modal show
  $('#print-modal').on('show.bs.modal', function() {
      var el = $(".print-item-trigger-clicked"); // See how its usefull right here? 
      var row = el.closest(".data-row");

      // get the data
      var transac = el.data('item-id');
      var userid = el.data('item-user');
      var status =el.data("item-status");
      var ship =el.data("item-shipped");
      var arrive =el.data("item-arrived");

      console.log(transac)

  })
})


//edit modal
$(document).ready(function() {

$('#editsearch').on('submit', function() {
    var id = $('/invoices/'+'#modal-input-id').val();
    var formAction = $('#editsearch').attr('action');
    $('#editsearch').attr('action', formAction + id);
});
  /**
* for showing edit item popup
  */
  $(document).on('click', "#edit-item", function() {
  $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

      var options = {
      'backdrop': 'static'
      };
      $('#edit-modal').modal(options)
  })

  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
      var el = $(".edit-item-trigger-clicked"); // See how its usefull right here? 
      var row = el.closest(".data-row");

      // get the data
      var transac = el.data('item-id');
      var userid = el.data('item-user');
      var status =el.data("item-status");
      var ship =el.data("item-shipped");
      var arrive =el.data("item-arrived");


  // var description = row.children("item-email").text();

      // fill the data in the input fields
      $("#editTransactionNo").val(transac);
      $("#editUserID").val(userid);
      $("#editStatus").val(status);
      $("#editShippedDate").val(ship);
      $("#editArrivedDate").val(arrive);

  })

    // on modal hide
    $('#edit-modal').on('hide.bs.modal', function() {
        $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
        $("#edit-form").trigger("reset");
    })
})



  </script>
@endpush