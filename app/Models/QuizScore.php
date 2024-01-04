<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizScore extends Model
{
    protected $guarded = ['id'];

    public function student()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    //END
}
