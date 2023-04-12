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
        foreach (User::all() as $user) {
            $user->notify(
                NovaNotification::make()
                    ->message('Booking ID: ' . $booking->id . ' - ' . $booking->field->name . ' terbooking pada tanggal ' . $booking->date->format('d-m-Y') . ' selama ' . $booking->duration . ' jam, dari jam ' . $booking->starting_hour . ' sampai ' . $booking->ending_hour.'.')
                    ->url('/resources/bookings/'.$booking->id)
                    ->icon('collection')
                    ->type('info')
            );
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
        if ($booking->status == 'paid' || $booking->status == 'canceled') {
            foreach (User::all() as $user) {
                if ($booking->status == 'paid') {
                    $message = 'Booking ID: ' . $booking->id . ' - sudah dibayar.';
                }
                if ($booking->status == 'canceled') {
                    $message = 'Booking ID: ' . $booking->id . ' - dibatalkan.';
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

        $customer = $booking->customer;
        if ($booking->status == 'canceled') {
            $message = 'Booking anda dengan ID ' . $booking->id . ' telah dibatalkan.';
        }
        if ($booking->status == 'booked') {
            $message = 'Booking anda dengan ID ' . $booking->id . ' sudah dikonfirmasi.';
        }
        if ($booking->status == 'rejected') {
            $message = 'Booking anda dengan ID ' . $booking->id . ' ditolak.';
        }

        $customer->notify(
            NovaNotification::make()
                ->message($message)
                ->url(route('customer.booking.detail', $booking->id))
                ->icon('collection')
                ->type('info')
        );
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
