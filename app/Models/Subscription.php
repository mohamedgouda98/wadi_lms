<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /*Check popular*/
    public function scopePopular($query)
    {
        return $query->where('popular', true);
    }

    /*Check deactive*/
    public function scopePublished($query)
    {
        return $query->where('deactive', true);
    }

    //END
}
