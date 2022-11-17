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

        $products = collect();

        foreach(range(19002, 100000) as $i) {
            $products->push(
                Product::factory()
                    ->make([
                        'title' => 'unique' . $i,
                        'slug' => 'unique' . $i,
                        'category_id' => $categories->random(),
                    ])
            );
        }

        $products->chunk(1000)
            ->each(fn ($productItems) => Product::insert($productItems->toArray()));
    }
}
