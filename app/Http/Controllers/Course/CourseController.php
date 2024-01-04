<?php

namespace App\Http\Controllers\Course;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Category;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Language;
use App\Models\NotificationUser;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    use ImageTrait;
    public function userNotify($user_id, $details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*only instructor show only his/her course
     Admin can show all Course
    */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            if (Auth::user()->user_type == 'Admin') {
                $courses = Course::where('title', 'like', '%'.$request->search.'%')->latest()->paginate(10);
            } else {
                $courses = Course::where('user_id', Auth::id())->where('title', 'like', '%'.$request->search.'%')->latest()->paginate(10);
            }
        } else {
            if (Auth::user()->user_type == 'Admin') {
                $courses = Course::latest()->paginate(10);
            } else {
                $courses = Course::where('user_id', Auth::id())->latest()->paginate(10);
            }
        }

        return view('course.index', compact('courses'));
    }

    // course.create
    public function create()
    {
        //Todo::There have twist only Register instructor can show his/her course
        $categories = Category::all();
        $languages = Language::all();

        return view('course.create', compact('categories', 'languages'));
    }

    // course.store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:courses',
            'image' => 'required',
            'overview_url' => 'required',
            'provider' => 'required',
            'requirement' => 'required',
            'outcome' => 'required',
            'tag' => 'required',
            'language' => 'required',
            'category_id' => 'required',
            'level' => 'required',
        ], [
            'title.required' => translate('Title is required'),
            'level.required' => translate('Course Level is required'),
            'title.unique' => translate('Course title must be unique'),
            'overview_url.required' => translate('Overview Url is required'),
            'provider.required' => translate('Provider is required'),
            'requirement.required' => translate('Requirement is required'),
            'outcome.required' => translate('Outcome is required'),
            'tag.required' => translate('Tag is required'),
            'language.required' => translate('Language is required'),
            'category_id.required' => translate('You must choose a category'),
            'image.required' => translate('Course thumbnail is required'),
        ]);

        if($request->hasFile('image'))
        {
            $imageName = $this->uploadImage($request->image, Course::PATH);
        }

        $courses = new Course();
        $courses->title = $request->title;
        $courses->slug = Str::slug($request->title);
        $courses->short_description = $request->short_description;
        $courses->big_description = $request->big_description;
        $courses->image = $imageName;
        $courses->overview_url = $request->overview_url;
        $courses->provider = $request->provider;
        $courses->level = $request->level;

        $req = explode(',', $request->requirement);
        $reqC = [];
        foreach ($req as $item) {
            array_push($reqC, $item);
        }
        $courses->requirement = json_encode($reqC);

        $out = explode(',', $request->outcome);
        $outC = [];
        foreach ($out as $itemo) {
            array_push($outC, $itemo);
        }
        $courses->outcome = json_encode($outC);

        $tag = explode(',', $request->tag);
        $tagC = [];
        foreach ($tag as $itemt) {
            array_push($tagC, $itemt);
        }
        $courses->tag = json_encode($tagC);
        $courses->is_free = $request->is_free == 'on' ? true : false;

        if (! $courses->is_free) {
            $courses->price = $request->price;
        }

        $courses->is_discount = $request->is_discount == 'on' ? true : false;

        if ($courses->is_discount) {
            $courses->discount_price = $request->discount_price;
        }

        $courses->language = $request->language;

        $meta = explode(',', $request->meta_title);
        $metaC = [];
        foreach ($meta as $itemm) {
            array_push($metaC, $itemm);
        }
        $courses->meta_title = json_encode($metaC);
        $courses->meta_description = $request->meta_description;
        $courses->category_id = $request->category_id;
        $courses->is_published = $request->is_published == 'on' ? true : false;
        $courses->user_id = Auth::user()->id;
        $courses->save();

        $details = [
            'body' => translate($request->title.' new course uploaded by '.Auth::user()->name),
        ];

        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id, $details);

        notify()->success(translate($request->title.' created successfully'));

        return redirect()->route('course.show', [$courses->id, $courses->slug]);
    }

    /*Check all slug*/
    public function check(Request $request)
    {
        $slug = $request->title;
        if ($slug) {
            $data = Course::where('title', $slug)->count();

            if ($data > 0) {
                return 'not_unique';
            } else {
                return 'unique';
            }
        }
    }

    // course.show
    public function show($course_id)
    {
        $course = Course::with('classesAll')->findOrFail($course_id);

        return view('course.show', compact('course', 'course_id'));
    }

    // course.destroy
    public function destroy($course_id)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $s = Enrollment::where('course_id', $course_id)->count();

        if ($s <= 0) {
            Course::findOrFail($course_id)->delete();
            notify()->success(translate('Course deleted successfully'));

            return back();
        } else {
            notify()->success(translate('This course has enrolled student'));

            return back();
        }
    }

    // course.edit
    public function edit($course_id)
    {
        $each_course = Course::findOrFail($course_id);
        $categories = Category::all();
        $languages = Language::all();


        return view('course.edit', compact('each_course', 'categories', 'languages'));
    }

    // course.update
    public function update(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                Rule::unique('courses')->ignore($request->id , 'id'),
            ],
            'overview_url' => 'required',
            'provider' => 'required',
            'requirement' => 'required',
            'outcome' => 'required',
            'tag' => 'required',
            'language' => 'required',
            'category_id' => 'required',
            'level' => 'required',
        ], [
            'title.required' => translate('Title is required'),
            'level.required' => translate('Level is required'),
            'overview_url.required' => translate('Overview Url is required'),
            'provider.required' => translate('Provider is required'),
            'requirement.required' => translate('Requirement is required'),
            'outcome.required' => translate('Outcome is required'),
            'tag.required' => translate('Tag is required'),
            'language.required' => translate('Language is required'),
            'category_id.required' => translate('You must choose a category'),

        ]);
        if($request->hasFile('image'))
        {
            $imageName = $this->uploadImage($request->image, Course::PATH);
        }

        $courses = Course::where('id', $request->id)->firstOrFail();
        $courses->title = $request->title;
        $courses->short_description = $request->short_description;
        $courses->big_description = $request->big_description;
        $courses->image = $imageName ?? $courses->getRawOriginal('image') ;
        $courses->overview_url = $request->overview_url;
        $courses->level = $request->level;
        $courses->provider = $request->provider;

        $req = explode(',', $request->requirement);
        $reqC = [];
        foreach ($req as $item) {
            array_push($reqC, $item);
        }
        $courses->requirement = json_encode($reqC);

        $out = explode(',', $request->outcome);
        $outC = [];
        foreach ($out as $itemo) {
            array_push($outC, $itemo);
        }
        $courses->outcome = json_encode($outC);

        $tag = explode(',', $request->tag);
        $tagC = [];
        foreach ($tag as $itemt) {
            array_push($tagC, $itemt);
        }
        $courses->is_free = $request->is_free == 'on' ? true : false;
        if (! $courses->is_free) {
            $courses->price = $request->price;
        }
        $courses->is_discount = $request->is_discount == 'on' ? true : false;

        if ($courses->is_discount) {
            $courses->discount_price = $request->discount_price;
        }

        $courses->language = $request->language;

        $meta = explode(',', $request->meta_title);
        $metaC = [];
        foreach ($meta as $itemm) {
            array_push($metaC, $itemm);
        }
        $courses->meta_title = json_encode($metaC);
        $courses->meta_description = $request->meta_description;
        $courses->category_id = $request->category_id;
        if ($courses->is_published) {
            $courses->is_published = true;
        } else {
            $courses->is_published = false;
        }
        $courses->user_id = Auth::user()->id;
        $courses->save();

        notify()->success(translate('Course Updated'));

        return redirect(route('course.index'));
    }

    //published
    public function published(Request $request)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $course = Course::where('id', $request->id)->first();
        if ($course->is_published == 1) {
            $course->is_published = 0;
            $course->save();
        } else {
            $course->is_published = 1;
            $course->save();
        }

        return response(['message' => translate('Course Published  Status is Change ')], 200);
    }

    //course rating
    public function rating(Request $request)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $course = Course::where('id', $request->id)->first();
        $course->rating = $request->rating;
        $course->save();

        return response(['message' => translate('Course Rating is Changed ')], 200);
    }
    //END
}
