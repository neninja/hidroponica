<?php

use App\Enums\UserRole;
use App\Models\Text;
use App\Models\User;

describe('has policy', function () {
    it('create', function ($role, $permissionValue) {
        $user = User::factory()->create([
            'role' => $role,
        ]);

        expect($user->can('create', Text::class))->toBe($permissionValue);
    })->with([
        [UserRole::Admin, true],
        [UserRole::DemoOperator, false],
    ]);
});
