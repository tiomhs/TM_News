<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(10),
            'category_id' => rand(1,5),
            'user_id' => rand(1,5),
            'coment_id' => rand(1,20),
            'slug' => fake()->unique()->word(),
            'body' => fake()->paragraphs(10,true),
        ];
    }
}
