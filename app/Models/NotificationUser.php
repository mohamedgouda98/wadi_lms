<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
    ];
}
