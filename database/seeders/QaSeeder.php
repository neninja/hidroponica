<?php

namespace Database\Seeders;

use App\Enums\LanguageType;
use App\Models\Sentence;
use App\Models\Text;
use App\Models\TranslatedSentence;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsers();
        $this->call(AesopSeeder::class);
    }

    public function createUsers(): void
    {
        User::factory()->admin()->create([
            'email' => 'admin@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->operator()->create([
            'email' => 'operator@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->consumer()->create([
            'email' => 'consumer@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory(10)->create();
    }

    public function createTexts(): void
    {
        Text::factory()
            ->count(10)
            ->afterCreating(function (Text $text) {
                Sentence::factory()
                    ->count(5)
                    ->afterCreating(function (Sentence $sentence) {
                        TranslatedSentence::factory()
                            ->count(2)
                            ->sequence(
                                ['language' => LanguageType::English],
                                ['language' => LanguageType::BrazilianPortuguese],
                            )
                            ->create(['sentence_id' => $sentence->id]);
                    })
                    ->create(['text_id' => $text->id]);
            })
            ->create();
    }
}
