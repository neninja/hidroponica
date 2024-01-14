<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\post;

it('creates a token', function () {
    $password = fake()->password();

    User::factory()->create();
    $user = User::factory()->create(['password' => $password]);

    $data = [
        'email' => $user->email,
        'password' => $password,
    ];

    post('/api/tokens', $data)
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

    $resp = post('/api/tokens?token_only=true', $data)
        ->assertSuccessful()
        ->getContent();

    expect($resp)->not->toMatch('/{/');

    expect(Auth::user()->id)->toBe($user->id);
});
