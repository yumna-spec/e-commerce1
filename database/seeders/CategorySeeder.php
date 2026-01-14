<?php

namespace Database\Seeders;

use App\Models\Category;

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
            [
                'name' => 'food',
                'parent_id' => null
            ],
            [
                'name' => 'Electronics',
                'parent_id' => null

            ],

            [
                'name' => 'Clothing',
                'parent_id' => null
            ],

            [
                'name'=>'Vegetables',
                'parent_id'=>1
            ],
            [
                'name'=> 'fruits',
                'parent_id'=>1,
            ],

            [
                'name'=>'Mobiles',
                'parent_id'=>2
            ],

            [
                'name'=>'Laptops',
                'parent_id'=>2
            ]

        ];
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
