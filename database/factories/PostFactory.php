<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->pluck('id')->toArray();

        return [
            "title" => fake()->sentence(),
            "content" => fake()->paragraph(),
            "image" => fake()->imageUrl(),
            "slug" => fake()->unique()->slug(),
            "user_id" => fake()->randomElement($users),
        ];
    }
}
