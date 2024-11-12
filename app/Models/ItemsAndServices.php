<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsAndServices extends Model
{
    protected $fillable = [
        'name',
        'departure'
    ];

    //? Obtiene las reservaciones que pertenecen al item o servicio.
    public function reservations(){
        return $this->belongsToMany(Reservation::class, 'reservation_items_and_services')
                    ->withTimestamps();
    }
}
