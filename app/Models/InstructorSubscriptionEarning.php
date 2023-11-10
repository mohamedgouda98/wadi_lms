<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorSubscriptionEarning extends Model
{
    /*Check deactive*/
    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'course_id');
    }

    //END
}
