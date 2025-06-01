<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PesananDetail
 * 
 * @property int $id
 * @property int $pesanan_id
 * @property int $produk_id
 * @property int $harga
 * @property int $jumlah
 * 
 * @property Pesanan $pesanan
 * @property Produk $produk
 *
 * @package App\Models
 */
class PesananDetail extends Model
{
	protected $table = 'pesanan_detail';
	public $timestamps = false;

	protected $casts = [
		'pesanan_id' => 'int',
		'produk_id' => 'int',
		'harga' => 'int',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'pesanan_id',
		'produk_id',
		'harga',
		'jumlah'
	];

	public function pesanan()
	{
		return $this->belongsTo(Pesanan::class);
	}

	public function produk()
	{
		return $this->belongsTo(Produk::class);
	}
}
