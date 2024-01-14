<?php

namespace Database\Factories;

use App\Enums\LanguageType;
use App\Models\Sentence;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TranslatedSentence>
 */
class TranslatedSentenceFactory extends Factory
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
            'sentence_id' => Sentence::factory(),
            'content' => fake()->sentence(),
            'language' => fake()->randomElement(LanguageType::cases()),
        ];
    }
}
