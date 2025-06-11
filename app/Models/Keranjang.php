<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Keranjang
 * 
 * @property int $id
 * @property int $kode_produk
 * @property int $user_id
 * @property string $nama
 * @property int $harga
 * @property int|null $jumlah
 * @property string|null $gambar
 * 
 * @property Produk $produk
 *
 * @package App\Models
 */
class Keranjang extends Model
{
	use HasFactory;
	protected $table = 'keranjang';
	public $timestamps = false;

	protected $casts = [
		'kode_produk' => 'string',
		'user_id' => 'int',
		'harga' => 'int',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'kode_produk',
		'user_id',
		'nama',
		'harga',
		'jumlah',
		'gambar'
	];

	public function produk()
	{
		return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
	}
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
