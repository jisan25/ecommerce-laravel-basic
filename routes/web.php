<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FrontendController;

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

// Route::get('/', function () {

// });

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('frontend');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'categoryIndex')->name('category.index');
    Route::get('/product-details/{id}/{slug}', 'singleProduct')->name('single.product');
    Route::get('/new-release', 'newRelease')->name('new.release');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(ClientController::class)->group(function () {
        Route::get('/add-to-cart', 'addToCart')->name('add.to.cart');
        Route::post('/add-product-to-cart/{id}', 'addProductToCart')->name('add.product.to.cart');
        Route::get('/shipping-address', 'shippingAddress')->name('shipping.address');
        Route::post('/shipping-address-store', 'shippingAddressStore')->name('shipping.address.store');
        Route::post('/place-order', 'placeOrder')->name('place.order');
        Route::get('/checkout', 'checkout')->name('checkout');
        Route::get('/user-profile', 'userProfile')->name('user.profile');
        Route::get('/user-profile/pending-orders', 'pendingOrders')->name('pending.orders');
        Route::get('/user-profile/history', 'history')->name('history');
        Route::get('/todays-deal', 'todaysDeal')->name('todays.deal');
        Route::get('/custom-service', 'customService')->name('custom.service');
        Route::get('/remove-cart-item/{id}', 'removeCart')->name('remove.cart');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:customer'])->name('dashboard');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin-dashboard');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/all-categories', 'index')->name('admin-all-categories');
        Route::get('/admin/add-category', 'addCategory')->name('admin-add-category');
        Route::post('/admin/add-category', 'StoreCategory')->name('store-category');
        Route::get('/admin/edit-category/{id}', 'EditCategory')->name('edit-category');
        Route::post('/admin/update-category', 'UpdateCategory')->name('update-category');
        Route::get('/admin/delete-category/{id}', 'DeleteCategory')->name('delete-category');
    });
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/admin/all-sub-categories', 'index')->name('admin-all-sub-categories');
        Route::get('/admin/add-sub-category', 'addSubCategory')->name('admin-add-sub-category');
        Route::post('/admin/store-sub-category', 'StoreSubCategory')->name('admin-store-sub-category');
        Route::get('/admin/edit-sub-category/{id}', 'edit')->name('edit-sub-category');
        Route::post('/admin/update-subcategory/{id}', 'update')->name('update-sub-category');
        Route::get('/admin/delete-sub-category/{id}', 'destroy')->name('delete-sub-category');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/admin/all-products', 'index')->name('admin-all-products');
        Route::get('/admin/add-product', 'addProduct')->name('admin-add-product');
        Route::post('/admin/store-product', 'store')->name('store-product');
        Route::get('/admin/edit-product-img/{id}', 'editImg')->name('edit-product-img');
        Route::post('/admin/update-product-img/{id}', 'updateImg')->name('update-product-img');
        Route::get('/admin/edit-product/{id}', 'edit')->name('edit-product');
        Route::post('/admin/update-product/{id}', 'update')->name('update-product');
        Route::get('/admin/delete-product/{id}', 'destroy')->name('delete-product');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/pending-order', 'index')->name('admin-pending-orders');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
