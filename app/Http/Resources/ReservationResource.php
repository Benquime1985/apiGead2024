<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'Usuario' => "ID: {$this->user->id} - {$this->user->name}",
            'Espacio' => "ID: {$this->space->id} - {$this->space->name}",
            'Fecha Reserva' => $this->reservation_date,
            'Fecha de inico' => $this-> start_date,
            'Fecha finalizacion' => $this->end_date,
            'Hora Inicio' => $this->start_time,
            'Hora Finalizacion' => $this->end_time,
            'Archivo Subido' => $this->uploaded_job,
            'Reservacion Estados' => $this->status,
            'Comentarios' => $this->reservation_details,
            'Servicos e Insumos' => ItemsAndServicesResource::collection($this->whenLoaded('itemsandservices')),
            'Equipos' => EquipmentResource::collection($this->whenLoaded('equipments')),
        ];
    }
}
