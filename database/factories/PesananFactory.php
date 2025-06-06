<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Pesanan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pesanan>
 */
class PesananFactory extends Factory
{
    protected $model = Pesanan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::where('role', 'user')->inRandomOrder()->value('user_id'),
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'kontak' => '08' . fake()->numerify('##########'),
            'tanggal' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
