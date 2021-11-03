<?php

use App\Http\Controllers\API\Product\ProductAPIController;
use Illuminate\Http\Request;
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

Route::get('/product/list', [ProductAPIController::class, 'getProductList']);

Route::get('/product/{productId}', [ProductAPIController::class, 'getProductById']);
Route::post('/product/create', [ProductAPIController::class, 'createProduct']);
Route::post('/product/upload', [ProductAPIController::class, 'uploadProductCSVFile']);
Route::post('/product/edit/{productId}', [ProductAPIController::class, 'updateProduct']);
Route::delete('/product/delete/{productId}', [ProductAPIController::class, 'deleteProductById']);
