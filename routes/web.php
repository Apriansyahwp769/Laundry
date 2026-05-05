<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrackOrderController;
use App\Http\Controllers\SupportController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ComplaintController;
use App\Http\Controllers\Admin\SettingController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses siapa saja - Customer Facing)
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('pages.services'))->name('home');
Route::get('/services', fn() => view('pages.services'))->name('services');
Route::get('/pricing', fn() => view('pages.pricing'))->name('pricing');
Route::get('/support', [SupportController::class, 'index'])->name('support');

// Track Order (Public - tanpa login, pakai order_number)
Route::get('/track-order', [TrackOrderController::class, 'showForm'])->name('track-order');
Route::post('/track-order', [TrackOrderController::class, 'track'])->name('track-order.process');

// Services API (untuk frontend async load)
Route::get('/api/services', [ServiceController::class, 'index'])->name('api.services.index');

/*
|--------------------------------------------------------------------------
| Guest Routes (Hanya untuk user BELUM login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
});

/*
|--------------------------------------------------------------------------
| Auth Routes - Customer (Hanya untuk user SUDAH login sebagai Customer)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Booking / Order untuk customer
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

    // My Orders (lihat history pesanan sendiri)
    Route::get('/my-orders', [TrackOrderController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{order_number}', [TrackOrderController::class, 'showDetail'])->name('orders.detail');

   Route::post('/orders/{order}/complete', [TrackOrderController::class, 'complete'])
    ->name('orders.complete');

    // Profile customer
    Route::get('/profile', [RegisterController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [RegisterController::class, 'update'])->name('profile.update');

    // Submit complaint dari customer
    Route::post('/complaints', [SupportController::class, 'store'])->name('complaints.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Hanya untuk Admin/Manager/Staff dengan role tertentu)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,manager'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Orders Management (Kanban Board)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Filter orders by customer (untuk sidebar customer detail)
    Route::get('/orders/customer/{customer}', [OrderController::class, 'indexByCustomer'])->name('orders.byCustomer');

    // Customers Database
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');

    // Complaints / Helpdesk (Kanban Board)
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::patch('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.updateStatus');

    // Settings (Pricing, General, Staff, Business Info)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings/pricing', [SettingController::class, 'updatePricing'])->name('settings.updatePricing');
    Route::put('/settings/general', [SettingController::class, 'updateGeneral'])->name('settings.updateGeneral');
    Route::put('/settings/staff', [SettingController::class, 'updateStaff'])->name('settings.updateStaff');
    Route::put('/settings/business-info', [SettingController::class, 'updateBusinessInfo'])->name('settings.updateBusinessInfo');
});

/*
|--------------------------------------------------------------------------
| Fallback Route (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404', ['message' => 'Halaman tidak ditemukan.']);
});