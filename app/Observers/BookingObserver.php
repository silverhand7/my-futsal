<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\User;
use Laravel\Nova\Notifications\NovaNotification;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function created(Booking $booking)
    {
        if ($booking->field_id != 4) {
            foreach (User::all() as $user) {
                $user->notify(
                    NovaNotification::make()
                        ->message('Booking ID: ' . $booking->id . ' - ' . $booking->field->name . ' is booked on ' . $booking->date->format('d-m-Y') . ' for ' . $booking->duration . ' hours, from ' . $booking->starting_hour . ' to ' . $booking->ending_hour.'.')
                        ->url('/resources/bookings/'.$booking->id)
                        ->icon('collection')
                        ->type('info')
                );
            }
        }
    }

    /**
     * Handle the Booking "updated" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function updated(Booking $booking)
    {
        if ($booking->field_id != 4) {
            if ($booking->status == 'paid' || $booking->status == 'canceled') {
                foreach (User::all() as $user) {
                    if ($booking->status == 'paid') {
                        $message = 'Booking ID: ' . $booking->id . ' - has been paid.';
                    }
                    if ($booking->status == 'canceled') {
                        $message = 'Booking ID: ' . $booking->id . ' - has been canceled.';
                    }
                    $user->notify(
                        NovaNotification::make()
                            ->message($message)
                            ->url('/resources/bookings/'.$booking->id)
                            ->icon('collection')
                            ->type('info')
                    );
                }
            }

            if (in_array($booking->status, ['canceled', 'booked', 'rejected'])) {
                $customer = $booking->customer;
                if ($booking->status == 'canceled') {
                    $message = 'Your Booking ID ' . $booking->id . ' has been canceled.';
                }
                if ($booking->status == 'booked') {
                    $message = 'Your Booking ID ' . $booking->id . ' has been confirmed.';
                }
                if ($booking->status == 'rejected') {
                    $message = 'Your Booking ID ' . $booking->id . ' has been rejected.';
                }

                $customer->notify(
                    NovaNotification::make()
                        ->message($message)
                        ->url(route('customer.booking.detail', $booking->id))
                        ->icon('collection')
                        ->type('info')
                );
            }
        }
    }

    /**
     * Handle the Booking "deleted" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function deleted(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function restored(Booking $booking)
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     *
     * @param  \App\Models\Booking  $booking
     * @return void
     */
    public function forceDeleted(Booking $booking)
    {
        //
    }
}
