<?php

use App\Models\Text;

use function Pest\Laravel\getJson;

it('shows a text', function () {
    $texts = Text::factory()->count(5)->create();
    $text = fake()->randomElement($texts);

    asRandomUser();

    getJson("/api/texts/{$text->id}")
        ->assertSuccessful()
        ->assertJsonPath('data.id', $text->id)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'language',
                'is_active',
                'sentences' => [
                    '*' => [
                        'id',
                        'content',
                        'translated_sentences' => [
                            '*' => [
                                'id',
                                'language',
                                'content',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
});
