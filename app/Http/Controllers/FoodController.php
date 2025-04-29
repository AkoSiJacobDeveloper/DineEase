<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FoodController extends Controller
{
    public function showMenu()
    {
        return Inertia::render('WebPage/Menu', [
            'foods' => Food::select('id', 'name', 'description', 'price', 'image', 'category_id')->get(),
            'categories' => Category::select('id', 'name', 'description')->get()
        ]);
    }

    public function showMenuWithCategory($category)
    {
        return Inertia::render('WebPage/Menu', [
            'foods' => Food::where('category_id', $category)->select('id', 'name', 'description', 'price', 'image', 'category_id')->get(),
            'categories' => Category::select('id', 'name', 'description')->get(),
            'currentCategory' => $category
        ]);
    }

    public function selectFood(Request $request)
    {
        $validated = $request->validate([
            'food_id' => 'required|exists:foods,id'
        ]);

        return Inertia::location(route('order.show', ['food' => $validated['food_id']]));
    }
}