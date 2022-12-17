<?php

namespace Tests\Unit;

use Carbon\CarbonPeriod;
use PHPUnit\Framework\TestCase;

class BookingTimeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_basic_booking_time()
    {
        $schedules = [
            [
                'start' => '12:00:00',
                'end' => '13:00:00',
            ],
            [
                'start' => '08:00:00',
                'end' => '10:00:00',
            ],
        ];
        // $time = [
        //     'start' => '10:00:00',
        //     'end' => '11:00:00'
        // ];
        $time = [
            'start' => '10:00:00',
            'end' => '11:00:00'
        ];
        $result = false;
        foreach ($schedules as $schedule) {
            $periods = CarbonPeriod::since($schedule['start'])->minutes(1)->until($schedule['end'])->toArray();
            foreach ($periods as $period) {
                if ($time['start'] !== $period->format('H:i')) {
                    $result = true;
                }
            }
        }
        dd($result);
        $this->assertTrue(true);
    }
}
