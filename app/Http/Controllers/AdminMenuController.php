<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Food;
use App\Models\Category;

class AdminMenuController extends Controller
{
    public function menu () {
        return Inertia::render('AdminPage/AdminMenu', [
            'dishes' => Food::with('category')->get(),
            'categories' => Category::all()
        ]);
    }
    
}
