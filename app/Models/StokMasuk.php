<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StokMasuk
 * 
 * @property int $id_masuk
 * @property string $kode_produk
 * @property Carbon $tanggal_masuk
 * @property int $jumlah_masuk
 * 
 * @property Produk $produk
 *
 * @package App\Models
 */
class StokMasuk extends Model
{
	protected $table = 'stok_masuk';
	protected $primaryKey = 'id_masuk';
	public $timestamps = false;

	protected $casts = [
		'tanggal_masuk' => 'datetime',
		'jumlah_masuk' => 'int'
	];

	protected $fillable = [
		'kode_produk',
		'tanggal_masuk',
		'jumlah_masuk'
	];

	public function produk()
	{
		return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
	}

	public function scopeByMonth($query, $month, $year)
	{
		return $query->whereMonth('tanggal_masuk', $month)
					->whereYear('tanggal_masuk', $year);
	}
}
