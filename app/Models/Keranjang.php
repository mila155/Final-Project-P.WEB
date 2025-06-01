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
 * @property int $produk_id
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
		'produk_id' => 'int',
		'harga' => 'int',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'produk_id',
		'nama',
		'harga',
		'jumlah',
		'gambar'
	];

	public function produk()
	{
		return $this->belongsTo(Produk::class);
	}
}
