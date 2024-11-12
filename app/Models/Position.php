<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name'
    ];

    //? Obtiene los usuarios que pertenecen a la posición.
    public function users(){
        return $this->hasMany(User::class);
    }
}
