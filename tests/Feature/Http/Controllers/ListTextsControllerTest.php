<?php

use App\Models\Text;

use function Pest\Laravel\getJson;

it('lists all texts', function () {
    Text::factory()->count(5)->create();
    asRandomUser();

    getJson('/api/texts')
        ->assertSuccessful()
        ->assertJsonCount(5, 'data')
        ->assertJsonPath('meta.total', 5)
        ->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links' => [
                    '*' => [
                        'url',
                        'label',
                        'active',
                    ],
                ],
                'path',
                'per_page',
                'to',
                'total',
            ],
        ]);
});
