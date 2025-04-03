<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Inertia\Inertia;

class FoodController extends Controller
{
    // $foods = Food::all(); // Kuhaon niya tanang data sa database
    // return Inertia::render('WebPage/Menu', [
    //     'foods' => $foods // i pasa niya ang data gikan sa database adto sa menu page
    // ]);
    // return response()->json(Food::all());
    
    public function getFoods() {
        return response()->json(Food::all());
    }

    public function showMenu() {
        return Inertia::render('WebPage/Menu', [
            'foods' => Food::all()
        ]);
    }
}

