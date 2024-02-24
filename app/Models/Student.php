<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id');
    }


    public function seenContents()
    {
        return $this->hasMany(SeenContent::class, 'user_id', 'user_id');
    }

    // exams
    public function exams()
    {
        return $this->hasMany(StudentExam::class, 'student_id', 'id');
    }








}
