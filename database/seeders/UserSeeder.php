<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Store Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Demo Customer',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'is_admin' => false,
            ]
        );

        User::factory()->count(10)->create();
    }
}
