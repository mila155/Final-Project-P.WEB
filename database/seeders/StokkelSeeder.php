<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\StokKeluar;

class StokkelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesananDetail::all()->each(function ($detail) {
            StokKeluar::create([
                'kode_produk' => $detail->kode_produk,
                'pesanan_id' => $detail->pesanan_id,
                'tanggal_keluar' => $detail->pesanan->tanggal,
                'jumlah_keluar' => $detail->jumlah
            ]);

        });
    }
}
