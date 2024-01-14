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
        $this->createTexts();
    }

    public function createUsers(): void
    {
        User::factory()->admin()->create([
            'email' => 'qa_admin@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->operator()->create([
            'email' => 'qa_operator@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->student()->create([
            'email' => 'qa_student@hidroponi.ca',
            'password' => '123',
        ]);
    }

    public function createTexts(): void
    {
        Text::factory()
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
            ->create([
                'id' => '1a5c4380-d96f-33f0-886a-4e4f77632ac0',
                'name' => 'QA Test n1'
            ]);
    }
}
