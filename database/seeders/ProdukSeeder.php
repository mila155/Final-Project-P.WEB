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
        'foto' => 'public\img\keju.png',
		'deskripsi' => 'Keripik pisang rasa keju yang gurih dan renyah.'
        ]);

        Produk::create([
        'kode_produk' => 'PCC002',
		'nama_produk' => 'Cemal-Cemil Coklat',
		'stok' => 24,
		'harga_jual' => 16500.00,
		'harga_produksi' => 10000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
        'foto' => 'public\img\coklat.png',
		'deskripsi' => 'Manis dan renyah, pas buat pencinta coklat!'
        ]);

        Produk::create([
        'kode_produk' => 'PCC003',
		'nama_produk' => 'Cemal-Cemil Original',
		'stok' => 24,
		'harga_jual' => 16500.00,
		'harga_produksi' => 10000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
        'foto' => 'public\img\ori.png',
		'deskripsi' => 'Rasa asli pisang tanpa tambahan rasa.'
        ]);

        Produk::create([
        'kode_produk' => 'PCC004',
		'nama_produk' => 'Granola Cinnamon',
		'stok' => 24,
		'harga_jual' => 25000.00,
		'harga_produksi' => 16000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
        'foto' => 'public\img\gran.cin.png',
		'deskripsi' => 'Rasa hangat dan khas dari kayu manis langsung terasa sejak suapan pertama.'
        ]);

        Produk::create([
        'kode_produk' => 'PCC005',
		'nama_produk' => 'Granola Coklat',
		'stok' => 24,
		'harga_jual' => 23000.00,
		'harga_produksi' => 14000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
        'foto' => 'public\img\gran.coklat.png',
		'deskripsi' => 'Setiap suapan granola coklat menghadirkan perpaduan rasa yang kaya dan memanjakan lidah.'
        ]);

        Produk::create([
        'kode_produk' => 'PCC006',
		'nama_produk' => 'Granola Madu',
		'stok' => 24,
		'harga_jual' => 24000.00,
		'harga_produksi' => 15000.00,
		'kuantitas_produk' => 200,
		'satuan' => 'gram',
        'foto' => 'public\img\gran.madu.png',
		'deskripsi' => 'Renyahnya oat dan kacang-kacangan berpadu sempurna dengan karamel alami dari madu yang dipanggang hingga keemasan.'
        ]);

        Produk::create([
        'kode_produk' => 'PCC007',
		'nama_produk' => 'Susu Pisang Strawberry',
		'stok' => 24,
		'harga_jual' => 13000.00,
		'harga_produksi' => 8000.00,
		'kuantitas_produk' => 350,
		'satuan' => 'ml',
        'foto' => 'public\img\susu.beri.png',
		'deskripsi' => 'Perpaduan manisnya pisang dan segarnya stroberi dalam satu botol!'
        ]);

        Produk::create([
        'kode_produk' => 'PCC008',
		'nama_produk' => 'Susu Pisang Coklat',
		'stok' => 24,
		'harga_jual' => 13000.00,
		'harga_produksi' => 8000.00,
		'kuantitas_produk' => 350,
		'satuan' => 'ml',
        'foto' => 'public\img\susu.coklat.png',
		'deskripsi' => 'Manis lembut pisang berpadu dengan rich-nya coklat menciptakan rasa yang creamy, legit, dan bikin nagih.'
        ]);

        Produk::create([
        'kode_produk' => 'PCC009',
		'nama_produk' => 'Susu Pisang Original',
		'stok' => 24,
		'harga_jual' => 13000.00,
		'harga_produksi' => 8000.00,
		'kuantitas_produk' => 350,
		'satuan' => 'ml',
        'foto' => 'public\img\susu.ori.png',
		'deskripsi' => 'Rasa klasik pisang yang natural, ringan, dan lembut di lidah tanpa tambahan rasa lain.'
        ]);
    }
}
