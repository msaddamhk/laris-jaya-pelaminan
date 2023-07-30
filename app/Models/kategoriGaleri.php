<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriGaleri extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri';
    protected $fillable = ['nama'];
}
