<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StokKeluar
 * 
 * @property int $id_keluar
 * @property string $kode_produk
 * @property Carbon $tanggal_keluar
 * @property int $jumlah_keluar
 * 
 * @property Produk $produk
 *
 * @package App\Models
 */
class StokKeluar extends Model
{
	protected $table = 'stok_keluar';
	protected $primaryKey = 'id_keluar';
	public $timestamps = false;

	protected $casts = [
		'tanggal_keluar' => 'datetime',
		'jumlah_keluar' => 'int',
		'pesanan_id' => 'int'
	];

	protected $fillable = [
		'kode_produk',
		'tanggal_keluar',
		'jumlah_keluar',
		'pesanan_id'
	];

	public function produk()
	{
		return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
	}
}
