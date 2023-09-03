<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;

    protected $table = 'jasa';

    protected $fillable = [
        'vendor_id',
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'modal',
        'is_cod',
        'banyak_hari',
        'tipe_unit',
        'jumlah_minimal',
        'jumlah_maksimal',
        'jumlah_pesanan',
        'status_pengembalian',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function jasaFoto()
    {
        return $this->hasMany(JasaFoto::class);
    }

    public function jasaOpsi()
    {
        return $this->hasMany(JasaOpsi::class);
    }

    public function pemesananItems()
    {
        return $this->hasMany(PemesananItem::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function pemesanan()
    {
        return $this->hasManyThrough(Pemesanan::class, PemesananItem::class, 'jasa_id', 'id');
    }
}
