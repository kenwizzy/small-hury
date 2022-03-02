<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;


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

Route::middleware(['auth'])->group(function () {
    
    Route::post('dashboard/create_product', [ProductController::class, 'store'])->name('create_product');
    Route::get('dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
    Route::get('dashboard/sub_categories/{id}', [CategoryController::class, 'getSubCategories'])->name('dashboard.sub_categories');
    Route::get('dashboard/sub-categories/', [CategoryController::class, 'getsCats'])->name('dashboard.sub-categories');
    Route::post('create_category', [CategoryController::class, 'store'])->name('create_category');
    Route::get('dashboard/edit_cat/{id}', [CategoryController::class, 'edit'])->name('dashboard.edit_cat');
    Route::get('dashboard/delete_category/{category}', [CategoryController::class, 'destroy'])->name('dashboard.delete_category');
    Route::post('create_sub_category', [CategoryController::class, 'createSubCategory'])->name('create_sub_category');
    Route::patch('dashboard/update_category/{id}', [CategoryController::class, 'update'])->name('dashboard.update_category');
    Route::get('dashboard/view_profile', [UserController::class, 'show'])->name('dashboard.view_profile');
    Route::get('dashboard/products', [ProductController::class, 'allProducts'])->name('dashboard.products');
    Route::get('dashboard/create', [ProductController::class, 'create'])->name('dashboard.create');
    Route::get('delete_product/{product}', [ProductController::class, 'destroy'])->name('delete_product');
    Route::get('dashboard/discounts', [DiscountController::class, 'index'])->name('dashboard/discounts');
    Route::get('dashboard/edit_discount/{discount}', [DiscountController::class, 'edit'])->name('dashboard.edit_discount');
    Route::get('dashboard/attributes', [AttributeController::class, 'index'])->name('dashboard/attributes');
    Route::post('add_discount', [DiscountController::class, 'addDiscount']);
    Route::patch('update_discount/{discount}', [DiscountController::class, 'update'])->name('update_discount');
    Route::get('delete_discount/{id}', [DiscountController::class, 'delete'])->name('delete_discount');
    Route::post('add_attribute', [AttributeController::class, 'store']);
    Route::get('/dashboard/edit_attribute/{attribute}', [AttributeController::class, 'edit'])->name('dashboard.edit_attribute');
    Route::patch('update_attribute/{attribute}', [AttributeController::class, 'update'])->name('update_attribute');
    Route::delete('delete_attribute/{attribute}', [AttributeController::class, 'destroy'])->name('delete_attribute');
    Route::get('dashboard/product_details/{product}', [ProductController::class, 'show'])->name('dashboard/product_details');
    Route::get('dashboard/edit_product/{product}', [ProductController::class, 'edit'])->name('dashboard/edit_product');
    Route::patch('update_product/{product}', [ProductController::class, 'update'])->name('update_product');
    Route::get('dashboard/add_store', [WarehouseController::class, 'create']);
    Route::get('/get_state_lgas/{id}', [WarehouseController::class, 'FetchStateLgas']);
    Route::get('/get_attr_values/{id}', [AttributeController::class, 'FetchAttributeValues']);
    Route::get('/get_subcategory_values/{id}', [CategoryController::class, 'FetchSubCategoryValues']);
    Route::post('submit_store', [WarehouseController::class, 'store'])->name('submit_store');
    Route::get('dashboard/stores', [WarehouseController::class, 'index'])->name('dashboard.stores');
    Route::get('dashboard/stores/{warehouse}', [WarehouseController::class, 'edit'])->name('dashboard.edit_store');
    Route::get('dashboard/districts/{warehouse}', [WarehouseController::class, 'district'])->name('dashboard.districts');
    Route::patch('update_store/{warehouse}', [WarehouseController::class, 'update'])->name('update_store');
    Route::get('dashboard/store_details/{store}', [WarehouseController::class, 'show'])->name('store_details');
    Route::get('dashboard/add_user', [UserController::class, 'create'])->name('dashboard.add_user');
    Route::get('dashboard/edit_user', [UserController::class, 'edit'])->name('dashboard.edit_user');
    Route::patch('update_user', [UserController::class, 'update'])->name('update_user');
    Route::post('create_user', [UserController::class, 'store'])->name('create_user');
    Route::get('dashboard/users', [UserController::class, 'index'])->name('dashboard.users');
    Route::get('dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');
    Route::get('dashboard/order_details/{order}', [OrderController::class, 'show'])->name('dashboard/order_details');
    Route::get('process_order/{order}', [OrderController::class, 'process'])->name('process_order');
    Route::get('dashboard/declineorder/{order}', [OrderController::class, 'decline'])->name('dashboard.declineorder');
    Route::get('dashboard/get_bikers/{order}', [OrderController::class, 'getBikers'])->name('dashboard.get_bikers');
    Route::post('dashboard/assign_biker', [OrderController::class, 'assignBiker'])->name('dashboard.assign_biker');
    Route::get('dashboard/assign_manager/{warehouse}', [WarehouseController::class, 'assign'])->name('dashboard.assign_manager');
    Route::post('assign_manager', [WarehouseController::class, 'assignManager'])->name('assign_manager');
    Route::get('dashboard/revenues', [OrderController::class, 'getRevenues'])->name('dashboard.revenues');
    Route::get('dashboard/total-orders', [OrderController::class, 'totalOrders'])->name('dashboard.total-orders');
    Route::get('dashboard/abandoned-cart', [OrderController::class, 'abandonedCart'])->name('dashboard.abandoned-cart');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Route::get('/dashboard', function () {
    //     return view('dashboard.index');
    // })->middleware(['auth'])->name('dashboard');

});
require __DIR__ . '/auth.php';
