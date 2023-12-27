<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorEarning extends Model
{
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class)->with('enrollCourse');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
