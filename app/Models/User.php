<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Users
 * 
 * @property int $user_id
 * @property string $user_name
 * @property string $user_email
 * @property Carbon|null $email_verified_at
 * @property string $user_password
 * @property string|null $user_telp
 * @property string|null $remember_token
 * @property Carbon $created_at
 * @property string $role
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Pesanan[] $pesanans
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasFactory, Notifiable;

	protected $primaryKey = 'user_id';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];
	
	protected $hidden = [
		'user_password',
		'remember_token'
	];

	protected $fillable = [
		'user_name',
		'user_email',
		'email_verified_at',
		'user_password',
		'user_telp',
		'role',
		'remember_token'
	];

	public function pesanans()
	{
		return $this->hasMany(Pesanan::class, 'id_user');
	}
	public function keranjangs()
	{
		return $this->hasMany(Keranjang::class, 'user_id');
	}
}
