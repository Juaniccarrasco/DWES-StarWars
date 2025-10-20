<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pilot;
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
            'tripulation' => $this->faker->random_int(1,5),
            'passengers' => $this->faker->random_int(1,300)
        ];
    }

    public function configure(): static
    {
        return $this
        ->afterCreating(function ($ship) {
            $pilotOwners = rand(0,2); // Cambia esto al número deseado de partes por profesor.
            $pilotsIds = Pilot::inRandomOrder()->take($pilotOwners)->pluck('id_pilot')->toArray();
            $ship->pilots()->attach($pilotsIds);
        })
        // ->afterCreating(function ($ship) {
        //     $pilotOwners = Pilot::factory()->count(rand(0, 2))->create();
        //     $ship->pilots()->attach($pilotOwners->pluck('id'));
        // })

        // ->afterMaking(function ($profesor, $faker) {
        //    // Hacemos lo que sea con los datos del modelo del profesor antes de guardarlo definitivamente en la base de datos.
        //    // $profesor->save();
        // })
        ;
    }
}
