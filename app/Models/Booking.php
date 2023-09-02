<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'jasa_id',
        'pemesanan_id',
        'tanggal_booking',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class);
    }

    // public function bookingStatus()
    // {
    //     if ($this->pemesanan->metode_pembayaran === 'cod' || $this->pemesanan->created_at->addHours(1)->diffInMinutes(now(), false) < 0) {
    //         return true;
    //     }

    //     return $this->pemesanan->status_pembayaran;
    // }
}
