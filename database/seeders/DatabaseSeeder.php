<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Booking::insert([
            [
                'field_id' => 1,
                'date' => '2022-12-17',
                'starting_hour' => '10:00:00',
                'starting_time' => '2022-12-17 10:00:00',
                'ending_hour' => '13:00:00',
                'ending_time' => '2022-12-17 13:00:00',
                'note' => 1,
                'proof_of_payment' => 1,
                'status' => 'booked',
                'customer_id' => 1
            ],
            [
                'field_id' => 1,
                'date' => '2022-12-17',
                'starting_hour' => '17:00:00',
                'starting_time' => '2022-12-17 10:00:00',
                'ending_hour' => '19:00:00',
                'ending_time' => '2022-12-17 13:00:00',
                'note' => 1,
                'proof_of_payment' => 1,
                'status' => 'booked',
                'customer_id' => 1
            ]
        ]);
    }
}
