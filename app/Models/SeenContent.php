<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeenContent extends Model
{
    protected $fillable = [
        'email', 'token',
    ];
}
