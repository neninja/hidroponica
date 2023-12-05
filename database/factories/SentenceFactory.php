<?php

namespace Database\Factories;

use App\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sentence>
 */
class SentenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text_id' => Text::factory(),
            'start_at' => fake()->randomFloat(0, 100),
            'end_at' => fake()->randomFloat(0, 100),
            'content' => fake()->sentence(),
            'new_paragraph' => fake()->boolean(),
        ];
    }
}
