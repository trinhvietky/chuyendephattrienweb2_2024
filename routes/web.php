<?php


use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CrudVoucherController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DanhmucController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;

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


Route::get('/', function() {
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
})->name('product-detail');

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

//Danh muc
Route::get('/admin/danhmuc-list', [DanhmucController::class, 'index'])->name('danhmuc.index');

Route::get('/admin/danhmuc-add', function () {
    return view('/admin/danhmuc-add');
});

Route::post('/admin/danhmuc-add', [DanhmucController::class, 'store'])->name('danhmuc.store');

Route::get('/admin/danhmuc/{danhmuc_ID}/edit', [DanhmucController::class, 'edit'])->name('danhmuc.edit');

Route::put('/admin/danhmuc/{danhmuc_ID}', [DanhmucController::class, 'update'])->name('danhmuc.update');

Route::delete('/admin/danhmuc/{id}', [DanhmucController::class, 'destroy'])->name('danhmuc.destroy');

//Quan ly product
Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('admin/product_variants', [ProductVariantController::class, 'index'])->name('product_variants.index');
Route::get('admin/product_variants/create', [ProductVariantController::class, 'create'])->name('product_variants.create');
Route::post('admin/product_variants', [ProductVariantController::class, 'store'])->name('product_variants.store');
Route::get('admin/product_variants/{productVariant_id}/edit', [ProductVariantController::class, 'edit'])->name('product_variants.edit');
Route::put('admin/product_variants/{productVariant_id}', [ProductVariantController::class, 'update'])->name('product_variants.update');
Route::delete('admin/product_variants/{productVariant_id}', [ProductVariantController::class, 'destroy'])->name('product_variants.destroy');

Route::get('/sizes', [SizeController::class, 'getSizes'])->name('sizes.get');



// quản lý voucher
Route::get('admin/voucher-list', [CrudVoucherController::class, 'listVoucher'])->name('voucher_list');

// thêm voucher
Route::post('admin/create-voucher', [CrudVoucherController::class, 'postVoucher'])->name('create_voucher');
Route::get('admin/create-Voucher', function () {
    return view('admin.voucher-add');
})->name('Voucher-create');

// sửa voucher
Route::get('admin/edit_voucher/{id}', [CrudVoucherController::class, 'edit'])->name('edit_voucher');
Route::post('admin/update-voucher/{id}', [CrudVoucherController::class, 'updateVoucher'])->name('update_voucher');
// xóa voucher
Route::delete('admin/delete-voucher/{id}', [CrudVoucherController::class, 'deleteVoucher'])->name('delete_voucher');

