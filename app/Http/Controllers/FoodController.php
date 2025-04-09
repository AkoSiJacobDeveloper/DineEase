<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;


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
            'categories' => $categories,
            // track what the users click in the filters option
            // if click 'All' it means na walay na click the filter options and it also signifies na ang gi click sa user is 'All' and it will also change the button bg color to specific color, applied to all buttons including the filter buttons
            'currentCategory' => null,
            'auth' => [
                'user' => Auth::user()
            ]   
        ]);
    }

    // mao ni ang mag show sa product with their specific category
    public function showMenuWithCategory(Category $category){
        $categories = Category::all();
        $foods = $category->foods()->get();

        return Inertia::render('WebPage/Menu', [
            'foods' => $foods,
            'categories' => $categories,
            // if i click bsag asa sa filter option sultihan niya ang frontend kung unsa ang gi click sa filter option based sa category id
            'currentCategory' => $category->id,
            'auth' => [
                'user' => Auth::user()
            ]
        ]);
    }
}

