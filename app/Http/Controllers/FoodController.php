<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::all();
        return Inertia::render('WebPage/Menu', [
            'foods' => Food::all(),
            'categories' => $categories

        ]);
    }

    // mao ni ang mag show sa product with their specific category
    public function showMenuWithCategory(Category $category){
        $categories = Category::all();
        $foods = $category->foods()->get();

        return Inertia::render('WebPage/Menu', [
            'foods' => $foods,
            'categories' => $categories
        ]);
    }
}

