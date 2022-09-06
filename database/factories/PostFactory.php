<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'community_id'=>rand(1,50),
            'user_id'=>rand(1,100),
            'title'=>fake()->text(50),
            'post_text'=>fake()->text(500)
        ];
    }
}
