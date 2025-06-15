<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Produk;

class PesananDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pesanan::all()->each(function ($pesanan) {
            $jumlahDetail = rand(1, 3);

            for ($i = 0; $i < $jumlahDetail; $i++) {
                $kode_produk = Produk::inRandomOrder()->first()->kode_produk;
                $harga = Produk::where('kode_produk', $kode_produk)->value('harga_jual');

                // dd([
                //     'pesanan_id' => $pesanan->id,
                //     'kode_produk' => $kode_produk,
                //     'harga' => $harga,
                // ]);

                PesananDetail::factory()->create([
                    'pesanan_id' => $pesanan->id,
                    'kode_produk' => $kode_produk,
                    'harga' => $harga,
                ]);
            }
        });
    }
}
