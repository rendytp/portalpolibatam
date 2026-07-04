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
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'integer',
    ];

    /**
     * Relasi: satu layanan dimiliki oleh satu kategori.
     * Nama method dibuat "kategoriRelation" (bukan "kategori") supaya tidak
     * bentrok dengan accessor getKategoriAttribute() di bawah, yang dipakai
     * supaya blade view lama ({{ $item->kategori }}) tidak perlu diubah.
     */
    public function kategoriRelation()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    /**
     * Relasi: satu layanan bisa difavoritkan oleh banyak user.
     */
    public function favorit()
    {
        return $this->hasMany(UserFavorit::class, 'id_layanan', 'id');
    }

    /**
     * Accessor supaya $layanan->kategori tetap berupa string nama kategori,
     * sama seperti hasil "kategori.nama as kategori" pada query lama.
     * Dipakai di resources/views/admin/layanan.blade.php
     */
    public function getKategoriAttribute()
    {
        return $this->kategoriRelation?->nama;
    }

    /**
     * Accessor supaya $layanan->nama_kategori tetap tersedia,
     * sama seperti alias lama "kategori.nama as nama_kategori".
     * Dipakai di resources/views/user/beranda.blade.php,
     * cari-layanan.blade.php, dan favorit.blade.php
     */
    public function getNamaKategoriAttribute()
    {
        return $this->kategoriRelation?->nama;
    }
}