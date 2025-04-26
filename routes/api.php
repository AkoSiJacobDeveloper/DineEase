<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\TableController;

Route::get('/foods', [FoodController::class, 'getFoods']);
Route::get('/tables', [TableController::class, 'index']);

// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/menu', [FoodController::class, 'index']);
// });