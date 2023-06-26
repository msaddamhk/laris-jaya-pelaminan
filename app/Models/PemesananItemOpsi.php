<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananItemOpsi extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_item_opsi';

    protected $fillable = [
        'pemesanan_item_id',
        'jasa_opsi_item_id',
    ];

    public function pemesananItem()
    {
        return $this->belongsTo(PemesananItem::class);
    }

    public function jasaOpsiItem()
    {
        return $this->belongsTo(JasaOpsiItem::class, 'jasa_opsi_item_id');
    }
}
