<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Стеллаж Кринум',
                'category_id' => 3,
                'price' => 2000,
                'colors' => [1],
                'image' => ['krinumw1.png'],
            ],
            [
                'title' => 'Стеллаж Тумба Лаки',
                'category_id' => 3,
                'price' => 4000,
                'colors' => [1],
                'image' => ['lakiw1.png'],
            ],
            [
                'title' => 'Стеллаж модульный',
                'category_id' => 3,
                'price' => 2300,
                'colors' => [1],
                'image' => ['transformerw1.png'],
            ],
            [
                'title' => 'Стеллаж Zett',
                'category_id' => 3,
                'price' => 3500,
                'colors' => [1,3,4,5],
                'image' => [
                    'zettw1.png',
                    'zettd3.png',
                    'zettk4.png',
                    'zettv2.png',
                ],
            ],
            [
                'title' => 'Офисное кресло',
                'category_id' => 2,
                'price' => 12300,
                'colors' => [6],
                'image' => ['helmi.png'],
            ],
            [
                'title' => 'Офисное кресло с подлокотниками',
                'category_id' => 2,
                'price' => 21500,
                'colors' => [7],
                'image' => ['brabix.png'],
            ],
            [
                'title' => 'Письменный стол',
                'category_id' => 1,
                'price' => 2700,
                'colors' => [1,3,7],
                'image' => [
                    'stylew1.png',
                    'styled2.png',
                    'styleb3.png',
                ],
            ],
            [
                'title' => 'Письменный стол с надстройкой',
                'category_id' => 1,
                'price' => 3200,
                'colors' => [3],
                'image' => ['letta.png'],
            ],
            [
                'title' => 'Журнальный стол',
                'category_id' => 1,
                'price' => 1800,
                'colors' => [1,4],
                'image' => [
                    'nordw1.png',
                    'nordk2.png',
                ],
            ],
        ];

        foreach ($products as $product) {
            $model = Product::create([
                'title' => $product['title'],
                'slug' => Str::slug($product['title']),
                'category_id' => $product['category_id'],
                'price' => $product['price'],
            ]);

            $model->colors()->sync($product['colors']);

            foreach($product['image'] as $image) {
                $model->addMedia(resource_path('img/' . $image))
                    ->toMediaCollection(Product::MEDIA_IMAGES);
            }
        }
    }
}
