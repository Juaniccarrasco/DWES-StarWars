<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Planet;

class PlanetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Planet::factory()->count(3)->create();

    //Las relaciones no lo soportan, porque una nave no puede estar asociada a varios planetas
        // $planet = Planet::find(1);
        // Ship::whereIn('id', [10, 11, 12])->update(['planet_id' => $planet->id]);
    
        // Planet::factory()
        // ->has(Ship::factory()->count(3))
        // ->create();
        
    // Crear 5 planetas, cada uno con 3 naves
        // Planet::factory()
        // ->count(5)
        // ->has(Ship::factory()->count(3))
        // ->create();

        // Planet::factory()
        // ->count(5)
        // ->has(
        //     Ship::factory()
        //         ->count(3)
        //         ->hasAttached(
        //             Pilot::factory()->count(2),
        //             ['assigned' => now(), 'unassigned' => null]
        //         )
        // )
        // ->create();



    }
}
