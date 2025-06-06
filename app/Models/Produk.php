<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Produk
 * 
 * @property int $id
 * @property string $kode_produk
 * @property string $nama_produk
 * @property int $stok
 * @property float $harga_jual
 * @property int $harga_produksi
 * @property int $kuantitas_produk
 * @property string $satuan
 * @property string|null $deskripsi
 * @property string|null $foto
 * @property int|null $stok_akhir
 * 
 * @property Collection|Keranjang[] $keranjangs
 * @property Collection|PesananDetail[] $pesanan_details
 * @property Collection|StokKeluar[] $stok_keluars
 * @property Collection|StokMasuk[] $stok_masuks
 *
 * @package App\Models
 */
class Produk extends Model
{
	protected $table = 'produk';
	// protected $primaryKey = 'kode_produk';
	public $timestamps = false;

	protected $casts = [
		'stok' => 'int',
		'harga_jual' => 'float',
		'harga_produksi' => 'int',
		'kuantitas_produk' => 'int',
		'stok_akhir' => 'int'
	];

	protected $fillable = [
		'kode_produk',
		'nama_produk',
		'stok',
		'harga_jual',
		'harga_produksi',
		'kuantitas_produk',
		'satuan',
		'deskripsi',
		'foto',
		'stok_akhir'
	];

	public function keranjangs()
	{
		return $this->hasMany(Keranjang::class, 'kode_produk', 'kode_produk');
	}

	public function pesanan_details()
	{
		return $this->hasMany(PesananDetail::class, 'kode_produk', 'kode_produk');
	}

	public function stok_keluars()
	{
		return $this->hasMany(StokKeluar::class, 'kode_produk', 'kode_produk');
	}

	public function stok_masuks()
	{
		return $this->hasMany(StokMasuk::class, 'kode_produk', 'kode_produk');
	}
}
