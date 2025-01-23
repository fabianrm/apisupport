<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function () {


    Route::apiResource('users', UserController::class);

    //Login
    Route::post('auth/login', [UserController::class, 'login']);

    Route::middleware('auth:sanctum')->post('auth/refresh-token', [UserController::class, 'refreshToken']);
    Route::middleware('auth:sanctum')->get('auth/check-token', [UserController::class, 'checkToken']);


    // Route::post('auth/refresh-token', [UserController::class, 'refreshToken']);
    // Route::get('auth/check-token', [UserController::class, 'checkToken']);

    //Brand
    Route::patch('brands/{brand}/deactivate', [BrandController::class, 'deactivate']); //Desactivar brand
    Route::apiResource('brands', BrandController::class);

    //Category
    Route::apiResource('categories', CategoryController::class);
    Route::patch('categories/{category}/deactivate', [CategoryController::class, 'deactivate']); //Desactivar categoria

    //Device Type
    Route::apiResource('device-types', DeviceTypeController::class);

    //Store
    Route::apiResource('stores', StoreController::class);

    //Rutas autenticadas
    Route::middleware(['auth:sanctum'])->group(function () {

        //Customer
        Route::patch('customers/{customer}/deactivate', [CustomerController::class, 'deactivate']); //Desactivar cliente
        Route::apiResource('customers', CustomerController::class);
        //Device
        Route::apiResource('devices', DeviceController::class);
        //Suppliers
        Route::apiResource('suppliers', SupplierController::class);
        //Products
        Route::apiResource('products', ProductController::class);
        //Purchases
        Route::apiResource('purchases', PurchaseController::class);
        //Repairs
        Route::apiResource('repairs', RepairController::class);
    });
});
