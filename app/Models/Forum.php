<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $guarded = ['id'];

    // username
    public function username()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    // category
    public function categoryName()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category');
    }
    //END
}
