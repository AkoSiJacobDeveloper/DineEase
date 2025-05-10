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
        $categories = Category::select('id', 'name', 'description')->get();
        $foods = Food::select('id', 'name', 'description', 'price', 'image', 'category_id')
            ->with(['category' => function ($query) {
                $query->select('id', 'name');
            }])
            ->paginate(6); // 6 dishes per page

        return Inertia::render('WebPage/Menu', [
            'categories' => $categories,
            'foods' => $foods,
            'currentCategory' => null,
        ]);
    }

    public function showMenuWithCategory($category)
    {
        $categories = Category::select('id', 'name', 'description')->get();
        $foods = Food::select('id', 'name', 'description', 'price', 'image', 'category_id')
            ->where('category_id', $category)
            ->with(['category' => function ($query) {
                $query->select('id', 'name');
            }])
            ->paginate(6); // 6 dishes per page

        return Inertia::render('WebPage/Menu', [
            'categories' => $categories,
            'foods' => $foods,
            'currentCategory' => $category,
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