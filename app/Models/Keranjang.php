<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Keranjang
 * 
 * @property int $id
 * @property int $kode_produk
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
	protected $table = 'keranjang';
	public $timestamps = false;

	protected $casts = [
		'kode_produk' => 'string',
		'harga' => 'int',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'kode_produk',
		'nama',
		'harga',
		'jumlah',
		'gambar'
	];

	public function produk()
	{
		return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
	}
}
