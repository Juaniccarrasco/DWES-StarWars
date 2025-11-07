<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User_Role extends Pivot
{
    protected $table = 'role_user';
    protected $primaryKey=['id_role','id_user'];
    public $incrementing= false;
    protected $fillable = ['id_role','id_user'];
}
