<?php

namespace Database\Factories;

use App\Models\Text;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'id' => Str::uuid(),
            'text_id' => Text::factory(),
            'start_at' => fake()->randomFloat(0, 100),
            'end_at' => fake()->randomFloat(0, 100),
            'content' => fake()->sentence(),
            'new_paragraph' => fake()->boolean(),
        ];
    }
}
