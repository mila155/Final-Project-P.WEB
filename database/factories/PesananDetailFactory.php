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
            'kode_produk' => $produk->kode_produk, 
            'harga' => $produk->harga_jual,
            'jumlah' => fake()->numberBetween(1, 3),
        ];
    }
}