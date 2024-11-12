<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
        'name',
        'capacity',
        'description',
    ];

     //? Un espacio puede tener muchas reservas
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
