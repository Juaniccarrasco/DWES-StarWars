<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\User_Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $descriptions = ['admin', 'manager', 'user'];
    
    public function definition(): array
    {
        return [
            'description' => array_shift(self::$descriptions),
        ];            
    }

    public function configure(): static
    {
        return $this
        ->afterCreating(function ($role) {
            $num=2;
            if($role->description=='user'){
                $num=20;
            }
            $users= User::factory($num)->create();
            foreach($users as $user){
                // User_Role::create([
                //     'id_user' => $user->id,
                //     'id_role' => $role->id,

                // ]);
                $user->roles()->attach($role->id_role);
            }
        });
    }
}
