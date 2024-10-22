<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SizeController;

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


Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('product_variants', [ProductVariantController::class, 'index'])->name('product_variants.index');
Route::get('product_variants/create', [ProductVariantController::class, 'create'])->name('product_variants.create');
Route::post('product_variants', [ProductVariantController::class, 'store'])->name('product_variants.store');
Route::get('product_variants/{productVariant_id}/edit', [ProductVariantController::class, 'edit'])->name('product_variants.edit');
Route::put('product_variants/{productVariant_id}', [ProductVariantController::class, 'update'])->name('product_variants.update');
Route::delete('product_variants/{productVariant_id}', [ProductVariantController::class, 'destroy'])->name('product_variants.destroy');

Route::get('/sizes', [SizeController::class, 'getSizes'])->name('sizes.get');
