<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->text(30);
        return [
            'name' => $name,
            'user_id' => rand(1,100),
            'description' => fake()->text(200),
            'slug'=> \Str::slug($name)
        ];
    }
}
