<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDescriptionController;
use App\Http\Controllers\UserSecurityController;
use App\Http\Resources\ProductImages;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// basic routing
Route::get('/', function () {
    return view('landing');
});

// Route::get('/login', function () {
//     return view('login');
// });
// Route::get('/product', [ProductController::class, 'advanceSearch']);
Route::resource('/user_descriptions', UserDescriptionController::class);

Route::resource('/products', ProductController::class);

Route::resource('/orders', OrderItemController::class);

Route::resource('/categories', CategoryController::class);

Route::resource('/brands', BrandController::class);

Route::resource('/suppliers', SupplierController::class);

Route::resource('/invoices', InvoiceController::class);

Route::resource('/user_security', UserSecurityController::class);

Route::resource('/analytics', AnalyticController::class);

Route::resource('/users', UserController::class);

Route::resource('/product_photo', ProductPhoto::class);


// Route::resource([
//     '/products', ProductController::class,
// ]);


// Auth::routes();
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user_descriptions', [App\Http\Controllers\UserDescriptionController::class, 'index'])->name('user_descriptions');

Route::get('/user_security', [App\Http\Controllers\UserSecurityController::class, 'index'])->name('user_security');

Route::get('/admin', [App\Http\Controllers\HomeAdminController::class, 'index'])->name('admin.home')->middleware('is_admin');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products')->middleware('is_admin');

Route::get('/orders', [App\Http\Controllers\OrderItemController::class, 'index'])->name('orders')->middleware('is_admin');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories')->middleware('is_admin');

Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands')->middleware('is_admin');

Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers')->middleware('is_admin');

Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices')->middleware('is_admin');

Route::get('/analytics', [App\Http\Controllers\AnalyticController::class, 'index'])->name('analytics')->middleware('is_admin');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users')->middleware('is_admin');

// Resources

//  Route::resource('product', CategoryController::class)->only([
//     'index', 'show'
// ]);


Route::get('/ProductImages', function (Request $request) {
    return new ProductImages(
        ProductPhoto::where('barcode', $request->Id)
            ->get()
    );
});

Route::get('/ProductImages/delete', function (Request $request) {
    ProductPhoto::where('product_photo_id', $request->Id)
        ->delete();
});
