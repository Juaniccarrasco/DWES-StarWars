<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pilot;
use App\Models\Planet;
use App\Models\Ship;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ship>
 */
class ShipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //protected $fillable = ['name_ship', 'model', 'class', 'tripulation', 'passengers'];
            'name_ship' => $this->faker->randomElement(['Tie advanced','Y wing','X wing','Transport']),
            'model' => $this->faker->randomElement(['BTL', 'T65', 'Twin Ion Engine','Space C-15']),
            'class' => $this->faker->randomElement(['Assault', 'Battle', 'Cargo']),
            'id_planet' => null,
            'tripulation' => rand(1,25),
            'passengers' => rand(0,300)
        ];
    }

    public function configure(): static
    {
        return $this
        ->afterCreating(function ($ship) {
            $pilotOwners = rand(0,2);
            $pilots = Pilot::inRandomOrder()->take($pilotOwners)->get();

            foreach ($pilots as $pilot) {
                $ship->pilots()->attach($pilot->id_pilot,[
                    'assigned' => now(),
                    'unassigned' =>null
                ]);
            }
        })
        
        ->afterCreating(function ($ship) {
            $planet = Planet::inRandomOrder()->first();
            $rand= rand(1,2);
            if($rand==1){
                $ship->planet()->associate($planet)->save();
            }
        })

        // ->afterCreating(function($ship){
        //     Planet::whereIn('id', [1,2,3])->update(['ship_id' => $ship->id]);
        // })

        // ->afterMaking(function ($profesor, $faker) {
        //    // Hacemos lo que sea con los datos del modelo del profesor antes de guardarlo definitivamente en la base de datos.
        //    // $profesor->save();
        // })
        ;
    }
}
