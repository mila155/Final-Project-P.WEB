<?php

namespace Database\Factories;

use App\Models\Keranjang;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produk;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Keranjang>
 */
class KeranjangFactory extends Factory
{
    protected $model = Keranjang::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produk = Produk::inRandomOrder()->first();
        // dd($produk);
        return [
            'kode_produk' => $produk->kode_produk, 
            'user_id' => User::where('role', 'user')->inRandomOrder()->value('user_id'),
            'nama' => $produk->nama_produk, 
            'harga' => $produk->harga_jual,
            'jumlah' => fake()->numberBetween(1, 10),
            'gambar' => $produk->foto,
        ];
    }
}
