<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default admin user if it doesn't exist
        if (!User::where('email', 'admin@university.edu')->exists()) {
            User::create([
                'name' => 'System Administrator',
                'email' => 'admin@university.edu',
                'password' => Hash::make('admin123'),
                'contactNo' => '0771234567',
                'faculty' => 'Administration',
                'department' => 'IT Department',
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ]);

            $this->command->info('Admin user created: admin@university.edu / admin123');
        } else {
            $this->command->info('Admin user already exists');
        }
    }
}
