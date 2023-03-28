<?php

namespace Tests\Unit;

use App\Models\Booking;
use Carbon\CarbonPeriod;
use Tests\TestCase;

class BookingTimeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_basic_booking_time()
    {
        // $schedules = collect([[
        //     'name' => 'hello',
        //     'start' => 1671307200, //20
        //     'end' => 1671318000 //23
        // ]]);

        // $input = [
        //     'name' => 'test',
        //     'start' => 1671310800, //21
        //     'end' => 1671314400, //22
        //     // 'start' => 1671303600, // 19
        //     // 'end' => 1671307200 // 20
        // ];

        // $data = $schedules->whereBetween('start', [$input['start'], $input['end']]);
        // dd($data->count());

        
        /**
         * Scenario:
         * Lapangan normal dapat dipesan di jam yang sama sebanyak 2x. 
         * Jika memesan lapangan besar maka lapangan normal tidak dapat dipesan di jam yang sama.
         * 
         * 
         * WHERE STARTING_TIME BETWEEN INPUT STARTING_TIME AND INPUT ENDING TIME
         * WHERE ENDING_TIME BETWEEN INPUT STARTING_TIME AND INPUT ENDING TIME
         */
        $input = [
            // 'starting_time' => '21:00:00', 
            // 'ending_time' => '22:00:00',
            // 'starting_time' => '19:00:00', 
            // 'ending_time' => '20:00:00',
            'starting_time' => '19:30:00', 
            'ending_time' => '20:30:00',
        ];
        // Jika ada event jam 20-24 masih gagal
        /**
         * Update: untuk even jam 21-22 sudah mau jika ada event dijam 20 tidak akan terinput jika sudah ada event dijam 20-24
         * Update: sudah mau jika ada event jam 19:30-20:30 tapi sudah terbooking di jam 20-24
         */

        // $bookings = Booking::whereBetween('starting_hour', [$input['starting_time'], $input['ending_time']])
        // ->orWhereBetween('ending_hour', [$input['starting_time'], $input['ending_time']])
        // ->get();
        $bookings = Booking::where(function($query) use ($input){
            $query->whereRaw("'$input[starting_time]' BETWEEN starting_hour and ending_hour");
        })
        ->orWhere(function($query) use($input) {
            $query->whereRaw("'$input[ending_time]' BETWEEN starting_hour and ending_hour");
        })
        ->where('ending_hour', '!=', $input['starting_time'])
        ->get();
        //dd($bookings);
        dd($bookings->count());
    }
}
