<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    /**
     * Seed one default user for each admin role.
     */
    public function run(): void
    {
        $defaultPassword = Hash::make('password');

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@stafflink.pro',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@stafflink.pro',
                'role' => 'admin',
            ],
            [
                'name' => 'Booking Checker',
                'email' => 'bookingchecker@stafflink.pro',
                'role' => 'booking_checker',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => $defaultPassword,
                    'role' => $user['role'],
                ]
            );
        }
    }
}
