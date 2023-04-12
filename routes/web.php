<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Theme\ThemeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', [LoginController::class, 'showLoginForm']);

/**
 * redirect user to login
 */
Route::redirect('/', '/login');

/**
 * user must verification email
 * remove ['verify' => true] if you no need email verification
 * remove 'verified' from middleware tho
 */
Auth::routes(['register' => false]);


Route::middleware(['auth'])->group(function () {
    /**
     * route for dashboard
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * route for customer
     */
    Route::controller(CustomerController::class)->group( function() {
        Route::get('/customer', 'index')->middleware('permission:customers-view')->name('customer.index');
        Route::get('/customer/create', 'create')->middleware('permission:customers-create')->name('customer.create');
        Route::post('/customer', 'store')->middleware('permission:customers-create')->name('customer.store');
        Route::get('/customer/{customer}', 'show')->middleware('permission:customers-detail')->name('customer.show');
        Route::get('/customer/{customer}/edit', 'edit')->middleware('permission:customers-update')->name('customer.edit');
        Route::put('/customer/{customer}', 'update')->middleware('permission:customers-update')->name('customer.update');
        Route::delete('/customer/{customer}', 'destroy')->middleware('permission:customers-delete')->name('customer.destroy');
        Route::get('customer/get-customer/{id}', 'getCustomer');
    });

    /**
     * route for item
     */
    Route::controller(ItemController::class)->group( function() {
        Route::get('/item', 'index')->middleware('permission:items-view')->name('item.index');
        Route::get('/item/create', 'create')->middleware('permission:items-create')->name('item.create');
        Route::post('/item', 'store')->middleware('permission:items-create')->name('item.store');
        Route::get('/item/{item}', 'show')->middleware('permission:items-detail')->name('item.show');
        Route::get('/item/{item}/edit', 'edit')->middleware('permission:items-update')->name('item.edit');
        Route::put('/item/{item}', 'update')->middleware('permission:items-update')->name('item.update');
        Route::delete('/item/{item}', 'destroy')->middleware('permission:items-delete')->name('item.destroy');
    });

    /**
     * route for order
     */
    Route::controller(OrderController::class)->group( function() {
        Route::get('/order', 'index')->middleware('permission:orders-view')->name('order.index');
        Route::get('/order/create', 'create')->middleware('permission:orders-create')->name('order.create');
        Route::post('/order', 'store')->middleware('permission:orders-create')->name('order.store');
        Route::get('/order/{order}', 'show')->middleware('permission:orders-detail')->name('order.show');
        Route::delete('/order/{order}', 'destroy')->middleware('permission:orders-delete')->name('order.destroy');
    });

    /**
     * route for user
     */
    Route::controller(UserController::class)->group( function() {
        Route::get('/user', 'index')->middleware('permission:users-view')->name('user.index');
        Route::get('/user/create', 'create')->middleware('permission:users-create')->name('user.create');
        Route::post('/user', 'store')->middleware('permission:users-create')->name('user.store');
        Route::get('/user/{user}', 'show')->middleware('permission:users-detail')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->middleware('permission:users-update')->name('user.edit');
        Route::put('/user/{user}', 'update')->middleware('permission:users-update')->name('user.update');
        Route::delete('/user/{user}', 'destroy')->middleware('permission:users-delete')->name('user.destroy');
    });

    /**
     * route for role
     */
    Route::controller(RoleController::class)->group( function() {
        Route::get('/role', 'index')->middleware('permission:roles-view')->name('role.index');
        Route::get('/role/create', 'create')->middleware('permission:roles-create')->name('role.create');
        Route::post('/role', 'store')->middleware('permission:roles-create')->name('role.store');
        Route::get('/role/{role}', 'show')->middleware('permission:roles-detail')->name('role.show');
        Route::delete('/role/{role}', 'destroy')->middleware('permission:roles-delete')->name('role.destroy');
    });

    /**
     * route for permission
     */
    Route::controller(PermissionController::class)->group( function() {
        Route::get('/permission', 'index')->middleware('permission:permissions-view')->name('permission.index');
        Route::get('/permission/{permission}', 'show')->name('permission.show');
    });

    /**
     * route for change theme mode
     */
    Route::get('theme/{theme}', [ThemeController::class, 'update'])->name('theme.update');
});

