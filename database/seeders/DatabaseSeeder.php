<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleUserSeeder::class);

        // Seed page sections
        $this->call(PageSectionSeeder::class);

        // Optional: seed full global countries/states from API.
        // Enable by setting SEED_LOCATIONS=true in environment.
        if ((bool) env('SEED_LOCATIONS', false)) {
            $this->call(CountryStateSeeder::class);
        }
    }
}
