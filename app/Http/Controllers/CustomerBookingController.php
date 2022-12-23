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
        $ending = Carbon::parse($request->starting_hour)->addHour($request->duration);

        $startingTimestamp = Carbon::parse($request->starting_hour)->timestamp;
        $endingTimestamp = $ending->timestamp;
        $date = $request->date;
        $field = $request->field_id;

        $bookings = Booking::getBookedTime($field, $date, $startingTimestamp, $endingTimestamp, $request->resourceId);
        //dd($field, $startingTimestamp, $endingTimestamp, $bookings);
        if ($bookings->count() >= 1) {
            return redirect()->back()->with('error', 'Gagal membooking lapangan karena dijam dan tanggal tersebut lapangan sudah terbooking.');
        }

        Booking::create([
            'field_id' => $request->field_id,
            'date' => $date,
            'starting_hour' => $request->starting_hour,
            'starting_timestamp' => $startingTimestamp,
            'ending_hour' => $ending->format('H:i'),
            'ending_timestamp' => $endingTimestamp,
            'duration' => $request->duration,
            'status' => 'pending',
            'customer_id' => auth()->guard('customer')->user()->id,
        ]);

        return redirect()->back()->with('success', 'Berhasil membuat booking, silahkan lengkapi pembayaran');
    }
}
