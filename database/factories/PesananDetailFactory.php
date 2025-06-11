<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\PesananDetail;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PesananDetail>
 */
class PesananDetailFactory extends Factory
{
    protected $model = PesananDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produk = Produk::inRandomOrder()->first();
        
        return [
                // 'pesanan_id' => Pesanan::inRandomOrder()->first()->id ?? Pesanan::factory(),
                // 'kode_produk' => Produk::inRandomOrder()->value('kode_produk'),
                // 'harga' => fake()->numberBetween(10000, 100000),
                // 'jumlah' => fake()->numberBetween(1, 10),
            // 'pesanan_id' => Pesanan::factory(), // ini otomatis buat 1 pesanan dulu
            // 'kode_produk' => $produk->kode_produk,
            // 'harga' => $produk->harga_jual, // pakai harga dari produk
            'kode_produk' => $produk->kode_produk, 
            'harga' => $produk->harga_jual,
            'jumlah' => fake()->numberBetween(1, 5),
        ];
    }
}