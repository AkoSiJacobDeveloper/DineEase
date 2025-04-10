<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('LandingPage/Landing');
})->name('Home');

Route::get('/menu', function () {
    return Inertia::render('WebPage/Menu');
})->name('Menu');

// Route::get('/menu', function () {
//    return Inertia::render('WebPage/Menu'); // Ensure 'Menu' is the correct Vue component name
// })->name('Menu');

Route::get('/login', function() {
    return Inertia::render('WebPage/Login');
})->name('Login');

Route::get('/signup', function() {
    return Inertia::render('WebPage/Signup');
})->name('Signup');

Route::get('/menu', [FoodController::class, 'showMenu'])->name('menu');
Route::get('/menu/{category}', [FoodController::class, 'showMenuWithCategory'])->name('menu.category');