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
            'foods' => Food::select('id', 'name', 'description', 'price', 'image', 'category_id')
                ->where('is_active', true)
                ->with(['category' => function ($query) {
                    $query->select('id', 'name', 'description');
                }])
                ->get(),
            'categories' => Category::select('id', 'name', 'description')->get(),
            'currentCategory' => null
        ]);
    }

    public function showMenuWithCategory($category)
    {
        return Inertia::render('WebPage/Menu', [
            'foods' => Food::select('id', 'name', 'description', 'price', 'image', 'category_id')
                ->where('is_active', true)
                ->where('category_id', $category)
                ->with(['category' => function ($query) {
                    $query->select('id', 'name', 'description');
                }])
                ->get(),
            'categories' => Category::select('id', 'name', 'description')->get(),
            'currentCategory' => (int) $category
        ]);
    }

    public function selectFood(Request $request)
    {
        $request->validate(['food_id' => 'required|exists:foods,id']);
        // Store food_id in session or cart logic
        return response()->json(['message' => 'Food selected']);
    }

    public function showOrderSummary()
    {
        return Inertia::render('WebPage/OrderSummary');
    }
}