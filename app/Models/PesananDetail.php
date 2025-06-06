<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PesananDetail
 * 
 * @property int $id
 * @property int $pesanan_id
 * @property int $kode_produk
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
	use HasFactory;
	protected $table = 'pesanan_detail';
	public $timestamps = false;

	protected $casts = [
		'pesanan_id' => 'int',
		'kode_produk' => 'string',
		'harga' => 'int',
		'jumlah' => 'int'
	];

	protected $fillable = [
		'pesanan_id',
		'kode_produk',
		'harga',
		'jumlah'
	];

	public function pesanan()
	{
		return $this->belongsTo(Pesanan::class);
	}

	public function produk()
	{
		return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
	}
}
