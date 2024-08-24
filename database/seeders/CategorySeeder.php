<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            ['name' => 'Travel', 'status' => 1],
            ['name' => 'Grocery', 'status' => 1],
            ['name' => 'Electronics', 'status' => 1],
            ['name' => 'Books', 'status' => 1],
            ['name' => 'Clothing', 'status' => 1],
            ['name' => 'Home & Kitchen', 'status' => 1],
            ['name' => 'Sports & Outdoors', 'status' => 1],
        ];

         // Create each category
         foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
