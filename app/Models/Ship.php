<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    //protected $table = 'ships'; //Por defecto tomaría la tabla 'nombre + s' que no existe.
    //protected $primaryKey = ['dni', 'matricula'];
    protected $primaryKey = 'id_ship';
    //protected $keyType = ['string','string'];
    //public $incrementing = true; //Para indicarle que la clave no es autoincremental. (Ya lo cumple).
    //protected $keyType = 'int';   //Indicamos que la clave no es entera. (Ya lo cumple).
    public $timestamps = false;   //Con esto Eloquent no maneja automáticamente created_at ni updated_at.
    //protected $hidden = ['dni','matricula'];
    protected $fillable = ['name_ship', 'model', 'class', 'tripulation', 'passengers'];
    
//Documentación Laravel:
    // class Comment extends Model
    // {
        // public function post(): BelongsTo
        // {
        //     return $this->belongsTo(Post::class); (DA POR HECHO post_id SI NO, ESPECIFICAR) 
        // }
    // }

    function shipOfPlanet(){
        return $this->belongsTo(Planet::class, 'id_planet');
    }

    belongsToMany(
    RelatedModel::class,     // 1. Modelo relacionado
    'pivot_table',           // 2. Nombre de la tabla pivote
    'foreign_key',           // 3. Clave foránea del modelo actual
    'related_key'            // 4. Clave foránea del modelo relacionado
)
return $this->belongsToMany(Ship::class, 'ship_pilots', 'id_pilot', 'id_ship');
    
    function shipOfPilot(){
        return $this->belongsToMany(Pilot::class, 'id_pilot')
        ->using(Ship_Pilot::class)
        ->withPivot('associated','reassigned','unassigned')
        ->withTimestamps();
    }
    
}
