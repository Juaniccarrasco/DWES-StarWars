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
        //protected $fillable = ['name_planet', 'population', 'climate', 'id_ship', 'rotation_period'];
        return [
            'name_planet' => $this->faker->randomElement(['Dagobah', 'Naboo', 'Tatooine', 'Kenari', 'Endor', 'Yavin', 'Coruscant']),
            'population' => $this->faker->numberBetween(0,900000),
            'climate' => $this->faker->randomElement(['primavera', 'verano', 'otoño', 'invierno']),
            //'id_ship' => Ship::inRandomOrder()->first()?->id_ship,
            'id_ship' => Ship::inRandomOrder()->take(2)->pluck('id_ship')->toArray(),
            'rotation_period' => $this->faker->numberBetween(0,180000),
        ];
    }
}
