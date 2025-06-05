<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
// use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();
        
        User::create([
            'user_name' => "bumi raya",
            'user_email' => "bumiraya@mail.com",
            'user_password' => Hash::make('superadmin123'),
            'role' => 'superadmin',
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'user_name' => "mila",
            'user_email' => "mila@mail.com",
            'user_password' => Hash::make('admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(10)
        ]);
    }
}
