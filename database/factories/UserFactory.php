<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $randomUserRole = rand(0,2);        //Gives a random user role to the user being created
        $fakeEmail = $this->faker->unique()->safeEmail;
        $avatar = "https://i.pravatar.cc/40?u=".$fakeEmail;
        return [
            'name' => $this->faker->name,
            'email' => $fakeEmail,
            'email_verified_at' => now(),
            'avatar' => $avatar,
            'role' =>$randomUserRole,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
