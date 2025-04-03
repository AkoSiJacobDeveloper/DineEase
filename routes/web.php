<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use  App\Http\Controllers\FoodController;

Route::get('/', function () {
   return Inertia::render('LandingPage/Landing');
})->name('Home');

// Route::get('/menu', function () {
//    return Inertia::render('WebPage/Menu'); // Ensure 'Menu' is the correct Vue component name
// })->name('Menu');

Route::get('/menu', [FoodController::class,'showMenu'])->name('Menu');