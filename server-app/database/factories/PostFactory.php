<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        $title=fake()->paragraph(1);
        return [
            'title' => $title,
            'slug' => $title,
            'description' => fake()->paragraph(3),
            'status' => rand(0,1),
            'user_id'=> \App\Models\User::get()->random()

        ];
    }
}
