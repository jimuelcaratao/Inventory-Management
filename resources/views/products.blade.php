@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
@endpush

@section('content')

<!-- Start of Left Navbar -->
<div class="left-navbar" id="left-navbar">
  <!-- for navbar links -->
  <div class="left-navbar-links">
      <a href="{{ URL::to('admin') }}" ><i class="fas fa-columns icons icon_color"></i><span class="navbar-span">Home</span></a>
      <a href="{{ URL::to('products') }}" class="navbar-link-active"><i class="fas fa-box-open icons icon_color"></i><span class="navbar-span">Items</span></a>
      <a href="{{ URL::to('orders') }}"><i class="far fa-list-alt icons"></i><span class="navbar-span icon_color">Orders</span></a>
      <a href="{{ URL::to('categories') }}"><i class="fas fa-clipboard icons icon_color"></i><span class="navbar-span">Category</span></a>
      <a href="{{ URL::to('brands') }}"><i class="fas fa-tags icons icon_color"></i><span class="navbar-span">Brand</span></a>
      <a href="{{ URL::to('suppliers') }}"><i class="fas fa-phone icons icon_color"></i><span class="navbar-span">Supplier</span></a>
      <a href="{{ URL::to('invoices') }}"><i class="fas fa-file-invoice icons icon_color"></i><span class="navbar-span">Invoice</span></a>
      <a href="{{ URL::to('analytics') }}"><i class="fas fa-chart-bar icons icon_color"></i><span class="navbar-span">Analytics</span></a>
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

<div class="container main-container ">
  <div class="row">
    <div class="col-2 col-lg-1">
      
    </div>
    <div class="col-10 col-lg-11 ">
      <div class="container custom-container pl-5">
        {{-- contents --}}
        <div class="row ">
          <div class="col">
            <h3>Products</h3>
          </div>
        </div>
        <div class="row py-4">
          <div class="col-8">
            {{-- search --}}
            <form class="form-inline " >
              <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
              
              <button type="submit" class="btn btn-secondary  mx-2">
                <i class="fas fa-search"></i> 
              </button>
                {{-- advance search --}}
              <div class="advance-search">
                <a
                class="icons"
                data-target="search-modal"
                data-toggle="modal"
                data-tooltip="tooltip"
                data-placement="top"
                title="Advance search"
                id="search-item"
                ><i class="fas fa-chevron-down fa-2x"></i></a>
              </div>
            </form>
         
          </div>
          <div class="col-4">
            {{-- adding product button --}}
            <button type="submit" data-community="{{ json_encode($products) }}" data-toggle="modal" data-target="add-modal" id="add-item" class="add-btn btn btn-primary float-right"><i class="fas fa-plus mr-1"></i>ADD PRODUCT</button>
          </div>
        </div>
        <div class="row">
          <div class="col">



 <!-- Trigger the modal with a button -->
 {{-- <button type="button" id="btnGetItem" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal-item">Open Modal</button> --}}

 <!-- modal example -->
 <div id="modal-item" class="modal fade" role="dialog">
   <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
       <div class="modal-body">
         <p id="title-sample">Loading</p>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
     </div>
 
   </div>
 </div>


            {{-- <img src="data:image/png;base64,{{ chunk_split(base64_encode($productPhoto->photo)) }}" height="100" width="100"> --}}
              {{-- tables --}}
                <div class="table-container" id="table-container">
                  <table id="dtHorizontalExample" class="table table-striped">
                    <thead>
                      <tr>
                          <th>Barcode</th>
                          <th>SKU</th>
                          <th>ProductName</th>
                          <th>Description</th>
                          <th>Specs</th>
                          <th>Category</th>
                          <th>Brand</th>
                          <th>Stock</th>
                          <th>Price</th>
                          <th colspan="2">Action</th>
                      </tr>
                    </thead>  
                        @forelse ($products as $product)
                          <tr class="data-row table-sm table-product">
                              <td>{{$product->barcode}}</td>
                              <td>{{$product->sku}}</td>
                              <td>{{$product->product_name}}</td>
                              <td>{{$product->description}}</td>
                              <td>{{$product->specs}}</td>
                              <td>{{$product->category}}</td>
                              <td>{{$product->brand}}</td>
                              <td>{{$product->stock}}</td>
                              <td>{{$product->price}}</td>
                              <td>
                                {{-- edit icon --}}
                          
                                <a
                                class="float-left"
                                data-target="edit-modal"
                                data-toggle="modal"
                                data-tooltip="tooltip"
                                data-placement="top"
                                title="Edit"
                                data-community="{{ json_encode($product) }}"
                                data-item-barcode="{{ $product->barcode }}"
                                data-item-sku="{{ $product->sku }}"
                                data-item-productname="{{ $product->product_name }}"
                                data-item-description="{{ $product->description }}"
                                data-item-specs="{{ $product->specs }}"
                                data-item-category="{{ $product->category }}"
                                data-item-brand="{{ $product->brand }}"
                                data-item-stock="{{ $product->stock }}"
                                data-item-price="{{ $product->price }}"
                                id="edit-item"
                                {{-- onclick="document.getElementById('primaryButton').click()" --}}
                                ><i class="far fa-edit icons"></i></a>
      
                                {{-- delete icon --}}
                                <form method="POST" action="/products/{{$product->barcode}}" class="float-left">
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
                            <td colspan="10" style="text-align: center">
                              <h3>No data!</h3>
                            </td>
                          </tr>
                        @endforelse
                        {{-- <form class="form-inline" id="barcodeImg">
                            <input type="text" name="barcodeImg" class="form-control " id="barcodeImg">
                              <button type="button" id="primaryButton" class="btn btn-secondary  mx-2">
                                <i class="fas fa-search"></i> 
                              </button>
                        </form> --}}
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
              {{ $products->render("pagination::bootstrap-4") }}
            </div>
          </div>
        </div>
        {{-- container --}}
      </div>
    </div>
  </div>
  {{-- main-container --}}
</div>




   <!-- Search Modal -->
   <div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="search-modal-label">Search Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="attachment-body-content">
        <form id="search-form" class="form-horizontal" action="/products" method="GET">
            <div class="card text-black bg-light mb-0">
              <div class="card-header">
                <h2 class="m-0">Search</h2>
              </div>
              <div class="card-body">
                <!-- Search bar --> 
                <div class="form-group input-group-sm">
                  <input class="form-control" type="search" name="advanceSearch" placeholder="Search" aria-label="Search">
                </div>
                <!-- / Search bar -->
                <!-- Category --> 
                <div class="form-group input-group-sm">
                    <label for="searchCategory">Category</label>
                    <select name="searchCategory" id="searchCategory" class="form-control">
                        <option selected disabled value="">Choose...</option>
                          @foreach ($categories as $category)
                            <option>{{ $category->category_name }}</option>
                          @endforeach
                    </select>
                </div>
                <!-- /Category --> 
                <!-- Brand --> 
                <div class="form-group input-group-sm">
                  <label for="searchBrand">Brand</label>
                  <select name="searchBrand" id="searchBrand" class="form-control">
                      <option selected disabled value="">Choose...</option>
                        @foreach ($brands as $brand)
                            <option>{{ $brand->brand_name }}</option>
                        @endforeach
                  </select>
                </div>
                <!-- /Brand --> 
              </div>
            </div>
              <div class="form-group modal-footer">
                <button type="submit" id="advanceSearch" class="btn btn-primary ">Search</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>
<!-- /search Modal -->

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
            <form id="add-form" class="form-horizontal" action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="card text-black bg-light mb-0">
                  <div class="card-header">
                    <h2 class="m-0">ADD</h2>
                  </div>
                  <div class="card-body">

                    <!-- Barcode -->
                    <div class="form-group input-group-sm">
                      <label class="col-form-label" for="inputBarcode">Barcode</label>
                      <input type="text" name="inputBarcode" class="form-control " id="inputBarcode" required autofocus>
                    </div>
                    <!-- /Barcode -->
                    <!-- SKU --> 
                    <div class="form-group input-group-sm">
                      <label class="col-form-label" for="inputSKU">SKU</label>
                    <input type="text" name="inputSKU" class="form-control " id="inputSKU" required >
                    </div>
                    <!-- /SKU -->
                    <!-- ProductName --> 
                    <div class="form-group input-group-sm">
                      <label class="col-form-label" for="inputProductName">Product Name</label>
                      <input type="text" name="inputProductName" class="form-control" id="inputProductName" required>
                    </div>
                    <!-- /ProductName -->
                    <!-- Description --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="inputDescription">Description</label>
                        <input type="text" name="inputDescription" class="form-control" id="inputDescription" required>
                    </div>
                    <!-- /Description -->
                    <!-- Specs --> 
                      <div class="form-group input-group-sm">
                          <label class="col-form-label" for="inputSpecs">Specs</label>
                          <input type="text" name="inputSpecs" class="form-control" id="inputSpecs" required>
                      </div>
                    <!-- /Specs -->
                    <!-- Category --> 
                    <div class="form-group input-group-sm">
                        <label for="inputCategory">Category</label>
                        <select name="inputCategory" id="inputCategory" class="form-control" required>
                            <option selected disabled value="">Choose...</option>
                              @foreach ($categories as $category)
                                <option>{{ $category->category_name }}</option>
                              @endforeach
                        </select>
                    </div>
                    <!-- /Category --> 
                    <!-- Brand --> 
                    <div class="form-group input-group-sm">
                      <label for="inputBrand">Brand</label>
                      <select name="inputBrand" id="inputBrand" class="form-control" required>
                          <option selected disabled value="">Choose...</option>
                            @foreach ($brands as $brand)
                                <option>{{ $brand->brand_name }}</option>
                            @endforeach
                      </select>
                    </div>
                    <!-- /Brand --> 
                    <!-- Stock --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="inputStock">Stock</label>
                        <input type="text" name="inputStock" class="form-control" id="inputStock" required>
                    </div>
                    <!-- /Stock -->
                    <!-- Price --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="inputPrice">Price</label>
                        <input type="text" name="inputPrice" class="form-control" id="inputPrice" required>
                    </div>
                    <!-- /Price -->
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
            @forelse ($products as $product)
            <form id="edit-form_{{$product->barcode}}" class="form-horizontal" method="POST" action="/products/{{$product->barcode}}" enctype="multipart/form-data">
            @empty
            @endforelse
              @csrf
              {{ method_field('PUT') }}
              <div class="card text-dark bg-light mb-0">
                <div class="card-header">
                  <h2 class="m-0">Edit</h2>
                </div>
                <div class="card-body">
                  {{-- Display images --}}
                    <!-- Swiper -->
                    <div class="swiper-container h-100">

                      <div class="swiper-wrapper" id="image-container">
                        {{-- <div class="swiper-slide">Slide 1</div>
                        <div class="swiper-slide">Slide 2</div>
                        <div class="swiper-slide">Slide 3</div>
                        <div class="swiper-slide">Slide 4</div>
                        <div class="swiper-slide">Slide 5</div>
                        <div class="swiper-slide">Slide 6</div>
                        <div class="swiper-slide">Slide 7</div>
                        <div class="swiper-slide">Slide 8</div>
                        <div class="swiper-slide">Slide 9</div>
                        <div class="swiper-slide">Slide 10</div> --}}
                      </div>
                    </div>



                    {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner" id="image-container">
                        <div class="carousel-item active">
                          <img src="{{  asset('product_images/1111cc_fb-dp-HJM.png') }}" class="rounded mx-auto d-block w-50" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="{{  asset('product_images/1111cc_hjm-mockup.jpg') }}" class="d-block w-50" alt="...">
                        </div>
                        <div class="carousel-item">
                          <img src="{{  asset('product_images/1111cc_fb-dp-HJM.png') }}" class="d-block w-50" alt="...">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div> --}}
                  
                    {{-- Images Input --}}
                    <div class="form-group input-group-sm">
                      <input type="file"id="product_pic" name="product_pic" accept=".jpg,.gif,.png,.jpeg">

                      {{-- <input type="file" id="product_pic" name="product_pic"
                      accept=".jpg, .jpeg, .png"> --}}
                    </div> 

                    <!-- Barcode -->
                    <div class="form-group input-group-sm">
                      <label class="col-form-label" for="editBarcode">Barcode</label>
                      <input type="text" name="editBarcode" class="form-control " id="editBarcode">
                    </div>  
                    <!-- /Barcode -->
                    <!-- SKU --> 
                    <div class="form-group input-group-sm">
                      <label class="col-form-label" for="editSKU">SKU</label>
                    <input type="text" name="editSKU" class="form-control " id="editSKU" required autofocus>
                    </div>
                    <!-- /SKU -->
                    <!-- ProductName --> 
                    <div class="form-group input-group-sm">
                      <label class="col-form-label" for="editProductName">Product Name</label>
                      <input type="text" name="editProductName" class="form-control" id="editProductName" required>
                    </div>
                    <!-- /ProductName -->
                    <!-- Description --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="editDescription">Description</label>
                        <input type="text" name="editDescription" class="form-control" id="editDescription" required>
                    </div>
                    <!-- /Description -->
                    <!-- Specs --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="editSpecs">Specs</label>
                        <input type="text" name="editSpecs" class="form-control" id="editSpecs" required>
                    </div>
                    <!-- /Specs -->
                    <!-- Category --> 
                    <div class="form-group input-group-sm">
                        <label for="editCategory">Category</label>
                        <select name="editCategory" id="editCategory" class="form-control" required>
                            <option selected disabled value="">Choose...</option>
                              @foreach ($categories as $category)
                                <option>{{ $category->category_name }}</option>
                              @endforeach
                        </select>
                    </div>
                    <!-- /Category --> 
                    <!-- Brand --> 
                    <div class="form-group input-group-sm">
                      <label for="editBrand">Brand</label>
                    
                      <select name="editBrand" id="editBrand" class="form-control" required>
                          <option selected disabled value="">Choose...</option>
                            @foreach ($brands as $brand)
                              <option>{{ $brand->brand_name }}</option>
                            @endforeach
                      </select>
                    </div>
                    <!-- /Brand --> 
                    <!-- Stock --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="editStock">Stock</label>
                        <input type="text" name="editStock" class="form-control" id="editStock" required>
                    </div>
                    <!-- /Stock -->
                    <!-- Price --> 
                    <div class="form-group input-group-sm">
                        <label class="col-form-label" for="editPrice">Price</label>
                        <input type="text" name="editPrice" class="form-control" id="editPrice" required>
                    </div>
                    <!-- /Price -->
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


 {{-- sample  --}}




@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="{{asset('js/layouts/jquery-3.5.1.min.js')}}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{asset('js/product.js')}}"></script>
    <script>
      // alert to fade
      $("#element").fadeTo(2000, 500).slideUp(500, function(){
          $("#element").slideUp(500);
      });

      var swiper = new Swiper('.swiper-container', {
      slidesPerView: 3,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });

    </script>
@endpush
@endsection
