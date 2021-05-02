<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = 
    [
        'user_id',
        'rol_tipo'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
