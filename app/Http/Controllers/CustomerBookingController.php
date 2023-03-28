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
            return redirect()
                ->back()
                ->withInput($request->toArray())
                ->with('error', 'Gagal membooking lapangan karena dijam dan tanggal tersebut lapangan sudah terbooking.');
        }

        $booking = Booking::create([
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

        return redirect()->route('customer.booking.detail', $booking->id)->with('success', 'Berhasil membuat booking, silahkan lengkapi pembayaran');
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

        return redirect()->back()->with('success', 'Berhasil mengupload bukti pembayaran, kami akan segera memproses booking anda.');
    }

    public function checkExpiredBooking()
    {
        Booking::where('created_at', '<', \Carbon\Carbon::now()->subHour(1))
            ->where('status', 'pending')
            ->update([
                'status' => 'canceled'
            ]);
        return "Booking checked!";
    }
}
