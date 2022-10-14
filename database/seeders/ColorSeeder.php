<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'bg-white' => 'Белый',
            'bg-black' => 'Чёрный',
            'bg-orange-200' => 'Дуб',
            'bg-amber-700' => 'Дуб крафт',
            'bg-stone-600' => 'Венге',
            'bg-neutral-400' => 'Серый',
            'bg-zinc-800' => 'Черный',
        ];

        foreach ($colors as $class => $title) {
            Color::create([
                'title' => $title,
                'class' => $class,
            ]);
        }
    }
}
