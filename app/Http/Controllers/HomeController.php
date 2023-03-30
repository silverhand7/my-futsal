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
}
