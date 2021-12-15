<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

Route::get('/', function () {
    return view('auth.login');
});

Route::post('dashboard/create_product', [ProductController::class, 'store'])->name('create_product');
Route::view('dashboard/categories', 'dashboard.categories')->name('dashboard.categories');
Route::view('dashboard/products', 'dashboard.products')->name('dashboard.products');
Route::get('dashboard/create', [ProductController::class, 'create'])->name('dashboard.create');
Route::view('dashboard/products/details', 'dashboard.details')->name('dashboard.details');
Route::view('dashboard/add_store', 'dashboard.add_store')->name('dashboard.add_store');
Route::view('dashboard/stores', 'dashboard.stores')->name('dashboard.stores');
Route::view('dashboard/add_user', 'dashboard.add_user')->name('dashboard.add_user');
Route::view('dashboard/users', 'dashboard.users')->name('dashboard.users');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
