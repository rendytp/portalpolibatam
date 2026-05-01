<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCustomLink extends Model
{
    protected $table = 'user_custom_link';

    protected $fillable = [
        'id_user',
        'judul_link',
        'url_link'
    ];
}