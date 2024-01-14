<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\postJson;

it('creates a token', function () {
    $password = fake()->password();

    User::factory()->create();
    $user = User::factory()->create(['password' => $password]);

    $data = [
        'email' => $user->email,
        'password' => $password,
    ];

    postJson('/api/tokens', $data)
        ->assertSuccessful()
        ->assertJsonStructure([
            'access_token',
            'device',
            'user',
        ]);

    expect(Auth::user()->id)->toBe($user->id);
});

it('creates a token and only return its', function () {
    $user = User::factory()->create(['password' => '123']);

    $data = [
        'email' => $user->email,
        'password' => '123',
    ];

    $resp = postJson('/api/tokens?token_only=true', $data)
        ->assertSuccessful()
        ->getContent();

    expect($resp)->not->toMatch('/{/');

    expect(Auth::user()->id)->toBe($user->id);
});

it('requires email field', function () {
    postJson('/api/tokens', ['password' => '123'])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(
            [
                'email' => __('validation.required', ['attribute' => __('validation.attributes.email')]),
            ],
            'errors'
        );

    expect(Auth::user())->toBeNull();
});
