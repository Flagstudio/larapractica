<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Exception
     *
     * @return void
     */
    public function run()
    {
        if (! config('app.admin_password')) {
            throw new \Exception('Environment variable ADMIN_PASSWORD is required. You can set it in .env file');
        }

        User::factory()->create([
            'name' => 'Flagstudio',
            'email' => config('app.admin_email'),
            'password' => Hash::make(config('app.admin_password')),
            'email_verified_at' => now(),
        ]);
    }
}
