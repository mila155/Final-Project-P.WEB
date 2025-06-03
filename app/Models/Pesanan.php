<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pesanan
 * 
 * @property int $id
 * @property int|null $id_user
 * @property string|null $nama
 * @property string|null $alamat
 * @property string|null $kontak
 * @property Carbon|null $tanggal
 * 
 * @property User|null $user
 * @property Collection|PesananDetail[] $pesanan_details
 *
 * @package App\Models
 */
class Pesanan extends Model
{
	protected $table = 'pesanan';
	public $timestamps = false;

	protected $casts = [
		'id_user' => 'int',
		'tanggal' => 'datetime'
	];

	protected $fillable = [
		'id_user',
		'nama',
		'alamat',
		'kontak',
		'tanggal'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'id_user');
	}

	public function pesanan_details()
	{
		return $this->hasMany(PesananDetail::class);
	}
}
