<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\get;
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
        ->dump()
        ->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'device',
            'user',
        ]);

    expect(Auth::user()->id)->toBe($user->id);

    get('/api/me')->dump();
});
