<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningBank extends Model
{
    use HasFactory;

    protected $table = 'rekening_bank';

    protected $fillable = [
        'nama_bank',
        'no_rekening',
        'atas_nama',
    ];
}
