<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    protected $primaryKey = 'id_pilot';
    protected $fillable = ['name_pilot', 'height', 'birth_year', 'gender'];
    
    function pilotOfShips(){
        return $this->belongsToMany(Ship::class, 'id_ship', 'id_ship')
        ->using(Ship_Pilot::class)
        ->withPivot('associated','unassigned','reassigned')
        ->withTimestamps();
    }
}
