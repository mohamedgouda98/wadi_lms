<?php

namespace App\Http\Controllers\Module;

use Alert;
use App\Http\Controllers\Controller;
use App\Models\NotificationUser;
use Auth;

class UserNotificationController extends Controller
{
    // mark_as_read
    public function mark_as_read($id)
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $as_read = NotificationUser::all();

        foreach ($as_read as $read) {
            NotificationUser::findOrFail($id)->update([
                'is_read' => true,
            ]);
        }

        return back();
    }

    // mark_as_all_read
    public function mark_as_all_read()
    {
        if (env('DEMO') === 'YES') {
            Alert::warning('warning', 'This is demo purpose only');

            return back();
        }

        $all_read = NotificationUser::where('user_id', Auth::user()->id)->get();

        foreach ($all_read as $read) {
            NotificationUser::where('user_id', Auth::user()->id)->update([
                'is_read' => true,
            ]);
        }

        return back();
    }

    // see_all_notifications
    public function see_all_notifications($user)
    {
        $notifications = NotificationUser::latest()->where('user_id', Auth::user()->id)->get();

        return view('dashboard.notification', compact('notifications'));
    }
    // END
}
