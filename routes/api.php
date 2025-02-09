<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RepairHistoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SunatCurrencyController;
use App\Http\Controllers\SunatDocumentIdController;
use App\Http\Controllers\SunatDocumentTypeController;
use App\Http\Controllers\SunatOperationTypeController;
use App\Http\Controllers\SunatUnitController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Models\SunatDocumentType;
use App\Models\SunatOperationType;
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


    //Route::apiResource('users', AuthController::class);

    //Login
    Route::post('auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->post('auth/refresh-token', [AuthController::class, 'refreshToken']);
    Route::middleware('auth:sanctum')->get('auth/check-token', [AuthController::class, 'checkToken']);


    //Brand
    Route::patch('brands/{brand}/deactivate', [BrandController::class, 'deactivate']); //Desactivar brand
    Route::apiResource('brands', BrandController::class);

    //Category
    Route::apiResource('categories', CategoryController::class);
    Route::patch('categories/{category}/deactivate', [CategoryController::class, 'deactivate']); //Desactivar categoria

    //Sunat Unit
    Route::apiResource('units', SunatUnitController::class);
    Route::patch('units/{unit}/deactivate', [SunatUnitController::class, 'deactivate']); //Desactivar unidad

    //Device Type
    Route::apiResource('device-types', DeviceTypeController::class);

    //Store
    Route::apiResource('stores', StoreController::class);

    // Route::apiResource('products', ProductController::class);

    //Rutas autenticadas
    Route::middleware(['auth:sanctum'])->group(function () {

        //Filter Technicians
        Route::post('users/technicians', [UserController::class, 'filterTechnicians']);

        Route::patch('repairs/{repair}/changeAtention', [RepairController::class, 'changeAtention']); //Desactivar cliente
        
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
        //Histories
        Route::apiResource('histories', RepairHistoryController::class);
        //Sales
        Route::apiResource('sales', SaleController::class);
        //Documents IDS
        Route::apiResource('documents-ids', SunatDocumentIdController::class);
        //Tipo Operacion
        Route::apiResource('operations-type', SunatOperationTypeController::class);
        //Tipo Documento
        Route::apiResource('documents-type', SunatDocumentTypeController::class);
        //Tipo Moneda
        Route::apiResource('currencies', SunatCurrencyController::class);

        //Users
        Route::apiResource('users', UserController::class);
    });
});
