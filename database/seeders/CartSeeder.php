<?php

namespace Database\Seeders;

use App\Models\Keranjang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\User;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produkList = Produk::all();
        $userList = User::where('role', 'user')->get();
        foreach ($userList as $user) {
            // Untuk setiap user, ambil beberapa produk acak
            $jumlahProduk = rand(1, $produkList->count());
            $produkAcak = $produkList->random($jumlahProduk);
            foreach ($produkAcak as $produk) {
                // Gunakan firstOrCreate untuk mencegah duplikasi
                Keranjang::firstOrCreate(
                    [
                        'user_id' => $user->user_id,
                        'kode_produk' => $produk->kode_produk,
                    ],
                    [
                        'nama' => $produk->nama_produk,
                        'harga' => $produk->harga_jual,
                        'jumlah' => fake()->numberBetween(1, 10),
                        'gambar' => $produk->foto,
                    ]
                );
            }
        }
    }
}
// Keranjang::factory(20)->create();
