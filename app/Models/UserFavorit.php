<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavorit extends Model
{
    protected $table = 'user_favorit';
    protected $guarded = [];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id');
    }
}