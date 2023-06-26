<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaOpsiItem extends Model
{
    use HasFactory;

    protected $table = 'jasa_opsi_item';

    protected $fillable = [
        'opsi_jasa_id',
        'label',
        'value',
        'harga',
        'foto',
    ];

    public function jasaOpsi()
    {
        return $this->belongsTo(JasaOpsi::class, 'opsi_jasa_id');
    }

    public function pemesananItemOpsi()
    {
        return $this->hasMany(PemesananItemOpsi::class, 'jasa_item_opsi_id');
    }
}
