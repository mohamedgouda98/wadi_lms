<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    const PATH = 'certifications';

    protected $guarded = ['id'];


    protected function getImageAttribute($value)
    {
        return config('app.url') . $this::PATH.DIRECTORY_SEPARATOR. $value;
    }

    /*Check the course is published*/
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /*Check the course is published*/
    public function scopeNotFree($query)
    {
        return $query->where('is_free', false);
    }

    // relationBetweenCategory
    public function relationBetweenCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // relationBetweenLanguage
    public function relationBetweenLanguage()
    {
        return $this->hasOne(Language::class, 'id', 'language');
    }

    public function relationBetweenInstructorUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->where('user_type', 'Instructor');
    }

    // classes
    public function classes()
    {
        return $this->hasMany(Classes::class)
            ->where('is_published', true)
            ->with('contents');
    }

    // class duration
    public function course_duration()
    {
        return $this->hasMany(ClassContent::class, 'course_id', 'id')
            ->where('is_published', 1);
    }

    public function classesAll()
    {
        return $this->hasMany(Classes::class)
            ->with('contentsAll');
    }

    //enroll
    public function enrollClasses()
    {
        return $this->hasMany(Classes::class)
            ->where('is_published', true)
            ->with('enrollContents');
    }

    // category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // relationWithEnrollment
    public function enrolled()
    {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

    // enrollment
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class)->where('course_id', 'id');
    }

    // meeting
    public function meeting()
    {
        return $this->hasOne('App\Models\Meeting', 'course_id', 'id');
    }

    // subscription
    public function subscription()
    {
        return $this->hasOne('App\Models\SubscriptionCourse', 'course_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'course_id');
    }

    // seenContents
    public function seenContents()
    {
        return $this->hasMany(SeenContent::class, 'course_id', 'id');
    }

    // classContents
    public function classContents()
    {
        return $this->hasMany(ClassContent::class, 'course_id', 'id');
    }
}
