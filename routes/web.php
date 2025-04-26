<?php

// use App\Http\Controllers\ProfileController;
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

Route::get('/menu', function () {
    return Inertia::render('WebPage/Menu');
})->name('Menu');

// Route::get('/reservation', function() {
//     return Inertia::render('WebPage/Reservation');
// })->name('Reservation');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/reservation', function () {
//         return Inertia::render('WebPage/Reservation');
//     });
// })->name('Reservation');

Route::middleware(['auth'])->group(function () {
    Route::get('/reservation', [ReservationController::class, 'create'])->name('Reservation');
});

Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');


Route::get('/login', function() {
    return Inertia::render('Auth/Login');
})->name('Login');

Route::get('/signup', function() {
    return Inertia::render('Auth/Signup');
})->name('Signup');

Route::get('/order-summary', function() {
    return Inertia::render('WebPage/OrderSummary');
})->name('OrderSummary');

Route::get('/menu', [FoodController::class, 'showMenu'])->name('menu');
Route::get('/menu/{category}', [FoodController::class, 'showMenuWithCategory'])->name('menu.category');

Route::post('/select-food', [FoodController::class, 'selectFood']);
Route::get('/order-summary', [FoodController::class, 'showOrderSummary']);

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/order/confirmation/{order}', [OrderController::class, 'showConfirmation'])->name('order.confirmation');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/menu', [FoodController::class, 'index'])->name('admin.menu');
    Route::get('/orders', [AdminOrderController::class, 'orders'])->name('admin.orders');
});

Route::post('/order', [OrderController::class, 'store']);
Route::get('/orders/{order}/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');

// Route::middleware(['auth'])->group(function () {
//     Route::post('/order/{order}/processing', [OrderController::class, 'markAsProcessing'])
//         ->name('order.processing');
        
//     Route::post('/order/{order}/complete', [OrderController::class, 'markAsCompleted'])
//         ->name('order.complete');
        
//     Route::post('/order/{order}/cancel', [OrderController::class, 'cancel'])
//         ->name('order.cancel');
// });
// Route::get('/reservation', [ReservationController::class, 'create']);

require __DIR__.'/auth.php';