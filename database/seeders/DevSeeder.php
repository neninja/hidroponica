<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
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
            'email' => 'admin@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->operator()->create([
            'email' => 'operator@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory()->student()->create([
            'email' => 'student@hidroponi.ca',
            'password' => '123',
        ]);

        User::factory(10)->create();
    }
}
