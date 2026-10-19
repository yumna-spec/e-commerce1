<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BurgerMenuSeeder extends Seeder
{
    public function run(): void
    {
        $foodCategory = Category::firstOrCreate([
            'name' => 'food',
            'parent_id' => null,
        ]);

        Category::firstOrCreate([
            'name' => 'Sample Burgers',
            'parent_id' => $foodCategory->id,
        ]);

        $products = [
            [
                'name' => [
                    'en' => 'Happy Classic',
                    'ar' => 'هابي كلاسيك',
                ],
                'description' => [
                    'en' => 'A juicy grilled beef patty with crisp lettuce, tomato, cheddar, and our house sauce.',
                    'ar' => 'قطعة لحم بقري مشوية مع خس طازج وطماطم وجبن شيدر وصلصة المطعم الخاصة.',
                ],
                'price' => 8.99,
                'category_name' => 'Sample Burgers',
                'image' => 'images/resturant.jpg',
                'Is_trend' => false,
            ],
            [
                'name' => [
                    'en' => 'Double Cheese',
                    'ar' => 'دبل تشيز',
                ],
                'description' => [
                    'en' => 'Two grilled beef patties, double cheddar, pickles, and a tangy burger sauce.',
                    'ar' => 'قطعتان من اللحم البقري المشوي مع جبن شيدر مضاعف ومخلل وصلصة برغر شهية.',
                ],
                'price' => 11.49,
                'category_name' => 'Sample Burgers',
                'image' => 'images/resturant.jpg',
                'Is_trend' => false,
            ],
            [
                'name' => [
                    'en' => 'Crispy Chicken',
                    'ar' => 'دجاج مقرمش',
                ],
                'description' => [
                    'en' => 'Crispy golden chicken with crunchy lettuce and creamy house dressing.',
                    'ar' => 'دجاج ذهبي مقرمش مع خس طازج وصلصة كريمية من اختيار المطعم.',
                ],
                'price' => 9.49,
                'category_name' => 'Sample Burgers',
                'image' => 'images/resturant.jpg',
                'Is_trend' => false,
            ],
        ];

        foreach ($products as $product) {
            $existingProduct = Product::withTrashed()
                ->where('name->en', $product['name']['en'])
                ->first();

            if (!$existingProduct) {
                Product::create($product);
            }
        }
    }
}
