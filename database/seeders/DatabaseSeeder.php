<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SettingsSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            ProductSeeder::class,
            AdditionalProductSeeder::class,
        ]);
    }
}
