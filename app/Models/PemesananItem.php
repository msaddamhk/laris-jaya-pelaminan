<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananItem extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_item';

    protected $fillable = [
        'jasa_id',
        'pemesanan_id',
        'jumlah',
        'status_pengembalian_barang',

    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function pemesananItemOpsi()
    {
        return $this->hasMany(PemesananItemOpsi::class);
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'jasa_id');
    }
}
