<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrNew(['email' => 'superadmin@ecosa.com'])
            ->forceFill([
                'name' => 'ECOSA Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
                'must_change_password' => false,
            ])
            ->save();
    }
}
