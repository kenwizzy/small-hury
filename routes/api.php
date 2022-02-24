<?php

use App\Http\Controllers\API\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DeliveryCostController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\WareHouseController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//Route::middleware(['auth:sanctum'])->group(function ($router) {

Route::group([
    'middleware' => 'auth:sanctum'
], function ($router) {


    //Route::get('/products', [ProductController::class, 'getProducts']);
    Route::get('/categories', [CategoryController::class, 'getCategories']);
    Route::get('/categories-parent',[CategoryController::class,'getParent']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::get('/product/{id}', [ProductController::class, 'show']);

    /* Uzezi Jephter endpoints  */

    //For working with users
    Route::get('/user', [UserController::class, 'getUser']);
    Route::post('update-user',[UserController::class,'update']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/change-password',[UserController::class,'changePassword']);
    Route::get('/unread-notification-count',[UserController::class,'getUnreadNotificationCount']);
    Route::get('/notifications',[UserController::class,'getNotifications']);
    Route::get('/read',[UserController::class,'readNotifications']);
    Route::post('/enquiry',[UserController::class,'sendEnquiry']);
    Route::post('/feedback',[UserController::class,'sendFeedback']);

    Route::get('/warehouses',[WareHouseController::class,'index']);
    Route::get('/warehouses/{id}',[WareHouseController::class,'show']);
    //For managing addresses for user
    Route::get('/addresses',[AddressController::class,'index']);
    Route::get('/default-address',[AddressController::class,'getDefaultAddress']);
    Route::post('/addresses',[AddressController::class,'create']);
    Route::delete('/addresses/{id}',[AddressController::class,'destroy']);
    Route::patch('/addresses/{id}',[AddressController::class,'edit']);

    //For managing wishing of products
    Route::patch('/wish-product/{id}',[ProductController::class,'wishProduct']);
    Route::delete('/wish-product/{id}',[ProductController::class,'removeWished']);
    Route::get('/search',[ProductController::class,'search']);
    Route::get('/user-searches',[ProductController::class,'getRecentSearches']);
    Route::get('/wishlists',[UserController::class,'getWishlists']);

    //For adding Items to cart
    Route::prefix('cart')->group(function(){
        Route::get('/',[CartController::class,'index']);
        Route::post('/add-product/{id}',[CartController::class,'addProduct']);
        Route::post('/remove-product/{id}',[CartController::class,'removeProduct']);
    });

    // For geeting delivery cost
    Route::get('delivery-cost',[DeliveryCostController::class,'index']);

    //For dealing with Orders
    Route::prefix('orders')->group(function(){
        Route::get('/',[OrderController::class,'index']);
        Route::post('/store',[OrderController::class,'store']);
        Route::patch('/cancel/{id}',[OrderController::class,'cancelOrder']);
        Route::put('/re-order/{id}',[OrderController::class,'reOrder']);
        Route::get('/{id}',[OrderController::class,'show']);
        Route::post('/rating',[OrderController::class,'storeRating']);
    });
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. Please check your url and try again.'
    ], 404);
});
