<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Sale\SaleController;
use Illuminate\Support\Facades\Route;

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
    return view('layouts/app');
});

Route::get('/customer/list', [CustomerController::class, 'showCustomerList'])->name('customerlist');
Route::get('/product/list', [ProductController::class, 'showProductList'])->name('productlist');
Route::get('/sale/list', [SaleController::class, 'showSaleList'])->name('salelist');

Route::delete('/customer/list/{customerId}', [CustomerController::class, 'deleteCustomerById'])->name('deletecustomer');
Route::delete('/sale/list/{saleId}', [SaleController::class, 'deleteSaleById'])->name('deletesale');
Route::delete('/product/list/{productId}', [ProductController::class, 'deleteProductById'])->name('deleteproduct');

Route::get('/customer/create', [CustomerController::class, 'showCustomerCreateView'])->name('create.customer');
Route::post('/customer/create', [CustomerController::class, 'submitCustomerCreateView'])->name('create.customer');
Route::get('/customer/create/confirm', [CustomerController::class, 'showCustomerCreateConfirmView'])->name('customer.create.confirm');
Route::post('/customer/create/confirm', [CustomerController::class, 'submitCustomerCreateConfirmView'])->name('customer.create.confirm');

Route::get('/product/create', [ProductController::class, 'showProductCreateView'])->name('create.product');
Route::post('/product/create', [ProductController::class, 'submitProductCreateView'])->name('create.product');
Route::get('/product/create/confirm', [ProductController::class, 'showProductCreateConfirmView'])->name('product.create.confirm');
Route::post('/product/create/confirm', [ProductController::class, 'submitProductCreateConfirmView'])->name('product.create.confirm');

Route::get('/sale/create', [SaleController::class, 'showSaleCreateView'])->name('create.sale');
Route::post('/sale/create', [SaleController::class, 'submitSaleCreateView'])->name('create.sale');
Route::get('/sale/create/confirm', [SaleController::class, 'showSaleCreateConfirmView'])->name('sale.create.confirm');
Route::post('/sale/create/confirm', [SaleController::class, 'submitSaleCreateConfirmView'])->name('sale.create.confirm');

Route::get('/customer/edit/{postId}', [CustomerController::class, 'showCustomerEdit'])->name('edit.customer');
Route::post('/customer/edit/{postId}', [CustomerController::class, 'submitCustomerEditView'])->name('edit.customer');
Route::get('/customer/edit/confirm/{postId}', [CustomerController::class, 'showCustomerEditConfirmView'])->name('customer.edit.confirm');
Route::post('/customer/edit/confirm/{postId}', [CustomerController::class, 'submitCustomerEditConfirmView'])->name('customer.edit.confirm');

Route::get('/product/edit/{postId}', [ProductController::class, 'showProductEdit'])->name('edit.product');
Route::post('/product/edit/{postId}', [ProductController::class, 'submitProductEditView'])->name('edit.product');
Route::get('/product/edit/confirm/{postId}', [ProductController::class, 'showProductEditConfirmView'])->name('product.edit.confirm');
Route::post('/product/edit/confirm/{postId}', [ProductController::class, 'submitProductEditConfirmView'])->name('product.edit.confirm');

Route::get('/sale/edit/{postId}', [SaleController::class, 'showSaleEdit'])->name('edit.sale');
Route::post('/sale/edit/{postId}', [SaleController::class, 'submitSaleEditView'])->name('edit.sale');
Route::get('/sale/edit/confirm/{postId}', [SaleController::class, 'showSaleEditConfirmView'])->name('sale.edit.confirm');
Route::post('/sale/edit/confirm/{postId}', [SaleController::class, 'submitSaleEditConfirmView'])->name('sale.edit.confirm');

Route::get('/customer/upload', [CustomerController::class, 'showcustomerUploadView'])->name('customer.upload');
Route::post('/customer/upload', [CustomerController::class, 'submitcustomerUploadView'])->name('customer.upload');

Route::get('/product/upload', [ProductController::class, 'showProductUploadView'])->name('product.upload');
Route::post('/product/upload', [ProductController::class, 'submitProductUploadView'])->name('product.upload');

Route::get('/sale/upload', [SaleController::class, 'showSaleUploadView'])->name('sale.upload');
Route::post('/sale/upload', [SaleController::class, 'submitSaleUploadView'])->name('sale.upload');

Route::get('/customer/download', [CustomerController::class, 'downloadCustomerCSV'])->name('downloadCustomerCSV');
Route::get('/product/download', [ProductController::class, 'downloadProductCSV'])->name('downloadProductCSV');
Route::get('/sale/download', [SaleController::class, 'downloadSaleCSV'])->name('downloadSalesCSV');

Route::get('/customer/search', [CustomerController::class, 'searchCustomer'])->name('customer.search');
Route::get('/product/search', [ProductController::class, 'searchProduct'])->name('product.search');
Route::get('/sale/search', [SaleController::class, 'searchSale'])->name('sale.search');


Route::get('/api/product', function() {
    return view('product.api.list');
});

Route::get('/api-view/product/create', function() {
    return view('product.api.create');
});

Route::get('/api-view/product/edit/{productID}', function() {
   return view('product.api.edit'); 
});
