<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id', 'id')->where('status', 1);
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function instructor()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function scores()
    {
        return $this->hasMany('App\QuizScore', 'quiz_id', 'id');
    }
}
