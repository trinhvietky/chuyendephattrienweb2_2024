<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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
    // Kiểm tra nếu người dùng đã đăng nhập
    if (Auth::check()) {
        // Chuyển hướng dựa trên vai trò của người dùng
        if (Auth::user()->usertype === 'admin') {
            return redirect('/admin/home');
        } else {
            return redirect('/users/home');
        }
    }

    // Nếu chưa đăng nhập, trả về trang index (trang chủ)
    return view('index');
})->name('index');

Route::middleware(['auth', 'checkUserType'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/users/home', [UserController::class, 'index'])->name('users.home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


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

//users
//user/home
Route::get('/users/home', function () {
    return view('users/home');
})->name('users/home');

//user/blog
Route::get('/users/blog', function () {
    return view('users/blog');
})->name('users/blog');

//user/blog-detail
Route::get('/users/blog-detail', function () {
    return view('/users/blog-detail');
})->name('users/blog-detail');

//user/product
Route::get('/users/product', function () {
    return view('/users/product');
})->name('users/product');

//user/contact
Route::get('/users/contact', function () {
    return view('/users/contact');
})->name('users/contact');

//user/about
Route::get('/users/about', function () {
    return view('/users/about');
})->name('users/about');

//user/product-detail
Route::get('/users/product-detail', function () {
    return view('users/productproduct-detail');
})->name('users/product-detail');

// Những route của những trang chưa đăng nhập
Route::get('/shoping-cart', function () {
    return view('shoping-cart');
})->name('shoping-cart');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// Route::get('/admin/home', function () {
//     return view('admin/home');
// })->name('admin/home');
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
