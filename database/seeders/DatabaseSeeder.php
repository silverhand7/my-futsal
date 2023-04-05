<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
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
        \App\Models\User::updateOrcreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'level' => 'admin'
        ]);

        \App\Models\User::updateOrCreate([
            'email' => 'owner@example.com',
        ], [
            'name' => 'Owner',
            'password' => bcrypt('password'),
            'level' => 'owner'
        ]);

        \App\Models\Field::updateOrCreate([
            'name' => 'Lapangan Normal 1',
        ], [
            'size' => 'normal',
            'hourly_rate' => 200000,
            'note' => ''
        ]);

        \App\Models\Field::updateOrCreate([
            'name' => 'Lapangan Normal 2',
        ], [
            'size' => 'normal',
            'hourly_rate' => 200000,
            'note' => ''
        ]);

        \App\Models\Field::updateOrCreate([
            'name' => 'Lapangan Besar',
        ], [
            'size' => 'normal',
            'hourly_rate' => 400000,
            'note' => ''
        ]);

        \App\Models\Field::updateOrCreate([
            'name' => 'Lapangan Tidak Tersedia',
        ], [
            'size' => 'big',
            'hourly_rate' => 0,
            'note' => ''
        ]);

        //Category::factory(5)->create();
        //Product::factory(10)->create();
        Sale::factory(150)->create();
    }
}
