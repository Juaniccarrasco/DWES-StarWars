<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    protected $primaryKey = 'id_planet';
    protected $fillable = ['name_planet', 'population', 'climate', 'id_ship', 'rotation_period'];
    
    function planetShips(){
        return $this->hasMany(Ship::class, 'id_ship', 'id_ship');
    }
}
