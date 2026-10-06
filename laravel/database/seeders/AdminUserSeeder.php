<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@koneksiku.test');
        $password = env('ADMIN_PASSWORD') ?: 'admin123';

        // firstOrCreate: menjalankan seeder ulang tidak menimpa password yang sudah diganti.
        User::firstOrCreate(['email' => $email], [
            'name' => 'Administrator',
            'password' => Hash::make($password),
        ]);
    }
}
