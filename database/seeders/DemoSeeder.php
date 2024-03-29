<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    use WithoutModelEvents;

    public const DEMO_OPERATOR_ID = '9855f644-24db-44b4-88ca-704100097bb4';

    public const DEMO_STUDENT_ID = '60b6c856-1967-40e1-9cdc-b122e4cd0458';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsers();
    }

    public function createUsers(): void
    {
        if (! User::find(self::DEMO_OPERATOR_ID)) {
            User::factory()->create([
                'id' => self::DEMO_OPERATOR_ID,
                'name' => 'Operador Demo',
                'email' => 'demo.operador@hidroponi.ca',
                'role' => UserRole::DemoOperator,
                'password' => '123',
            ]);
        }

        if (! User::find(self::DEMO_STUDENT_ID)) {
            User::factory()->create([
                'id' => self::DEMO_STUDENT_ID,
                'name' => 'Aluno Demo',
                'email' => 'demo.aluno@hidroponi.ca',
                'role' => UserRole::DemoStudent,
                'password' => '123',
            ]);
        }
    }
}
