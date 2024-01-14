<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    use WithoutModelEvents;

    public const USER_ID = '9855f644-24db-44b4-88ca-704100097bb4';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUser();
    }

    public function createUser(): void
    {
        if (User::withTrashed()->find(self::USER_ID)) {
            return;
        }

        User::factory()->create([
            'id' => self::USER_ID,
            'email' => 'demo.operador@hidroponi.ca',
            'role' => UserRole::DemoOperator,
            'password' => '123',
        ]);

        User::factory()->create([
            'id' => self::USER_ID,
            'email' => 'demo.aluno@hidroponi.ca',
            'role' => UserRole::DemoStudent,
            'password' => '123',
        ]);
    }
}
