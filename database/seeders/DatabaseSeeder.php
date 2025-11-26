<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------------------------------------------------
        // 1. Seed Users (Super Admin → Agents → Students)
        // ---------------------------------------------------------

        // SUPER ADMIN
        $superAdminId = DB::table('users')->insertGetId([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'super_admin',
            'status' => 'approved',
            'referral_code' => 'SUPER001',
            'created_by' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // AGENTS
        $agent1Id = DB::table('users')->insertGetId([
            'name' => 'John Agent',
            'email' => 'agent1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'agent',
            'status' => 'approved',
            'referral_code' => 'AGENT001',
            'created_by' => $superAdminId,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $agent2Id = DB::table('users')->insertGetId([
            'name' => 'Jane Agent',
            'email' => 'agent2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'agent',
            'status' => 'pending',
            'referral_code' => 'AGENT002',
            'created_by' => $superAdminId,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // STUDENTS
        DB::table('users')->insert([
            [
                'name' => 'Alice Student',
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'referral_code' => 'STU001',
                'created_by' => $agent1Id,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Student',
                'email' => 'bob@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'pending',
                'referral_code' => 'STU002',
                'created_by' => $agent1Id,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charlie Student',
                'email' => 'charlie@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'approved',
                'referral_code' => 'STU003',
                'created_by' => $agent2Id,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diana Student',
                'email' => 'diana@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'status' => 'pending',
                'referral_code' => 'STU004',
                'created_by' => $agent2Id,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ---------------------------------------------------------
        // 2. Call Other Seeders (universities + admission forms)
        // ---------------------------------------------------------

        $this->call([
            UniversitySeeder::class,
            AdmissionFormSeeder::class,
        ]);

        // ---------------------------------------------------------
        // CLI Output
        // ---------------------------------------------------------

        $this->command->info('------------------------------------------------');
        $this->command->info('Users seeded successfully!');
        $this->command->info('Super Admin: superadmin@example.com / password123');
        $this->command->info('Agent 1: agent1@example.com / password123');
        $this->command->info('Agent 2: agent2@example.com / password123');
        $this->command->info('Student 1: alice@example.com / password123');
        $this->command->info('------------------------------------------------');
    }
}
