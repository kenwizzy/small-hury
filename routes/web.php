<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\AttributeController;


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
Route::get('dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
Route::post('create_category', [CategoryController::class, 'store'])->name('create_category');
Route::get('dashboard/edit_cat/{id}', [CategoryController::class, 'edit'])->name('dashboard.edit_cat');
Route::patch('dashboard/update_category/{id}', [CategoryController::class, 'update'])->name('dashboard.update_category');
Route::get('dashboard/view_profile', [UserController::class, 'show']);
Route::get('dashboard/products', [ProductController::class, 'allProducts'])->name('dashboard.products');
Route::get('dashboard/create', [ProductController::class, 'create'])->name('dashboard.create');
Route::get('dashboard/discounts', [DiscountController::class, 'index'])->name('dashboard/discounts');
Route::get('dashboard/attributes', [AttributeController::class, 'index'])->name('dashboard/attributes');
Route::post('add_discount', [DiscountController::class, 'addDiscount']);
Route::post('add_attribute', [AttributeController::class, 'store']);
Route::view('dashboard/products/details', 'dashboard.details')->name('dashboard.details');
Route::get('dashboard/add_store', [WarehouseController::class, 'create']);
Route::get('/get_state_lgas/{id}', [WarehouseController::class, 'FetchStateLgas']);
Route::get('/get_attr_values/{id}', [AttributeController::class, 'FetchAttributeValues']);
Route::get('/get_subcategory_values/{id}', [CategoryController::class, 'FetchSubCategoryValues']);
Route::post('submit_store', [WarehouseController::class, 'store'])->name('submit_store');
Route::get('dashboard/stores', [WarehouseController::class, 'index'])->name('dashboard.stores');
Route::get('dashboard/add_user', [UserController::class,'create'])->name('create_user');
Route::post('create_user', [UserController::class,'store'])->name('dashboard.add_user');
Route::get('dashboard/users', [UserController::class,'index'])->name('dashboard.users');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
