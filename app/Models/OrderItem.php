<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

       protected $fillable = [
           'order_id',
           'kode_produk',
           'quantity',
           'price',
       ];

       public function order()
       {
           return $this->belongsTo(Order::class);
       }

       public function produk()
       {
           return $this->belongsTo(Produk::class, 'kode_produk', 'kode_produk');
       }
}
