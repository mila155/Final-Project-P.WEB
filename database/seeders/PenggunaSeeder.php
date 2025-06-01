<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::factory(5)->create();
        
        Pengguna::create([
            'user_name' => "bumi raya",
            'user_email' => "bumiraya@mail.com",
            'user_password' => Hash::make('superadmin123'),
            'role' => 'superadmin',
            'remember_token' => Str::random(10)
        ]);
        Pengguna::create([
            'user_name' => "mila",
            'user_email' => "mila@mail.com",
            'user_password' => Hash::make('admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(10)
        ]);
    }
}
