<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pilot>
 */
class PilotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //protected $fillable = ['name_pilot', 'height', 'birth_year', 'gender'];
        return [
            'name_pilot' => $this->faker->name(),
            'height' => $this->faker->numberBetween(150,300),
            'birth_year' => $this->faker->numberBetween(-150,0),
            'gender' => $this->faker->randomElement(["Wookiee",
                                                    "Togruta",
                                                    "Twi'lek",
                                                    "Chiss",
                                                    "Zabrak",
                                                    "Gungan",
                                                    "Kaminoano",
                                                    "Nautolano",
                                                    "Mon Calamari",
                                                    "Cyborg",
                                                    "Clon",
                                                    "Ser de la Fuerza"
                                                    ])
        ];
    }
}
