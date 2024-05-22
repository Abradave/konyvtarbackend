<?php

namespace Database\Seeders;

use App\Models\Rentals;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rentals::factory(15)->create();
    }
}
