<?php

use App\Models\Text;

use function Pest\Laravel\get;

it('shows a text', function () {
    $texts = Text::factory()->count(5)->create();
    $text = fake()->randomElement($texts);

    asRandomUser();

    get("/api/texts/{$text->id}")
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
