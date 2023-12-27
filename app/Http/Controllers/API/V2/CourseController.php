<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function top_course()
    {
        $courses = Course::where('top', 1)
                    ->with('relationBetweenInstructorUser')
                    ->with('course_duration')
                    ->withCount('classes')
                    ->latest()
                    ->get();

        // sum course duration
        $courses->map(function ($course) {
            $course->total_duration = convertMinutesToHoursMins($course->course_duration->sum('duration'));
        });

        return response()->json($courses);
    }

    public function discount_courses()
    {
        $courses = Course::where('is_discount', 1)
                    ->with('relationBetweenInstructorUser')
                    ->with('course_duration')
                    ->withCount('classes')
                    ->latest()
                    ->get();

        // sum course duration
        $courses->map(function ($course) {
            $course->total_duration = convertMinutesToHoursMins($course->course_duration->sum('duration'));
        });

        return response()->json($courses);
    }

    // single_course
    public function single_course($slug)
    {
        $course = Course::where('slug', $slug)
                    ->withCount('enrolled')
                    ->with('relationBetweenInstructorUser')
                    ->with('course_duration')
                    ->with('classes')
                    ->withCount('classes')
                    ->first();

        // sum course duration
        $course->total_duration = convertMinutesToHoursMins($course->course_duration->sum('duration'));

        return response()->json($course);
    }
    //ENDS
}
