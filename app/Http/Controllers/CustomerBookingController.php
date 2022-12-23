<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerBookingController extends Controller
{
    public function getBookings()
    {
        $bookings = Booking::getBookingsCalendar();

        return $bookings;
    }

    public function form()
    {
        return view('customer.booking-form', [
            'fields' => Field::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_id' => ['required'],
            'date' => ['required'],
            'starting_hour' => ['required'],
            'duration' => ['required', 'numeric', 'max:5'],
        ]);
    }
}
