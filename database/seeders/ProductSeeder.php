<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use GuzzleHttp\Promise\Is;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'tomato',
                'price' => 19.99,
                'description' => 'Description for Product 1',
                'Is_trend' => 0,
                'category_id' =>9,
                'image'=>'photos/1.jpg',
            ], 
            [
                'name' => 'Onion',
                'price' => 29.99,
                'description' => 'Description for Product 2',
                'Is_trend'=> 1,
                'category_id'=> 9,
                'image'=>'photos/2.jpg',
            ],
            [
                'name' => 'Apple',
                'price' => 39.99,
                'description' => 'Description for Product 3',
                'Is_trend' => 0,
                'category_id'=> 9,
                'image'=>'photos/3.jpg'
            ],

            [
                'name' => 'nokia mobile',
                'price' => 9.99,
                'description' => 'Description for Product 4',
                'Is_trend' => 1,
                'category_id'=> 11,
                'image'=>'photos/4.jpg'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }     //
    }
}
