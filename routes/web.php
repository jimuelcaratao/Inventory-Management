<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserDescriptionController;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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

Route::resource('/categories', CategoryController::class);

Route::resource('/brands', BrandController::class);

Route::resource('/suppliers', SupplierController::class);

Route::resource('/invoices', InvoiceController::class);



// Auth::routes();
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user_descriptions', [App\Http\Controllers\UserDescriptionController::class, 'index'])->name('user_descriptions');

Route::get('/admin', [App\Http\Controllers\HomeAdminController::class, 'index'])->name('admin.home')->middleware('is_admin');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products')->middleware('is_admin');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories')->middleware('is_admin');

Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands')->middleware('is_admin');

Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'index'])->name('suppliers')->middleware('is_admin');

Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index'])->name('invoices')->middleware('is_admin');

Route::get('/analytics', [App\Http\Controllers\AnalyticController::class, 'index'])->name('analytics')->middleware('is_admin');


// Resources

//  Route::resource('product', CategoryController::class)->only([
//     'index', 'show'
// ]);
