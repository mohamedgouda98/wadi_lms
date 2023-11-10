<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = ['meeting_id', 'owner_id', 'start_time', 'zoom_url', 'user_id', 'meeting_title', 'course_id', 'link_by', 'type', 'agenda'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function courses()
    {
        return $this->belongsTo('App\Models\Course', 'course_id', 'id');
    }

    //END
}
