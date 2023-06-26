<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanan';

    protected $fillable = [
        'user_id',
        'no_pemesanan',
        'tanggal_acara',
        'status_pembayaran',
        'bukti_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pemesananItem()
    {
        return $this->hasMany(PemesananItem::class);
    }

    public function jumlah()
    {
        return $this->pemesananItem->reduce(function ($total, $item) {
            return $total += (($item->jasa->harga + $item->pemesananItemOpsi->reduce(function ($total, $item) {
                return $total += $item->jasaOpsiItem->harga;
            })) * $item->jumlah);
        });
    }
}
