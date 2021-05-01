<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    protected $fillable = [
        'titulo',
        'contenido',
        'user_id'
    ];
}
