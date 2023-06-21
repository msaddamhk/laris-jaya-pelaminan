<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaOpsi extends Model
{
    use HasFactory;

    protected $table = 'jasa_opsi';

    protected $fillable = [
        'jasa_id',
        'nama',
        'tipe',
    ];

    public function jasa()
    {
        return $this->belongsTo(Jasa::class);
    }

    public function jasaItems()
    {
        return $this->hasMany(JasaOpsiItem::class, 'opsi_jasa_id');
    }
}
