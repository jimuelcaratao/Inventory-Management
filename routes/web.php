<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::resource('/products', ProductController::class);


// Auth::routes();
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\HomeAdminController::class, 'index'])->name('admin.home')->middleware('is_admin');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products')->middleware('is_admin');



// Resources

//  Route::resource('product', CategoryController::class)->only([
//     'index', 'show'
// ]);
