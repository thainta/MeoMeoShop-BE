<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HotelTypeController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\HotelBookingController;
use App\Http\Controllers\ServicesAppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

//Route::apiResource('users', UserController::class);

Route::apiResources([
    'users' => UserController::class,
    'pets' => PetController::class,
//    'products' => ProductsController::class,
    'hotel_booking' => HotelBookingController::class,
    'hotel_type' => HotelTypeController::class,
    'order' => OrderController::class,
    'order_item' => OrderItemController::class,
    'services' => ServiceController::class,
    'service_appointments' => ServicesAppointmentController::class,
    'cart' => CartController::class,
    'images' => ImageController::class,
]);

Route::controller(ProductsController::class)->prefix("products")->group(function () {

    Route::get('/',  'index');
    Route::post('/',  'store');
    Route::get('/{product}', 'show');
    Route::match(['put', 'patch'], 'products/{product}', 'update');
    Route::delete('/{product}',  'destroy');
    Route::get('/species/{species}', 'getProductBySpecies');
    Route::get('/species/{species}/category/{category}', 'getProductBySpeciesAndCategory');

});
