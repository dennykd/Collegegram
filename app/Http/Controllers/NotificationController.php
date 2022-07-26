<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications', [
            'title' => 'Notifications'
        ]);
    }

    public function removeAll()
    {
        $notifs = Notification::where('to_user_id', auth()->user()->id)->where('show', true)->get();
        foreach ($notifs as $notif) {
            $notif->show = false;
            $notif->save();
        }
        return response()->json(['changedNotif' => $notifs, 'status' => 'success']);
    }

    public function remove(Request $request)
    {
        $notif = Notification::find($request->notif_id);
        $notif->show = false;
        $notifs = Notification::where('to_user_id', auth()->user()->id)->where('show', true)->get();
        $notif->save();
        return response()->json(['changedNotif' => $notif, 'status' => 'success', 'notifs' => $notifs]);
    }

    public function getNotif()
    {
        $notifs = Notification::where('to_user_id', auth()->user()->id)->where('show', true)->take(8)->get();
        $data = view('notifications', [
            'notifs' => $notifs,
        ])->render();
        return response()->json(['html' => $data, 'success' => true]);
    }
}
