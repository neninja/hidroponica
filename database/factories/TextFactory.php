<?php

namespace Database\Factories;

use App\Enums\LanguageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Text>
 */
class TextFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->unique()->words(5, true),
            'is_active' => fake()->boolean(),
            'language' => fake()->randomElement(LanguageType::cases()),
        ];
    }
}
