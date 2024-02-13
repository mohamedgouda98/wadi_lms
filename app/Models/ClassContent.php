<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassContent extends Model
{
    use SoftDeletes;

    // relationBetweenClass
    public function relationBetweenClass()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    // meeting
    public function meeting()
    {
        return $this->hasOne('App\Meeting', 'id', 'meeting_id');
    }

    // exam
    public function exam()
    {
        return $this->hasOne(Exam::class, 'class_content_id', 'id');
    }
}
