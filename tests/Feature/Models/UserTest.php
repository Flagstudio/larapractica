<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    public function test_user_model_exists()
    {
        $model = User::factory()->make();
        $this->assertInstanceOf(User::class, $model);
    }

    public function test_user_can_be_created_with_expected_fields()
    {
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'email_verified_at' => $this->faker->dateTime,
            'remember_token' => $this->faker->uuid,
            'password' => Hash::make($this->faker->password(8, 10)),
        ];

        $model = User::factory()->create($data);

        $this->assertEquals($data['name'], $model->name);
        $this->assertEquals($data['email'], $model->email);
        $this->assertEquals($data['remember_token'], $model->remember_token);
        $this->assertEquals($data['password'], $model->password);
        $this->assertDatabaseHas('users', ['email' => $model->email]);
    }
//
//    public function test_user_can_assign_role()
//    {
//        $user = User::factory()->developerUser()->create();
//        Role::updateOrCreate(['name' => $role = UserRoleEnum::admin()->value]);
//
//        $user->assignRole($role);
//
//        $this->assertTrue($user->hasRole($role));
//    }
}
