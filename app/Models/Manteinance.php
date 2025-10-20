<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manteinance extends Model
{
    
    protected $primaryKey = 'id_manteinance';
    protected $fillable = ['id_ship', 'date_manteinance', 'description', 'cost'];
}
