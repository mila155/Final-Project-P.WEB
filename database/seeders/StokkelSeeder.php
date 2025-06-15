<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\StokKeluar;
use App\Models\Produk;

class StokkelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesananDetail::with('pesanan')->get()->each(function ($detail) {
            StokKeluar::create([
                'kode_produk' => $detail->kode_produk,
                'pesanan_id' => $detail->pesanan_id,
                'tanggal_keluar' => $detail->pesanan->tanggal,
                'jumlah_keluar' => $detail->jumlah
            ]);

            $produk = Produk::where('kode_produk', $detail->kode_produk)->first();

            if ($produk) {
                $produk->stok_akhir -= $detail->jumlah;
                // $produk->stok -= $detail->jumlah;
                $produk->save();
            }
        });
    }
}
