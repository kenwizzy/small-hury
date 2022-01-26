<?php

use App\Http\Controllers\API\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\WareHouseController;
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

    Route::get('/user', [UserController::class, 'getUser']);
    //Route::get('/products', [ProductController::class, 'getProducts']);
    Route::get('/categories', [CategoryController::class, 'getCategories']);

    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::get('/product/{id}', [ProductController::class, 'show']);

    /* Uzezi Jephter endpoints  */

    Route::get('/warehouses',[WareHouseController::class,'index']);
    //For managing addresses for user
    Route::get('/addresses',[AddressController::class,'index']);
    Route::post('/addresses',[AddressController::class,'create']);
    Route::delete('/addresses/{id}',[AddressController::class,'destroy']);
    Route::patch('/addresses/{id}',[AddressController::class,'edit']);

});

Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. Please check your url and try again.'
    ], 404);
});
