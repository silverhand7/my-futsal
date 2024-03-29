<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use App\Rules\BookingDateRule;
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
            'fields' => Field::where('name', '!=', 'Lapangan Tidak Tersedia')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'field_id' => ['required'],
            'date' => ['required', new BookingDateRule()],
            'starting_hour' => ['required'],
            'duration' => ['required', 'numeric'],
        ]);

        $date = $request->date;
        $startingHour = explode(' - ', $request->starting_hour)[0];

        if ($date == Carbon::now()->toDateString()) {
            if ($startingHour < Carbon::now()->format("H").'00') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unable to book at hours that have passed.',
                ], 500);
            }
        }

        $ending = Carbon::parse($date . ' ' . $startingHour)->addHour($request->duration);

        $startingTimestamp = Carbon::parse($date . ' ' .$startingHour)->timestamp;
        $endingTimestamp = $ending->timestamp;
        $field = $request->field_id;

        $bookings = Booking::getBookedTime($field, $date, $startingTimestamp, $endingTimestamp);

        if ($bookings->count() >= 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to book the field because at that time and date the field was already booked or not available.',
            ], 422);
        }

        $booking = Booking::create([
            'field_id' => $request->field_id,
            'date' => $date,
            'starting_hour' => $startingHour,
            'starting_timestamp' => $startingTimestamp,
            'ending_hour' => $ending->format('H:i'),
            'ending_timestamp' => $endingTimestamp,
            'duration' => $request->duration,
            'status' => 'pending',
            'customer_id' => auth()->guard('customer')->user()->id,
        ]);

        return [
            'data' => $booking,
            'path' => route('customer.booking.detail', $booking->id),
        ];

        // return redirect()->route('customer.booking.detail', $booking->id)->with('success', 'Berhasil membuat booking, silahkan lengkapi pembayaran');
    }

    public function bookingList()
    {
        return view('customer.booking-list', [
            'bookings' => Booking::where('customer_id', auth()->guard('customer')->user()->id)->orderBy('id', 'desc')->get()
        ]);
    }

    public function detail($id)
    {
        return view('customer.booking-detail', [
            'booking' => Booking::findOrFail($id)
        ]);
    }

    public function paymentAction(Request $request, $id)
    {
        $request->validate([
            'proof_of_payment' => ['required'],
        ]);

        $fileName = $request->file('proof_of_payment')->store('proof_of_payment');

        Booking::findOrFail($id)
            ->update([
                'proof_of_payment' => $fileName,
                'status' => 'paid'
            ]);

        return redirect()->back()->with('success', 'Congratulations on successfully uploaded the proof of payment! We will immediately process your order.');
    }

    public function checkExpiredBooking()
    {
        Booking::where('created_at', '<', \Carbon\Carbon::now()->subMinutes(15))
            ->where('status', 'pending')
            ->update([
                'status' => 'canceled'
            ]);
        return "Booking checked!";
    }
}
