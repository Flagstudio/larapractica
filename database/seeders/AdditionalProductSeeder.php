<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AdditionalProductSeeder extends Seeder
{
    public function run(): void
    {
        $colors = Color::all();
        $categories = Category::all();

        $firstKey = Product::latest()->first()->id;
        $lastKey = $firstKey + 3000;

        foreach(range($firstKey, $lastKey) as $i) {
            $product = Product::factory()
                ->create([
                    'title' => 'unique' . $i,
                    'slug' => 'unique' . $i,
                    'category_id' => $categories->random(),
                ]);

            $product->colors()
                ->sync($colors->random(rand(1, 5)));
        }
    }
}
