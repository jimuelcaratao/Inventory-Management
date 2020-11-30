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
        <a href="{{ URL::to('brands') }}" ><i class="fas fa-tags icons"></i><span class="navbar-span icon_color">Brand</span></a>
        <a href="{{ URL::to('suppliers') }}" ><i class="fas fa-phone icons"></i><span class="navbar-span icon_color">Supplier</span></a>
        <a href="{{ URL::to('invoices') }}" ><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
        <a href="{{ URL::to('analytics') }}" class="navbar-link-active"><i class="fas fa-chart-bar icons"></i><span class="navbar-span icon_color">Analytics</span></a>
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


<div class="container main-container">
    <div class="row">
        <div class="col-2 col-lg-1">

        </div>
        <div class="col-10 col-lg-11">

            <div class="container custom-container pl-5">
                <div class="row my-4" >
                    <h3>Analytics</h3>
                </div>
           
                <div class="row py-4">
                    <div class="card w-100 card-shadow">
                        <div class="card-header bg-white shadow-sm">
                            <div class="header text-primary">
                                <h3>Sales analysis</h3>
                            </div>

                          {{-- datepicker --}}
                          <form action="/analytics" method="GET" id="datePicker" class="form-inline col align-self-end">
                                <label for="sales_from ">from:</label>
                                <div class="form-group input-group-sm w-25 ml-2">
                                    <input class="form-control" type="date" id="sales_from" name="sales_from" required>
                                </div>
                                <label for="sales_to">to:</label>
                                <div class="form-group input-group-sm w-25 ml-2">
                                    <input class="form-control" type="date" id="sales_to" name="sales_to" required>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-search"></i> 
                                  </button>
                            </form>

                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="400" height="150"></canvas>
                        </div>
                      </div>
                </div>

                <div class="row my-4" >
                    <h3>Sales</h3>
                </div>

                {{-- cards --}}
                <div class="row py-4">

                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                                <h6 class="card-title text-primary">Earned last month</h6>
                                <h1 class="card-text">₱{{ $earned_last }}</h1>
                                {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                                <h6 class="card-title text-primary">Earned this month</h6>
                                @if ($earned_this >= $earned_last)
                                    <img src="{{asset('images/increase.png')}}" class="card-image float-right mr-3" width="35px" title="Revenue Increase">
                                @else
                                    <img src="{{asset('images/decreas.png')}}" class="card-image float-right mr-3" width="35px" title="Revenue Decrease">
                                @endif
                                <h1 class="card-text">₱{{ $earned_this }}</h1>
                                {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                                <h6 class="card-title text-primary">Total Revenue</h6>
                                <h1 class="card-text">₱{{ $earned_all }}</h1>
                                {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row my-4" >
                    <h3>Others</h3>
                </div>


                <div class="row py-4">
                    {{-- New products --}}
                    <div class="col-md-6 pb-1">
                        <div class="card card-shadow" >
                            <div class="card-body border-custom-darkblue">
                              <h5 class="card-title text-primary">Products Added</h5>
                              <form action="/analytics" method="GET" id="datePickerProducts" class="form-inline col align-self-end">
                                    <label for="product_month ">Month:</label>
                                    <div class="form-group input-group-sm  ml-2">
                                        <input class="form-control" type="date" id="product_month" name="product_month" required>
                                    </div>
                                    <button type="submit" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-search"></i> 
                                    </button>
                                </form>

                              <h1 class="card-text pt-4">{{ $new_products }}</h1>
                              <a href="{{ URL::to('products') }}" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>

                    {{-- TBA --}}
                    <div class="col-md-6 pb-1">
                        <div class="card card-shadow" >
                            <div class="card-body border-custom-darkblue">
                              <h5 class="card-title text-primary">New Users</h5>
                              <form action="/analytics" method="GET" id="datePickerProducts" class="form-inline col align-self-end">
                                    <label for="user_month ">Month:</label>
                                    <div class="form-group input-group-sm  ml-2">
                                        <input class="form-control " type="date" id="user_month" name="user_month" required>
                                    </div>
                                    <button type="submit" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-search"></i> 
                                    </button>
                                </form>

                              <h1 class="card-text pt-4">{{ $new_users }}</h1>
                              <a href="{{ URL::to('users') }}" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- cards --}}
                <div class="row py-4">

                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Total invoices</h6>
                              <h1 class="card-text">{{ $total_invoices }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Total Orders</h6>
                              <h1 class="card-text">{{ $orders_count }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Shipping Orders</h6>
                              <h1 class="card-text">{{ $orders_shipping }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Returned Orders</h6>
                              <h1 class="card-text">{{ $orders_returned }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Delivered Orders</h6>
                              <h1 class="card-text">{{ $orders_delivered }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Canceled Orders</h6>
                              <h1 class="card-text">{{ $orders_canceled }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Best sellers</h6>
                              <h1 class="card-text">{{ $best_seller }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Active suppliers</h6>
                              <h1 class="card-text">{{ $active_supplier }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pb-1 mb-4">
                        <div class="card card-shadow">
                            <div class="card-body border-custom-darkblue">
                              <h6 class="card-title text-primary">Inactive suppliers</h6>
                              <h1 class="card-text">{{ $inactive_supplier }}</h1>
                              {{-- <a href="{{ URL::to('orders') }}" class="card-link">view more</a> --}}
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: [
                    @foreach ($order_items as $order_item)
                        '{{ $order_item->created_at }}', 
                    @endforeach
                ],
                datasets: [{
                    label: 'Sales',
                    backgroundColor: '#4d648d',
                    borderColor: '#4d648d',
                    data: [
                        // 0, 10, 5, 2, 20, 30, 45
                        @foreach ($order_items as $order_item)
                            {{ $order_item->price }}, 
                        @endforeach
                    ]
                }]
            },

            // Configuration options go here
            options: {
                
            }
        });
        // var dateControl = document.querySelector('input[type="date"]');
        // dateControl.value = '2017-06-01';   
    </script>
@endpush