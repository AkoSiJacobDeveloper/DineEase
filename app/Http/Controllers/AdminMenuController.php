<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminMenuController extends Controller
{
    public function index()
    {
        return Inertia::render('AdminPage/AdminMenu', [
            'foods' => Food::select('id', 'name', 'description', 'price', 'image', 'category_id', 'is_active')
                ->get(),
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dishes', 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        Food::create(array_merge($validated, ['is_active' => true]));

        return redirect()->route('admin.menu.index')->with('flash', ['success' => 'Dish created successfully!']);
    }

    public function edit(Food $food)
    {
        return Inertia::render('AdminPage/AdminMenu', [
            'food' => $food->only('id', 'name', 'description', 'price', 'image', 'category_id', 'is_active'),
            'categories' => Category::select('id', 'name')->get()
        ]);
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0'
        ]);

        $food->update($validated);

        return redirect()->route('admin.menu.index')->with('flash', ['success' => 'Dish updated successfully!']);
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('admin.menu.index')->with('flash', ['success' => 'Dish deleted successfully!']);
    }
}