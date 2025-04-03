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
            'description' => 'A delicious steak dish wrapped in puff pastry.',
            'price' => 850,
            'image' => 'beef_wellington.jpg'
        ]);

        Food::create([
            'name' => 'Spaghetti Carbonara',
            'description' => 'Classic Italian pasta with creamy sauce and bacon.',
            'price' => 250,
            'image' => 'carbonara.jpg'
        ]);
    }
}
