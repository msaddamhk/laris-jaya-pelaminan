<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'kategori_galeri_id',
        'foto',
        'judul',
        'tanggal_booking',

    ];

    public function kategori_galeri()
    {
        return $this->belongsTo(kategoriGaleri::class);
    }
}
