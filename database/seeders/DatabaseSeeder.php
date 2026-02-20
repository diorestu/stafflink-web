<?php

namespace Database\Seeders;

use App\Models\User;
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
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@stafflink.pro'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role' => 'super_admin',
            ]
        );

        // Seed page sections
        $this->call(PageSectionSeeder::class);

        // Optional: seed full global countries/states from API.
        // Enable by setting SEED_LOCATIONS=true in environment.
        if ((bool) env('SEED_LOCATIONS', false)) {
            $this->call(CountryStateSeeder::class);
        }
    }
}
