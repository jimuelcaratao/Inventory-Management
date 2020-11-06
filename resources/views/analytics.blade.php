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
        <a href="{{ URL::to('categories') }}"><i class="fas fa-clipboard icons"></i><span class="navbar-span icon_color">Category</span></a>
        <a href="{{ URL::to('brands') }}" ><i class="fas fa-tags icons"></i><span class="navbar-span icon_color">Brand</span></a>
        <a href="{{ URL::to('suppliers') }}" ><i class="fas fa-phone icons"></i><span class="navbar-span icon_color">Supplier</span></a>
        <a href="{{ URL::to('invoices') }}" ><i class="fas fa-file-invoice icons"></i><span class="navbar-span icon_color">Invoice</span></a>
        <a href="{{ URL::to('analytics') }}" class="navbar-link-active"><i class="fas fa-chart-bar icons"></i><span class="navbar-span icon_color">Analytics</span></a>
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
                    <div class="card w-100">
                        <div class="card-header">
                          Earnings
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" width="400" height="150"></canvas>
                        </div>
                      </div>
                </div>


                <div class="row py-4">
                    <div class="col pb-1">
                        <div class="card card-user" style="width: 10.5rem;">
                            <div class="card-body">
                              <h5 class="card-title">New Users</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <h1 class="card-text">100</h1>
                                {{-- <img src="{{asset('images/user-homepage.png')}}" class="card-image"> --}}
                              <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 10.5rem;">
                            <div class="card-body">
                              <h5 class="card-title">New Products</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <h1 class="card-text">100</h1>
                              <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 10.5rem;">
                            <div class="card-body">
                              <h6 class="card-title">Canceled Orders</h6>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <h1 class="card-text">100</h1>
                              <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 10.5rem;">
                            <div class="card-body">
                              <h5 class="card-title">Total Orders</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <h1 class="card-text">100</h1>
                              <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 10.5rem;">
                            <div class="card-body">
                              <h5 class="card-title">Best sellers</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <h1 class="card-text">100</h1>
                              <a href="#" class="card-link">view more</a>
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
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Sales',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {
        
    }
});
    </script>
@endpush