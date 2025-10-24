<?php

namespace Database\Factories;

use App\Models\Ship;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Planet>
 */
class PlanetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //protected $fillable = ['name_planet', 'population', 'climate', 'rotation_period'];
        return [
            'name_planet' => $this->faker->randomElement(['Dagobah', 'Naboo', 'Tatooine', 'Kenari', 'Endor', 'Yavin', 'Coruscant']),
            'population' => $this->faker->numberBetween(0,900000),
            'climate' => $this->faker->randomElement(['primavera', 'verano', 'otoño', 'invierno']),
            'rotation_period' => $this->faker->numberBetween(0,180000),
        ];
    }

    public function configure(): static
    {
        return $this
        ->afterCreating(function ($planet) {
            $shipNumber = rand(0,2);
            $ships = Ship::inRandomOrder()->take($shipNumber)->get();
            foreach ($ships as $ship) {
                $ship->id_planet = $planet->id_planet;
                $ship->save();
            }
            
        });
    
    }
}
