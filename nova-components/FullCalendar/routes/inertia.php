<?php

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;

/*
|--------------------------------------------------------------------------
| Tool Routes
|--------------------------------------------------------------------------
|
| Here is where you may register Inertia routes for your tool. These are
| loaded by the ServiceProvider of the tool. The routes are protected
| by your tool's "Authorize" middleware by default. Now - go build!
|
*/

Route::get('/', function (NovaRequest $request) {
    $bookings = Booking::whereBetween('date', [Carbon::now()->startOfMonth()->format('Y-m-d'), Carbon::now()->endOfMonth()->format('Y-m-d')])
    ->whereNotIn('status', ['rejected', 'canceled'])
    ->get();
    $bookingsData = [];
    foreach ($bookings as $booking) {
        $bookingsData[] = [
            'id' => $booking->id,
            'title' => ($booking->field->name != 'Lapangan Tidak Tersedia') ? $booking->field->name : $booking->field->name . ' – ' . $booking->note,
            'color' => $booking->event_color,
            'start' => $booking->date->format('Y-m-d').'T'.$booking->starting_hour,
            'end' => $booking->date->format('Y-m-d').'T'.$booking->ending_hour
        ];
    }

    return inertia('FullCalendar', [
        'bookings' => $bookingsData
    ]);
});
