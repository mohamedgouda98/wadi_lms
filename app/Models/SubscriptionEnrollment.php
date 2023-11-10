<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionEnrollment extends Model
{
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    //END
}
