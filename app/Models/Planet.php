<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_planet';
    protected $fillable = ['name_planet', 'population', 'climate', 'rotation_period'];
    public $timestamps= false;

    function ships(){
        return $this->hasMany(Ship::class);
    }
}
