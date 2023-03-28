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

        \App\Models\Field::insert([
            [
                'name' => 'Lapangan Normal 1',
                'size' => 'normal',
                'hourly_rate' => 100000,
                'note' => ''
            ],
            [
                'name' => 'Lapangan Normal 2',
                'size' => 'normal',
                'hourly_rate' => 100000,
                'note' => ''
            ],
            [
                'name' => 'Lapangan Besar',
                'size' => 'big',
                'hourly_rate' => 200000,
                'note' => ''
            ],
        ]);
    }
}
