<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Table;


class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('tables')->truncate();

        Table::insert([
            [
                'id' => 1,
                'is_available' => true,
                'table_number' => 'Table 1', // Optional: Add if your table has a table_number column
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'is_available' => false,
                'table_number' => 'Table 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'is_available' => true,
                'table_number' => 'Table 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'is_available' => false,
                'table_number' => 'Table 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'is_available' => true,
                'table_number' => 'Table 5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
