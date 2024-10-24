<?php

use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ColorController;
use App\Models\Color;
use App\Models\Size;

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

Route::get('/admin-home', function () {
    return view('admin-home');
});
Route::get('/user-list', function () {
    return view('user-list');
});
Route::get('/user-add', function () {
    return view('admin.user.user-add');
});
Route::get('/user-list', [UserController::class, 'index']);

Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/user-list', [UserController::class, 'index'])->name('user-list');

//Them user
Route::post('/users', [UserController::class, 'store'])->name('users.store');


//Sua user
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');

Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');


Route::get('/', function () {
    return view('page-home');
});

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

//-------SIZE
//Hiển thị view size list
Route::get('/size-list', function () {
    return view('admin.size.size-list');
}); 

//Hiển thị danh sách size
Route::get('/size-list', [SizeController::class, 'index'])->name('size-list');

//Xóa size
Route::delete('/size/{size_id}', [SizeController::class, 'destroy'])->name('size.destroy');
Route::get('/size-list', [SizeController::class, 'index'])->name('size-list');

// Add size
Route::get('/size-add', function () {
    return view('admin.size.size-add');
});

Route::post('/sizes', [SizeController::class, 'store'])->name('size.store');

//Edit size
Route::get('/size/{size_id}/edit', [SizeController::class, 'edit'])->name('size.edit');

Route::put('/size/{id}', [SizeController::class, 'update'])->name('size.update');


//Color
//Hiển thị view color list
Route::get('/color-list', function () {
    return view('admin.color.color-list');
}); 

//Hiển thị danh sách color
Route::get('/color-list', [ColorController::class, 'index'])->name('color-list');

//Xóa color
Route::delete('/color/{color_id}', [ColorController::class, 'destroy'])->name('color.destroy');
Route::get('/color-list', [ColorController::class, 'index'])->name('color-list');

// Add color
Route::get('/color-add', function () {
    return view('admin.color.color-add');
});

Route::post('/colors', [ColorController::class, 'store'])->name('color.store');

//Edit size
Route::get('/color/{color_id}/edit', [ColorController::class, 'edit'])->name('color.edit');

Route::put('/color/{id}', [ColorController::class, 'update'])->name('color.update');