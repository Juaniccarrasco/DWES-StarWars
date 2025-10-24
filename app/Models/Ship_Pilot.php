<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Ship_Pilot extends Pivot
{
    //si quitamos de la clase la barra baja pero dejamos el camelCase te poner el nombre automático,
    //si no, no
    protected $table = 'ship_pilots';
    protected $primaryKey=['id_ship','id_pilot'];
    public $incrementing= false;
    //Este fillable es para asignaciones masivas, tal y como lo voy a hacer mediante seeder se puede generar pilotos, naves y luego asignar los id de estos manualmente a la tabla
    protected $fillable = ['id_ship', 'id_pilot', 'assigned', 'unassigned'];
    //si asingamos con seeders, podemos, tal y como está planteada la tabla, hacer asignaciones
    //solo de id de piloto e id de nave y guardar:
    // $shipPilot->id_ship = ...;
    // $shipPilot->id_pilot = ...;
    // $shipPilot->save();

}