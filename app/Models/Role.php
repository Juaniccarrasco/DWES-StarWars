<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory;
    protected $primaryKey ='id_role';
    protected $fillable= ['description'];
    public $timestamps= false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'id_role', 'id_user')
        ->using(User_Role::class);
    }
}
