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
use App\Http\Controllers\AddressController;

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
        if (Auth::user()->usertype === '1') {
            return redirect('/dashboard');
        } else {
            return redirect('/home');
        }
    }

    // Nếu chưa đăng nhập, trả về trang index (trang chủ)
    return view('/users/home');
})->name('home');

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

//users
//user/home
Route::get('/home', function () {
    return view('users/home');
})->name('users/home');

Route::get('/dashboard', function () {
    return view('admin/dashboard');
})->name('admin/dashboard');

//user/blog
Route::get('/blog', function () {
    return view('users/blog');
})->name('users/blog');

//user/blog-detail
Route::get('/blog-detail', function () {
    return view('/users/blog-detail');
})->name('users/blog-detail');

//user/product
Route::get('/product', function () {
    return view('/users/product');
})->name('users/product');

//user/contact
Route::get('/contact', function () {
    return view('/users/contact');
})->name('users/contact');

//user/about
Route::get('/about', function () {
    return view('/users/about');
})->name('users/about');

//user/product-detail
Route::get('/product-detail', function () {
    return view('users/product-detail');
})->name('users/product-detail');

// Những route của những trang chưa đăng nhập
Route::get('/shoping-cart', function () {
    return view('shoping-cart');
})->name('shoping-cart');

Route::get('/address', function () {
    return view('users/address');
})->name('users/address');

Route::get('/diachi', function () {
    return view('users/diachi');
})->name('users/diachi');

Route::post('/address/form', [AddressController::class, 'showForm'])->name('address.form');
Route::post('/address/save', [AddressController::class, 'saveAddress'])->name('address.save');
// Route để cập nhật địa chỉ
// Route để cập nhật địa chỉ
Route::put('/address/update', [AddressController::class, 'update'])->name('address.update');



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
Route::get('/admin/danhmuc-list', [DanhmucController::class, 'AllDanhMuc'])->name('danhmuc.index');

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

