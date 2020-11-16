@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endpush

@section('content')

<!-- Start of Left Navbar -->
<div class="left-navbar" id="left-navbar">
    <!-- for navbar links -->
    <div class="left-navbar-links">
        <a href="{{ URL::to('admin') }}" class="navbar-link-active"><i class="fas fa-columns icons"></i><span class="navbar-span">Home</span></a>
        <a href="{{ URL::to('products') }}"><i class="fas fa-box-open icons"></i><span class="navbar-span">Items</span></a>
        <a href="{{ URL::to('categories') }}"><i class="fas fa-clipboard icons"></i><span class="navbar-span">Category</span></a>
        <a href="{{ URL::to('brands') }}"><i class="fas fa-tags icons"></i><span class="navbar-span">Brand</span></a>
        <a href="{{ URL::to('suppliers') }}"><i class="fas fa-phone icons"></i><span class="navbar-span">Supplier</span></a>
        <a href="{{ URL::to('invoices') }}"><i class="fas fa-file-invoice icons"></i><span class="navbar-span">Invoice</span></a>
        <a href="{{ URL::to('analytics') }}"><i class="fas fa-chart-bar icons"></i><span class="navbar-span">Analytics</span></a>
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
                <div class="row">
                    <h5 class="pl-2">{{ $dayTerm }}, {{ $users->firstname }} !</h5>
                </div>
                <div class="row my-4" >
                    <h3>Overview</h3>
                </div>
           
                <div class="row py-4">
                    <div class="col pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body card_border">
                                <h5 class="card-title">Active Users</h5>
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                <h1 class="card-text">{{ $users_count }}</h1>
                                <img src="{{asset('images/user-homepage.png')}}" class="card-image">
                                <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body card_border">
                                <h5 class="card-title">Products</h5>
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                <h1 class="card-text">{{ $products_count }}</h1>
                                <img src="{{asset('images/shopping-cart.png')}}" class="card-image">
                                <a href="{{ URL::to('products') }}" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col pb-1">
                        <div class="card" style="width: 15rem;">
                            <div class="card-body card_border">
                                <h5 class="card-title">Orders</h5>
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                <h1 class="card-text">{{ $orders_count }}</h1>
                                <img src="{{asset('images/order.png')}}" class="card-image">
                                <a href="{{ URL::to('invoices') }}" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-4" >
                    <h3>Sales Summary</h3>
                </div>
                <div class="row py-4" >
                    <div class="col col-lg-4  pb-1 ">
                        <div class="card mb-4 " style="width: 15rem;">
                            <div class="card-body">
                                <h5 class="card-title">Earned last month</h5>
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                <h1 class="card-text">{{ $earned_month }}</h1>
                                <a href="#" class="card-link">view more</a>
                            </div>
                        </div>
                        <div class="card mb-2" style="width: 15rem;">
                            <div class="card-body">
                                <h5 class="card-title">Low in Stock Items</h5>
                                {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                <h1 class="card-text">{{ $products_count_low }}</h1>
                                <a href="{{ URL::to('products') }}" class="card-link">view more</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col col-lg-8  pb-1">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                              <h5 class="card-title">Earning summary</h5>
                              {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                              {{-- <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure, nostrum!</p> --}}

                              <div id="chartContainer" style="height: 300px; width: 100%;"></div>

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
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

        {{-- custom chart --}}
    <script>
        // collections
        var order_items = {!! json_encode($order_items->toArray(), JSON_HEX_TAG) !!};

        // Chart
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
            title:{
                text: "Quarterly Revenue Analysis"
            },
            axisY:[{
                title: "Supplies",
                lineColor: "#C24642",
                tickColor: "#C24642",
                labelFontColor: "#C24642",
                titleFontColor: "#C24642",
                // includeZero: true,
                suffix: "k"
            }],
            axisY2: {
                title: "Revenue",
                lineColor: "#7F6084",
                tickColor: "#7F6084",
                labelFontColor: "#7F6084",
                titleFontColor: "#7F6084",
                // includeZero: true,
                prefix: "₱",
            },
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            data: [
            {
                type: "line",
                name: "Supplies",
                color: "#C24642",
                axisYIndex: 0,
                showInLegend: true,
                dataPoints: [
                    // { x: new Date(2020, 03, 7), y: 32.3 }, 
                    // { x: new Date(2020, 03, 14), y: 33.9 },
                    // { x: new Date(2020, 03, 21), y: 26.0 },
                    // { x: new Date(2020, 03, 28), y: 15.8 },
                    // { x: new Date(2020, 04, 4), y: 18.6 },
                    // { x: new Date(2020, 04, 11), y: 34.6 },
                    // { x: new Date(2020, 04, 18), y: 37.7 },
                    // { x: new Date(2020, 04, 25), y: 24.7 },
                    // { x: new Date(2020, 05, 4), y: 35.9 },
                    // { x: new Date(2020, 05, 11), y: 12.8 },
                    // { x: new Date(2020, 05, 18), y: 38.1 },
                    // { x: new Date(2020, 05, 25), y: 42.4 }
                ]
            },
            {
                type: "line",
                name: "Revenue",
                color: "#7F6084",
                axisYType: "secondary",
                showInLegend: true,
                dataPoints: [

                    @foreach ($order_items as $order_item)
                         { x:  new Date("{{ $order_item->created_at }}"), y:{{ $order_item->price }}}, 
                    @endforeach
           
                    // { x: new Date(2020, 03, 7), y: 42.5 }, 
                    // { x: new Date(2020, 03, 14), y: 44.3 },
                    // { x: new Date(2020, 03, 21), y: 28.7 },
                    // { x: new Date(2020, 03, 28), y: 22.5 },
                    // { x: new Date(2020, 04, 4), y: 25.6 },
                    // { x: new Date(2020, 04, 11), y: 45.7 },
                    // { x: new Date(2020, 04, 18), y: 54.6 },
                    // { x: new Date(2020, 04, 25), y: 32.0 },
                    // { x: new Date(2020, 05, 4), y: 43.9 },
                    // { x: new Date(2020, 05, 11), y: 26.4 },
                    // { x: new Date(2020, 05, 18), y: 40.3 },
                    // { x: new Date(2020, 05, 25), y: 54.2 }
                ]
            }]
        });
        chart.render();
        
        function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.chart.render();
        }
        
        }   


        console.log(order_items)
        
        // var categories = {!! json_encode($categories->toArray(), JSON_HEX_TAG) !!};

        // @foreach ($categories as $category)
        //  console.log('{{ $category->category_name }}');
        // @endforeach

    
        // categories.forEach(element => {
        //  console.log(element.category_name);
        // });
        // console.log(categories);

  
        </script>
@endpush
