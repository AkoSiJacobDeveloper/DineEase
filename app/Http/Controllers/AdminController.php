<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function home () {
        return Inertia::render('AdminPage/AdminHome');
    }
    public function dashboard () {
        return Inertia::render('AdminPage/Dashboard', [
            // 'foods' => Food::with('category')->latest()->get(),
        ]);
    }
}
