<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaFoto extends Model
{
    use HasFactory;

    protected $table = 'jasa_foto';

    protected $fillable = [
        'jasa_id',
        'foto',
    ];

    public function jasa()
    {
        return $this->belongsTo(Jasa::class);
    }
}
