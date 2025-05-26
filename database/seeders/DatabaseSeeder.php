<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (Category::count() === 0){
            $categories = ['легкий', 'средний', 'тяжелый'];

            foreach ($categories as $name) {
                Category::firstOrCreate(['name' => $name]);
            }
        }

        if (Product::count() === 0){

            $category1 = Category::where('name', 'легкий')->first();

            Product::create([
                'name' => 'Сережки',
                'description' => 'Изящные серебряные сережки ручной работы.',
                'category_id' => $category1->id,
                'price' => 1499.99,
            ]);

            $category2 = Category::where('name', 'средний')->first();

            Product::create([
                'name' => 'Сапожки',
                'description' => 'Изящные сапожки для красивой ножки.',
                'category_id' => $category2->id,
                'price' => 4499.99,
            ]);

            $category3 = Category::where('name', 'тяжелый')->first();

            Product::create([
                'name' => 'Шкаф',
                'description' => 'Огромный шкаф.',
                'category_id' => $category3->id,
                'price' => 14499.99,
            ]);
        }


    }
}
