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
            $jumlahProduk = rand(1, $produkList->count());
            $produkAcak = $produkList->random($jumlahProduk);
            foreach ($produkAcak as $produk) {
                if ($produk->stok_akhir > 0) {
                // if ($produk->stok > 0) {
                    $jumlah = fake()->numberBetween(1, min($produk->stok_akhir, 5));
                    // $jumlah = fake()->numberBetween(1, min($produk->stok, 5));

                    Keranjang::firstOrCreate(
                        [
                            'user_id' => $user->user_id,
                            'kode_produk' => $produk->kode_produk,
                        ],
                        [
                            'nama' => $produk->nama_produk,
                            'harga' => $produk->harga_jual,
                            'jumlah' => $jumlah,
                            'gambar' => $produk->foto,
                        ]
                    );
                }
            }
        }
    }
}