<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseComment;
use App\Models\Instructor;
use App\Models\InstructorSubscriptionEarning;
use App\Models\InstructorSubscriptionPayment;
use App\Models\Subscription;
use App\Models\SubscriptionCart;
use App\Models\SubscriptionCourse;
use App\Models\SubscriptionCourseRequest;
use App\Models\SubscriptionEnrollment;
use App\Models\SubscriptionSettings;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        if (adminPower()) {
            $packages = Subscription::all();

            return view('subscription.index', compact('packages'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * CREATE
     */
    public function create(Request $request)
    {
        $subscription = new Subscription();
        $subscription->name = $request->name;
        $subscription->description = json_encode($request->description);
        $subscription->price = $request->price;
        $subscription->instructor_payment = $request->instructor_payment;
        $subscription->duration = $request->duration;
        if ($request->popular == 'on') {
            $subscription->popular = true;
        } else {
            $subscription->popular = false;
        }
        $subscription->save();
        notify()->success(translate('New Subscription Package Created'));

        return back();
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'nullable',
            'duration' => 'required',
        ]);

        $package = Subscription::findOrFail($id);
        $package->name = $request->name;
        $package->description = json_encode($request->description);
        if ($package->price != null) {
            $package->price = $request->price;
        } else {
            $package->price = 0;
        }
        $package->duration = $request->duration;
        $package->instructor_payment = $request->instructor_payment;
        if ($request->popular == 'on') {
            $package->popular = true;
        } else {
            $package->popular = false;
        }
        $package->save();
        notify()->success(translate('Subscription Package Updated'));

        return back();
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        if (adminPower()) {
            $package = Subscription::findOrFail($id);

            return view('subscription.edit', compact('package'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * deactivate
     */
    public function deactivate($id)
    {
        $deactivate = Subscription::where('id', $id)->first();

        if ($deactivate->deactive == 0) {
            $deactivate->deactive = 1;
        } else {
            $deactivate->deactive = 0;
        }

        $deactivate->save();
        notify()->success(translate('Updated'));

        return back();
    }

    /**
     * popular
     */
    public function popular($id)
    {
        $popular = Subscription::where('id', $id)->first();

        if ($popular->popular == 0) {
            $popular->popular = 1;
        } else {
            $popular->popular = 0;
        }

        $popular->save();
        notify()->success(translate('Updated'));

        return back();
    }

    /**
     * PACKAGE COURSES
     */
    public function packageCourse($package)
    {
        if (adminPower()) {
            $courses = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

            return view('subscription.subscription_coureses', compact('courses', 'package'));
        } else {
            $courses = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->where('user_id', Auth::user()->id)->with('course')->paginate(10);

            return view('subscription.subscription_coureses', compact('courses', 'package'));
        }
    }

    /**
     * COURSES
     */
    public function courses()
    {
        if (Auth::user()->user_type == 'Admin') {
            $courses = Course::latest()->NotFree()->paginate(10);
        } else {
            $courses = Course::where('user_id', Auth::id())->latest()->NotFree()->paginate(10);
        }

        $durations = Subscription::all();

        return view('subscription.courses', compact('courses', 'durations'));
    }

    /**
     * SELECT COURSES
     */
    public function selectCourses(Request $request)
    {
        if ($request->subscription_duration != null) {
            $subs = [];

            foreach ($request->subscription_duration as $data) {
                $item = explode('-', $data);
                array_push($subs, $item[0]);
            }

            $subscription_courses = SubscriptionCourse::where('course_id', $request->course_id)->first();
            $subscription_course_requests = SubscriptionCourseRequest::where('course_id', $request->course_id)->first();

            if (adminPower()) {
                if ($subscription_courses != null) {
                    $subscription_courses->update([
                        'course_id' => request('course_id'),
                        'user_id' => request('user_id'),
                        'is_published' => 1,
                        'subscription_duration' => json_encode($subs),
                    ]);
                } else {
                    $subscription_courses = new SubscriptionCourse();
                    $subscription_courses->course_id = request('course_id');
                    $subscription_courses->user_id = request('user_id');
                    $subscription_courses->is_published = 1;
                    $subscription_courses->subscription_duration = json_encode($subs);
                    $subscription_courses->save();
                }
            } else {
                foreach ($subs as $duration) {
                    $subscription_course_requests = SubscriptionCourseRequest::where('course_id', $request->course_id)
                                                ->where('user_id', $request->user_id)
                                                ->where('subscription_duration', $duration)
                                                ->first();

                    if ($subscription_course_requests == null) {
                        $InstructorSubscriptionCourseRequest = new SubscriptionCourseRequest();
                        $InstructorSubscriptionCourseRequest->course_id = $request->course_id;
                        $InstructorSubscriptionCourseRequest->user_id = $request->user_id;
                        $InstructorSubscriptionCourseRequest->subscription_duration = $duration;
                        $InstructorSubscriptionCourseRequest->save();
                    }
                }
            }

            InstructorSubscriptionPayment::where('course_id', $request->course_id)->delete();

            $subscription_durations = SubscriptionCourse::where('course_id', $request->course_id)
                                                    ->get();

            foreach ($subscription_durations as $subscription_duration) {
                foreach (json_decode($subscription_duration->subscription_duration) as $item) {
                    $InstructorSubscriptionPayment = new InstructorSubscriptionPayment();
                    $InstructorSubscriptionPayment->course_id = $request->course_id;
                    $InstructorSubscriptionPayment->user_id = $request->user_id;
                    $InstructorSubscriptionPayment->subscription_duration = $item;
                    $InstructorSubscriptionPayment->save();
                }
            }

            return response()->json('success', 200);
        }
    }

    /**
     * settings
     */
    public function settings()
    {
        if (adminPower()) {
            return view('subscription.settings');
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * settings Update
     */
    public function settingsUpdate(Request $request)
    {
        if ($request->has('enable_instructor_request')) {
            $system = SubscriptionSettings::where('type', 'enable_instructor_request')->first();
            $system1 = SubscriptionSettings::where('type', 'enable_all_course')->first();

            if ($request->enable_instructor_request_value == 'on') {
                $system->value = true;
                $system1->value = false;
            } else {
                $system->value = false;
                $system1->value = true;
            }

            $system->save();
            $system1->save();
        }

        if ($request->has('enable_free_trial')) {
            $system = SubscriptionSettings::where('type', $request->enable_free_trial)->first();

            if ($request->enable_free_trial_value == 'on') {
                $system->value = true;
            } else {
                $system->value = false;
            }

            $system->save();
        }

        if ($request->has('payment_schedule')) {
            $system = SubscriptionSettings::where('type', $request->payment_schedule)->first();
            $system->value = $request->payment_schedule_value;
            $system->save();
        }

        notify()->success(translate('Settings Updated'));

        return back();
    }

    /**
     * FRONEND
     */
    public function frontend($package)
    {
        $courses = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

        return view('subscription.frontend.index', compact('courses'));
    }

    public function cartList(Request $request)
    {
        $courses_id = $request->course_id;
        $subscription_price = $request->subscription_price;
        $subscription_package = $request->subscription_package;

        $courses = collect();

        foreach ($courses_id as $course_id) {
            $course_contents = Course::where('id', $course_id)->first();
            $courses->push($course_contents);
        }

        $checkCart = SubscriptionEnrollment::where('subscription_package', $request->subscription_package)
                                    ->where('user_id', Auth::user()->id)->first();

        $subscriptionEnrollment = new SubscriptionCart();
        $subscriptionEnrollment->user_id = Auth::user()->id;
        $subscriptionEnrollment->subscription_package = $subscription_package;
        $subscriptionEnrollment->subscription_price = $subscription_price;
        $subscriptionEnrollment->start_at = Carbon::now();

        $duration = $request->subscription_package;

        if ($duration == 'Free') {
            $subscriptionEnrollment->end_at = Carbon::now();
        }

        if ($duration == 'Monthly') {
            $subscriptionEnrollment->end_at = Carbon::now()->addMonth(1);
        }

        if ($duration == 'Weekly') {
            $subscriptionEnrollment->end_at = Carbon::today()->addDays(7);
        }

        if ($duration == 'Daily') {
            $subscriptionEnrollment->end_at = Carbon::today()->addDays(1);
        }

        if ($duration == 'Yearly') {
            $subscriptionEnrollment->end_at = Carbon::today()->addMonth(12);
        }

        $subscriptionEnrollment->save();

        notify()->success(translate('success'));

        return view('subscription.frontend.cart', compact('courses', 'subscription_price', 'subscription_package'));
    }

    /**
     * my_subscription
     */
    public function my_subscription()
    {
        $subscriptions = SubscriptionEnrollment::where('user_id', Auth::id())->paginate(6);

        return view('subscription.frontend.my_subscription', compact('subscriptions'));
    }

    /**
     * my_subscription_package_course
     */
    public function my_subscription_package_course($package)
    {
        switch ($package) {
            case 'Monthly':

                $sub = SubscriptionEnrollment::where('subscription_package', $package)->where('end_at', '>', Carbon::now())->where('user_id', Auth::user()->id)->count();

                if ($sub > 0) {
                    $enrolls = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

                    return view('subscription.frontend.my_subscription_coureses', compact('enrolls'));
                } else {
                    Session::flash('message', translate('Please renew your subscription.'));

                    return back();
                }

                break;

            case 'Weekly':

                $sub = SubscriptionEnrollment::where('subscription_package', $package)->where('end_at', '>', Carbon::now())->where('user_id', Auth::user()->id)->count();

                if ($sub > 0) {
                    $enrolls = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

                    return view('subscription.frontend.my_subscription_coureses', compact('enrolls'));
                } else {
                    Session::flash('message', translate('Please renew your subscription.'));

                    return back();
                }

                break;

            case 'Daily':

                $sub = SubscriptionEnrollment::where('subscription_package', $package)->where('end_at', '>', Carbon::now())->where('user_id', Auth::user()->id)->count();

                if ($sub > 0) {
                    $enrolls = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

                    return view('subscription.frontend.my_subscription_coureses', compact('enrolls'));
                } else {
                    Session::flash('message', translate('Please renew your subscription.'));

                    return back();
                }

                break;

            case 'Yearly':

                $sub = SubscriptionEnrollment::where('subscription_package', $package)->where('end_at', '>', Carbon::now())->where('user_id', Auth::user()->id)->count();

                if ($sub > 0) {
                    $enrolls = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

                    return view('subscription.frontend.my_subscription_coureses', compact('enrolls'));
                } else {
                    Session::flash('message', translate('Please renew your subscription.'));

                    return back();
                }

                break;

            case 'Free':

                $sub = SubscriptionEnrollment::where('subscription_package', $package)->where('user_id', Auth::user()->id)->count();

                if ($sub > 0) {
                    $enrolls = SubscriptionCourse::where('subscription_duration', 'LIKE', '%'.$package.'%')->with('course')->paginate(10);

                    return view('subscription.frontend.my_subscription_coureses', compact('enrolls'));
                } else {
                    Session::flash('message', translate('Please renew your subscription.'));

                    return back();
                }

                break;

            default:
                Session::flash('message', translate('Please renew your subscription.'));

                return back();
                break;
        }
    }

    /**
     * subscription_lesson_details
     */
    public function subscription_lesson_details($slug)
    {
        $s_course = Course::Published()->where('slug', $slug)->with('classes')->with('meeting')->first(); // single course details
        /*check enroll this course*/

        $enroll = SubscriptionEnrollment::where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
        if ($enroll->count() == 0) {
            return back();
        }
        $comments = CourseComment::latest()->with('user')->get();

        return view('subscription.frontend.subscription_lesson_details', compact('s_course', 'comments', 'enroll'));
    }

    /**
     * members
     */
    public function members()
    {
        if (Auth::user()->user_type == 'Admin') {
            $members = SubscriptionEnrollment::latest()->with('user')->paginate(20);

            return view('subscription.members', compact('members'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    /**
     * payments
     */
    public function payments()
    {
        if (Auth::user()->user_type == 'Admin') {
            $payments = SubscriptionCourse::latest()->with('payment')->paginate(20);
        } else {
            $payments = SubscriptionCourse::where('user_id', Auth::user()->id)->with('payment')->paginate(20);
        }

        return view('subscription.payments', compact('payments'));
    }

    /**
     * instructor_earning
     */
    public function instructor_earning()
    {
        if (Auth::user()->user_type == 'Admin') {
            $instructors = Instructor::paginate(20);

            return view('subscription.earnings', compact('instructors'));
        } else {
            return redirect()->route('subscription.instructor.earning.view', Auth::user()->id);
        }
    }

    /**
     * instructor_earning_view
     */
    public function instructor_earning_view($id)
    {
        $instructor_earning = InstructorSubscriptionEarning::where('user_id', $id)->sum('amount');
        $payments = SubscriptionCourse::latest()->with('payment')->paginate(20);

        return view('subscription.single_earning', compact('payments', 'id', 'instructor_earning'));
    }

    /**
     * earning
     */
    public function earning(Request $request)
    {
        $earning = new InstructorSubscriptionEarning();
        $earning->user_id = $request->user_id;
        $earning->amount = $request->amount;
        $earning->save();

        $instructor = Instructor::where('user_id', $request->user_id)->first();
        $instructor->balance = $instructor->balance + $earning->amount;
        $instructor->save();

        notify()->success(translate('success'));

        return back();
    }

    /**
     * REQUESTS
     */
    public function requests()
    {
        if (Auth::user()->user_type == 'Admin') {
            $courses = SubscriptionCourseRequest::with('course')->paginate(10);
        } else {
            $courses = Course::where('user_id', Auth::id())->latest()->NotFree()->paginate(10);
        }

        $durations = Subscription::all();

        return view('subscription.requests', compact('courses', 'durations'));
    }

    public function request_fire($fire, $id, $course_id)
    {
        $approve = SubscriptionCourseRequest::where('id', $id)->first();

        $add_to_course = SubscriptionCourse::where('course_id', $course_id)->first();

        if ($fire == 'approve') {
            if ($add_to_course != null) {
                $old_data = json_decode($add_to_course->subscription_duration);
                array_push($old_data, $approve->subscription_duration);
                $unique_data = array_unique($old_data);

                $add_to_course->subscription_duration = json_encode($unique_data);
                $add_to_course->save();
                $approve = SubscriptionCourseRequest::where('id', $id)->delete();

                notify()->success(translate('Approved'));
            } else {
                $new_data = json_decode($approve->subscription_duration);
                $new_array = [];
                array_push($new_array, $approve->subscription_duration);
                $new_duration_data = new SubscriptionCourse();
                $new_duration_data->course_id = $course_id;
                $new_duration_data->user_id = $approve->user_id;
                $new_duration_data->is_published = 1;
                $new_duration_data->subscription_duration = json_encode($new_array);
                $new_duration_data->save();

                notify()->success(translate('Approved'));
            }
        } else {
            SubscriptionCourseRequest::where('id', $id)->delete();

            notify()->success(translate('Declined'));
        }

        return back();
    }

    //END
}
