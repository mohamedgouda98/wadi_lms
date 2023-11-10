<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Instructor;
use App\Models\InstructorEarning;
use App\Models\Slider;

class FrontendController extends Controller
{
    // slider
    public function slider()
    {
        return $sliders = Slider::where('is_published', 1)->first();
    }

    // counting_data
    public function counting_data()
    {
        return [
            'categories' => Category::where('is_published', 1)->count(),
            'courses' => Course::where('is_published', 1)->count(),
            'enrollments' => Enrollment::count(),
            'instructors' => Instructor::count(),
            'instructor_earnings' => InstructorEarning::sum('course_price'),
        ];
    }

    /**
     * top_instructor
     */
    public function top_instructor()
    {
        $top_instructor = Instructor::orderBy('rating', 'desc')->with('user')->limit(10)->get();

        return $top_instructor;
    }

    //ENDS
}
