<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function lapangan()
    {
        return view('lapangan');
    }

    public function event()
    {
        return view('event', [
            'events' => Event::where('status', 'active')->orderBy('start_date', 'desc')->get()
        ]);
    }

    public function eventDetail($id)
    {
        return view('event-detail', [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function readNotifications()
    {
        return auth()->guard('customer')->user()->readNotifications();
    }

    public function watchNewNotifications()
    {
        $notifications = auth()->guard('customer')->user()->watchNewNotifications();
        return [
            'count' => $notifications->count(),
            'data' => $notifications->map(function($notification) {
                $data = json_decode($notification->data);
                $data->id = $notification->id;
                return $data;
            }),
        ];
    }
}
