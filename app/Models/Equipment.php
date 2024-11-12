<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{

    protected $fillable = [
        'name',
    ];

    //? Obtiene las reservaciones que pertenecen al equipo.
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_equipment')
                    ->withTimestamps();
    }
}
