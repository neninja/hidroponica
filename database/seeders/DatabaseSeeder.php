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
        if (! app()->environment('e2e')) {
            $this->call(DemoSeeder::class);
        }

        if (app()->environment('local')) {
            $this->call(DevSeeder::class);
        }

        if (app()->environment('e2e')) {
            $this->call(EndToEndSeeder::class);
        }
    }
}
