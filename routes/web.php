<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
=======
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SizeController;
>>>>>>> CRUD-Product-ThanhTai

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
<<<<<<< HEAD
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
=======
    return view('welcome');
});

>>>>>>> CRUD-Product-ThanhTai

Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('product_variants', [ProductVariantController::class, 'index'])->name('product_variants.index');
Route::get('product_variants/create', [ProductVariantController::class, 'create'])->name('product_variants.create');
Route::post('product_variants', [ProductVariantController::class, 'store'])->name('product_variants.store');
Route::get('product_variants/{productVariant_id}/edit', [ProductVariantController::class, 'edit'])->name('product_variants.edit');
Route::put('product_variants/{productVariant_id}', [ProductVariantController::class, 'update'])->name('product_variants.update');
Route::delete('product_variants/{productVariant_id}', [ProductVariantController::class, 'destroy'])->name('product_variants.destroy');

<<<<<<< HEAD
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
// Route::get('/admin/user-list', function () {
//     return view('/admin/user-list');
// });
Route::get('/admin/user-add', function () {
    return view('/admin/user-add');
});
Route::get('/admin/user-list', [AdminController::class, 'AllUser']);

Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('user.destroy');

Route::get('/admin/user-list', [AdminController::class, 'AllUser'])->name('admin/user-list');

//Them user
Route::post('/admin/users', [AdminController::class, 'store'])->name('users.store');


//Sua user
Route::get('/admin/user/{id}/edit', [AdminController::class, 'edit'])->name('user.edit');

Route::put('/admin/user/{id}', [AdminController::class, 'update'])->name('user.update');
=======
Route::get('/sizes', [SizeController::class, 'getSizes'])->name('sizes.get');
>>>>>>> CRUD-Product-ThanhTai
