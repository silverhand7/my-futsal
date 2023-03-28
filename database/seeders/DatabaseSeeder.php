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
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'level' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
            'level' => 'owner'
        ]);

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
