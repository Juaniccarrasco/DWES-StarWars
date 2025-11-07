<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'id_user', 'id_role')
                    ->using(User_Role::class);
    }


    function ships(){
        return $this->belongsToMany(Ship::class, 'ship_pilots', 'id_pilot', 'id_ship')
        ->using(Ship_Pilot::class)
        ->withPivot('assigned','unassigned')
        ->withTimestamps();
        //Para mostrar el histórico comentamos la siguiente linea, 
            //si quisieramos los actualmente asignados la descomentariamos:
        //->wherePivot('unassigned', null);
    }


}
