<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Sesuaikan dengan nama tabel di database Anda (misal: 'kategori' atau 'kategoris')
    protected $table = 'kategori'; 
    protected $primaryKey = 'id';

    // Jika primary key bukan 'id', tentukan di sini. 
    // Berdasarkan ERD Anda, sepertinya menggunakan 'id' atau 'id_kategori'
    // protected $primaryKey = 'id_kategori'; 

    protected $guarded = []; // Mengizinkan mass-assignment
}