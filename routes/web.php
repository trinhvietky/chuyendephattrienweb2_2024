<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Các trang khác (ví dụ Blog, About, Contact)
Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/blog-detail', function () {
    return view('blog-detail');
})->name('blog-');

Route::get('/product', function () {
    return view('product');
})->name('product');

Route::get('/product-detail', function () {
    return view('product-detail');
})->name('product-');

Route::get('/shoping-cart', function () {
    return view('shoping-cart');
})->name('shoping-cart');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');