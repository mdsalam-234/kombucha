<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FlavoursController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrdermanagementController;
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
    return view('blank');
});

Route::get('products', [ProductsController::class,'index']);
Route::post('products/store', [ProductsController::class,'store']);
Route::post('products/update/{id}', [ProductsController::class,'update']);
Route::post('products/delete/{id}', [ProductsController::class,'destroy']);

Route::get('flavours', [FlavoursController::class,'index']);
Route::post('flavours/store', [FlavoursController::class,'store']);
Route::post('flavours/update/{id}', [FlavoursController::class,'update']);
Route::post('flavours/delete/{id}', [FlavoursController::class,'destroy']);

Route::get('customers', [CustomersController::class,'index']);
Route::post('customers/store', [CustomersController::class,'store']);
Route::post('customers/update/{id}', [CustomersController::class,'update']);
Route::post('customers/delete/{id}', [CustomersController::class,'destroy']);

Route::get('orders', [OrdermanagementController::class,'index']);
Route::post('orders/update/{id}', [OrdermanagementController::class,'update']);
Route::post('orders/delete/{id}', [OrdermanagementController::class,'destroy']);
Route::get('orders/invoice/{id}', [OrdermanagementController::class,'getInvoice']);
