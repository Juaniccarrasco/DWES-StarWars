<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ship;

class ShipSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ship::factory()->count(20)->create();
    }

    
}
