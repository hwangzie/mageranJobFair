<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'nomor_telepon' => '081234567890',
            'email_verified_at' => now(),
        ]);

        // Create Company Users
        User::create([
            'name' => 'PT. Tech Indonesia',
            'email' => 'company1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'company',
            'nomor_telepon' => '081234567891',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'CV. Digital Solutions',
            'email' => 'company2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'company',
            'nomor_telepon' => '081234567892',
            'email_verified_at' => now(),
        ]);

        // Create Job Seeker Users
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'jobseeker1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'job_seeker',
            'nomor_telepon' => '081234567893',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'jobseeker2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'job_seeker',
            'nomor_telepon' => '081234567894',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'jobseeker3@example.com',
            'password' => Hash::make('password123'),
            'role' => 'job_seeker',
            'nomor_telepon' => '081234567895',
            'email_verified_at' => now(),
        ]);
    }
}
