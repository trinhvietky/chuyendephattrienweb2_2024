<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('user-add');
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

