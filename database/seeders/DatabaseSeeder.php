<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananDetail;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProdukSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PesananSeeder::class);
        $this->call(PesananDetailSeeder::class);
    }
}
