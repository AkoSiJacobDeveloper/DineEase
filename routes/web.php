<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\AdminOrderController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('LandingPage/Landing');
})->name('Home');

Route::get('/menu', [FoodController::class, 'showMenu'])->name('menu');
Route::get('/menu/{category}', [FoodController::class, 'showMenuWithCategory'])->name('menu.category');

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('Login');

Route::get('/signup', function () {
    return Inertia::render('Auth/Signup');
})->name('Signup');

Route::middleware(['auth'])->group(function () {
    Route::get('/reservation', [ReservationController::class, 'create'])->name('Reservation');
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/order/{food}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/confirmation/{order}', [OrderController::class, 'showConfirmation'])->name('order.confirmation');
});

Route::post('/select-food', [FoodController::class, 'selectFood'])->name('food.select');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminOrderController::class, 'orders'])->name('admin.orders');
});

Route::prefix('admin/menu')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [AdminMenuController::class, 'index'])->name('admin.menu.index');
    Route::post('/', [AdminMenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/{food}/edit', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
    Route::patch('/{food}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/{food}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/admin/orders/{order}/confirm', [AdminOrderController::class, 'confirm'])->name('admin.orders.confirm');
    Route::post('/admin/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('admin.orders.reject');
});

require __DIR__.'/auth.php';