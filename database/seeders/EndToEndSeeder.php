<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EndToEndSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createUsers();
        $this->call(AesopSeeder::class);
    }

    public function createUsers(): void
    {
        User::factory()->admin()->create([
            'name' => 'Qavi Admin',
            'email' => 'qa_admin@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->operator()->create([
            'name' => 'Quixote Auxilar',
            'email' => 'qa_operator@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->student()->create([
            'name' => 'Quira Aluno',
            'email' => 'qa_student@hidroponi.ca',
            'password' => '123',
        ]);
    }
}
