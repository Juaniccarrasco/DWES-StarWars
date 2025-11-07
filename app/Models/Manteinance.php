<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manteinance extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id_maintenance';
    protected $fillable = ['id_ship', 'description', 'cost', 'date'];
}
