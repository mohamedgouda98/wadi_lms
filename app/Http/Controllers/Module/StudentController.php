<?php

namespace App\Http\Controllers\Module;

use Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\UpdateStudent;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\User;
use App\Models\VerifyUser;
use App\Notifications\StudentRegister;
use App\Notifications\VerifyNotifications;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*All students with search option */
    public function index(Request $request)
    {
        if (Auth::user()->user_type == 'Admin') {
            /*if Authenticated  user is admin , admin can show all students */
            if ($request->get('search')) {
                $students = Student::where('name', 'like', '%'.$request->get('search').'%')
                    ->orWhere('email', 'like', '%'.$request->get('search').'%')
                    ->orderBydesc('id')->paginate(10);
            } else {
                $students = Student::orderBydesc('id')->paginate(10);
            }
        } else {
            /*There are the Instructor show only his/her register Students list*/
            $courses = Course::where('user_id', Auth::id())->get();
            $course_id_array = [];
            foreach ($courses as $i) {
                array_push($course_id_array, $i->id);
            }
            $enroll_student_id = [];
            $enroll = Enrollment::whereIn('course_id', $course_id_array)->get();
            foreach ($enroll as $i) {
                array_push($enroll_student_id, $i->user_id);
            }

            if ($request->get('search')) {
                $students = Student::where('name', 'like', '%'.$request->get('search').'%')
                    ->orWhere('email', 'like', '%'.$request->get('search').'%')
                    ->whereIn('user_id', $enroll_student_id)->orderBydesc('id')->paginate(10);
            } else {
                $students = Student::whereIn('user_id', $enroll_student_id)->orderBydesc('id')->paginate(10);
            }
        }
        return view('module.students.index', compact('students'));
    }

    /*This function show all instructor related history
    like Package, Course , Enrolment Student list Get Payment History*/
    public function show($id)
    {

        $each_student = Student::where('user_id', $id)->first();

        return view('module.students.show', compact('each_student'));
    }
    public function edit($id)
    {
        $student = Student::where('user_id', $id)->first();

        return view('module.students.edit', compact('student'));
    }

    public function update(UpdateStudent $request)
    {
        $student = Student::findOrFail($request->student_id);
        $student->update($request->validated());
        Alert::success('Student updated');
        return redirect(route('students.index'));
    }

    public function create()
    {
        return view('module.students.create');
    }

    public function student_store(Request $request)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        // registration validation
        $request->validate(
            [
                'name' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'confirmed' => 'required|required_with:password|same:password',
            ],
            [
                'name.required' => translate('Name is required'),
                'email.required' => translate('Email is required'),
                'email.unique' => translate('Email is already register'),
                'password.required' => translate('Password is required'),
                'password.min' => translate('Password  must be 8 character '),
                'password.string' => translate('Password is required'),
                'confirmed.required' => translate('Please confirm your password'),
                'confirmed.same' => translate('Password did not match'),
            ]

        );

        //create user for login
        $user = new User();
        $user->name = $request->name;
        $user->slug = Str::slug($request->name);
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_type = 'Student';
        $user->save();

        //create student
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->user_id = $user->id;
        $student->save();

        /*here is the student */
        try {
            $user->notify(new StudentRegister());

            VerifyUser::create([
                'user_id' => $user->id,
                'token' => sha1(time()),
            ]);

            // send verify mail
            $user->notify(new VerifyNotifications($user));
        } catch (\Exception $exception) {
        }

        Session::flash('message', translate('Registration done successfully.'));

        return back();
    }

    public function student_enroll_courses($id)
    {
        $enrollments = Enrollment::where('user_id', $id)->select('course_id')->get();
        return view('module.students.enroll_course', compact('enrollments', 'id'));
    }

    public function student_enroll_courses_store(Request $request, $id)
    {
        $items = $request->course_id;

        DB::transaction(function () use ($id, $items) {
            $userCurrentCourseIds = Enrollment::where('user_id', $id)->pluck('course_id')->toArray();

            $coursesToRemove = array_diff($userCurrentCourseIds, $items);
            $coursesToAdd = array_diff($items, $userCurrentCourseIds);

            Enrollment::where('user_id', $id)
                ->whereIn('course_id', $coursesToRemove)
                ->delete();

            $enrollments = array_map(function ($courseId) use ($id) {
                return [
                    'course_id' => $courseId,
                    'user_id' => $id,
                    'created_at' => now(), // Assuming you have timestamps
                    'updated_at' => now(),
                ];
            }, $coursesToAdd);

            if (!empty($enrollments)) {
                Enrollment::insert($enrollments);
            }
            Alert::success('message', translate('Course enrolled for student.'));
        });

        return back();
    }

}
