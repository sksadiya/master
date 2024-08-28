<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();

            // Redirect to the URL stored in the notification's data
            return redirect($notification->data['url']);
        }

        return redirect()->back()->with('error', 'Notification not found.');
    }
    public function delete(Request $request)
{
    $notificationIds = $request->input('notification_ids', []);

    // Delete notifications for the authenticated user
    Auth::user()->notifications()->whereIn('id', $notificationIds)->delete();

    return response()->json(['success' => true]);
}
}
