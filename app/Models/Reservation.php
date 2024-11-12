<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'space_id',
        'reservation_date',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'event_type',
        'uploaded_job',
        'reservation_details',
        'requisition_number',
    ];

    //? Una reserva pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    //? Una reserva pertenece a un espacio
    public function space(){
        return $this->belongsTo(Space::class);
    }

    //? Obtiene los items y servicios que pertenecen a la reservación.
public function itemsAndServices(){
    return $this->belongsToMany(ItemsAndServices::class, 'reservation_items_and_services', 'reservation_id', 'item_and_service_id');
}

    //? Obtiene los equipos que pertenecen a la reservación.
    public function equipments(){
        return $this->belongsToMany(Equipment::class, 'reservation_equipment');
    }
}
