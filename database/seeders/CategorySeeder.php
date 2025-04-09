<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Main Course', 'description' => 'Hearty and satisfying dishes crafted to be the centerpiece of your meal, featuring rich flavors and wholesome ingredients. '],
            ['name' => 'Appetizers', 'description' => 'Small, flavorful bites to awaken your taste buds and start your dining experience right. '],
            ['name' => 'Side Dish', 'description' => 'Perfectly portioned additions that complement your main course with extra flavor and variety'],
            ['name' => 'Salads', 'description' => 'Fresh, crisp greens and vibrant toppings tossed with house-made dressings for a light and healthy option. '],
            ['name' => 'Soups', 'description' => 'Warm and comforting bowls made from rich broths, fresh ingredients, and savory seasonings'],
            ['name' => 'Desserts', 'description' => 'Sweet treats and indulgent finishes, from classic favorites to delightful creations. '],
            ['name' => 'Beverages', 'description' => 'A refreshing selection of drinks, both classic and crafted, to pair perfectly with any meal. '],
          
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}