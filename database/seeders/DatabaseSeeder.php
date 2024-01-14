<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! app()->environment('production')) {
            $this->call(QaSeeder::class);
            $this->call(DevSeeder::class);
        }
    }
}
