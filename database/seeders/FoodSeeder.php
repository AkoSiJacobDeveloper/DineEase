<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::create([
            'name' => 'Beef Wellington',
            'category_id' => 1,
            'description' => 'A delicious steak dish wrapped in puff pastry.',
            'price' => 850,
            'image' => 'beef_wellington.jpg'
        ]);

        Food::create([
            'name' => 'Spaghetti Carbonara',
            'category_id' => 1,
            'description' => 'Classic Italian pasta with creamy sauce and bacon.',
            'price' => 250,
            'image' => 'https://i5.walmartimages.com/seo/Bertolli-Chicken-Carbonara-Frozen-Meals-With-Spaghetti-Peas-and-Bacon-in-Alfredo-Sauce-22-oz_330c4234-2c58-4de8-a9ad-64a5fd4d09b4.1616ee20c586f87bb3319ccf6aff312f.jpeg?odnHeight=2000&odnWidth=2000&odnBg=FFFFFF'
            // 'image' => 'carbonara.jpg'
        ]);
    }
}
