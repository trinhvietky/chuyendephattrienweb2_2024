<?php


use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CrudVoucherController;

use App\Models\Categories;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\DanhmucController;

use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;


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

Route::post('/products/{product_id}', [ReviewController::class, 'storeReview'])->name('products.reviews');
// Route cho việc chỉnh sửa review
Route::get('/reviews/{review_id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review_id}', [ReviewController::class, 'update'])->name('reviews.update');
// Xử lý xóa review
Route::delete('reviews/{review_id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Route cho việc tạo review mới
Route::post('/products/{product_id}/reviews', [ReviewController::class, 'store'])->name('products.reviews.store');


// search user
Route::get('/search-products', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/suggestions', [ProductController::class, 'suggestions'])->name('products.suggestions');

Route::get('/product-variants/search', [ProductVariantController::class, 'search'])->name('product_variants.search');

// Add this to routes/web.php
Route::get('/admin/user-search', [AdminController::class, 'search'])->name('admin.user.search');


Route::get('/', function () {
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
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/home', [UserController::class, 'index'])->name('users/home');
});

Route::get('/home', [UserController::class, 'index'])->name('users/home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update-avatar');
    Route::post('/profile', [ProfileController::class, 'edit'])->name('address.edit');
});

require __DIR__ . '/auth.php';

use App\Http\Controllers\WishlistController;
use App\Models\Cart;
use App\Models\Product;

Route::get('/get-wishlist', [WishlistController::class, 'getWishlist']);
Route::get('/get-wishlist-count', [WishlistController::class, 'getWishlistCount']);
// Route to add product to wishlist
Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->middleware('auth');
Route::post('/remove-from-wishlist', [WishlistController::class, 'removeFromWishlist']);
Route::get('/favourite', [WishlistController::class, 'index'])->name('users/favourite');

// //user/blog
// Route::get('/blog', function () {
//     return view('users/blog');
// })->name('users/blog');

//user/blog-detail
Route::get('/blog-detail', function () {
    return view('/users/blog-detail');
})->name('users/blog-detail');

//user/product
// Route::get('/product', function () {
//     return view('/users/product');
// })->name('users/product');

//user/contact
Route::get('/contact', function () {
    return view('/users/contact');
})->name('users/contact');

//user/about
Route::get('/about', function () {
    return view('/users/about');
})->name('users/about');

//user/product-detail
// Route::get('/product-detail', function () {
//     return view('users/product-detail');
// })->name('users/product-detail');

// Những route của những trang chưa đăng nhập
// Route::get('/shoping-cart', function () {
//     return view('users/shoping-cart');
// })->name('users/shoping-cart');

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
Route::delete('/address/delete', [AddressController::class, 'destroy'])->name('address.destroy');
Route::put('/address/update', [AddressController::class, 'update'])->name('address.update');

//Test
Route::get('/', [ProductController::class, 'index'])->name('users.home');
Route::get('/product', [ProductController::class, 'product'])->name('product');
Route::get('/product-detail/{product_id}', [ProductController::class, 'show'])->name('users/product-detail');

//Shoping-cart
Route::get('/shoping-cart', [CartController::class, 'index'])->name('users/shoping-cart');

Route::patch('/shoping-cart/update/{cartId}', [CartController::class, 'update'])->name('shoping-cart.update');

Route::delete('/shoping-cart/{id}', [CartController::class, 'destroy'])->name('shoping-cart.destroy');

Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

Route::post('/cart', [CartController::class, 'store']);

Route::post('/btn_checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.index');

Route::post('/apply-voucher', [OrderController::class, 'applyVoucher']);


//Payment
Route::post('/payment', [OrderController::class, 'store'])->name('order.store');

Route::get('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');

Route::post('/payment/ipn', [PaymentController::class, 'ipnUrl'])->name('payment.ipn');

Route::get('/payment/notification', [PaymentController::class, 'returnUrl'])->name('payment.return');


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
Route::get('/admin/danhmuc-list', [CategoriesController::class, 'AllDanhMuc'])->name('danhmuc.index');

Route::get('/admin/danhmuc-add', function () {
    return view('/admin/danhmuc-add');
});

Route::post('/admin/danhmuc-add', [CategoriesController::class, 'store'])->name('danhmuc.store');

Route::get('/admin/danhmuc/{danhmuc_ID}/edit', [CategoriesController::class, 'edit'])->name('danhmuc.edit');

Route::put('/admin/danhmuc/{danhmuc_ID}', [CategoriesController::class, 'update'])->name('danhmuc.update');

Route::delete('/admin/danhmuc/{id}', [CategoriesController::class, 'destroy'])->name('danhmuc.destroy');




//Quan ly product
Route::get('admin/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('products', [ProductController::class, 'store'])->name('products.store');

Route::get('admin/product', [ProductController::class, 'getProductAdmin'])->name('productAdmin.index');
Route::get('admin/product/{product_id}/edit', [ProductController::class, 'edit'])->name('productAdmin.edit');
Route::post('admin/product/{product_id}', [ProductController::class, 'update'])->name('productAdmin.update');
Route::delete('admin/product/{product_id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/admin/productVariant/{id}', [ProductVariantController::class, 'index'])->name('productVariant.index');
Route::get('admin/product_variants/create/{id}', [ProductVariantController::class, 'create'])->name('product_variants.create');
Route::post('admin/product_variants', [ProductVariantController::class, 'store'])->name('product_variants.store');
Route::get('admin/product_variants/{productVariant_id}/edit', [ProductVariantController::class, 'edit'])->name('product_variants.edit');
Route::put('admin/product_variants/{productVariant_id}', [ProductVariantController::class, 'update'])->name('product_variants.update');
Route::delete('admin/product_variants/{productVariant_id}', [ProductVariantController::class, 'destroy'])->name('product_variants.destroy');

Route::get('/sizes', [SizeController::class, 'getSizes'])->name('sizes.get');

// //Lọc product theo Categories
// Route::get('/products/filter/{subCategoryId}', [ProductController::class, 'filterByCategory'])->name('products.filter.category');

// //Lọc product theo price
// Route::get('/products/filter/price', [ProductController::class, 'filterByPrice'])->name('products.filter.price');

//Fillter
Route::get('/products/filter/{subCategoryId}', [ProductController::class, 'filter'])->name('products.filter');


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



//-------SIZE
//Hiển thị view size list
Route::get('/size-list', function () {
    return view('admin.size-list');
});

//Hiển thị danh sách size
Route::get('/size-list', [SizeController::class, 'index'])->name('size-list');

//Xóa size
Route::delete('/size/{size_id}', [SizeController::class, 'destroy'])->name('size.destroy');
Route::get('/size-list', [SizeController::class, 'index'])->name('size-list');

// Add size
Route::get('/size-add', function () {
    return view('admin.size-add');
});

Route::post('/sizes', [SizeController::class, 'store'])->name('size.store');

//Edit size
Route::get('/size/{size_id}/edit', [SizeController::class, 'edit'])->name('size.edit');

Route::put('/size/{id}', [SizeController::class, 'update'])->name('size.update');


//Color
//Hiển thị view color list
Route::get('/color-list', function () {
    return view('/admin/color-list');
});

//Hiển thị danh sách color
Route::get('/color-list', [ColorController::class, 'index'])->name('color-list');

//Xóa color
Route::delete('/color/{color_id}', [ColorController::class, 'destroy'])->name('color.destroy');
Route::get('/color-list', [ColorController::class, 'index'])->name('color-list');

// Add color
Route::get('/color-add', function () {
    return view('/admin/color-add');
});

Route::post('/colors', [ColorController::class, 'store'])->name('color.store');

//Edit size
Route::get('/color/{color_id}/edit', [ColorController::class, 'edit'])->name('color.edit');

Route::put('/color/{id}', [ColorController::class, 'update'])->name('color.update');




//contact
Route::post('/send', [ContactController::class, 'send'])->name('contact.send');



//blog
Route::get('/blog-list', [BlogController::class, 'index'])->name('blog-list');

Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
Route::get('/blog-add', function () {
    return view('/admin/blog-add');
});

// Xử lý lưu blog mới
Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');

// Hiển thị form sửa blog
Route::get('/blogs/{blog_id}/edit', [BlogController::class, 'edit'])->name('blog.edit');

// Xử lý cập nhật blog
Route::put('/blogs/{blog_id}', [BlogController::class, 'update'])->name('blog.update');
Route::put('/blogs/{blog_id}', [BlogController::class, 'update'])->name('blogs.update');

Route::get('blog', [BlogController::class, 'AllBlog'])->name('users/blog');

Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/', [ProductController::class, 'index'])->name('users.home'); // Trang chủ
Route::get('/product', [ProductController::class, 'product'])->name('product'); // Trang sản phẩm

