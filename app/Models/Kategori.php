<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id';

    // Diganti dari $guarded = [] ke $fillable eksplisit supaya lebih aman
    // (mass-assignment hanya diperbolehkan untuk kolom yang memang dikirim dari form).
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    /**
     * Relasi: satu kategori punya banyak layanan.
     */
    public function layanan()
    {
        return $this->hasMany(Layanan::class, 'id_kategori', 'id');
    }
}
