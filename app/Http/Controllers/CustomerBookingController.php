<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerBookingController extends Controller
{
    public function getBookings()
    {
        $bookings = Booking::whereBetween('date', [Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')])
        ->where('status', 'booked')
        ->get();
        $bookingsData = [];
        foreach ($bookings as $booking) {
            $bookingsData[] = [
                'id' => $booking->id,
                'title' => 'booking-' . $booking->id,
                'start' => $booking->date->format('Y-m-d').'T'.$booking->starting_hour,
                'end' => $booking->date->format('Y-m-d').'T'.$booking->ending_hour
            ];
        }

        return $bookingsData;
    }
}
