<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
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

// Route::get('/reservation', [ReservationController::class, 'create']);

require __DIR__.'/auth.php';