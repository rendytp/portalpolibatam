<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';

    protected $fillable = [
        'id_kategori',
        'nama',
        'deskripsi',
        'url',
        'is_active'
    ];
}