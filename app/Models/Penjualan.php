<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'pelanggan_id',
        'nomor_transaksi',
        'tanggal',
        'total',
        'tunai',
        'kembalian',
        'status',
        'subtotal',
        'diskon',
        'pajak'
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'penjualan_id');
    }
}
