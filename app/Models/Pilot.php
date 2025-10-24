<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pilot';
    protected $fillable = ['name_pilot', 'height', 'birth_year', 'gender'];
    public $timestamps= false;
    
    function ships(){
        return $this->belongsToMany(Ship::class, 'ship_pilots', 'id_pilot', 'id_ship')
        ->using(Ship_Pilot::class)
        ->withPivot('assigned','unassigned')
        ->withTimestamps()
        ->wherePivot('unassigned', null);
    }
}
