<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
        'kode_produk' => 'PCC001',
		'nama_produk' => 'Cemal-Cemil Keju',
		'stok' => 24,
		'harga_jual' => 16500.00,
		'harga_produksi' => 10000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
		'deskripsi' => 'Keripik pisang rasa keju yang gurih dan renyah.',
        'foto' => 'img/keju.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC002',
		'nama_produk' => 'Cemal-Cemil Coklat',
		'stok' => 24,
		'harga_jual' => 16500.00,
		'harga_produksi' => 10000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
		'deskripsi' => 'Manis dan renyah, pas buat pencinta coklat!',
        'foto' => 'img/coklat.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC003',
		'nama_produk' => 'Cemal-Cemil Original',
		'stok' => 24,
		'harga_jual' => 16500.00,
		'harga_produksi' => 10000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
		'deskripsi' => 'Rasa asli pisang tanpa tambahan rasa.',
        'foto' => 'img/ori.png',
		'stok_akhir' => 24,
        ]);

        $produk = Produk::create([
        'kode_produk' => 'PCC004',
		'nama_produk' => 'Granola Cinnamon',
		'stok' => 24,
		'harga_jual' => 25000.00,
		'harga_produksi' => 16000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
		'deskripsi' => 'Rasa hangat dan khas dari kayu manis langsung terasa sejak suapan pertama.',
        'foto' => 'img/gran.cin.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC005',
		'nama_produk' => 'Granola Coklat',
		'stok' => 24,
		'harga_jual' => 23000.00,
		'harga_produksi' => 14000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
		'deskripsi' => 'Setiap suapan granola coklat menghadirkan perpaduan rasa yang kaya dan memanjakan lidah.',
        'foto' => 'img/gran.coklat.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC006',
		'nama_produk' => 'Granola Madu',
		'stok' => 24,
		'harga_jual' => 24000.00,
		'harga_produksi' => 15000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
		'deskripsi' => 'Renyahnya oat dan kacang-kacangan berpadu sempurna dengan karamel alami dari madu yang dipanggang hingga keemasan.',
        'foto' => 'img/gran.madu.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC007',
		'nama_produk' => 'Susu Pisang Strawberry',
		'stok' => 24,
		'harga_jual' => 13000.00,
		'harga_produksi' => 8000.00,
		'kuantitas_produk' => 350,
		'satuan' => 'ml',
		'deskripsi' => 'Perpaduan manisnya pisang dan segarnya stroberi dalam satu botol!',
        'foto' => 'img/susu.beri.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC008',
		'nama_produk' => 'Susu Pisang Coklat',
		'stok' => 24,
		'harga_jual' => 13000.00,
		'harga_produksi' => 8000.00,
		'kuantitas_produk' => 350,
		'satuan' => 'ml',
		'deskripsi' => 'Manis lembut pisang berpadu dengan rich-nya coklat menciptakan rasa yang creamy, legit, dan bikin nagih.',
        'foto' => 'img/susu.coklat.png',
		'stok_akhir' => 24,
        ]);

        Produk::create([
        'kode_produk' => 'PCC009',
		'nama_produk' => 'Susu Pisang Original',
		'stok' => 24,
		'harga_jual' => 13000.00,
		'harga_produksi' => 8000.00,
		'kuantitas_produk' => 350,
		'satuan' => 'ml',
		'deskripsi' => 'Rasa klasik pisang yang natural, ringan, dan lembut di lidah tanpa tambahan rasa lain.',
        'foto' => 'img/susu.ori.png',
		'stok_akhir' => 24,
        ]);
		// dd($produk);
    }
}
