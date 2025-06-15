<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'cemalcemil_transaksi';
    
    protected $fillable = [
        'tanggal_transaksi',
        'kode_transaksi',
        'deskripsi',
        'jenis',
        'jumlah',
        'kategori',
        'catatan',
        'dibuat_oleh'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'date',
        'jumlah' => 'decimal:2'
    ];

    public function scopeByMonth($query, $month, $year)
    {
        return $query->whereMonth('tanggal_transaksi', $month)
                    ->whereYear('tanggal_transaksi', $year);
    }

    public function scopeByType($query, $type)
    {
        if ($type !== 'semua') {
            return $query->where('jenis', $type);
        }
        return $query;
    }

    public function getFormattedJumlahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    public static function generateKodeTransaksi()
    {
        $prefix = 'TRX';
        $date = date('Ymd');
        $lastTransaction = self::where('kode_transaksi', 'like', $prefix . $date . '%')
                              ->orderBy('kode_transaksi', 'desc')
                              ->first();
        
        if ($lastTransaction) {
            $lastNumber = intval(substr($lastTransaction->kode_transaksi, -3));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return $prefix . $date . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}