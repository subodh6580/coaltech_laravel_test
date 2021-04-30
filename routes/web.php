<?php

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

Route::get('/', [App\Http\Controllers\InventoryController::class, 'ProductListView']);

Route::post('product_submit', [App\Http\Controllers\InventoryController::class, 'productSubmit']);
Route::get('list', [App\Http\Controllers\InventoryController::class, 'index']);
Route::get('update_product/{id}', [App\Http\Controllers\InventoryController::class, 'ProductListView']);
Route::post('update', [App\Http\Controllers\InventoryController::class, 'update']);