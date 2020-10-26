@extends('layouts.app')

@push('css')
@endpush

@section('content')
<!-- Start of Left Navbar -->
<div class="left-navbar" id="left-navbar">
    <!-- for navbar links -->
    <div class="left-navbar-links">
        <a href="#" class="navbar-link-active"><i class="fas fa-columns icons"></i><span class="navbar-span">Home</span></a>
        <a href="{{ URL::route('products') }}"><i class="fas fa-box-open icons"></i><span class="navbar-span">Items</span></a>
        <a href="#"><i class="fas fa-clipboard icons"></i><span class="navbar-span">Category</span></a>
        <a href="#"><i class="fas fa-tags icons"></i><span class="navbar-span">Brand</span></a>
        <a href="#"><i class="fas fa-phone icons"></i><span class="navbar-span">Supplier</span></a>
        <a href="#"><i class="fas fa-file-invoice icons"></i><span class="navbar-span">Invoice</span></a>
        <a href="#"><i class="fas fa-chart-bar icons"></i><span class="navbar-span">Analytics</span></a>
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
                    <h3>Overview</h3>
                </div>
                <div class="row py-4">
                    <div class="col pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                              <h5 class="card-title">Active Users</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, nostrum!</p>
                              <a href="#" class="card-link">view more</a>
                            </div>
                          </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                              <h5 class="card-title">Products</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, nostrum!</p>
                              <a href="#" class="card-link">view more</a>
                            </div>
                          </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                              <h5 class="card-title">Orders</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, nostrum!</p>
                              <a href="#" class="card-link">view more</a>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="row my-4" >
                    <h3>Sales</h3>
                </div>
                <div class="row py-4" >
                    <div class="col col-lg-4  pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body">
                              <h5 class="card-title">Earned this month</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, nostrum!</p>
                              <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-8  pb-1">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                              <h5 class="card-title">Earning summary</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, nostrum!</p>
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
