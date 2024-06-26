<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Card;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::transaction(function () {
                // Create the admin user
                $user = User::create([
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin123'),
                    // 'is_admin' => true, // Assuming there's an is_admin column to identify admin users
                ]);
    
                // Create the associated card for the admin user
                Card::create([
                    'user_id' => $user->id,
                    'card_number' => '1234567890123456',
                    'balance' => 1000, // Initial balance
                ]);
            });
        
    }
}
