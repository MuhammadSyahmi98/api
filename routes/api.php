<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('buyers', 'App\Http\Controllers\Buyer\BuyerController', ['only' => ['show', 'index']]);
Route::resource('buyers.transactions', 'App\Http\Controllers\Buyer\BuyerTransactionController', ['only' => [ 'index']]);
Route::resource('buyers.products', 'App\Http\Controllers\Buyer\BuyerProductController', ['only' => [ 'index']]);
Route::resource('buyers.sellers', 'App\Http\Controllers\Buyer\BuyerSellerController', ['only' => [ 'index']]);
Route::resource('buyers.categories', 'App\Http\Controllers\Buyer\BuyerCategoryController', ['only' => [ 'index']]);
Route::resource('sellers', 'App\Http\Controllers\Seller\SellerController', ['only' => ['show', 'index']]);
Route::resource('products', 'App\Http\Controllers\Product\ProductController', ['only' => ['show', 'index']]);
Route::resource('transactions', 'App\Http\Controllers\Transaction\TransactionController', ['only' => ['show', 'index']]);
Route::resource('transactions.categories', 'App\Http\Controllers\Transaction\TransactionCategoryController', ['only' => ['index']]);
Route::resource('transactions.seller', 'App\Http\Controllers\Transaction\TransactionSellerController', ['only' => ['index']]);
Route::resource('categories', 'App\Http\Controllers\Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('users', 'App\Http\Controllers\User\UserController', ['except' => ['create', 'edit']]);
