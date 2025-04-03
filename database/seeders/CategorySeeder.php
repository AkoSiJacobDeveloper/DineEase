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
            ['name' => 'Main Course', 'description' => 'Various canned food items'],
            ['name' => 'Appetizers', 'description' => 'Milk, cheese, and other dairy products'],
            ['name' => 'Side Dish', 'description' => 'Different types of noodles and pasta'],
            ['name' => 'Salads', 'description' => 'Frozen meals and ingredients'],
            ['name' => 'Soups', 'description' => 'Drinks including sodas, juices, and water'],
            ['name' => 'Desserts', 'description' => 'Alcoholic beverages'],
            ['name' => 'Beverages', 'description' => 'Chips, cookies, and other snack items'],
          
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}