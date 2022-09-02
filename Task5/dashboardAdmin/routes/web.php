<?php

use App\Http\Controllers\Products\ProductsController;
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
    return view('welcome');
});
Route::get('products/', [ProductsController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
Route::get('products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('products/store', [ProductsController::class, 'store'])->name('products.store');
Route::put('products/{id}/update', [ProductsController::class, 'update'])->name('products.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
