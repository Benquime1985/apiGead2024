<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    //? Un Rol es unico para cada usuario
    public function users(){
        return $this->hasMany(User::class);
    }
}
