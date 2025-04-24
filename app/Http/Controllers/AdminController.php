<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index () {
        return Inertia::render('AdminPage/AdminMenu/Index', [
            'foods' => Food::with('category')->latest()->get(),
        ]);
    }
}
